<?php
session_start();
include '../db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid request.");
}

$post_id = (int) $_GET['id'];
$course_id = (int) $_GET['course_id'];

// Prepare statement
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
if (!$stmt) {
    die("SQL error: " . $conn->error);
}

$stmt->bind_param("i", $post_id);

if ($stmt->execute()) {
    // Redirect back with success message and post id
    header("Location: course.php?success=2&id=" . $course_id);
    exit;
} else {
    echo "Error deleting post: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
