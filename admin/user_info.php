<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../db_connection.php'; // Adjust path if needed

function getUserInfo() {
    global $conn;

    if (!isset($_SESSION['user_id']) || !$conn) {
        return null;
    }

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT first_name, last_name, profile FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        return null;
    }

    $full_name = htmlspecialchars($user['first_name'] . ', ' . $user['last_name']);
    $profile_image = !empty($user['profile']) 
        ? '../static/uploads/' . htmlspecialchars($user['profile']) 
        : '../static/uploads/default_profile.jpg';

    return [
        'full_name' => $full_name,
        'profile_image' => $profile_image
    ];
}
?>
