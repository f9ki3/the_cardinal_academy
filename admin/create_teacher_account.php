<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $acc_type      = 'teacher';
    $subject_title = trim($_POST['subject_title'] ?? '');
    $email         = trim($_POST['email']);
    $first_name    = trim($_POST['first_name']);
    $last_name     = trim($_POST['last_name']);
    $gender        = $_POST['gender'] ?? null;
    $birthdate     = $_POST['birthdate'] ?? null;
    $phone_number  = $_POST['phone_number'] ?? null;
    $address       = $_POST['address'] ?? null;
    $acc_status    = 'active';
    $profile_path  = '';
    $rfid          = null;  // not used yet

    // Generate a unique username (firstname.lastname + random + ".teacher")
    $base_username = strtolower(preg_replace('/\s+/', '', $first_name . '.' . $last_name));
    do {
        $rand_suffix = rand(100, 999);
        $username = $base_username . $rand_suffix . '.teacher';

        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $check_stmt->bind_param("s", $username);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();
    } while ($count > 0);

    // Generate a random password
    function generateRandomPassword($length = 10) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()';
        return substr(str_shuffle($chars), 0, $length);
    }
    $plain_password = generateRandomPassword();
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    // Handle profile image upload
    $upload_dir = __DIR__ . '/../static/uploads';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

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

    // Prepare insert statement
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
            $acc_type, $username, $email, $hashed_password,
            $first_name, $last_name, $gender, $birthdate,
            $phone_number, $address, $profile_path, $rfid,
            $acc_status, $subject_title
        );

        if ($stmt->execute()) {
            // Redirect to generated_teacher.php with email and password
            $redirect_url = 'generated_teacher.php?email=' . urlencode($username) . '&password=' . urlencode($plain_password);
            header("Location: $redirect_url");
            exit;
        } else {
            echo "Failed to create account: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to prepare insert statement: " . $conn->error;
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>
