<?php
include 'session_login.php';
include '../db_connection.php';

// Throw exceptions instead of fatal errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (!$conn) {
    die("<p style='color:red;'>Database connection failed: " . mysqli_connect_error() . "</p>");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'enroll') {

    $admission_id    = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $payment_plan    = $_POST['payment_plan'] ?? '';
    $tuition_fee     = floatval($_POST['tuition_fee'] ?? 0);
    $miscellaneous   = floatval($_POST['miscellaneous'] ?? 0);
    $discount_type   = trim($_POST['discount_type'] ?? '');
    $discount_value  = floatval($_POST['discount_value'] ?? 0);
    $downpayment     = 2500.00;
    $status          = 'enrolled';

    $total = $tuition_fee + $miscellaneous;

    // Calculate discount
    $discount = 0.00;
    if ($discount_type === 'percent') {
        $discount = ($discount_value > 0 && $discount_value <= 100) ? ($total * ($discount_value / 100)) : 0;
    } elseif ($discount_type === 'fixed') {
        $discount = ($discount_value > 0 && $discount_value <= $total) ? $discount_value : 0;
    }

    $discounted_total = max(0, $total - $discount);
    $balance = max(0, $discounted_total - $downpayment);

    if ($admission_id <= 0 || empty($payment_plan)) {
        echo "<p style='color:red;'>Invalid form data.</p>";
        exit;
    }

    // Get student data from admission_form
    $stmt = $conn->prepare("SELECT * FROM admission_form WHERE id = ?");
    if (!$stmt) {
        die("<p style='color:red;'>Prepare failed (SELECT): " . $conn->error . "</p>");
    }

    $stmt->bind_param("i", $admission_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        // Update admission status
        $update_stmt = $conn->prepare("UPDATE admission_form SET admission_status = 'enrolled' WHERE id = ?");
        if (!$update_stmt) {
            die("<p style='color:red;'>Prepare failed (UPDATE): " . $conn->error . "</p>");
        }
        $update_stmt->bind_param("i", $admission_id);
        $update_stmt->execute();
        $update_stmt->close();

        // Store fields in variables
        $id                  = $row['id'];
        $lrn                 = $row['lrn'];
        $firstname           = $row['firstname'];
        $middlename          = $row['middlename'];
        $lastname            = $row['lastname'];
        $status              = $row['status'];
        $gender              = $row['gender'];
        $grade_level         = $row['grade_level'];
        $profile_picture     = $row['profile_picture'];
        $birthday            = $row['birthday'];
        $religion            = $row['religion'];
        $place_of_birth      = $row['place_of_birth'];
        $age                 = $row['age'];
        $residential_address = $row['residential_address'];
        $region              = $row['region'];
        $province            = $row['province'];
        $municipal           = $row['municipal'];
        $barangay            = $row['barangay'];
        $father_name         = $row['father_name'];
        $father_occupation   = $row['father_occupation'];
        $father_contact      = $row['father_contact'];
        $mother_name         = $row['mother_name'];
        $mother_occupation   = $row['mother_occupation'];
        $mother_contact      = $row['mother_contact'];
        $guardian_name       = $row['guardian_name'];
        $guardian_occupation = $row['guardian_occupation'];
        $guardian_contact    = $row['guardian_contact'];
        $admission_status    = $row['admission_status'];
        $que_code            = $row['que_code'];
        $email               = $row['email'];
        $facebook            = $row['facebook'];

        // Insert data into enroll table
        $insert = $conn->prepare("INSERT INTO enroll_form(
            id, lrn, firstname, middlename, lastname, status, gender, grade_level, profile_picture, birthday, religion,
            place_of_birth, age, residential_address, region, province, municipal, barangay,
            father_name, father_occupation, father_contact, mother_name, mother_occupation, mother_contact,
            guardian_name, guardian_occupation, guardian_contact, admission_status, que_code, email, facebook, admission_date,
            payment_plan, downpayment, tuition_fee, miscellaneous, discount_type, discount, discount_value
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?)");

        if (!$insert) {
            die("<p style='color:red;'>Prepare failed (INSERT): " . $conn->error . "</p>");
        }

        $insert->bind_param(
            "issssssssssissssssssssssssssssssssdssd",
            $id, $lrn, $firstname, $middlename, $lastname, $status,
            $gender, $grade_level, $profile_picture, $birthday, $religion,
            $place_of_birth, $age, $residential_address, $region, $province,
            $municipal, $barangay, $father_name, $father_occupation, $father_contact,
            $mother_name, $mother_occupation, $mother_contact, $guardian_name,
            $guardian_occupation, $guardian_contact, $admission_status, $que_code,
            $email, $facebook, $payment_plan, $downpayment, $tuition_fee, $miscellaneous,
            $discount_type, $discount, $discount_value
        );

        // 🔄 Wrap the insert in try...catch to handle duplicate errors
        try {
            if ($insert->execute()) {
                // Generate 8-character random password
                function generateRandomPassword($length = 8) {
                    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    return substr(str_shuffle($chars), 0, $length);
                }

                $raw_password = generateRandomPassword(8);
                $hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

                $acc_type   = 'student';
                $username = strtolower($firstname . '_' . $lastname . '.student');
                $profile    = $profile_picture ?: 'dummy.png';
                $rfid       = null;

                $user_stmt = $conn->prepare("INSERT INTO users (
                    acc_type, username, email, password, first_name, last_name,
                    gender, birthdate, phone_number, address, profile, rfid, enroll_id
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

                if (!$user_stmt) {
                    die("<p style='color:red;'>Prepare failed (USER INSERT): " . $conn->error . "</p>");
                }

                $user_stmt->bind_param(
                    "ssssssssssssi",
                    $acc_type,
                    $username,
                    $email,
                    $hashed_password,
                    $firstname,
                    $lastname,
                    $gender,
                    $birthday,
                    $facebook,
                    $residential_address,
                    $profile,
                    $rfid,
                    $id
                );

                if ($user_stmt->execute()) {
                    // ✅ Auto-submit to receipt.php with needed data
                    echo '<form id="receiptForm" method="POST" action="receipt.php">';
                    echo '<input type="hidden" name="student_name" value="' . htmlspecialchars($firstname . ' ' . $lastname) . '">';
                    echo '<input type="hidden" name="grade_level" value="' . htmlspecialchars($grade_level) . '">';
                    echo '<input type="hidden" name="tuition_fee" value="' . htmlspecialchars($tuition_fee) . '">';
                    echo '<input type="hidden" name="miscellaneous" value="' . htmlspecialchars($miscellaneous) . '">';
                    echo '<input type="hidden" name="total" value="' . htmlspecialchars($total) . '">';
                    echo '<input type="hidden" name="discount_type" value="' . htmlspecialchars($discount_type) . '">';
                    echo '<input type="hidden" name="discount_value" value="' . htmlspecialchars($discount_value) . '">';
                    echo '<input type="hidden" name="final_amount" value="' . htmlspecialchars($discounted_total) . '">';
                    echo '<input type="hidden" name="downpayment" value="' . htmlspecialchars($downpayment) . '">';
                    echo '<input type="hidden" name="balance" value="' . htmlspecialchars($balance) . '">';
                    echo '<input type="hidden" name="payment_plan" value="' . htmlspecialchars($payment_plan) . '">';
                    echo '</form>';
                    echo '<script>document.getElementById("receiptForm").submit();</script>';
                } else {
                    echo "<p style='color:red;'>User insert failed: " . $user_stmt->error . "</p>";
                }

                $user_stmt->close();
            }
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) {
                header("Location: enroll_form.php?error=duplicate");
                exit;
            } else {
                echo "<p style='color:red;'>Insert failed: " . $e->getMessage() . "</p>";
            }
        }

        $insert->close();

    } else {
        echo "<p style='color:red;'>No admission record found for ID $admission_id.</p>";
    }

    $stmt->close();
} else {
    echo "<p style='color:red;'>Invalid request.</p>";
}
?>
