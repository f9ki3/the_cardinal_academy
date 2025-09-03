<?php
include '../db_connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference = $_POST['reference'] ?? '';
    $payment_type = $_POST['payment_type'] ?? '';
    $payment = floatval($_POST['payment'] ?? 0);
    $transaction_fee = floatval($_POST['transaction_fee'] ?? 0);

    $tuition_id = intval($_POST['tuition_id'] ?? 0);
    $invoice_number = mt_rand(1000000, 9999999); // fits in double, but better as int

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

    // ✅ Correct SQL (6 placeholders)
    $stmt = $conn->prepare("
        INSERT INTO payment 
            (payment, transaction_fee, payment_type, tuition_id, `date`, invoice_number, reference_number) 
        VALUES 
            (?, ?, ?, ?, NOW(), ?, ?)
    ");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // debug info
    }

    // ✅ Correct binding: ddsidi (6 params)
    $stmt->bind_param(
        "ddsidi",
        $payment,
        $transaction_fee,
        $payment_type,
        $tuition_id,
        $invoice_number,
        $reference_number
    );

    if ($stmt->execute()) {
        header("Location: view_invoice.php?invoice_id=" . urlencode($invoice_number) . "&tuition_id=" . urlencode($tuition_id));
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
