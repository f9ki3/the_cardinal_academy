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

    // ✅ Generate Student Number (Format: YYYY-XXXXX)
    $year = date("Y");
    $randomDigits = str_pad(mt_rand(0, 99999), 5, "0", STR_PAD_LEFT);
    $student_number = $year . "-" . $randomDigits;

    // ✅ Enrolled Date
    $enrolled_date = date("Y-m-d H:i:s");

    try {
        $conn->begin_transaction();

        // 1️⃣ Move admission record → student_information
        $sqlMove = "INSERT INTO student_information (
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

        // 2️⃣ Delete admission record
        $sqlDelete = "DELETE FROM admission_form WHERE id = ?";
        $stmt = $conn->prepare($sqlDelete);
        $stmt->bind_param("i", $admission_id);
        $stmt->execute();

        // 3️⃣ Insert into student_tuition
        $sqlTuition = "INSERT INTO student_tuition 
            (student_number, payment_plan, enrolled_section, registration_fee, tuition_fee, miscellaneous, uniform, uniform_cart, discount_type, discount_value, discount_amount, downpayment, enrolled_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sqlTuition);
        $cart_json = json_encode($decoded_cart);
        $reg_fee = 2500.00;
        $stmt->bind_param("sssddddssddds", 
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
        echo json_encode(["error" => "Transaction failed: " . $e->getMessage()], JSON_PRETTY_PRINT);
    }

} else {
    echo json_encode(["error" => "Invalid request"], JSON_PRETTY_PRINT);
}
?>
