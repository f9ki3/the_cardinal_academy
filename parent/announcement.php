<?php
include 'session_login.php';
include '../db_connection.php';

// Fetch parent announcements only
$announcements = [];
$stmt = $conn->prepare("SELECT * FROM announcements WHERE acc_type = 'parent' ORDER BY date DESC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $announcements[] = $row;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Parent Announcements</title>
<?php include 'header.php'; ?>
<style>
.announcement-card {
    border-radius: 1rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    padding: 1.5rem;
    background-color: #ffffff;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.2s;
}
.announcement-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}
.announcement-date {
    font-size: 0.85rem;
    color: #6c757d;
}
.acc-type-badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.5rem;
    border-radius: 0.5rem;
    background-color: #e7f1ff;
    color: #0d6efd;
}
</style>
</head>
<body>
<div class="d-flex flex-row bg-light">
    <?php include 'navigation.php'; ?>
    <div class="content flex-grow-1">
        <?php include 'nav_top.php'; ?>
        <div class="container my-4">
                <div class="row g-4">
                    <div class="col-12">
                      <div class="container my-4">
                          <div class="row mb-3">
                              <div class="col-12 col-md-5">
                                  <h4>Parent Announcements</h4>
                                  <p class="text-muted">You may now view school announcements here.</p>
                              </div>
                          </div>

                          <div class="row g-4">
                              <?php if(!empty($announcements)): ?>
                                  <?php foreach($announcements as $announcement): ?>
                                      <div class="col-md-6 col-lg-4">
                                          <div class="announcement-card" 
                                              data-bs-toggle="modal" 
                                              data-bs-target="#announcementModal<?= $announcement['id'] ?>">
                                              <div class="d-flex justify-content-between align-items-center mb-2">
                                                  <span class="acc-type-badge"><?= htmlspecialchars($announcement['acc_type']) ?></span>
                                                  <span class="announcement-date"><?= date("F j, Y, g:i A", strtotime($announcement['date'])) ?></span>
                                              </div>
                                              <div class="announcement-message" style="max-width: 100%;">
                                                  <?= htmlspecialchars(strlen($announcement['message']) > 100 ? substr($announcement['message'], 0, 100) . '...' : $announcement['message']) ?>
                                              </div>
                                          </div>
                                      </div>

                                      <!-- Modal -->
                                      <div class="modal fade" id="announcementModal<?= $announcement['id'] ?>" tabindex="-1" aria-labelledby="announcementModalLabel<?= $announcement['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                          <div class="modal-content">
                                            <div class="modal-header bg-light">
                                              <h5 class="modal-title fw-bold" id="announcementModalLabel<?= $announcement['id'] ?>">Announcement</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <p><strong>Date:</strong> <?= date("F j, Y, g:i A", strtotime($announcement['date'])) ?></p>
                                              <p><?= nl2br(htmlspecialchars($announcement['message'])) ?></p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-outline-secondary rounded-4 px-4" data-bs-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>

                                  <?php endforeach; ?>
                              <?php else: ?>
                                  <div class="col-12">
                                      <p class="text-muted">No parent announcements found.</p>
                                  </div>
                              <?php endif; ?>
                          </div>
                      </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
