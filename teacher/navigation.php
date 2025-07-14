<?php
include 'header.php';
include 'user_info.php';

$user_info = getUserInfo();
$full_name = isset($user_info['full_name']) ? $user_info['full_name'] : 'Guest';
$profile_image = isset($user_info['profile_image']) ? $user_info['profile_image'] : 'default.png';
?>


    <!-- Scrollable navigation -->

<div id="nav_side" class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-block" style="min-height: 100vh; width: 250px; overflow: hidden;">
    <div class="profile-pic mb-3 text-center">
        <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="border border-danger border-3 rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    <h5 class="text-center fw-bolder text-dark mb-3"><?= htmlspecialchars($full_name) ?></h5>
    <hr class="text-dark">

    <div style="overflow-y: auto; max-height: calc(100vh - 200px); padding-right: 5px;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>
           
            
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>Student Profile
                </a>
            </li>
            <li class="nav-item border-white">
                <a href="attendance_list.php" class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-calendar-range me-2"></i>Attendance
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>Grades
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>Assignment
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>Disciplinary
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>Medical
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>Announcement
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                    <i class="bi bi-speedometer2 me-2"></i>Schedule
                </a>
            </li>            
        </ul>
    </div>
</div>