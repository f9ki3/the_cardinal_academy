<?php
session_start();
include '../db_connection.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user ID from hidden field
    $user_id = intval($_POST['user_id']);

    // Collect form inputs
    $first_name   = trim($_POST['first_name']);
    $last_name    = trim($_POST['last_name']);
    $email        = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $birthdate    = $_POST['birthdate'] ?: null;
    $gender       = $_POST['gender'];
    $address      = trim($_POST['address']);

    // --- Handle profile picture upload ---
    $profile_picture = null;
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "../static/uploads/"; // make sure directory exists & writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $ext = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
        $filename = time() . "_" . uniqid() . "." . strtolower($ext);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['profile']['tmp_name'], $targetPath)) {
            $profile_picture = $filename;
        }
    }

    // --- Update query ---
    if ($profile_picture) {
        $sql = "UPDATE users 
                   SET first_name = ?, 
                       last_name = ?, 
                       email = ?, 
                       phone_number = ?, 
                       birthdate = ?, 
                       gender = ?, 
                       address = ?, 
                       profile = ? 
                 WHERE user_id = ?";
    } else {
        $sql = "UPDATE users 
                   SET first_name = ?, 
                       last_name = ?, 
                       email = ?, 
                       phone_number = ?, 
                       birthdate = ?, 
                       gender = ?, 
                       address = ? 
                 WHERE user_id = ?";
    }

    $stmt = $conn->prepare($sql);

    if ($profile_picture) {
        $stmt->bind_param("ssssssssi",
            $first_name,
            $last_name,
            $email,
            $phone_number,
            $birthdate,
            $gender,
            $address,
            $profile_picture,
            $user_id
        );
    } else {
        $stmt->bind_param("sssssssi",
            $first_name,
            $last_name,
            $email,
            $phone_number,
            $birthdate,
            $gender,
            $address,
            $user_id
        );
    }

    if ($stmt->execute()) {
        header("Location: profile.php?success=updated");
        exit;
    } else {
        header("Location: profile.php?success=error");
        exit;
    }
}
?>
