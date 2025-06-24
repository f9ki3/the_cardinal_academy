<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize inputs
    $user_id      = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    $email        = trim($_POST['email'] ?? '');
    $subject        = trim($_POST['subject'] ?? '');
    $first_name   = trim($_POST['first_name'] ?? '');
    $last_name    = trim($_POST['last_name'] ?? '');
    $gender       = $_POST['gender'] ?? null;
    $birthdate    = $_POST['birthdate'] ?? null;
    $phone_number = trim($_POST['phone_number'] ?? '');
    $address      = trim($_POST['address'] ?? '');
    $rfid         = isset($_POST['rfid']) && $_POST['rfid'] !== '' ? intval($_POST['rfid']) : null;
    $acc_status   = $_POST['acc_status'] ?? 'active';
    $profile_file = $_FILES['profile'] ?? null;

    if ($user_id <= 0) {
        die("❌ Invalid user ID.");
    }

    // Handle profile image upload
    $profile_path = '';
    if ($profile_file && $profile_file['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../static/uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $ext       = pathinfo($profile_file['name'], PATHINFO_EXTENSION);
        $new_name  = 'user_' . $user_id . '_' . time() . '.' . $ext;
        $target    = $upload_dir . $new_name;

        if (move_uploaded_file($profile_file['tmp_name'], $target)) {
            $profile_path = $new_name;
        } else {
            die("❌ Failed to upload profile image.");
        }
    }

    // Build the SQL update
    $fields = "email = ?, first_name = ?, last_name = ?, gender = ?, birthdate = ?, phone_number = ?, address = ?, rfid = ?, acc_status = ?, subject = ?";
    $types  = "ssssssssss";
    $params = [$email, $first_name, $last_name, $gender, $birthdate, $phone_number, $address, $rfid, $acc_status, $subject];

    if (!empty($profile_path)) {
        $fields .= ", profile = ?";
        $types  .= "s";
        $params[] = $profile_path;
    }

    $sql = "UPDATE users SET $fields WHERE user_id = ?";
    $types .= "i";
    $params[] = $user_id;

    // Execute query
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("❌ DB Error: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);
    if ($stmt->execute()) {
        // ✅ Redirect to view_student.php with user ID
        header("Location: view_teacher.php?id=" . $user_id . "&status=success");
        exit;
    } else {
        die("❌ Update failed: " . $stmt->error);
    }

    $stmt->close();
} else {
    die("❌ Invalid request method.");
}
?>
