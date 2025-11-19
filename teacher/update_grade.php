<?php
header('Content-Type: application/json');
include '../db_connection.php';

$student_id = intval($_POST['student_id'] ?? 0);
$course_id = intval($_POST['course_id'] ?? 0);
$field = $_POST['field'] ?? '';
$value = $_POST['value'] ?? ''; // keep raw value to check empty
$allowed_fields = ['q1','q2','q3','q4'];

// If empty or not numeric, set to 0
if($value === '' || !is_numeric($value)){
    $value = 0;
} else {
    $value = intval($value);
    if($value < 0) $value = 0;
    if($value > 100) $value = 100;
}

if($student_id && $course_id && in_array($field, $allowed_fields)){
    $stmt = $conn->prepare("UPDATE course_students SET $field = ? WHERE student_id = ? AND course_id = ?");
    if($stmt){
        $stmt->bind_param("iii", $value, $student_id, $course_id);
        if($stmt->execute()){
            echo json_encode(['success'=>true]);
        } else {
            echo json_encode(['success'=>false,'message'=>'DB update failed']);
        }
        $stmt->close();
    } else {
        echo json_encode(['success'=>false,'message'=>'DB prepare failed']);
    }
} else {
    echo json_encode(['success'=>false,'message'=>'Invalid data']);
}
?>
