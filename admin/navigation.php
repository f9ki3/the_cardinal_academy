<?php
include 'header.php';
include 'user_info.php';

$user_info = getUserInfo();
$full_name = isset($user_info['full_name']) ? $user_info['full_name'] : 'Guest';
$profile_image = isset($user_info['profile_image']) ? $user_info['profile_image'] : 'default.png';
$role = $_SESSION['role'] ?? 'Unknown';

// Helper function for access control
function canAccess($role, $allowedRoles) {
    return in_array($role, $allowedRoles);
}

// --- HARDCODED COUNTER VALUES ---
$admission_count = 15;  // Example: 15 pending admission applications
$enrollment_count = 5; // Example: 5 students pending final enrollment
// -----------------------------------

// Define allowed roles for each page
$access = [
    'admission' => ['Administrator', 'Assistant Principal', 'Registrar'],
    'enrollment' => ['Administrator', 'Assistant Principal', 'Registrar'],
    'student_info' => ['Administrator', 'Assistant Principal', 'Registrar'],
    'cor' => ['Administrator', 'Assistant Principal', 'Accounting'],
    'tuition' => ['Administrator', 'Assistant Principal', 'Accounting'],
    'disciplinary' => ['Administrator', 'Assistant Principal', 'Guidance'],
    'medical' => ['Administrator', 'Assistant Principal', 'School Nurse'],
    'grades' => ['Administrator', 'Assistant Principal', 'Registrar'],
    
];
?>

<div id="nav_side" class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-flex flex-column" style="min-height: 100vh; width: 250px;">
    <div class="text-center mb-3">
        <img src="<?= htmlspecialchars($profile_image) ?>" alt="Profile" class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
        <h5 class="fw-bolder text-dark mt-2"><?= htmlspecialchars($full_name) ?></h5>
        <p><?= ucfirst(htmlspecialchars($role)) ?></p>
        <hr class="text-dark">
    </div>

    <div class="flex-grow-1 sidebar-scroll pe-2">
        <ul class="nav flex-column">

            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-2">ANALYTICS AND INSIGHTS</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="dashboard.php">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>

            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-3">Student Services</h6>
            </li>

            <?php
            /**
             * Renders a navigation link with optional counter badge.
             * * @param string $page The target file name (e.g., 'admission.php').
             * @param string $icon The Bootstrap icon class.
             * @param string $label The text label for the link.
             * @param string $role The current user's role.
             * @param array $allowedRoles The roles allowed to access this page.
             * @param int $counter The number to display in the badge (0 or null to hide).
             */
            function renderLink($page, $icon, $label, $role, $allowedRoles, $counter = 0) {
                $allowed = canAccess($role, $allowedRoles);
                $class = $allowed ? 'text-dark' : 'text-muted disabled';
                $href = $allowed ? $page : '#';
                $disabledAttr = $allowed ? '' : 'tabindex="-1" aria-disabled="true"';
                $badge = '';

                // Add Badge if counter is greater than 0
                if ($counter > 0) {
                    $badge = " <span class='badge bg-danger rounded-pill ms-auto'>$counter</span>";
                }

                echo "
                <li class='nav-item'>
                    <a class='nav-link d-flex align-items-center py-2 fs-6 $class' href='$href' $disabledAttr>
                        <i class='$icon me-2'></i>$label$badge
                    </a>
                </li>";
            }

            // --- Links with Counter Implementation ---
            renderLink('admission.php', 'bi bi-journal-plus', 'Admission', $role, $access['admission'], $admission_count);
            renderLink('enrollment.php', 'bi bi-person-plus', 'Enrollment', $role, $access['enrollment'], $enrollment_count);
            // ----------------------------------------

            renderLink('student_informtion.php', 'bi bi-person', 'Student Info', $role, $access['student_info']);
            renderLink('cor_issuance2.php', 'bi bi-file-earmark-text', 'COR Issuance', $role, $access['cor']);
            renderLink('billing2.php', 'bi bi-credit-card-2-front', 'Tuition Payment', $role, $access['tuition']);
            renderLink('final_grade.php', 'bi bi bi-dropbox', 'Student Grades', $role, $access['grades']);
            ?>

            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-3">Content Management</h6>
            </li>
            <?php
            $adminAccess = ['Administrator', 'Assistant Principal'];
            renderLink('banner_edit.php?nav_drop=true', 'bi bi-journal-bookmark', 'Banner', $role, $adminAccess);
            renderLink('announcement.php', 'bi bi-megaphone', 'Announcement', $role, $adminAccess);
            ?>

            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-3">Disciplinary and Medical</h6>
            </li>
            <?php
            renderLink('disciplinary.php?nav_drop=true', 'bi bi-journal-bookmark', 'Disciplinary', $role, $access['disciplinary']);
            renderLink('medical.php', 'bi bi-heart-pulse', 'Medical', $role, $access['medical']);
            ?>

            <li class="nav-item">
                <h6 class="fw-bold text-uppercase text-secondary ps-2 mb-2 mt-3">System Management</h6>
            </li>
            <?php
            renderLink('students.php?nav_drop=true', 'bi bi-people-fill', 'Student Accounts', $role, $adminAccess);
            renderLink('parents.php', 'bi bi-house-heart', 'Parent Accounts', $role, $adminAccess);
            renderLink('teacher.php?nav_drop=true', 'bi bi-person-video2', 'Teacher Accounts', $role, $adminAccess);
            renderLink('admin.php', 'bi bi-lock', 'Admin Accounts', $role, $adminAccess);
            renderLink('tuition.php?nav_drop=true', 'bi bi-currency-dollar', 'Manage Tuition', $role, $adminAccess);
            renderLink('sectioning.php?nav_drop=true', 'bi bi-diagram-3', 'Manage Sections', $role, $adminAccess);
            renderLink('uniforms.php?nav_drop=true', 'bi bi-person', 'Manage Uniforms', $role, $adminAccess);
            renderLink('subject_unit.php?nav_drop=true', 'bi bi-journal-bookmark', 'Subjects & Units', $role, $adminAccess);
            ?>

            <li class="nav-item">
                <a class="nav-link text-dark d-flex align-items-center py-2 fs-6" href="profile.php?nav_drop=true">
                    <i class="bi bi-person-circle me-2"></i>My Account
                </a>
            </li>
        </ul>
    </div>

    <div class="mt-auto">
        <hr class="text-dark">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-danger d-flex align-items-center py-2 fs-6" href="logout.php">
                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
/* |--------------------------------------------------------------------------
| SCROLL FIX: Use 'overflow-y: scroll' to reserve space and prevent distortion.
|--------------------------------------------------------------------------
*/
.sidebar-scroll {
    max-height: calc(100vh - 220px);
    /* Set to 'scroll' instead of 'auto' or 'hidden' to reserve the scrollbar width */
    overflow-y: scroll; 
    /* Remove hover styles that were conditionally changing overflow */
    scrollbar-width: none;
}
/* Removed :hover block for conditional scroll to fix distortion */

/* Keep Webkit scrollbar styling for customization */
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
.nav h6 {
    font-size: 0.75rem;
    letter-spacing: 0.05em;
}
.nav-link:hover {
    background-color: #f8f9fa;
    border-radius: 5px;
}
.disabled {
    pointer-events: none !important;
    opacity: 0.6;
}
</style>