<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section_id = (int) ($_POST['section_id'] ?? 0);
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $gender = trim($_POST['gender'] ?? '');

    if ($section_id && $firstname && $lastname && in_array($gender, ['Male', 'Female'])) {
        $stmt = $conn->prepare("DELETE FROM master_list WHERE section_id = ? AND firstname = ? AND lastname = ? AND gender = ?");
        $stmt->bind_param("isss", $section_id, $firstname, $lastname, $gender);
        if ($stmt->execute()) {
            header("Location: view_section.php?id=$section_id&status=removed");
            exit;
        } else {
            echo "Failed to remove student.";
        }
    } else {
        echo "Invalid input.";
    }
} else {
    echo "Invalid request method.";
}
?>
