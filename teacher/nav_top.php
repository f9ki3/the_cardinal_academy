<!-- Header with logo and notification -->
<div class="d-flex  border-bottom sticky-top align-items-center justify-content-between px-4 py-3 bg-white">
    <div class="d-flex align-items-center">
        <img src="../static/uploads/logo.png" alt="Logo" style="height: 60px; width: auto;" class="me-3">
        <h3 class="m-0">The Cardinal Academy</h3>
    </div>
    <div>
        <!-- Bell icon opens offcanvas -->
        <a data-bs-toggle="offcanvas" href="#notificationCanvas" role="button" aria-controls="notificationCanvas" class="btn border rounded-4 me-2">
            <i class="bi bi-bell"></i>
        </a>
    </div>
</div>
<style>

  .nav-item {
    border: none !important;
  }

  .nav-item .nav-link {
    border: none !important;
    color: gray !important; /* Inactive tab text color */
    background-color: transparent !important;
  }

  .nav-item .nav-link.active {
    color: white !important; /* Active tab text color */
    border: none !important;
    background-color: red !important;
    border-radius: 0px !important;
  }

</style>


<!-- Offcanvas Notification Panel with Tabs -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="notificationCanvas" aria-labelledby="notificationCanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="notificationCanvasLabel">Notifications</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="bg-white p-0 m-0 offcanvas-body">

    <!-- Tabs Navigation -->
   <ul class="nav sticky-top bg-white nav-tabs mb-3 border-bottom d-flex w-100" id="notificationTabs" role="tablist">
  <li class="nav-item flex-fill" role="presentation">
    <button class="nav-link active w-100 text-start" id="announcement-tab" data-bs-toggle="tab" data-bs-target="#announcement" type="button" role="tab" aria-controls="announcement" aria-selected="true">
      Announcement
    </button>
  </li>
</ul>



    <!-- Tabs Content -->
   <div class="tab-content" id="notificationTabsContent">
  <!-- Announcement Tab -->
  <div class="tab-pane fade show active" id="announcement" role="tabpanel" aria-labelledby="announcement-tab">
    <ul class="list-group">
      <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <li class="list-group-item">
            <div class="fw-bold text-muted">Announcement</div>
            <p class="text-muted mb-0"><?= htmlspecialchars($row['message']) ?></p>
          </li>
        <?php endwhile; ?>
      <?php else: ?>
        <li class="list-group-item">No announcements available.</li>
      <?php endif; ?>
    </ul>
  </div>

  <!-- Attendance Tab -->
  <div class="tab-pane fade" id="attendance" role="tabpanel" aria-labelledby="attendance-tab">
    <ul class="list-group">
      <li class="list-group-item">
        <div class="fw-bold text-muted">Student Attendance</div>
        <p class="text-muted mb-0">John Doe — July 15, 2025<br>Time In: 7:45 AM | Time Out: 4:00 PM</p>
      </li>
      <li class="list-group-item">
        <div class="fw-bold text-muted">Student Attendance</div>
        <p class="text-muted mb-0">Jane Smith — July 15, 2025<br>Time In: 7:50 AM | Time Out: 3:55 PM</p>
      </li>
    </ul>
  </div>
</div>

  </div>
</div>
