<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

// Count total parent users
$count_query = "SELECT COUNT(*) as total FROM users 
                WHERE acc_type = 'parent' AND (
                    username LIKE '%$search%' 
                    OR CONCAT(first_name, ' ', last_name) LIKE '%$search%'
                )";

$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}

$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// Fetch parent users (removed enroll_id)
$query = "SELECT 
            user_id, 
            CONCAT(first_name, ' ', last_name) AS fullname, 
            username, 
            created_at
          FROM users 
          WHERE acc_type = 'parent' AND (
              username LIKE '%$search%' 
              OR CONCAT(first_name, ' ', last_name) LIKE '%$search%'
          )
          ORDER BY created_at DESC
          LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("<p style='color:red;'>Data Query Failed: " . mysqli_error($conn) . "</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Parent Overview</title>
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
                <div class="col-12 col-md-8">
                  <h4>Parent Accounts</h4>
                </div>
                <div class="col-12 col-md-4">
                  <form method="GET" action="">
                    <div class="input-group">
                      <input type="text" name="search" class="form-control rounded rounded-4" placeholder="Search parent name..." value="<?= htmlspecialchars($search) ?>">
                      <button class="btn border ms-2 rounded rounded-4" type="submit">Search</button>
                    </div>
                  </form>
                </div>
              </div>

              <!-- Table -->
              <div class="table-responsive">
                <table class="table table-striped table-hover" style="cursor: pointer">
                  <thead>
                    <tr>
                      <th>Full Name</th>
                      <th>User Name</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-id="<?= htmlspecialchars($row['user_id'], ENT_QUOTES) ?>" style="cursor:pointer;">
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['username']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['created_at']) ?></p></td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr><td colspan="3" class="text-center">No records found.</td></tr>
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
        window.location.href = `view_parent.php?id=${id}&nav_drop=true`;
      });
    });
  });
</script>
</body>
</html>
