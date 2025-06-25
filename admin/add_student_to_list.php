<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];

    // Fetch the student's info from the users table
    $stmt = $conn->prepare("SELECT first_name, last_name, gender FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $student = $result->fetch_assoc();
        $section_id = $_POST['section_id'];

        // Check if the student already exists in the master_list
        $check = $conn->prepare("SELECT id FROM master_list WHERE section_id = ? AND firstname = ? AND lastname = ?");
        $check->bind_param("iss", $section_id, $student['first_name'], $student['last_name']);
        $check->execute();
        $check_result = $check->get_result();

        if ($check_result->num_rows > 0) {
            // Student already exists
            header("Location: view_section.php?status=exists&nav_drop=true&id=" . $section_id);
            exit;
        }

        // Insert student into master_list
        $insert = $conn->prepare("INSERT INTO master_list (section_id, firstname, lastname, gender) VALUES (?, ?, ?, ?)");
        $insert->bind_param("isss", $section_id, $student['first_name'], $student['last_name'], $student['gender']);

        if ($insert->execute()) {
            header("Location: view_section.php?status=success&nav_drop=true&id=" . $section_id);
            exit;
        } else {
            echo "Error inserting student: " . $conn->error;
        }

    } else {
        echo "Student not found.";
    }
} else {
    echo "Invalid request.";
}
?>
