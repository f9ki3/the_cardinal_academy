<?php
include 'session_login.php';
include '../db_connection.php';

// ✅ Set timezone to Philippine Standard Time
date_default_timezone_set('Asia/Manila');

if (!isset($_GET['id']) || !isset($_GET['rfid'])) {
    $message = "Missing parameters.";
    $alertType = "danger";
    header("Location: start_attendance.php?id=0&message=" . urlencode($message) . "&alertType=$alertType");
    exit();
}

$course_id = intval($_GET['id']);
$rfid = trim($_GET['rfid']);

if (empty($rfid)) {
    $message = "RFID cannot be empty.";
    $alertType = "warning";
    header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message) . "&alertType=$alertType");
    exit();
}

// 1️⃣ Get student info from RFID
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
$user_id = $user['user_id'];
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$stmt->close();

// 2️⃣ Find linked parent_id
$parent_id = 0; // Default to 0 if no parent
$pstmt = $conn->prepare("SELECT parent_id FROM parent_link WHERE student_id = ?");
if ($pstmt) {
    $pstmt->bind_param("i", $user_id);
    $pstmt->execute();
    $presult = $pstmt->get_result();

    if ($presult->num_rows > 0) {
        $prow = $presult->fetch_assoc();
        $parent_id = $prow['parent_id'];
    }
    $pstmt->close();
}

// 3️⃣ Get course name
$course_name = '';
$cstmt = $conn->prepare("SELECT course_name FROM courses WHERE id = ?");
if ($cstmt) {
    $cstmt->bind_param("i", $course_id);
    $cstmt->execute();
    $cresult = $cstmt->get_result();
    if ($cresult->num_rows > 0) {
        $crow = $cresult->fetch_assoc();
        $course_name = $crow['course_name'];
    }
    $cstmt->close();
}

// 4️⃣ Check if attendance for today already exists
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

// 5️⃣ Insert attendance record
$time_in_db = date('H:i:s');
$time_in_display = date('h:i A');

$stmt = $conn->prepare("INSERT INTO attendance (date, time_in, course_id, rfid, user_id, first_name, last_name, parent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
if (!$stmt) {
    die("Prepare failed (attendance insert): " . $conn->error);
}
$stmt->bind_param("ssisissi", $today, $time_in_db, $course_id, $rfid, $user_id, $first_name, $last_name, $parent_id);

if ($stmt->execute()) {
    $message = "Attendance recorded for $first_name $last_name at $time_in_display.";
    $alertType = "success";

    // 6️⃣ Log to parent_attendance table (always insert, parent_id 0 if no linked parent)
    $p_att = $conn->prepare("INSERT INTO parent_attendance (date, time_in, course_name, rfid, user_id, first_name, last_name, parent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($p_att) {
        $p_att->bind_param("ssssissi", $today, $time_in_db, $course_name, $rfid, $user_id, $first_name, $last_name, $parent_id);
        $p_att->execute();
        $p_att->close();
    }

    // 7️⃣ Only send notifications if parent exists
    if ($parent_id != 0) {
        $notif_message = "$first_name $last_name time in at $time_in_display for the subject $course_name.";
        $notif_link = "attendance.php";
        $created_at = date('Y-m-d H:i:s');

        $notif_stmt = $conn->prepare("INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)");
        if ($notif_stmt) {
            $notif_stmt->bind_param("isss", $parent_id, $notif_message, $notif_link, $created_at);
            $notif_stmt->execute();
            $notif_stmt->close();
        }

        // 8️⃣ Increment parent's notification count
        $update_notif = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
        if ($update_notif) {
            $update_notif->bind_param("i", $parent_id);
            $update_notif->execute();
            $update_notif->close();
        }
    }

} else {
    $message = "Error recording attendance: " . $stmt->error;
    $alertType = "danger";
}

$stmt->close();
$conn->close();

// 9️⃣ Redirect back with message
header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message) . "&alertType=$alertType");
exit();
?>
