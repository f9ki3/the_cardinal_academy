<?php
include 'session_login.php';
include '../db_connection.php';

// ✅ Set timezone to Philippine Standard Time
date_default_timezone_set('Asia/Manila');

if (!isset($_GET['id']) || !isset($_GET['rfid'])) {
    $message = "Missing parameters.";
    $alertType = "danger"; // Error color
    header("Location: start_attendance.php?id=0&message=" . urlencode($message) . "&alertType=$alertType");
    exit();
}

$course_id = intval($_GET['id']);
$rfid = trim($_GET['rfid']);

if (empty($rfid)) {
    $message = "RFID cannot be empty.";
    $alertType = "warning"; // Warning color
    header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message) . "&alertType=$alertType");
    exit();
}

// 1. Search RFID in users table and get user_id, first_name, last_name
$stmt = $conn->prepare("SELECT user_id, first_name, last_name FROM users WHERE rfid = ?");
if (!$stmt) {
    die("Prepare failed (users select): " . $conn->error);
}
$stmt->bind_param("s", $rfid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $message = "RFID not found in users.";
    $alertType = "danger";
    header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message) . "&alertType=$alertType");
    exit();
}

$user = $result->fetch_assoc();
$user_id = $user['user_id'];       // user_id from users table
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$stmt->close();

// 2. Check if attendance for today already exists
$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT id FROM attendance WHERE rfid = ? AND course_id = ? AND date = ?");
if (!$stmt) {
    die("Prepare failed (attendance check): " . $conn->error);
}
$stmt->bind_param("sis", $rfid, $course_id, $today);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $message = "Attendance already recorded for $first_name $last_name today.";
    $alertType = "warning";
    header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message) . "&alertType=$alertType");
    exit();
}
$stmt->close();

// 3. Insert attendance record with user_id
$time_in_db = date('H:i:s');           // Stored in 24-hour format for database
$time_in_display = date('h:i A');      // Displayed in 12-hour format with AM/PM

$stmt = $conn->prepare("INSERT INTO attendance (date, time_in, course_id, rfid, user_id, first_name, last_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed (attendance insert): " . $conn->error);
}
$stmt->bind_param("ssisiss", $today, $time_in_db, $course_id, $rfid, $user_id, $first_name, $last_name);

if ($stmt->execute()) {
    $message = "Attendance recorded for $first_name $last_name at $time_in_display.";
    $alertType = "success";
} else {
    $message = "Error recording attendance: " . $stmt->error;
    $alertType = "danger";
}
$stmt->close();
$conn->close();

// Redirect to start_attendance.php with message and alertType
header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message) . "&alertType=$alertType");
exit();
?>
