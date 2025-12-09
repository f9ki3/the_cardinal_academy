<?php
include 'session_login.php'; 
include '../db_connection.php'; 

header('Content-Type: application/json');

$medical_id = isset($_GET['medical_id']) ? trim($_GET['medical_id']) : '';
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

if (empty($medical_id) || empty($student_id)) {
    echo json_encode(['error' => 'Missing required IDs.']);
    exit;
}

// Fetch all columns using SELECT * $query = "SELECT * FROM student_health_records WHERE medical_id = ? AND student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $medical_id, $student_id);
$stmt->execute();
$result = $stmt->get_result();
$record = $result->fetch_assoc();
$stmt->close();

if ($record) {
    // Basic sanitization/formatting before sending
    $record['created_at'] = date("Y-m-d H:i:s", strtotime($record['created_at']));
    echo json_encode($record);
} else {
    echo json_encode(['error' => 'Record not found.']);
}
?>