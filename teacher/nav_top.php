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

<?php

// Get user ID (from session or GET)
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch notifications for this user
$query = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!-- Offcanvas Notification Panel -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="notificationCanvas" aria-labelledby="notificationCanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="notificationCanvasLabel">Notifications</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body p-3">
    <?php if ($result->num_rows > 0): ?>
      <div class="list-group">
        <?php while ($row = $result->fetch_assoc()): ?>
          <a href="<?php echo htmlspecialchars($row['link']); ?>" class="list-group-item list-group-item-action mb-2 rounded-3">
            <div class="d-flex w-100 justify-content-between">
              <p class="mb-1 fw-semibold text-dark"><?php echo htmlspecialchars($row['message']); ?></p>
              <small class="text-muted">
                <?php echo date("M d, Y h:i A", strtotime($row['created_at'])); ?>
              </small>
            </div>
          </a>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <p class="text-muted text-center mt-4">No notifications yet.</p>
    <?php endif; ?>
  </div>
</div>
