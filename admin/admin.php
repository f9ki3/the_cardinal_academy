<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

// Count total admin users
$count_query = "SELECT COUNT(*) as total FROM users 
                WHERE acc_type = 'admin' AND (
                    username LIKE '%$search%' 
                    OR CONCAT(first_name, ' ', last_name) LIKE '%$search%'
                )";
$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}
$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// Fetch admin users
$query = "SELECT 
            user_id, 
            CONCAT(first_name, ' ', last_name) AS fullname, 
            username, 
            created_at
          FROM users 
          WHERE acc_type = 'admin' AND (
              username LIKE '%$search%' 
              OR CONCAT(first_name, ' ', last_name) LIKE '%$search%'
          )
          ORDER BY created_at DESC
          LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $query);

// Handle delete action
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delete_id = (int) $_GET['delete'];

    $delete_query = "DELETE FROM users WHERE user_id = ? AND acc_type = 'admin'";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Admin account deleted successfully.');
                window.location.href = 'admin.php?status=deleted';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Failed to delete admin account.');
              </script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Admin Overview</title>
  <?php include 'header.php'; ?>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>
  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-5">
                  <h4>Admin Accounts</h4>
                </div>
                <div class="col-12 col-md-7 d-flex justify-content-between align-items-center flex-wrap gap-2">
                  <!-- Search Form -->
                  <form method="GET" action="" class="flex-grow-1">
                    <div class="input-group">
                      <input 
                        class="form-control rounded rounded-4" 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($search) ?>" 
                        placeholder="Search Username or Fullname"
                      >
                      <button class="btn border rounded rounded-4 ms-2" type="submit">Search</button>
                    </div>
                  </form>

                  <!-- Create Button -->
                  <a 
                    href="create_admin.php" 
                    class="btn bg-main text-light rounded rounded-4 px-4"
                  >
                    + Create
                  </a>
                </div>
              </div>

              <!-- Alerts -->
              <div class="col-12 pt-3">
                  <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'created'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Created admin account successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ❌ Something went wrong. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'deleted'): ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ⚠️ Admin account removed successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
              </div>

              <!-- Table -->
              <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                  <thead class="text-muted">
                    <tr>
                      <th class="py-3">Full Name</th>
                      <th class="py-3">Username</th>
                      <th class="py-3">Created At</th>
                      <th class="text-center py-3">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-id="<?= htmlspecialchars($row['user_id'], ENT_QUOTES) ?>" style="cursor:pointer;">
                          <td class="text-muted py-3"><?= htmlspecialchars($row['fullname']) ?></td>
                          <td class="text-muted py-3"><?= htmlspecialchars($row['username']) ?></td>
                          <td class="text-muted py-3"><?= htmlspecialchars($row['created_at']) ?></td>
                          <td class="text-center py-3">
                            <a href="?delete=<?= $row['user_id'] ?>" 
                              class="btn btn-sm btn-outline-secondary"
                              title="Delete Admin"
                              onclick="return confirm('Are you sure you want to delete this admin account?');">
                              <i class="bi bi-trash"></i> Delete
                            </a>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted py-3">No records found.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-start pagination-sm">
                    <?php if ($page > 1): ?>
                      <li class="page-item">
                        <a class="page-link text-muted" href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">Previous</a>
                      </li>
                    <?php endif; ?>

                    <?php
                      $max_links = 5;
                      $start = max(1, $page - floor($max_links / 2));
                      $end = min($total_pages, $start + $max_links - 1);
                      if ($end - $start < $max_links - 1) {
                        $start = max(1, $end - $max_links + 1);
                      }
                    ?>

                    <?php for ($i = $start; $i <= $end; $i++): ?>
                      <li class="page-item <?= $i == $page ? '' : '' ?>">
                        <a class="page-link text-muted <?= $i == $page ? 'fw-bold' : '' ?>" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
                      </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                      <li class="page-item">
                        <a class="page-link text-muted" href="?search=<?= urlencode($search) ?>&page=<?= $page + 1 ?>">Next</a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </nav>
              <?php endif; ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.clickable-row');
    rows.forEach(row => {
      row.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        window.location.href = `view_admin.php?id=${id}&nav_drop=true`;
      });
    });
  });
</script>
</body>
</html>
