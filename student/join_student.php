<?php
session_start();
require_once "../db_connection.php";

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please log in.");
}

$student_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $join_code = trim($_POST['join_code'] ?? '');

    if (empty($join_code)) {
        header("Location: student/dashboard.php?status=empty_code");
        exit();
    }

    // Step 1: Verify the course exists
    $sql = "SELECT id FROM courses WHERE joined_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s", $join_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: ../student/dashboard.php?status=invalid_code");
        exit();
    }

    $course = $result->fetch_assoc();
    $course_id = $course['id'];

    // Step 2: Check if student already joined
    $check_sql = "SELECT id FROM course_students WHERE student_id = ? AND course_id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ii", $student_id, $course_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        header("Location: ../student/dashboard.php?status=already_joined");
        exit();
    }

    // Step 3: Insert student into course
    $insert_sql = "INSERT INTO course_students (course_id, student_id, joined_at) VALUES (?, ?, NOW())";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ii", $course_id, $student_id);

    if ($insert_stmt->execute()) {
        header("Location: ../student/dashboard.php?status=joined_success");
        exit();
    } else {
        header("Location: ../student/dashboard.php?status=join_failed");
        exit();
    }

    $insert_stmt->close();
    $check_stmt->close();
    $stmt->close();
}

$conn->close();
?>
