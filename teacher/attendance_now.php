<?php
include 'session_login.php';
include '../db_connection.php';

// ✅ Set timezone to Philippine Standard Time
date_default_timezone_set('Asia/Manila');

if (!isset($_GET['id']) || !isset($_GET['rfid'])) {
    $message = "Missing parameters.";
    header("Location: start_attendance.php?id=0&message=" . urlencode($message));
    exit();
}

$course_id = intval($_GET['id']);
$rfid = trim($_GET['rfid']);

if (empty($rfid)) {
    $message = "RFID cannot be empty.";
    header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message));
    exit();
}

// 1. Search RFID in users table
$stmt = $conn->prepare("SELECT first_name, last_name FROM users WHERE rfid = ?");
$stmt->bind_param("s", $rfid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $message = "RFID not found in users.";
    header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message));
    exit();
}

$user = $result->fetch_assoc();
$first_name = $user['first_name'];
$last_name = $user['last_name'];

// 2. Check if attendance for today already exists
$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT id FROM attendance WHERE rfid = ? AND course_id = ? AND date = ?");
$stmt->bind_param("sis", $rfid, $course_id, $today);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $message = "Attendance already recorded for $first_name $last_name today.";
    header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message));
    exit();
}

// 3. Insert attendance record
$time_in_db = date('H:i:s');           // Stored in 24-hour format for database
$time_in_display = date('h:i A');      // Displayed in 12-hour format with AM/PM

$stmt = $conn->prepare("INSERT INTO attendance (date, time_in, course_id, rfid, first_name, last_name) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssisss", $today, $time_in_db, $course_id, $rfid, $first_name, $last_name);

if ($stmt->execute()) {
    $message = "Attendance recorded for $first_name $last_name at $time_in_display.";
} else {
    $message = "Error recording attendance: " . $conn->error;
}

// Redirect to start_attendance.php with message
header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message));
exit();

?>
