<?php
include 'session_login.php';
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("❌ Invalid request method.");
}

// Get and sanitize inputs
$user_id      = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$email        = trim($_POST['email'] ?? '');
$first_name   = trim($_POST['first_name'] ?? '');
$last_name    = trim($_POST['last_name'] ?? '');
$phone_number = trim($_POST['phone_number'] ?? '');
$address      = trim($_POST['address'] ?? '');
$rfid         = isset($_POST['rfid']) && $_POST['rfid'] !== '' ? intval($_POST['rfid']) : null;
$profile_file = $_FILES['profile'] ?? null;

// Validate required fields
if ($user_id <= 0 || empty($email) || empty($first_name) || empty($last_name)) {
    die("❌ Missing required fields.");
}

// Handle profile image upload
$profile_path = '';
if ($profile_file && $profile_file['error'] === UPLOAD_ERR_OK) {
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
    $ext = strtolower(pathinfo($profile_file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed_exts)) {
        die("❌ Invalid profile image format.");
    }

    $upload_dir = '../static/uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $new_name = 'admin_' . $user_id . '_' . time() . '.' . $ext;
    $target = $upload_dir . $new_name;

    if (move_uploaded_file($profile_file['tmp_name'], $target)) {
        $profile_path = $new_name;
    } else {
        die("❌ Failed to upload profile image.");
    }
}

// Build SQL update dynamically
$fields = "email = ?, first_name = ?, last_name = ?, phone_number = ?, address = ?, rfid = ?";
$types  = "sssssi";
$params = [$email, $first_name, $last_name, $phone_number, $address, $rfid];

if (!empty($profile_path)) {
    $fields .= ", profile = ?";
    $types  .= "s";
    $params[] = $profile_path;
}

$sql = "UPDATE users SET $fields WHERE user_id = ?";
$types .= "i";
$params[] = $user_id;

// Prepare and execute
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("❌ DB Error: " . $conn->error);
}

$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    // Redirect to view_admin.php with success status
    header("Location: view_admin.php?nav_drop=true&id=" . urlencode($user_id) . "&status=success");
    exit;
} else {
    die("❌ Update failed: " . $stmt->error);
}

$stmt->close();
?>
