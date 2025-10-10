<?php
include '../db_connection.php';
session_start();

// ✅ Set timezone to Manila
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reference = $_POST['reference'] ?? '';
    $payment_type = $_POST['payment_type'] ?? '';
    $payment = floatval($_POST['payment'] ?? 0);
    $transaction_fee = floatval($_POST['transaction_fee'] ?? 0);
    $tuition_id = intval($_POST['tuition_id'] ?? 0);
    $invoice_number = mt_rand(1000000, 9999999);

    // 🔹 Step 1: Get student_number from student_tuition
    $stmt1 = $conn->prepare("SELECT student_number, account_number FROM student_tuition WHERE id = ?");
    $stmt1->bind_param("i", $tuition_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $student_data = ($result1->num_rows > 0) ? $result1->fetch_assoc() : null;
    $stmt1->close();

    $student_number = $student_data['student_number'] ?? null;
    $account_number = $student_data['account_number'] ?? '';

    if ($student_number) {
        // 🔹 Step 2: Get student_id from users using student_number
        $stmt2 = $conn->prepare("SELECT user_id FROM users WHERE student_number = ?");
        $stmt2->bind_param("s", $student_number);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $student_id = ($result2->num_rows > 0) ? $result2->fetch_assoc()['user_id'] : null;
        $stmt2->close();

        if ($student_id) {
            // 🔹 Step 3: Get parent_id from parent_link using student_id
            $stmt3 = $conn->prepare("SELECT parent_id FROM parent_link WHERE student_id = ?");
            $stmt3->bind_param("s", $student_id);
            $stmt3->execute();
            $result3 = $stmt3->get_result();
            $parent_id = ($result3->num_rows > 0) ? $result3->fetch_assoc()['parent_id'] : null;
            $stmt3->close();

            if ($parent_id) {
                // 🔹 Step 4: Update parent notification count (+1)
                $stmt4 = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
                $stmt4->bind_param("s", $parent_id);
                $stmt4->execute();
                $stmt4->close();

                // 🔹 Step 5: Log notification for parent
                $link = "view_invoice.php?invoice_id=" . $invoice_number . "&tuition_id=" . $tuition_id;
                $message = "Account number : $account_number pay this amount for their tuition.";
                $created_at = date('Y-m-d H:i:s'); // Manila timezone datetime

                $stmt5 = $conn->prepare("
                    INSERT INTO notifications (user_id, message, link, created_at)
                    VALUES (?, ?, ?, ?)
                ");
                $stmt5->bind_param("ssss", $parent_id, $message, $link, $created_at);
                $stmt5->execute();
                $stmt5->close();
            }
        }
    }

    // 🔹 Step 6: Generate unique reference if empty
    if (empty($reference)) {
        do {
            $generated_reference = mt_rand(1000000000, 9999999999);
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

    // 🔹 Step 7: Insert payment record
    $payment_date = date('Y-m-d H:i:s'); // Manila timezone datetime
    $stmt = $conn->prepare("
        INSERT INTO payment 
            (payment, transaction_fee, payment_type, tuition_id, `date`, invoice_number, reference_number) 
        VALUES 
            (?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ddsissi",
        $payment,
        $transaction_fee,
        $payment_type,
        $tuition_id,
        $payment_date,
        $invoice_number,
        $reference_number
    );

    if ($stmt->execute()) {
        header("Location: view_invoice.php?invoice_id=" . urlencode($invoice_number) . "&tuition_id=" . urlencode($tuition_id));
        exit();
    } else {
        echo "Error inserting payment: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
