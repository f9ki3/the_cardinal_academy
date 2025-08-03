<?php
include '../db_connection.php';

$user_id = $_SESSION['user_id'];

$sql = "SELECT first_name, last_name, profile FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

$full_name = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
$profile_image = !empty($user['profile']) ? '../static/uploads/' . htmlspecialchars($user['profile']) : '../static/uploads/default_profile.jpg';

// echo $profile_image;
?>

<style>
    .profile-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        border-radius: 50px;
    }
    .frame-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }
    .frame-container {
        position: relative;
        width: 100px;
        height: 100px;
        overflow: hidden;
        margin: auto;
    }
    .sidebar {
        width: 260px;
        min-height: 100vh;
        background-color: #b72029;
        padding: 1rem 0.5rem;
        box-shadow: 0 0 8px 0 rgb(0 0 0 / 0.5);
    }
    .sidebar .nav-item {
        color: #fafafa;
        font-weight: 500;
        border-radius: 0.75rem;
        user-select: none;
        transition: background-color 0.2s ease;
    }
    .sidebar .nav-item.active .nav-link,
    .sidebar .nav-item .nav-link.active {
        background-color: #da3030 !important;
        color: #fafafa !important;

    }

    .sidebar .nav-item:hover,
    .sidebar .nav-item.active {

    }
    .rotate {
        transform: rotate(-180deg);
        transition: transform 0.3s ease;
    }

    /* Disable submenu by default */


</style>

<div id="nav_side" class="d-print-none sidebar p-3 sticky-top d-none d-md-block" style="min-height: 100vh; width: 250px; overflow: hidden;">
    <div class="profile-pic mb-1 w-100 text-center">
        <div class="frame-container">
            <img src="student1.jpg" class="profile-photo" alt="User photo">
            <img src="tca_frame.png" class="frame-overlay" alt="Frame overlay">
        </div>
    </div>
    <h5 class="text-center fw-bolder text-light mb-3"><?= htmlspecialchars($full_name) ?></h5>
    <hr class="text-light mb-3">

    <div style="overflow-y: auto; max-height: calc(100vh - 200px); padding-right: 5px;">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-light d-flex align-items-center py-2 fs-6" href="dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>

            <li class="nav-item enrolled-parent">
                <a id="enrolledDropdown" class="dropdown-btn nav-link text-light d-flex justify-content-between align-items-center py-2 fs-6" href="javascript:void(0);">
                    <span><i class="bi bi-mortarboard me-2"></i>Enrolled</span> <i class="bi bi-chevron-down enrolled-chevron"></i>
                </a>
            </li>

            <div id="enrolledMenu" class="dropdown-container enrolled-disabled" style="display: none;">
                <li class="nav-item">
                    <a href="classes.php?nav_drop=true" class="nav-link text-light enrolled-link">
                        <i class="bi bi-journal-text me-2"></i>Classes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="assignment.php?nav_drop=true" class="nav-link text-light enrolled-link">
                        <i class="bi bi-card-checklist me-2"></i>Academic Task
                    </a>
                </li>
              
            </div>

            <li class="nav-item border-white">
                <a href="disciplinary.php" class="nav-link text-light d-flex align-items-center py-2 fs-6">
                    <i class="bi bi-people me-2"></i>Disciplinary
                </a>
            </li>
            <li class="nav-item border-white">
                <a href="medical.php" class="nav-link text-light d-flex align-items-center py-2 fs-6">
                    <i class="bi bi-capsule me-2"></i>Medical
                </a>
            </li>
            <li class="nav-item border-white">
                <a href="announcement.php" class="nav-link text-light d-flex align-items-center py-2 fs-6">
                    <i class="bi bi-megaphone me-2"></i>Announcement
                </a>
            </li>
          
            <li class="nav-item ">
                <a  class="nav-link text-light d-flex align-items-center py-2 fs-6" href="settings.php">
                    <i class="bi bi-megaphone me-2"></i>Setting
                </a>
            </li>
        </ul>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropdownBtn = document.getElementById("enrolledDropdown");
    const dropdownMenu = document.getElementById("enrolledMenu");
    const chevron = dropdownBtn.querySelector(".enrolled-chevron");
    const currentURL = window.location.pathname + window.location.search;

    // Toggle Enrolled dropdown
    dropdownBtn.addEventListener("click", () => {
        const isVisible = dropdownMenu.style.display === "block";
        dropdownMenu.style.display = isVisible ? "none" : "block";
        dropdownBtn.classList.toggle("active", !isVisible);
        chevron.classList.toggle("rotate", !isVisible);
    });

    // Handle submenu link clicks
    document.querySelectorAll('#enrolledMenu a').forEach(link => {
        link.addEventListener("click", function () {
            document.querySelectorAll('#enrolledMenu a').forEach(l => l.classList.remove("active"));
            this.classList.add("active");
            dropdownMenu.style.display = "block";
            chevron.classList.add("rotate");
        });

        // Activate submenu link on load
        const linkPath = new URL(link.href).pathname + new URL(link.href).search;
        if (currentURL.includes(linkPath)) {
            link.classList.add("active");
            dropdownMenu.style.display = "block";
            chevron.classList.add("rotate");
        }
    });

    // Activate top-level nav items (not in enrolled submenu)
    document.querySelectorAll('.nav > .nav-item > .nav-link').forEach(link => {
        const linkPath = new URL(link.href).pathname;
        if (currentURL.includes(linkPath) && !link.closest('#enrolledMenu')) {
            link.classList.add("active");
        }
    });
});
</script>
