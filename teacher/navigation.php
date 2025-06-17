<?php
include '../db_connection.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT first_name, last_name, profile FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$full_name = htmlspecialchars($user['first_name'] . ', ' . $user['last_name']);
$profile_image = !empty($user['profile']) ? '../static/uploads/' . htmlspecialchars($user['profile']) : '../static/uploads/default_profile.jpg';
?>

<!-- HTML starts here -->
<div id="nav_side" class="sidebar p-3 border-end sticky-top d-none d-md-block" style="min-height: 100vh; width: 250px;">
    <div class="profile-pic mb-3 text-center">
        <img src="<?= $profile_image ?>" alt="Profile Picture" class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    <h5 class="text-center fw-bolder text-light mb-3"><?= $full_name ?></h5>
    <hr class="text-light">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-light" href="dashboard.php"><i class="bi bi-bar-chart me-2"></i>Dashboard</a>
        </li>
        </li>
    </ul>
</div>
