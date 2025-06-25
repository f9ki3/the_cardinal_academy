<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $section_id = $_POST['section_id'];
    $description = $_POST['description'];
    $subject_code = $_POST['subject_code'];
    $time = $_POST['time'];
    $teacher_name = $_POST['teacher_id']; // assuming this is full name, not user_id
    $room = $_POST['room'];

    // You might want to fetch the teacher's ID using the name if needed
    // $teacher_id = ...

    $stmt = $conn->prepare("INSERT INTO class_schedule (section_id, description, subject_code, time, teacher, room) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $section_id, $description, $subject_code, $time, $teacher_name, $room);

    if ($stmt->execute()) {
        header("Location: class_schedule.php?id=$section_id&message=success");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
