<style>
    .dropdown-container a {
        font-size: 14px;
        padding: 5px 0;
    }
</style>

<?php
include 'header.php';
include 'user_info.php';

$user_info = getUserInfo();
$full_name = isset($user_info['full_name']) ? $user_info['full_name'] : 'Guest';
$profile_image = isset($user_info['profile_image']) ? $user_info['profile_image'] : 'default.png';
?>

<div id="nav_side" class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-flex flex-column" style="min-height: 100vh; width: 250px;">
    <!-- Profile Section -->
    <div class="profile-pic mb-3 text-center">
        <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    <h5 class="text-center fw-bolder text-dark mb-3"><?= htmlspecialchars($full_name) ?></h5>
    <hr class="text-dark">

    <!-- Scrollable Menu -->
    <div style="overflow-y: auto; flex-grow: 1; padding-right: 5px;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="admission.php">
                    <i class="bi bi-journal-plus me-2"></i>Student Admission
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="enrollment.php">
                    <i class="bi bi-person-plus me-2"></i>Enroll Student
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="cor_issuance.php">
                    <i class="bi bi-file-earmark-text me-2"></i>COR Issuance
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="billing.php">
                    <i class="bi bi-credit-card-2-front me-2"></i>Tuition Payment
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="banner_edit.php?nav_drop=true">
                    <i class="bi bi-journal-bookmark me-2"></i>Banner
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="announcement.php">
                    <i class="bi bi-megaphone me-2"></i>Announcement
                </a>
            </li>

            <!-- Maintenance Dropdown -->
            <li class="nav-item">
                <div id="maintenanceMenu" class="dropdown-container border p-3 bg-light rounded-4">
                    <h6 class="fw-bolder">Maintenance</h6>
                    <hr class="m-0 py-1">
                    <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="students.php?nav_drop=true">
                        <i class="bi bi-people-fill me-2"></i>Students Account
                    </a>
                    <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="parent.php">
                        <i class="bi bi-house-heart me-2"></i>Parent Account
                    </a>
                    <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="teacher.php?nav_drop=true">
                        <i class="bi bi-person-video2 me-2"></i>Teachers Account
                    </a>
                    <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="tuition.php?nav_drop=true">
                        <i class="bi bi-currency-dollar me-2"></i>Manage Tuition
                    </a>
                    <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="sectioning.php?nav_drop=true">
                        <i class="bi bi-diagram-3 me-2"></i>Manage Sections
                    </a>
                    <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="subject_unit.php?nav_drop=true">
                        <i class="bi bi-journal-bookmark me-2"></i>Subjects and Units
                    </a>
                </div>
            </li>
        </ul>
    </div>

    <!-- Logout Button at Bottom -->
    <div class="pt-3 border-top">
        <a class="nav-link d-flex align-items-center px-3 py-2 rounded-3 text-danger fw-semibold" href="logout.php">
            <i class="bi bi-box-arrow-right me-2"></i> <span>Logout</span>
        </a>
    </div>
</div>
