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

<div id="nav_side" class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-block" style="min-height: 100vh; width: 250px; overflow: hidden;">
    <div class="profile-pic mb-3 text-center">
        <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    <h5 class="text-center fw-bolder text-dark mb-3"><?= htmlspecialchars($full_name) ?></h5>
    <hr class="text-dark">

    <!-- Scrollable navigation -->
    <div style="overflow-y: auto; max-height: calc(100vh - 200px); padding-right: 5px;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>
           
            <li class="nav-item border-white">
                <a href="#" class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-person me-2"></i>Profile
                </a>
            </li>

            <li class="nav-item border-white">
                <a href="attendance_list.php" class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-calendar4-week me-2"></i>Attendance
                </a>
            </li>
            <li class="nav-item border-white">
                <a href="attendance_list.php" class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-card-text me-2"></i>Grades
                </a>
            </li>
            <li class="nav-item border-white">
                <a href="attendance_list.php" class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-card-checklist me-2"></i>Assignment
                </a>
            </li>
            <li class="nav-item border-white">
                <a href="attendance_list.php" class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-people me-2"></i>Disciplinary
                </a>
            </li>
            <li class="nav-item border-white">
                <a href="attendance_list.php" class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-capsule me-2"></i>Medical
                </a>
            </li>
            <li class="nav-item border-white">
                <a href="attendance_list.php" class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-megaphone me-2"></i>Announcement
                </a>
            </li>

        </ul>
    </div>
</div>