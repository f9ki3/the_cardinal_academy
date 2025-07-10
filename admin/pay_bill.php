<?php
include '../db_connection.php'; // make sure you include your DB connection
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference = $_POST['reference'] ?? '';
    $payment_type = $_POST['payment_type'] ?? '';
    $payment = floatval($_POST['payment'] ?? 0);
    $transaction_fee = floatval($_POST['transaction_fee'] ?? 0);
    $balance = floatval($_POST['balance'] ?? 0);
    $change = $payment - ($balance + $transaction_fee);

    $amount = $balance; // Assuming amount is the balance to be paid
    $student_id = $_POST['student_id'] ?? '';
    $registar_id = $_SESSION['user_id'] ?? 0;
    $invoice_number = mt_rand(1000000, 9999999);
    $proof = ''; // Add this if needed from file upload

    // Generate a unique reference number if empty
    if (empty($reference)) {
        do {
            $generated_reference = mt_rand(1000000000, 9999999999); // 10-digit number
            $check_stmt = $conn->prepare("SELECT COUNT(*) FROM payment WHERE reference_number = ?");
            $check_stmt->bind_param("i", $generated_reference);
            $check_stmt->execute();
            $check_stmt->bind_result($count);
            $check_stmt->fetch();
            $check_stmt->close();
        } while ($count > 0);

        $reference_number = $generated_reference;
    } else {
        $reference_number = intval($reference);
    }

    // ✅ Insert with transaction_fee field
    $stmt = $conn->prepare("INSERT INTO payment (amount, payment, `change`, transaction_fee, payment_type, proof, student_id, registar_id, `date`, invoice_number, reference_number) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?, ?)");

    $stmt->bind_param("ddddssiiii", $amount, $payment, $change, $transaction_fee, $payment_type, $proof, $student_id, $registar_id, $invoice_number, $reference_number);

    if ($stmt->execute()) {
        // success
        header("Location: view_tuition.php?id=" . urlencode($student_id) . "&nav_drop=true");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
