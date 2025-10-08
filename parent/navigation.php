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
$profile_image = !empty($user['profile']) ? '../static/uploads/' . htmlspecialchars($user['profile']) : '../static/uploads/dummy.jpg';
?>

<div id="nav_side" 
     class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-flex flex-column" 
     style="min-height: 100vh; width: 260px; background: #fff; box-shadow: 2px 0 6px rgba(0,0,0,0.05);">

    <!-- Profile Section -->
    <div class="profile-pic mb-3 w-100 text-center">
        <img 
            src="<?= htmlspecialchars($profile_image) ?>" 
            alt="Profile" 
            class="rounded-circle shadow-sm img-fluid d-block mx-auto" 
            style="width: 90px; height: 90px; object-fit: cover;"
        >
        <h6 class="mt-2 fw-semibold text-dark mb-0"><?= htmlspecialchars($full_name) ?></h6>
        <small class="text-muted">Parents</small>
    </div>

    <hr class="text-muted">

    <!-- Scrollable nav -->
    <div class="flex-grow-1 overflow-auto" style="max-height: calc(100vh - 200px);">
    <ul class="nav flex-column gap-1">
        <li class="nav-item">
        <a href="#" 
            class="nav-link d-flex align-items-center px-3 py-2 rounded-3"
            data-bs-toggle="modal" 
            data-bs-target="#linkStudentModal">
            <i class="bi bi-plus-circle me-2"></i> 
            <span>Link Student</span>
        </a>
        </li>

        <li class="nav-item">
        <a href="dashboard.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3">
            <i class="bi bi-megaphone me-2"></i> <span>Announcement</span>
        </a>
        </li>

        <li class="nav-item">
        <a href="attendance.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3">
            <i class="bi bi-calendar-check me-2"></i> <span>Attendance</span>
        </a>
        </li>

        <li class="nav-item">
        <a href="medical.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3">
            <i class="bi bi-heart-pulse me-2"></i> <span>Medical</span>
        </a>
        </li>

        <li class="nav-item">
        <a href="disciplinary.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3">
            <i class="bi bi-exclamation-triangle me-2"></i> <span>Disciplinary</span>
        </a>
        </li>
    </ul>
    </div>


    <!-- Logout at bottom -->
    <div class="mt-auto pt-3 border-top">
        <a class="nav-link d-flex align-items-center px-3 py-2 rounded-3 text-danger fw-semibold" href="logout.php">
            <i class="bi bi-box-arrow-right me-2"></i> <span>Logout</span>
        </a>
    </div>
</div>

<!-- Styles -->
<style>
    #nav_side .nav-link {
        color: #333 !important;
        font-size: 0.95rem;
        transition: all 0.25s ease-in-out;
    }
    #nav_side .nav-link i {
        font-size: 1.1rem;
        transition: inherit;
    }
    #nav_side .nav-link:hover {
        background: #f1f5ff;
        color: #0d6efd !important;
        font-weight: 600;
    }
    #nav_side .nav-link:hover i {
        color: #0d6efd !important;
    }
    #nav_side .nav-link.active {
        background: #e7f1ff;
        color: #0d6efd !important;
        font-weight: 700;
    }
    #nav_side .collapse .nav-link {
        font-size: 0.9rem;
        color: #555 !important;
    }
    #nav_side .collapse .nav-link:hover {
        background: #f8f9fa;
        color: #0d6efd !important;
    }
</style>


<div class="modal fade" id="linkStudentModal" tabindex="-1" aria-labelledby="linkStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="linkStudentModalLabel">Link Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="linkStudentForm">
          <div class="mb-3">
            <label for="studentCode" class="form-label">Student Code</label>
            <input type="text" id="studentCode" name="studentCode" class="form-control rounded-3" placeholder="Enter student code" required>
          </div>
          <button type="submit" class="btn btn-danger w-100 rounded-3">Link</button>
        </form>
      </div>
    </div>
  </div>
</div>