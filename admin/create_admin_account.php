<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Safe input handling with defaults
    $acc_type      = isset($_POST['acc_type']) ? trim($_POST['acc_type']) : 'staff'; // default acc_type
    $role          = isset($_POST['role']) ? trim($_POST['role']) : 'Guidance';      // default role
    $email         = isset($_POST['email']) ? trim($_POST['email']) : '';
    $first_name    = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $last_name     = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $phone_number  = $_POST['phone_number'] ?? null;
    $acc_status    = 'active';
    $profile_path  = '';
    $rfid          = null;
    $subject_title = null; // not applicable for these accounts

    // Check required fields
    if (empty($email) || empty($first_name) || empty($last_name)) {
        die("❌ Email, first name, and last name are required.");
    }

    // Generate unique username (firstname.lastname + random + "." + acc_type)
    $base_username = strtolower(preg_replace('/\s+/', '', $first_name . '.' . $last_name));
    do {
        $rand_suffix = rand(100, 999);
        $username = $base_username . $rand_suffix . '.' . strtolower($acc_type);

        $check_stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->store_result();
        $exists = $check_stmt->num_rows > 0;
        $check_stmt->close();
    } while ($exists);

    // Generate a random password
    function generateRandomPassword($length = 10) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        return substr(str_shuffle($chars), 0, $length);
    }
    $plain_password = generateRandomPassword();
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    // Handle profile image upload
    $upload_dir = __DIR__ . '/../static/uploads';
    if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
        $filename = 'user_' . uniqid() . '.' . $ext;
        $destination = $upload_dir . '/' . $filename;

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $destination)) {
            $profile_path = $filename;
        } else {
            $profile_path = 'dummy.jpg';
        }
    } else {
        $profile_path = 'dummy.jpg';
    }

    // Insert new account record
    $stmt = $conn->prepare("
        INSERT INTO users (
            acc_type, role, username, email, password,
            first_name, last_name, phone_number,
            profile, rfid, acc_status, subject
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt) {
        $stmt->bind_param(
            "ssssssssssss",
            $acc_type, $role, $username, $email, $hashed_password,
            $first_name, $last_name, $phone_number,
            $profile_path, $rfid, $acc_status, $subject_title
        );

        if ($stmt->execute()) {
            // Redirect to generated account info page
            $redirect_url = 'generated_admin.php?email=' . urlencode($username) . '&password=' . urlencode($plain_password);
            header("Location: $redirect_url");
            exit;
        } else {
            echo "❌ Failed to create account: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "❌ Failed to prepare insert statement: " . $conn->error;
    }

    $conn->close();

} else {
    echo "Invalid request method.";
}
?>
