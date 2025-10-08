<?php 
include 'session_login.php';
include '../db_connection.php';

$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;

// --- fetch post ---
$post = null;
if ($post_id > 0) {
    $stmt = $conn->prepare("
        SELECT id, course_id, teacher_id, title, description, video_link, attachment, created_at
        FROM posts
        WHERE id = ?
        LIMIT 1
    ");
    $stmt->bind_param("i", $post_id);
    $stmt->execute();
    $post = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Post Not Found</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
        background-color: #f8f9fa;
    }
    .card-center {
        max-width: 500px;
        margin: 100px auto;
        text-align: center;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        background-color: #fff;
    }
    .btn-back {
        padding: 10px 25px;
        font-weight: 500;
        border-radius: 50px;
    }
    .icon-warning {
        font-size: 50px;
        color: #dc3545;
        margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="card-center">
    <i class="bi bi-exclamation-triangle icon-warning"></i>
    <h4 class="fw-bold text-danger mb-3">Post Not Found</h4>
    <p class="text-muted mb-4">The post may have been removed by the teacher or does not exist.</p>
    <a href="dashboard.php?id=<?= $course_id ?>" class="btn btn-danger btn-back">
        <i class="bi bi-arrow-left-circle me-2"></i> Back to Stream
    </a>
  </div>
</body>
</html>
