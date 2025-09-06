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
    $student_number      = $_POST['student_number'] ?? '';
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

    // ✅ Enrolled Date
    $enrolled_date = date("Y-m-d H:i:s");

    try {
        $conn->begin_transaction();

        // 1️⃣ Delete admission record (no move to student_information)
        $sqlDelete = "DELETE FROM admission_old WHERE id = ?";
        $stmt = $conn->prepare($sqlDelete);
        $stmt->bind_param("i", $admission_id);
        $stmt->execute();
        
        // 2️⃣ Insert into student_tuition (added account_number)
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

        // 3️⃣ Update sections.enrolled (+1)
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
