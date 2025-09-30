<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $acc_type      = 'teacher';
    $subject_title = trim($_POST['subject_title']);
    $username      = trim($_POST['username']);
    $email         = trim($_POST['email']);
    $first_name    = trim($_POST['first_name']);
    $last_name     = trim($_POST['last_name']);
    $gender        = $_POST['gender'] ?? null;
    $birthdate     = $_POST['birthdate'] ?? null;
    $phone_number  = $_POST['phone_number'] ?? null;
    $address       = $_POST['address'] ?? null;
    $acc_status    = 'active';
    $profile_path  = '';
    $rfid          = null;  // assuming not used yet
    $default_pass  = password_hash('password123', PASSWORD_DEFAULT); // Default password

    // Handle profile image upload
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = realpath(__DIR__ . '/../static/uploads');
        if (!is_dir($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die("❌ Failed to create upload directory.");
            }
        }

        $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
        $filename = 'user_' . uniqid() . '.' . $ext;
        $destination = $upload_dir . '/' . $filename;

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $destination)) {
            $profile_path = '../static/uploads/' . $filename;
        } else {
            die("❌ Failed to upload profile image.");
        }
    } else {
        // Default placeholder image if none uploaded
        $profile_path = 'dummy.jpg'; // Make sure this file exists
    }

    // Prepare insert statement (removed enroll_id)
    $stmt = $conn->prepare("
        INSERT INTO users (
            acc_type, username, email, password,
            first_name, last_name, gender, birthdate,
            phone_number, address, profile, rfid,
            acc_status, subject
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssiss",
            $acc_type, $username, $email, $default_pass,
            $first_name, $last_name, $gender, $birthdate,
            $phone_number, $address, $profile_path, $rfid,
            $acc_status, $subject_title
        );

        if ($stmt->execute()) {
            header("Location: teacher.php?status=created&nav_drop=true");
            exit;
        } else {
            die("❌ Failed to create account: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("❌ Failed to prepare insert statement: " . $conn->error);
    }
} else {
    header("Location: teacher.php?status=invalid_access");
    exit;
}
