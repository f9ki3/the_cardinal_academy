<?php
include 'user_info.php'; // adjust path as needed

$user_info = getUserInfo();

$full_name = $user_info['full_name'];
$profile_image = $user_info['profile_image'];
?>




<div id="nav_side" class="sidebar p-3 border-end sticky-top d-none d-md-block" style="min-height: 100vh; width: 250px;">
    <!-- HTML -->
    <div class="profile-pic mb-3 text-center">
        <img src="<?= $profile_image ?>" alt="Profile" class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    <h5 class="text-center fw-bolder text-light mb-3"><?= $full_name ?></h5>
    <hr class="text-light">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link text-light" href="dashboard.php"><i class="bi bi-bar-chart me-2"></i>Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="admission.php"><i class="bi bi-calendar-check me-2"></i>Student Admission</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="enrollment.php"><i class="bi bi-book me-2"></i>Student Enrollment</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-wallet2 me-2"></i>Finance</a>
      </li>s
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-heart-pulse me-2"></i>Medical</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-exclamation-circle me-2"></i>Disciplinary</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-journal-bookmark me-2"></i>Study Plan</a>
      </li> -->
    </ul>
  </div>