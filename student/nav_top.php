<?php
include '../db_connection.php';

// Get user ID (from session)
$user_id = $_SESSION['user_id'];

// Fetch notification count
$count_query = $conn->prepare("SELECT notification FROM users WHERE user_id = ?");
$count_query->bind_param("i", $user_id);
$count_query->execute();
$count_result = $count_query->get_result();
$count_row = $count_result->fetch_assoc();
$notif_count = intval($count_row['notification'] ?? 0);

// Fetch notifications with teacher info
$query = "
    SELECT n.*, u.first_name, u.last_name 
    FROM notifications n
    LEFT JOIN users u ON n.user_id = u.user_id
    WHERE n.user_id = ?
    ORDER BY n.created_at DESC
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Header with logo and notification -->
<div class="d-flex border-bottom sticky-top align-items-center justify-content-between px-4 py-3 bg-white">
    <div class="d-flex align-items-center">
        <img src="../static/uploads/logo.png" alt="Logo" style="height: 60px; width: auto;" class="me-3">
        <h3 class="m-0">The Cardinal Academy</h3>
    </div>
    <div class="position-relative">
        <a id="notifBell" data-bs-toggle="offcanvas" href="#notificationCanvas" role="button" 
          aria-controls="notificationCanvas" class="btn border rounded-4 me-2 position-relative">
            <i class="bi bi-bell fs-5"></i>
            <?php if ($notif_count > 0): ?>
                <span id="notifBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?php echo $notif_count; ?>
                    <span class="visually-hidden">unread notifications</span>
                </span>
            <?php endif; ?>
        </a>
    </div>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const notifBell = document.getElementById("notifBell");
        const notifBadge = document.getElementById("notifBadge");

        if (notifBell) {
          notifBell.addEventListener("click", () => {
            // Hide badge visually
            if (notifBadge) notifBadge.style.display = "none";

            // Update notification count in database
            fetch("update_notification.php", {
              method: "POST"
            })
            .then(res => res.json())
            .then(data => {
              console.log("Notification reset:", data);
            })
            .catch(err => console.error("Error updating notifications:", err));
          });
        }
      });
    </script>


</div>

<style>
  .nav-item {
    border: none !important;
  }
  .nav-item .nav-link {
    border: none !important;
    color: gray !important;
    background-color: transparent !important;
  }
  .nav-item .nav-link.active {
    color: white !important;
    background-color: red !important;
    border-radius: 0 !important;
  }
  /* Badge style */
  .badge {
    font-size: 0.7rem;
    padding: 0.4em 0.5em;
    font-weight: bold;
  }
</style>
<!-- Offcanvas Notification Panel -->
<div class="offcanvas offcanvas-end" 
     tabindex="-1" 
     id="notificationCanvas" 
     aria-labelledby="notificationCanvasLabel"
     data-bs-scroll="true" 
     data-bs-backdrop="false"> <!-- allows scroll inside -->
  
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="notificationCanvasLabel">Notifications</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <!-- Scrollable body -->
  <div class="offcanvas-body p-3 overflow-auto" style="max-height: 100vh;">
    <?php if ($result->num_rows > 0): ?>
      <div class="list-group border-0">
        <?php while ($row = $result->fetch_assoc()): ?>
          <a href="<?php echo htmlspecialchars($row['link']); ?>" 
             class="list-group-item list-group-item-action mb-2 rounded-4 border shadow-sm d-flex align-items-start hover-notif">
            <div class="me-3 mt-1">
              <i class="bi bi-bell fs-4"></i>
            </div>
            <div class="flex-grow-1">
              <p class="mb-1 text-dark">
                <?php echo htmlspecialchars(mb_strimwidth($row['message'], 0, 100, "...")); ?>
              </p>
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

<style>
  .list-group-item {
    border: 1px solid #dee2e6 !important;
    transition: all 0.2s ease-in-out;
  }

  .hover-notif:hover {
    background-color: #f8f9fa !important;
    border-color: #adb5bd !important;
    transform: translateY(-2px);
  }

  /* Optional: style the scrollbar for smooth look */
  .offcanvas-body {
    scrollbar-width: thin;
    scrollbar-color: #adb5bd #f8f9fa;
  }

  .offcanvas-body::-webkit-scrollbar {
    width: 6px;
  }

  .offcanvas-body::-webkit-scrollbar-thumb {
    background-color: #adb5bd;
    border-radius: 10px;
  }

  .offcanvas-body::-webkit-scrollbar-thumb:hover {
    background-color: #6c757d;
  }
</style>
