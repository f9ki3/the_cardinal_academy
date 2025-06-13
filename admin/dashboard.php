<?php include 'session_login.php'?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'?>
  
</head>
<body>

<div class="d-flex flex-row" style="background-color: white;">
  <!-- Sidebar -->
  <div class="sidebar p-3 border-end sticky-top" style="min-height: 100vh; width: 250px;">
    <div class="profile-pic mb-3 text-center">
      <img src="../static/uploads/profile.jpeg" alt="" class="rounded-circle img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
    </div>
    <h5 class="text-center fw-bolder text-light mb-3">Dela Cruz, Juan</h5>
    <hr class="text-light">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active text-dark" href="#"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-bar-chart me-2"></i>Grades</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-calendar-check me-2"></i>Attendances</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-chat-left-text me-2"></i>Message Board</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-wallet2 me-2"></i>Finance</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-heart-pulse me-2"></i>Medical</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-exclamation-circle me-2"></i>Disciplinary</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#"><i class="bi bi-journal-bookmark me-2"></i>Study Plan</a>
      </li>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="content flex-grow-1" >
    <div class="d-flex sticky-top align-items-center justify-content-between px-4 py-3" style="background-color: #b72029;">
    <div class="d-flex align-items-center">
        <img src="../static/uploads/logo.png" alt="Logo" style="height: 60px; width: auto;" class="me-3">
        <h3 class="text-light m-0">The Cardinal Academy</h3>
    </div>
    <a class="btn btn-light rounded-4" href="logout.php">Logout</a>
    </div>

    <!-- Main Content Grid -->
    <div class="container my-4">
    <div class="row g-4">
  <div class="col-12">
    <div class="card p-3">
      <h2 class="fw-bold">Welcome to AcadeSys</h2>
      <p class="text-muted">—let's have an awesome year!</p>
    </div>
  </div>

  <!-- First row of three cards -->

<div class="col-md-4">
  <div class="card p-3 h-100">
    <h5 class="section-title fw-bolder">2nd Quarterly Grading</h5>
    <small>S.Y. 2025–2026</small>
    <hr>
    <div id="grading-chart"></div>
  </div>
</div>


  <!-- Make sure to include Bootstrap Icons in your HTML head or before closing body -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="col-md-4">
    <div class="card p-4 h-100">
      <h5 class="fw-bolder text-start">Attendance</h5>
      <div class="row g-3">
      <div class="col-12">
          <div class="text-center mt-3">
            <span class="badge text-dark bg-light border p-3 w-100">Perfect Attendance</span>
            <!-- <p class="text-muted small mt-2 mb-0">Keep up the great work!</p> -->
          </div>
        </div>

      <!-- Absents -->
      <div class="col-6">
        <div class="border rounded-4 text-center p-3 bg-light ">
          <p class="mb-1 text-muted fw-semibold">Absents</p>
          <h2 class="fw-bold mb-0">0</h2>
        </div>
      </div>

      <!-- Presents -->
      <div class="col-6">
        <div class="border rounded-4 text-center p-3 bg-light ">
          <p class="mb-1 text-muted fw-semibold">Presents</p>
          <h2 class="fw-bold mb-0">20</h2>
        </div>
      </div>

      <!-- Monthly Total -->
      <div class="col-12">
        <div class="rounded-4 text-center py-4 bg-white border">
          <p class="mb-1 text-muted fw-semibold">November 2025</p>
          <h1 class="fw-bold display-1 m-0">20</h1>
        </div>
      </div>
      
       
    </div>

    </div>
  </div>


  <div class="col-md-4">
  <div class="card text-center p-4 h-100">
    <h5 class="fw-bolder text-start">Schedule</h5>
    
    <!-- Scrollable List Group -->
    <ul class="list-group overflow-auto" style="max-height: 400px;">
      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Dec</h6>
          <small class="text-muted d-block">8–25</small>
        </div>
        <div class="text-end">
          <p class="mb-0">2nd Quarterly Exam</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Jan</h6>
          <small class="text-muted d-block">5–10</small>
        </div>
        <div class="text-end">
          <p class="mb-0">Field Trip</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Feb</h6>
          <small class="text-muted d-block">14</small>
        </div>
        <div class="text-end">
          <p class="mb-0">Valentine's Program</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Mar</h6>
          <small class="text-muted d-block">1–3</small>
        </div>
        <div class="text-end">
          <p class="mb-0">Sports Fest</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Apr</h6>
          <small class="text-muted d-block">10–12</small>
        </div>
        <div class="text-end">
          <p class="mb-0">3rd Quarterly Exam</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">May</h6>
          <small class="text-muted d-block">1</small>
        </div>
        <div class="text-end">
          <p class="mb-0">Labor Day Break</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Jun</h6>
          <small class="text-muted d-block">20–25</small>
        </div>
        <div class="text-end">
          <p class="mb-0">Final Exams</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Jul</h6>
          <small class="text-muted d-block">4</small>
        </div>
        <div class="text-end">
          <p class="mb-0">Recognition Day</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Aug</h6>
          <small class="text-muted d-block">15</small>
        </div>
        <div class="text-end">
          <p class="mb-0">Parent-Teacher Meeting</p>
        </div>
      </li>

      <li class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <h6 class="mb-0 fw-bold d-block">Sep</h6>
          <small class="text-muted d-block">2–6</small>
        </div>
        <div class="text-end">
          <p class="mb-0">Science Week</p>
        </div>
      </li>
    </ul>
  </div>
