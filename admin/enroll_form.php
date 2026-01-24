<?php
include 'session_login.php';
include '../db_connection.php';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
header('Content-Type: application/json'); // ✅ JSON response

if (!$conn) {
    die(json_encode(["error" => "Database connection failed: " . mysqli_connect_error()], JSON_PRETTY_PRINT));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'enroll') {

    $admission_id      = intval($_POST['id'] ?? 0);
    $payment_plan      = $_POST['payment_plan'] ?? '';
    $enrolled_section  = $_POST['enrolled_section'] ?? '';
    $tuition_fee       = floatval($_POST['tuition_fee'] ?? 0);
    $miscellaneous     = floatval($_POST['miscellaneous'] ?? 0);
    $uniform_raw       = $_POST['uniform'] ?? "0";
    $uniform           = floatval(preg_replace('/[^\d.]/', '', $uniform_raw));
    $discount_type     = trim($_POST['discount_type'] ?? '');
    $discount_value    = floatval($_POST['discount_value'] ?? 0);
    $downpayment       = floatval($_POST['down'] ?? 2500.00); // default reg fee if not given
    $uniform_cart      = $_POST['uniform_cart'] ?? '[]';

    $decoded_cart = json_decode($uniform_cart, true);
    $total = $tuition_fee + $miscellaneous + $uniform;

    // ✅ Calculate discount
    $discount = 0.00;
    if ($discount_type === 'percent') {
        $discount = ($discount_value > 0 && $discount_value <= 100) ? ($total * ($discount_value / 100)) : 0;
    } elseif ($discount_type === 'fixed') {
        $discount = ($discount_value > 0 && $discount_value <= $total) ? $discount_value : 0;
    }

    if ($admission_id <= 0 || empty($payment_plan)) {
        echo json_encode(["error" => "Invalid form data"], JSON_PRETTY_PRINT);
        exit;
    }

    // 🔹 Function to generate unique 8-digit account number
    function generateUniqueAccountNumber($conn) {
        do {
            $account_number = str_pad(mt_rand(0, 99999999), 8, "0", STR_PAD_LEFT);
            $check = $conn->prepare("SELECT COUNT(*) FROM student_tuition WHERE account_number = ?");
            $check->bind_param("s", $account_number);
            $check->execute();
            $check->bind_result($count);
            $check->fetch();
            $check->close();
        } while ($count > 0); // Repeat until unique
        return $account_number;
    }

    // ✅ Generate Account Number
    $account_number = generateUniqueAccountNumber($conn);

    // ✅ Generate Student Number (Format: YYYY-XXXXX)
    $year = date("Y");
    $randomDigits = str_pad(mt_rand(0, 99999), 5, "0", STR_PAD_LEFT);
    $student_number = $year . "-" . $randomDigits;

    // ✅ Enrolled Date
    $enrolled_date = date("Y-m-d H:i:s");

    // ✅ Check for duplicate LRN (allow "00000000000" to be duplicated)
    $sqlCheckLRN = "SELECT lrn FROM admission_form WHERE id = ?";
    $stmt = $conn->prepare($sqlCheckLRN);
    $stmt->bind_param("i", $admission_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admission_data = $result->fetch_assoc();
    $stmt->close();

    if ($admission_data) {
        $lrn = $admission_data['lrn'];
        
        // Only check for duplicates if LRN is NOT "00000000000"
        if ($lrn !== "00000000000" && $lrn !== null && $lrn !== '') {
            $sqlCheckDuplicate = "SELECT COUNT(*) as count FROM student_information WHERE lrn = ?";
            $stmt = $conn->prepare($sqlCheckDuplicate);
            $stmt->bind_param("s", $lrn);
            $stmt->execute();
            $result = $stmt->get_result();
            $duplicate_check = $result->fetch_assoc();
            $stmt->close();

            if ($duplicate_check && $duplicate_check['count'] > 0) {
                echo json_encode(["error" => "Duplicate LRN: This LRN already exists in the system"], JSON_PRETTY_PRINT);
                exit;
            }
        }
    }

    try {
        $conn->begin_transaction();

        // 1️⃣ Move admission record → student_information
        // Use INSERT IGNORE for "00000000000" to allow duplicates, otherwise use regular INSERT
        $is_zero_lrn = ($lrn === "00000000000");
        $sqlMove = $is_zero_lrn 
            ? "INSERT IGNORE INTO student_information (
                student_number, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
                birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
                father_name, father_occupation, father_contact,
                mother_name, mother_occupation, mother_contact,
                guardian_name, guardian_occupation, guardian_contact,
                admission_status, que_code, phone, email, facebook, admission_date, strand,
                birth_cert, report_card, good_moral, id_pic, esc_cert
            )
            SELECT 
                ?, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
                birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
                father_name, father_occupation, father_contact,
                mother_name, mother_occupation, mother_contact,
                guardian_name, guardian_occupation, guardian_contact,
                admission_status, que_code, phone, email, facebook, admission_date, strand,
                birth_cert, report_card, good_moral, id_pic, esc_cert
            FROM admission_form WHERE id = ?"
            : "INSERT INTO student_information (
                student_number, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
                birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
                father_name, father_occupation, father_contact,
                mother_name, mother_occupation, mother_contact,
                guardian_name, guardian_occupation, guardian_contact,
                admission_status, que_code, phone, email, facebook, admission_date, strand,
                birth_cert, report_card, good_moral, id_pic, esc_cert
            )
            SELECT 
                ?, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
                birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
                father_name, father_occupation, father_contact,
                mother_name, mother_occupation, mother_contact,
                guardian_name, guardian_occupation, guardian_contact,
                admission_status, que_code, phone, email, facebook, admission_date, strand,
                birth_cert, report_card, good_moral, id_pic, esc_cert
            FROM admission_form WHERE id = ?";
        
        $stmt = $conn->prepare($sqlMove);
        $stmt->bind_param("si", $student_number, $admission_id);
        $stmt->execute();
        
        // For INSERT IGNORE with "00000000000", check if insert actually happened
        if ($is_zero_lrn && $stmt->affected_rows === 0) {
            // If no rows were inserted (duplicate ignored), get the student_number from existing record
            $sqlGetExisting = "SELECT student_number FROM student_information WHERE lrn = ? ORDER BY student_number DESC LIMIT 1";
            $stmt = $conn->prepare($sqlGetExisting);
            $stmt->bind_param("s", $lrn);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result && $result->num_rows > 0) {
                $existing = $result->fetch_assoc();
                $student_number = $existing['student_number'];
            }
            $stmt->close();
        }

        // 2️⃣ Delete admission record
        $sqlDelete = "DELETE FROM admission_form WHERE id = ?";
        $stmt = $conn->prepare($sqlDelete);
        $stmt->bind_param("i", $admission_id);
        $stmt->execute();
        
        // 3️⃣ Insert into student_tuition (added account_number)
        $sqlTuition = "INSERT INTO student_tuition 
            (account_number, student_number, payment_plan, enrolled_section, registration_fee, tuition_fee, miscellaneous, uniform, uniform_cart, discount_type, discount_value, discount_amount, downpayment, enrolled_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sqlTuition);
        $cart_json = json_encode($decoded_cart);
        $reg_fee = 2500.00;
        $stmt->bind_param("sssiddddssddds", 
            $account_number,
            $student_number, 
            $payment_plan, 
            $enrolled_section, 
            $reg_fee, 
            $tuition_fee, 
            $miscellaneous, 
            $uniform, 
            $cart_json, 
            $discount_type, 
            $discount_value, 
            $discount, 
            $downpayment, 
            $enrolled_date
        );

        $stmt->execute();

        // ✅ Get inserted tuition_id
        $tuition_id = $stmt->insert_id;

        // 4️⃣ Update sections.enrolled (+1)
        if (!empty($enrolled_section)) {
            $sqlUpdateSection = "UPDATE sections SET enrolled = enrolled + 1 WHERE section_id = ?";
            $stmt = $conn->prepare($sqlUpdateSection);
            $stmt->bind_param("i", $enrolled_section);
            $stmt->execute();
        }

        $conn->commit();

        header("Location: generate_cor.php?tuition_id=$tuition_id");
        exit;

    } catch (Exception $e) {
        $conn->rollback();
        
        // Check if error is duplicate entry for "00000000000" LRN
        $error_message = $e->getMessage();
        if (strpos($error_message, "Duplicate entry '00000000000' for key 'lrn'") !== false) {
            // Allow duplicate "00000000000" - retry with INSERT IGNORE
            try {
                $conn->begin_transaction();
                
                // Retry insert with IGNORE for "00000000000"
                $sqlMoveRetry = "INSERT IGNORE INTO student_information (
                    student_number, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
                    birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
                    father_name, father_occupation, father_contact,
                    mother_name, mother_occupation, mother_contact,
                    guardian_name, guardian_occupation, guardian_contact,
                    admission_status, que_code, phone, email, facebook, admission_date, strand,
                    birth_cert, report_card, good_moral, id_pic, esc_cert
                )
                SELECT 
                    ?, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture,
                    birthday, religion, place_of_birth, age, residential_address, region, province, municipal, barangay,
                    father_name, father_occupation, father_contact,
                    mother_name, mother_occupation, mother_contact,
                    guardian_name, guardian_occupation, guardian_contact,
                    admission_status, que_code, phone, email, facebook, admission_date, strand,
                    birth_cert, report_card, good_moral, id_pic, esc_cert
                FROM admission_form WHERE id = ?";
                
                $stmt = $conn->prepare($sqlMoveRetry);
                $stmt->bind_param("si", $student_number, $admission_id);
                $stmt->execute();
                
                // If INSERT IGNORE didn't insert (duplicate), get existing student_number
                if ($stmt->affected_rows === 0) {
                    $sqlGetExisting = "SELECT student_number FROM student_information WHERE lrn = '00000000000' ORDER BY student_number DESC LIMIT 1";
                    $result = $conn->query($sqlGetExisting);
                    if ($result && $result->num_rows > 0) {
                        $existing = $result->fetch_assoc();
                        $student_number = $existing['student_number'];
                    }
                }
                
                // Continue with rest of the transaction
                $sqlDelete = "DELETE FROM admission_form WHERE id = ?";
                $stmt = $conn->prepare($sqlDelete);
                $stmt->bind_param("i", $admission_id);
                $stmt->execute();
                
                $sqlTuition = "INSERT INTO student_tuition 
                    (account_number, student_number, payment_plan, enrolled_section, registration_fee, tuition_fee, miscellaneous, uniform, uniform_cart, discount_type, discount_value, discount_amount, downpayment, enrolled_date) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                $stmt = $conn->prepare($sqlTuition);
                $cart_json = json_encode($decoded_cart);
                $reg_fee = 2500.00;
                $stmt->bind_param("sssiddddssddds", 
                    $account_number,
                    $student_number, 
                    $payment_plan, 
                    $enrolled_section, 
                    $reg_fee, 
                    $tuition_fee, 
                    $miscellaneous, 
                    $uniform, 
                    $cart_json, 
                    $discount_type, 
                    $discount_value, 
                    $discount, 
                    $downpayment, 
                    $enrolled_date
                );
                $stmt->execute();
                $tuition_id = $stmt->insert_id;

                if (!empty($enrolled_section)) {
                    $sqlUpdateSection = "UPDATE sections SET enrolled = enrolled + 1 WHERE section_id = ?";
                    $stmt = $conn->prepare($sqlUpdateSection);
                    $stmt->bind_param("i", $enrolled_section);
                    $stmt->execute();
                }

                $conn->commit();
                header("Location: generate_cor.php?tuition_id=$tuition_id");
                exit;
                
            } catch (Exception $retry_e) {
                $conn->rollback();
                echo json_encode(["error" => "Transaction failed: " . $retry_e->getMessage()], JSON_PRETTY_PRINT);
            }
        } else {
            echo json_encode(["error" => "Transaction failed: " . $error_message], JSON_PRETTY_PRINT);
        }
    }

} else {
    echo json_encode(["error" => "Invalid request"], JSON_PRETTY_PRINT);
}
?>
