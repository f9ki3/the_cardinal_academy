<?php
include '../db_connection.php';
include 'session_login.php';

// Get parameters
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

if ($id <= 0 || empty($student_id)) {
    header("Location: view_student_medical.php?student_id=" . urlencode($student_id));
    exit;
}

// Delete the record
$stmt = $conn->prepare("DELETE FROM student_health_records WHERE id = ? AND student_id = ?");
$stmt->bind_param("is", $id, $student_id);

if ($stmt->execute()) {
    // Redirect with success status
    header("Location: view_student_medical.php?student_id=" . urlencode($student_id) . "&status=2");
    exit;
} else {
    // Redirect with error status (optional)
    header("Location: view_student_medical.php?student_id=" . urlencode($student_id) . "&status=0");
    exit;
}

$stmt->close();
$conn->close();
