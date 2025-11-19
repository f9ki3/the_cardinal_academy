<?php
header('Content-Type: application/json');
include '../db_connection.php';

$student_id = intval($_POST['student_id'] ?? 0);
$course_id = intval($_POST['course_id'] ?? 0);
$field = $_POST['field'] ?? '';
$value = intval($_POST['value'] ?? -1);

$allowed_fields = ['q1','q2','q3','q4'];

if($student_id && $course_id && in_array($field, $allowed_fields) && $value >= 0 && $value <= 100){
    $stmt = $conn->prepare("UPDATE course_students SET $field = ? WHERE student_id = ? AND course_id = ?");
    if($stmt){
        $stmt->bind_param("iii", $value, $student_id, $course_id);
        if($stmt->execute()){
            echo json_encode(['success'=>true]);
        } else {
            echo json_encode(['success'=>false,'message'=>'DB update failed']);
        }
        $stmt->close();
    }
} else {
    echo json_encode(['success'=>false,'message'=>'Invalid data']);
}
?>
