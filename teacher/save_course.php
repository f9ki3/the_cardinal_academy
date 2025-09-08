<?php
include 'session_login.php';
include '../db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teacher_id = $_SESSION['user_id'];
    
    // Collect and sanitize input
    $course_name = trim($_POST['course_name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $day = $_POST['day'] ?? '';
    $start_time = $_POST['start_time'] ?? '';
    $end_time = $_POST['end_time'] ?? '';
    $section = trim($_POST['section'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $room = trim($_POST['room'] ?? '');

    // Validate required fields
    $errors = [];
    if (!$course_name) $errors[] = "Course Name is required.";
    if (!$day) $errors[] = "Day is required.";
    if (!$start_time || !$end_time) $errors[] = "Start and End Time are required.";
    if ($start_time >= $end_time) $errors[] = "Start Time must be earlier than End Time.";
    if (!$section) $errors[] = "Section is required.";
    if (!$subject) $errors[] = "Subject is required.";
    if (!$room) $errors[] = "Room is required.";

    // Handle file upload
    $cover_photo_path = null;
    if (isset($_FILES['cover_photo']) && $_FILES['cover_photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../static/uploads/';
        $filename = time() . '_' . basename($_FILES['cover_photo']['name']);
        $target_file = $upload_dir . $filename;

        // Optional: validate file type
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg','jpeg','png','gif','svg'];
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Invalid file type for cover photo.";
        } else {
            if (move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_file)) {
                $cover_photo_path = $filename;
            } else {
                $errors[] = "Failed to upload cover photo.";
            }
        }
    }

    if (count($errors) > 0) {
        // Display errors
        foreach ($errors as $err) {
            echo "<p style='color:red;'>$err</p>";
        }
        exit;
    }

    // Insert into database with teacher_id
    $stmt = $conn->prepare("INSERT INTO courses 
        (teacher_id, course_name, description, day, start_time, end_time, section, subject, room, cover_photo) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "isssssssss", 
        $teacher_id, 
        $course_name, 
        $description, 
        $day, 
        $start_time, 
        $end_time, 
        $section, 
        $subject, 
        $room, 
        $cover_photo_path
    );

    if ($stmt->execute()) {
        // Success, redirect or show message
        header("Location: attendance.php?success=Course created successfully");
        exit;
    } else {
        echo "<p style='color:red;'>Failed to save course: " . $stmt->error . "</p>";
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
