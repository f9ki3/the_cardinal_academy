<?php
include 'session_login.php';
include '../db_connection.php';

// Accept only JSON requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

// Read raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

$course_id = isset($data['course_id']) ? intval($data['course_id']) : 0;
$student_id = isset($data['student_id']) ? intval($data['student_id']) : 0;

if ($course_id <= 0 || $student_id <= 0) {
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Missing course or student ID']);
    exit;
}

// Prepare and execute delete
$stmt = $conn->prepare("DELETE FROM course_students WHERE course_id = ? AND student_id = ?");
if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
    exit;
}

$stmt->bind_param("ii", $course_id, $student_id);
$success = $stmt->execute();

if ($success && $stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Student not found or already removed']);
}

$stmt->close();
$conn->close();
exit;
