<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $email        = trim($_POST['email']);
    $first_name   = trim($_POST['first_name']);
    $last_name    = trim($_POST['last_name']);
    $phone_number = $_POST['phone_number'] ?? null;

    $acc_status     = 'active';
    $acc_type       = 'parent';
    $rfid           = null;
    $enroll_id      = 0;
    $subject_title  = null;  // Optional depending on schema
    $default_pass   = password_hash('parent123', PASSWORD_DEFAULT); // Default secure password
    $profile_path   = 'dummy.jpg'; // Default profile image fallback

    // 🔼 Upload profile image if available
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
    }

    // 🔁 Check if parent already exists by name
    $checkSql = "SELECT user_id FROM users WHERE first_name = ? AND last_name = ? AND acc_type = 'parent'";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("ss", $first_name, $last_name);
    $checkStmt->execute();
    $checkStmt->store_result();
    $exists = $checkStmt->num_rows > 0;
    $checkStmt->close();

    if ($exists) {
        // ✅ Already exists — redirect with status
        header("Location: parent.php?status=exists&nav_drop=true");
        exit;
    }

    // 🔐 Generate unique username: firstname + lastname + '.parent'
    $base_username = strtolower($first_name . $last_name . '.parent');
    $final_username = $base_username;
    $suffix = 1;

    while (true) {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $final_username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 0) {
            $stmt->close();
            break; // Unique username found
        }

        $stmt->close();
        $final_username = $base_username . $suffix++;
    }

    // ✅ Insert new parent into users table
    $insert = $conn->prepare("
        INSERT INTO users (
            acc_type, username, email, password,
            first_name, last_name,
            phone_number, profile, rfid,
            enroll_id, acc_status, subject
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($insert) {
        $insert->bind_param(
            "ssssssssssis",
            $acc_type,
            $final_username,
            $email,
            $default_pass,
            $first_name,
            $last_name,
            $phone_number,
            $profile_path,
            $rfid,
            $enroll_id,
            $acc_status,
            $subject_title
        );

        if ($insert->execute()) {
            header("Location: parent.php?status=created&nav_drop=true");
            exit;
        } else {
            die("❌ Failed to create account: " . $insert->error);
        }

        $insert->close();
    } else {
        die("❌ Failed to prepare insert statement: " . $conn->error);
    }
} else {
    header("Location: parent.php?status=invalid_access");
    exit;
}
