
<?php
include 'header.php';
include 'user_info.php';

$user_info = getUserInfo();
$full_name = isset($user_info['full_name']) ? $user_info['full_name'] : 'Guest';
$profile_image = isset($user_info['profile_image']) ? $user_info['profile_image'] : 'default.png';
?>

<div id="nav_side" class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-flex flex-column" style="min-height: 100vh; width: 250px;">
    <!-- Profile Section -->
    <div class="text-center mb-3">
        <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
        <h5 class="fw-bolder text-dark mt-2"><?= htmlspecialchars($full_name) ?></h5>
        <p>Administrator</p>
        <hr class="text-dark">
    </div>

    <!-- Scrollable Navigation -->
    <div class="flex-grow-1 sidebar-scroll pe-2">
        <ul class="nav flex-column">

            <!-- Main Navigation -->
            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-2">ANALYTICS AND INSIGHTS</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>

            <!-- Student Services -->
            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-3">Student Services</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="admission.php">
                    <i class="bi bi-journal-plus me-2"></i>Admission
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="enrollment.php">
                    <i class="bi bi-person-plus me-2"></i>Enrollment
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="student_informtion.php">
                    <i class="bi bi-person me-2"></i>Student Info
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="cor_issuance2.php">
                    <i class="bi bi-file-earmark-text me-2"></i>COR Issuance
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="billing2.php">
                    <i class="bi bi-credit-card-2-front me-2"></i>Tuition Payment
                </a>
            </li>

            <!-- Content Management -->
            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-3">Content Management</h6>
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
            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-3">Diciplinary and Medical</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="disciplinary.php?nav_drop=true">
                    <i class="bi bi-journal-bookmark me-2"></i>Diciplinary
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="medical.php">
                    <i class="bi bi-megaphone me-2"></i>Medical
                </a>
            </li>
            <!-- System Management -->
            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-3">System Management</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="students.php?nav_drop=true">
                    <i class="bi bi-people-fill me-2"></i>Student Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="parents.php">
                    <i class="bi bi-house-heart me-2"></i>Parent Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="teacher.php?nav_drop=true">
                    <i class="bi bi-person-video2 me-2"></i>Teacher Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="admin.php">
                    <i class="bi bi-lock me-2"></i>Admin Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="tuition.php?nav_drop=true">
                    <i class="bi bi-currency-dollar me-2"></i>Manage Tuition
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="sectioning.php?nav_drop=true">
                    <i class="bi bi-diagram-3 me-2"></i>Manage Sections
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="uniforms.php?nav_drop=true">
                    <i class="bi bi-person me-2"></i>Manage Uniforms
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="subject_unit.php?nav_drop=true">
                    <i class="bi bi-journal-bookmark me-2"></i>Subjects & Units
                </a>
            </li>
        </ul>
    </div>

    <!-- Logout Link -->
    <div class="mt-auto">
        <hr class="text-dark">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class=" nav-link text-danger d-flex align-items-center py-2 fs-6" href="logout.php">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</div>
<style>
    /* Sidebar scroll area */
    .sidebar-scroll {
        max-height: calc(100vh - 220px); /* Adjust as needed */
        overflow-y: hidden; /* Hidden by default */
        scrollbar-width: none; /* Firefox: hide scrollbar by default */
    }

    .sidebar-scroll:hover {
        overflow-y: auto; /* Show on hover */
        scrollbar-width: auto; /* Firefox: show scrollbar on hover */
    }

    /* Scrollbar styles for WebKit browsers */
    .sidebar-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar-scroll::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: 3px;
    }

    .sidebar-scroll::-webkit-scrollbar-track {
        background-color: transparent;
    }

    /* Section headers */
    .nav h6 {
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    /* Hover effect on nav links */
    .nav-link:hover {
        background-color: #f8f9fa;
        border-radius: 5px;
    }
</style>
