<?php
session_start();

/* ✅ Set timezone to Asia/Manila */
date_default_timezone_set('Asia/Manila');

include '../db_connection.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please log in first.");
}

$parent_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $student_code = trim($_POST['student_code']);

    if (empty($student_code)) {
        die("Student ID is required.");
    }

    /* --------------------------------------------------
       1️⃣ Find student by student_number
    -------------------------------------------------- */
    $stmt = $conn->prepare("
        SELECT user_id, first_name 
        FROM users 
        WHERE student_number = ?
    ");
    $stmt->bind_param("s", $student_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<script>alert('No student found with that ID.'); window.history.back();</script>";
        exit;
    }

    $student = $result->fetch_assoc();
    $student_id = $student['user_id'];
    $student_name = $student['first_name'];

    /* --------------------------------------------------
       2️⃣ Get parent name
    -------------------------------------------------- */
    $parent_stmt = $conn->prepare("
        SELECT first_name 
        FROM users 
        WHERE user_id = ?
    ");
    $parent_stmt->bind_param("s", $parent_id);
    $parent_stmt->execute();
    $parent_result = $parent_stmt->get_result();
    $parent_data = $parent_result->fetch_assoc();
    $parent_name = $parent_data['first_name'];
    $parent_stmt->close();

    /* --------------------------------------------------
       3️⃣ Check if link already exists
    -------------------------------------------------- */
    $check = $conn->prepare("
        SELECT id 
        FROM parent_link 
        WHERE parent_id = ? AND student_id = ?
    ");
    $check->bind_param("ss", $parent_id, $student_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('This student is already linked to your account.'); window.history.back();</script>";
        exit;
    }

    /* --------------------------------------------------
       4️⃣ Insert link
    -------------------------------------------------- */
    $insert = $conn->prepare("
        INSERT INTO parent_link (parent_id, student_id) 
        VALUES (?, ?)
    ");
    $insert->bind_param("ss", $parent_id, $student_id);

    if ($insert->execute()) {

        /* --------------------------------------------------
           5️⃣ Insert Notification for Student
        -------------------------------------------------- */
        $notification_message = "Your parent ($parent_name) has successfully linked their account to you.";
        $notification_link = "dashboard.php";

        $notify = $conn->prepare("
            INSERT INTO notifications (id, user_id, message, link) 
            VALUES (UUID(), ?, ?, ?)
        ");
        $notify->bind_param("sss", $student_id, $notification_message, $notification_link);
        $notify->execute();
        $notify->close();

        /* --------------------------------------------------
           6️⃣ Increment users.notification counter (+1)
        -------------------------------------------------- */
        $update_counter = $conn->prepare("
            UPDATE users 
            SET notification = notification + 1 
            WHERE user_id = ?
        ");
        $update_counter->bind_param("s", $student_id);
        $update_counter->execute();
        $update_counter->close();

        echo "<script>alert('Student linked successfully!'); window.location.href='dashboard.php?status=1';</script>";

    } else {
        echo "<script>alert('Error linking student. Please try again.'); window.history.back();</script>";
    }

    $insert->close();
    $check->close();
    $stmt->close();
    $conn->close();
}
?>
