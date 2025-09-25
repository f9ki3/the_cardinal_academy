<?php
session_start();
include '../db_connection.php';

// Validate required inputs
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = trim($_POST['title']);
    $description = trim($_POST['description']);
    $video_link  = !empty($_POST['video_link']) ? trim($_POST['video_link']) : null;
    $course_id   = intval($_POST['course_id']);
    $teacher_id  = intval($_POST['teacher_id']);

    if (empty($title) || empty($description) || !$course_id || !$teacher_id) {
        die("Missing required fields.");
    }

    // Handle multiple attachments
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

    // Convert to JSON so we can store multiple filenames
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
        header("Location: course.php?id=" . $course_id . "&success=1");
        exit;
    } else {
        die("Error saving post: " . $stmt->error);
    }
} else {
    die("Invalid request.");
}
