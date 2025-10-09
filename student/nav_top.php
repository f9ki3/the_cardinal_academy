<?php
include '../db_connection.php';
// session_start();

$user_id = $_SESSION['user_id'] ?? 0;

// Fetch unread notification count
$count_query = $conn->prepare("SELECT notification FROM users WHERE user_id = ?");
$count_query->bind_param("i", $user_id);
$count_query->execute();
$count_result = $count_query->get_result();
$count_row = $count_result->fetch_assoc();
$notif_count = intval($count_row['notification'] ?? 0);
?>

<!-- HEADER -->
<header class="border-bottom sticky-top bg-white py-3 px-4 shadow-sm">
  <div class="container-fluid d-flex align-items-center justify-content-between flex-nowrap">
    <!-- Logo + Title -->
    <div class="d-flex align-items-center flex-nowrap">
      <img src="../static/uploads/logo.png" alt="Logo" 
           class="me-3 flex-shrink-0" 
           style="height:60px; width:auto;">
      <h3 class="m-0 fw-bold text-nowrap">The Cardinal Academy</h3>
    </div>

    <!-- Notification Bell -->
    <div class="position-relative flex-shrink-0">
      <a id="notifBell" 
         data-bs-toggle="offcanvas" 
         href="#notificationCanvas" 
         aria-controls="notificationCanvas"
         class="btn border rounded-4 position-relative d-flex align-items-center justify-content-center"
         style="width:45px; height:45px;">
        <i class="bi bi-bell fs-5"></i>
        <span id="notifBadge"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
              style="display: <?= $notif_count > 0 ? 'inline-block' : 'none'; ?>; min-width:22px; font-size:0.7rem;">
          <?= $notif_count ?>
        </span>
      </a>
    </div>
  </div>
</header>

<!-- OFFCANVAS NOTIFICATIONS -->
<div class="offcanvas offcanvas-end"
     tabindex="-1"
     id="notificationCanvas"
     aria-labelledby="notificationCanvasLabel"
     data-bs-scroll="true"
     data-bs-backdrop="false">

  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="notificationCanvasLabel">Notifications</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body p-3 overflow-auto" style="max-height: 100vh;" id="notifContainer">
    <div id="notifList" class="list-group border-0"></div>

    <!-- Loader -->
    <div id="loader" class="text-center my-3" style="display:none;">
      <div class="spinner-border text-danger" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <!-- End text -->
    <p id="noMore" class="text-muted text-center mt-3" style="display:none;">No more notifications.</p>
  </div>
</div>

<!-- JS -->
 <script>
document.addEventListener("DOMContentLoaded", () => {
  const notifContainer = document.getElementById('notifContainer');
  const notifList = document.getElementById('notifList');
  const loader = document.getElementById('loader');
  const noMore = document.getElementById('noMore');
  const notifBell = document.getElementById('notifBell');
  const notifBadge = document.getElementById('notifBadge');
  const notifCanvas = document.getElementById('notificationCanvas');

  let offset = 0;
  const limit = 10;
  let loading = false;
  let endReached = false;
  let initialized = false; // ✅ Prevent reload flicker

  async function loadNotifications(initial = false) {
    if (loading || endReached) return;
    loading = true;
    loader.style.display = 'block';
    noMore.style.display = 'none';

    try {
      const res = await fetch(`fetch_notifications_lazy.php?offset=${offset}`);
      const data = await res.json();

      if (!Array.isArray(data) || data.length === 0) {
        if (offset === 0 && initial) {
          notifList.innerHTML = "<p class='text-muted text-center mt-3'>No notifications yet.</p>";
        } else {
          endReached = true;
          noMore.style.display = 'block';
        }
      } else {
        data.forEach(n => {
          const a = document.createElement('a');
          a.href = n.link || "#";
          a.className = 'list-group-item list-group-item-action mb-2 rounded-4 border shadow-sm d-flex align-items-start hover-notif fade-in';
          a.innerHTML = `
            <div class="me-3 mt-1"><i class="bi bi-bell fs-4"></i></div>
            <div class="flex-grow-1">
              <p class="mb-1 text-dark fw-medium">${n.message}</p>
              <small class="text-muted">${n.created_at}</small>
            </div>`;
          notifList.appendChild(a);
        });
        offset += limit;
      }
    } catch (err) {
      console.error('Error loading notifications:', err);
    } finally {
      loader.style.display = 'none';
      loading = false;
    }
  }

  // ✅ Show notifications only after data is ready
  notifBell.addEventListener("click", async (e) => {
    e.preventDefault(); // prevent anchor default
    notifBadge.style.display = "none";

    // Update notifications in DB (mark as read)
    fetch('update_notification.php', { method: 'POST' }).catch(err => console.error(err));

    // If already loaded before, just show
    if (initialized) {
      const offcanvas = bootstrap.Offcanvas.getOrCreateInstance(notifCanvas);
      offcanvas.show();
      return;
    }

    // First time: show loader, fetch, then open
    loader.style.display = 'block';
    await loadNotifications(true);

    const offcanvas = bootstrap.Offcanvas.getOrCreateInstance(notifCanvas);
    offcanvas.show();

    initialized = true;
  });

  // Infinite scroll (load more when scrolled to bottom)
  notifContainer.addEventListener('scroll', () => {
    const { scrollTop, scrollHeight, clientHeight } = notifContainer;
    if (scrollTop + clientHeight >= scrollHeight - 10) {
      loadNotifications();
    }
  });
});
</script>


<!-- STYLES -->
<style>
/* Stable header layout */
header {
  min-height: 80px;
}

/* Notification card style */
.list-group-item {
  border: 1px solid #dee2e6 !important;
  transition: all 0.2s ease-in-out;
  padding: 1rem 1.25rem !important;
  border-radius: 1rem !important;
  background-color: #fff !important;
}

.hover-notif:hover {
  background-color: #f8f9fa !important;
  border-color: #adb5bd !important;
  transform: translateY(-2px);
}

/* Fade-in animation */
.fade-in {
  opacity: 0;
  animation: fadeIn 0.4s ease forwards;
}
@keyframes fadeIn {
  to { opacity: 1; }
}

/* Prevent content wrapping or shifting */
.container-fluid {
  max-width: 100%;
  white-space: nowrap;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  header h3 {
    font-size: 1.1rem;
  }
  .list-group-item {
    padding: 0.8rem 1rem !important;
  }
}
</style>
