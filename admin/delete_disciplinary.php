<?php
include '../db_connection.php';
include 'session_login.php';

// Get parameters
$disciplinary_id = isset($_GET['disciplinary_id']) ? trim($_GET['disciplinary_id']) : '';
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

if (empty($disciplinary_id) || empty($student_id)) {
    header("Location: view_student_diciplinary.php?student_id=" . urlencode($student_id));
    exit;
}

// Prepare delete statement using disciplinary_id
$stmt = $conn->prepare("DELETE FROM student_disciplinary_records WHERE disciplinary_id = ? AND TRIM(student_id) = ?");
if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("ss", $disciplinary_id, $student_id);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        // Successfully deleted
        header("Location: view_student_diciplinary.php?student_id=" . urlencode($student_id) . "&status=2");
    } else {
        // No record found
        header("Location: view_student_diciplinary.php?student_id=" . urlencode($student_id) . "&status=0");
    }
    exit;
} else {
    // Execution error
    header("Location: view_student_diciplinary.php?student_id=" . urlencode($student_id) . "&status=0");
    exit;
}

$stmt->close();
$conn->close();
?>