</div>


  <!-- Second row of three cards with consistent spacing -->
  <div class="col-md-4">
    <div class="card p-4">
      <h5 class="section-title"><i class="bi bi-clipboard-heart me-2"></i>Medical</h5>
      <p class="mb-0">No Medical Issues</p>
    </div>

    <div class="card p-4 mt-3">
      <h5 class="section-title"><i class="bi bi-shield-exclamation me-2"></i>Disciplinary</h5>
      <p class="mb-0">No Disciplinary Measure Needed</p>
    </div>

    <div class="card p-4 mt-3">
      <h5 class="section-title"><i class="bi bi-journal-bookmark-fill me-2"></i>Study Plan</h5>
      <p class="mb-0">Quadratic Equation<br>Chapter 1: x is the...</p>
    </div>
  </div>
<div class="col-md-4">
  <div class="card p-4 h-100">
    <h5 class="section-title"><i class="bi bi-clipboard-data me-2"></i>Assignment</h5>

    <ul class="list-group mt-3" style="max-height: 300px; overflow-y: auto;">
      <li class="list-group-item">
        <strong>SCI</strong>: Interview a Cell<br>
        <small class="text-muted">Imagine you're a journalist...</small>
      </li>
      <li class="list-group-item">
        <strong>MATH</strong>: Equation Adventure<br>
        <small class="text-muted">Create a short comic strip...</small>
      </li>
      <li class="list-group-item">
        <strong>FIL</strong>: Liham para sa Bayani<br>
        <small class="text-muted">Sumulat ng liham bilang...</small>
      </li>
      <li class="list-group-item">
        <strong>PE</strong>: Fitness TikTok<br>
        <small class="text-muted">Design your own 30-sec video...</small>
      </li>
      <li class="list-group-item">
        <strong>SCI</strong>: Interview a Cell<br>
        <small class="text-muted">Imagine you're a journalist...</small>
      </li>
      <li class="list-group-item">
        <strong>MATH</strong>: Equation Adventure<br>
        <small class="text-muted">Create a short comic strip...</small>
      </li>
      <li class="list-group-item">
        <strong>FIL</strong>: Liham para sa Bayani<br>
        <small class="text-muted">Sumulat ng liham bilang...</small>
      </li>
      <li class="list-group-item">
        <strong>PE</strong>: Fitness TikTok<br>
        <small class="text-muted">Design your own 30-sec video...</small>
      </li>
      <!-- Add more items if needed to see scroll -->
    </ul>
  </div>
</div>

<div class="col-md-4">
  <div class="card p-4 h-100">
    <h5 class="section-title"><i class="bi bi-chat-left-text-fill me-2"></i>Message Board</h5>
    <ul class="list-group mt-3" style="max-height: 300px; overflow-y: auto;">
      <li class="list-group-item d-flex align-items-start gap-3">
        <div class="badge rounded-circle bg-primary text-white d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; font-weight: 600;">
          S
        </div>
        <div>
          <strong>Stephanie Candado</strong><br>
          <small class="text-muted">Here’s the image you need...</small>
        </div>
      </li>
      <li class="list-group-item d-flex align-items-start gap-3">
        <div class="badge rounded-circle bg-success text-white d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; font-weight: 600;">
          CJ
        </div>
        <div>
          <strong>Professor Escalora</strong><br>
          <small class="text-muted">Your group must publish...</small>
        </div>
      </li>
      <li class="list-group-item d-flex align-items-start gap-3">
        <div class="badge rounded-circle bg-warning text-dark d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; font-weight: 600;">
          S
        </div>
        <div>
          <strong>Librarian Stephany</strong><br>
          <small class="text-muted">According to our records...</small>
        </div>
      </li>
      <li class="list-group-item d-flex align-items-start gap-3">
        <div class="badge rounded-circle bg-danger text-white d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; font-weight: 600;">
          J
        </div>
        <div>
          <strong>Principal Juls</strong><br>
          <small class="text-muted">Can you please contact Mr. R...</small>
        </div>
      </li>
      <li class="list-group-item d-flex align-items-start gap-3">
        <div class="badge rounded-circle bg-danger text-white d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; font-weight: 600;">
          J
        </div>
        <div>
          <strong>Principal Juls</strong><br>
          <small class="text-muted">Can you please contact Mr. R...</small>
        </div>
      </li>
      <li class="list-group-item d-flex align-items-start gap-3">
        <div class="badge rounded-circle bg-danger text-white d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; font-weight: 600;">
          J
        </div>
        <div>
          <strong>Principal Juls</strong><br>
          <small class="text-muted">Can you please contact Mr. R...</small>
        </div>
      </li>
      <li class="list-group-item d-flex align-items-start gap-3">
        <div class="badge rounded-circle bg-danger text-white d-flex justify-content-center align-items-center" style="width: 36px; height: 36px; font-weight: 600;">
          J
        </div>
        <div>
          <strong>Principal Juls</strong><br>
          <small class="text-muted">Can you please contact Mr. R...</small>
        </div>
      </li>
      <!-- Add more items if needed to see scroll -->
    </ul>
  </div>
</div>

</div>

</div>
  </div>
</div>

<?php include'footer.php'?>
</body>
</html>
