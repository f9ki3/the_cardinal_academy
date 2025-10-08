<?php
session_start();

// Set timezone to Asia/Manila
date_default_timezone_set('Asia/Manila');

include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $video_link  = !empty($_POST['video_link']) ? trim($_POST['video_link']) : null;
    $course_id   = intval($_POST['course_id']);
    $teacher_id  = intval($_POST['teacher_id']);

    if (empty($title) || empty($description) || !$course_id || !$teacher_id) {
        die("Missing required fields.");
    }

    // Handle file uploads
    $uploaded_files = [];
    if (!empty($_FILES['attachments']['name'][0])) {
        $upload_dir = "../static/uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        foreach ($_FILES['attachments']['name'] as $index => $name) {
            $tmp_name = $_FILES['attachments']['tmp_name'][$index];
            $error    = $_FILES['attachments']['error'][$index];

            if ($error === UPLOAD_ERR_OK) {
                $ext      = pathinfo($name, PATHINFO_EXTENSION);
                $filename = uniqid("file_") . "." . $ext;
                $path     = $upload_dir . $filename;

                if (move_uploaded_file($tmp_name, $path)) {
                    $uploaded_files[] = $filename;
                }
            }
        }
    }

    $attachments_json = !empty($uploaded_files) ? json_encode($uploaded_files) : null;

    // Insert post
    $sql = "INSERT INTO posts (course_id, teacher_id, title, description, video_link, attachment) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("iissss", $course_id, $teacher_id, $title, $description, $video_link, $attachments_json);

    if ($stmt->execute()) {
        $post_id = $stmt->insert_id;

        // Fetch teacher name
        $teacher_sql = "SELECT first_name, last_name FROM users WHERE user_id = ?";
        $teacher_stmt = $conn->prepare($teacher_sql);
        $teacher_stmt->bind_param("i", $teacher_id);
        $teacher_stmt->execute();
        $teacher_result = $teacher_stmt->get_result();
        $teacher = $teacher_result->fetch_assoc();
        $teacher_name = htmlspecialchars($teacher['first_name'] . ' ' . $teacher['last_name']);

        // Fetch students
        $students_sql = "SELECT student_id FROM course_students WHERE course_id = ?";
        $students_stmt = $conn->prepare($students_sql);
        $students_stmt->bind_param("i", $course_id);
        $students_stmt->execute();
        $students_result = $students_stmt->get_result();

        // Prepare notification insertion
        $notif_sql = "INSERT INTO notifications (user_id, message, link, created_at) VALUES (?, ?, ?, ?)";
        $notif_stmt = $conn->prepare($notif_sql);
        if (!$notif_stmt) {
            die("Notification SQL Error: " . $conn->error);
        }

        $message = $teacher_name . " posted a new lesson titled: " .  $title ;
        $link = "view_post.php?post_id=" . $post_id;
        $now  = date("Y-m-d H:i:s"); // Asia/Manila time

        while ($row = $students_result->fetch_assoc()) {
            $user_id = $row['student_id'];
            $notif_stmt->bind_param("isss", $user_id, $message, $link, $now);
            $notif_stmt->execute();
        }

        header("Location: course.php?id=" . $course_id . "&success=1");
        exit;
    } else {
        die("Error saving post: " . $stmt->error);
    }
} else {
    die("Invalid request.");
}
?>
