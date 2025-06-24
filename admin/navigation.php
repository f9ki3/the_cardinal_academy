<?php
include 'header.php';
?>

<?php
include 'user_info.php'; // adjust path as needed
$user_info = getUserInfo();

$full_name = isset($user_info['full_name']) ? $user_info['full_name'] : 'Guest';
$profile_image = isset($user_info['profile_image']) ? $user_info['profile_image'] : 'default.png';
?>

<div id="nav_side" class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-block" style="min-height: 100vh; width: 250px;">
    <div class="profile-pic mb-3 text-center">
        <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    <h5 class="text-center fw-bolder text-dark mb-3"><?= htmlspecialchars($full_name) ?></h5>
    <hr class="text-dark">
    
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="dashboard.php">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
        </li>
        <li class="nav-item border-white">
            <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="admission.php">
                <i class="bi bi-journal-plus me-2"></i>Student Admission
            </a>
        </li>
        <li class="nav-item border-white">
            <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="enrollment.php">
                <i class="bi bi-person-plus me-2"></i>Enroll Student
            </a>
        </li>
        <li class="nav-item border-white">
            <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="enrollment.php">
                <i class="bi bi-file-earmark-text me-2"></i>COR Issuance
            </a>
        </li>

        <li class="nav-item border-white">
            <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="enrollment.php">
                <i class="bi bi-credit-card-2-front me-2"></i>Billing and Payment
            </a>
        </li>

        <li class="nav-item border-white">
            <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
                <i class="bi bi-calendar-range me-2"></i>Class Scheduling
            </a>
        </li>

        <li class="nav-item">
            <a id="maintenanceDropdown" class="dropdown-btn nav-link text-dark d-flex justify-content-between align-items-center py-2 fs-6" href="javascript:void(0);">
                <span><i class="bi bi-tools me-2"></i>Maintenance</span>
                <span id="arrow-icon">▼</span>
            </a>
            <div id="maintenanceMenu" class="dropdown-container shadow border p-3 bg-light rounded rounded-4" style="display: none;">
                <h6 class="fw-bolder">Maintenance</h6>
                <hr class="m-0 py-1">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="students.php?nav_drop=true">
                    <i class="bi bi-people-fill me-2"></i>Students Account
                </a>
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="#">
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

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            const dropdownBtn = document.getElementById("maintenanceDropdown");
            const dropdownMenu = document.getElementById("maintenanceMenu");
            const arrowIcon = document.getElementById("arrow-icon");

            let isOpen = false;

            function toggleDropdown(forceOpen = null) {
                if (forceOpen !== null) {
                    isOpen = forceOpen;
                } else {
                    isOpen = !isOpen;
                }

                dropdownMenu.style.display = isOpen ? "block" : "none";
                arrowIcon.textContent = isOpen ? "▲" : "▼";
            }

            // Click toggle
            dropdownBtn.addEventListener("click", () => toggleDropdown());

            // Auto open if nav_drop=true
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get("nav_drop") === "true") {
                toggleDropdown(true);
            }
        });
        </script>



    </ul>
</div>


<!-- script for dropdown -->
<style>
    .dropdown-container {
  display: none;
  flex-direction: column;
  padding-left: 10px;
}

.dropdown-container a {
  font-size: 14px;
  padding: 5px 0;
}

.dropdown-btn.active + .dropdown-container {
  display: flex;
}


  
  </style>
<script>
  document.querySelectorAll('.dropdown-btn').forEach(button => {
    button.addEventListener('click', function () {
      const dropdown = this.nextElementSibling;
      dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    });
  });
</script>



