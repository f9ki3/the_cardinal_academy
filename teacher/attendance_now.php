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
$parent_id = 0;
$pstmt = $conn->prepare("SELECT parent_id FROM parent_link WHERE student_id = ?");
$pstmt->bind_param("i", $user_id);
$pstmt->execute();
$presult = $pstmt->get_result();
if ($presult->num_rows > 0) {
    $parent_id = $presult->fetch_assoc()['parent_id'];
}
$pstmt->close();

// 3️⃣ Get course name
$course_name = '';
$cstmt = $conn->prepare("SELECT course_name FROM courses WHERE id = ?");
$cstmt->bind_param("i", $course_id);
$cstmt->execute();
$cresult = $cstmt->get_result();
if ($cresult->num_rows > 0) {
    $course_name = $cresult->fetch_assoc()['course_name'];
}
$cstmt->close();

// 4️⃣ Check if attendance for today already exists
$today = date('Y-m-d');
$stmt = $conn->prepare("SELECT id FROM attendance WHERE rfid = ? AND course_id = ? AND date = ?");
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
$stmt->bind_param("ssisissi", $today, $time_in_db, $course_id, $rfid, $user_id, $first_name, $last_name, $parent_id);

if ($stmt->execute()) {
    $message = "Attendance recorded for $first_name $last_name at $time_in_display.";
    $alertType = "success";

    // 6️⃣ Log to parent_attendance
    $p_att = $conn->prepare("INSERT INTO parent_attendance (date, time_in, course_name, rfid, user_id, first_name, last_name, parent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $p_att->bind_param("ssssissi", $today, $time_in_db, $course_name, $rfid, $user_id, $first_name, $last_name, $parent_id);
    $p_att->execute();
    $p_att->close();

    // 7️⃣ Notify parent in-app
    if ($parent_id != 0) {
        $notif_message = "$first_name $last_name time in at $time_in_display for the subject $course_name.";
        $notif_link = "attendance.php";
        $created_at = date('Y-m-d H:i:s');

        $notif_stmt = $conn->prepare("INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)");
        $notif_stmt->bind_param("isss", $parent_id, $notif_message, $notif_link, $created_at);
        $notif_stmt->execute();
        $notif_stmt->close();

        $update_notif = $conn->prepare("UPDATE users SET notification = notification + 1 WHERE user_id = ?");
        $update_notif->bind_param("i", $parent_id);
        $update_notif->execute();
        $update_notif->close();

        // 8️⃣ Get parent's phone number
        $phone_number = null;
        $phone_stmt = $conn->prepare("SELECT phone_number FROM users WHERE user_id = ?");
        $phone_stmt->bind_param("i", $parent_id);
        $phone_stmt->execute();
        $phone_result = $phone_stmt->get_result();
        if ($phone_result->num_rows > 0) {
            $phone_number = $phone_result->fetch_assoc()['phone_number'];
        }
        $phone_stmt->close();

        // 9️⃣ Send SMS notification (STRICT DOCUMENTATION COMPLIANCE)
        if (!empty($phone_number)) {
            // Clean phone number (ensure only digits)
            $clean_phone = preg_replace('/[^0-9]/', '', $phone_number);

            $url = 'https://www.iprogsms.com/api/v1/sms_messages';
            
            // Your API Token
            $api_token = 'f30f8713dd8a43abd1683be77964f8463cc32322';
            
            // Construct Message
            $sms_message = sprintf("Attendance Alert: %s %s has timed in at %s for the subject %s.", $first_name, $last_name, $time_in_display, $course_name);

            // Data array exactly as requested in documentation
            $data = [
                'api_token' => $api_token,
                'message' => $sms_message,
                'phone_number' => $clean_phone
            ];

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            
            // ⚠️ CRITICAL CHANGE: Use http_build_query as per documentation
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            
            // ⚠️ CRITICAL CHANGE: Set correct header
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/x-www-form-urlencoded'
            ]);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                error_log("SMS Error: " . curl_error($ch));
            } else {
                error_log("SMS Response: " . $response);
            }

            curl_close($ch);
        }

    }

} else {
    $message = "Error recording attendance: " . $stmt->error;
    $alertType = "danger";
}

$stmt->close();
$conn->close();

// 🔟 Redirect back with message
header("Location: start_attendance.php?id=$course_id&message=" . urlencode($message) . "&alertType=$alertType");
exit();
?>