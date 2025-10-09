<?php
session_start();
include '../db_connection.php'; // adjust the path if needed

// Ensure the parent is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please log in first.");
}

$parent_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_code = trim($_POST['student_code']);

    if (empty($student_code)) {
        die("Student ID is required.");
    }

    // Search for the student in the users table
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE student_number = ?");
    $stmt->bind_param("s", $student_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "<script>alert('No student found with that ID.'); window.history.back();</script>";
        exit;
    }

    $student = $result->fetch_assoc();
    $student_id = $student['user_id'];

    // Check if this link already exists
    $check = $conn->prepare("SELECT id FROM parent_link WHERE parent_id = ? AND student_id = ?");
    $check->bind_param("ii", $parent_id, $student_id);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        echo "<script>alert('This student is already linked to your account.'); window.history.back();</script>";
        exit;
    }

    // Insert new link
    $insert = $conn->prepare("INSERT INTO parent_link (parent_id, student_id) VALUES (?, ?)");
    $insert->bind_param("ii", $parent_id, $student_id);

    if ($insert->execute()) {
        echo "<script>alert('Student linked successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error linking student. Please try again.'); window.history.back();</script>";
    }

    $insert->close();
    $check->close();
    $stmt->close();
    $conn->close();
}
?>
