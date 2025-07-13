<?php include 'session_login.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php' ?>
  <style>
    .chat-icon {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #b72029;
      width: 50px;
      height: 50px;
      border-radius: 50%;
      color: white;
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      cursor: pointer;
      z-index: 1000;
    }
    .chat-icon:hover {
      background-color: #da3030;
    }
  </style>
</head>
<body class="bg-light">

<div class="d-flex">
  <!-- Sidebar -->
  <?php include 'navigation.php' ?>

  <!-- Main Content -->
  <div class="flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container py-4">
      <!-- Welcome Section -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h2 class="fw-bold mb-0">Welcome, Parent</h2>
          <p class="text-muted mb-0">— Let's have an awesome year!</p>
        </div>
      </div>

      <!-- Dashboard Cards -->
      <div class="row g-3 mb-4">
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h6 class="text-muted mb-1">Child Enrolled</h6>
              <h5 class="fw-bold text-primary">Grade 5 - Sophia</h5>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h6 class="text-muted mb-1">Tuition Balance</h6>
              <h5 class="fw-bold text-danger">₱5,500</h5>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h6 class="text-muted mb-1">Unread Announcements</h6>
              <h5 class="fw-bold text-success">2</h5>
            </div>
          </div>
        </div>
      </div>

      <!-- Upcoming Events -->
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <h4 class="mb-3">📆 Upcoming Events</h4>
          <ul class="list-unstyled mb-0">
            <li>✅ Parent-Teacher Conference: <strong>July 18</strong></li>
            <li>📄 Quarterly Report Release: <strong>July 22</strong></li>
          </ul>
        </div>
      </div>

      <!-- Announcements -->
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="mb-3">📢 Announcements</h4>
          <ul class="list-unstyled mb-0">
            <li>🚨 School fire drill on <strong>July 15 at 1PM</strong></li>
            <li>⚙️ Payment portal maintenance on <strong>July 16</strong></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Chat Icon -->
<div class="chat-icon" title="Message Support">
  💬
</div>

<?php include 'footer.php' ?>
</body>
</html>
