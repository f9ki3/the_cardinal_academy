<?php
include 'session_login.php';
include '../db_connection.php';

// --- Pagination & search ----------------------------------------------------
$limit  = 10;
$page   = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

// Simple escaping for LIKE (still recommend prepared stmts in production)
$searchEsc = mysqli_real_escape_string($conn, $search);

// --- Count total student users (only those with section_id) -----------------
$count_query = "
    SELECT COUNT(*) AS total
    FROM users
    WHERE acc_type = 'student'
      AND section_id IS NOT NULL                 -- ✨ exclude NULL section_id
      AND (
          username LIKE '%$searchEsc%'
          OR CONCAT(first_name, ' ', last_name) LIKE '%$searchEsc%'
      )
";

$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}

$total        = mysqli_fetch_assoc($count_result)['total'];
$total_pages  = ceil($total / $limit);

// --- Fetch student user rows -------------------------------------------------
$query = "
    SELECT
        users.user_id,
        CONCAT(users.first_name, ' ', users.last_name) AS fullname,
        users.username,
        users.created_at,
        users.enroll_id,
        users.section_id,
        enroll_form.lrn  -- ✅ now pulling LRN from enroll_form
    FROM users
    JOIN enroll_form ON users.enroll_id = enroll_form.id
    WHERE users.acc_type = 'student'
      AND users.section_id IS NOT NULL
      AND (
          users.username LIKE '%$searchEsc%'
          OR CONCAT(users.first_name, ' ', users.last_name) LIKE '%$searchEsc%'
      )
    ORDER BY users.created_at DESC
    LIMIT $limit OFFSET $offset
";


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
  <title>AcadeSys - Manage Students</title>
  <?php include 'header.php'; ?>
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
                  <h4>Certificate of Registration Issuance</h4>
                </div>
                <div class="col-12 col-md-4">
                  <form method="GET" action="">
                    <div class="input-group">
                      <input class="form-control rounded rounded-4" type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search Username or Fullname">
                      <button class="btn border ms-2 rounded rounded-4" type="submit">Search</button>
                    </div>
                  </form>
                </div>

                <div class="col-12 pt-3">
                  <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'success'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Admission updated successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ❌ Something went wrong. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'review'): ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ⚠️ Application is under review.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-hover" style="cursor: pointer">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Fullname</th>
                      <th>Username</th>
                      <th>LRN</th>
                      <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                       <tr class="clickable-row"
                          data-id="<?= $row['section_id'] ?>"
                          data-fullname="<?= htmlspecialchars($row['fullname'], ENT_QUOTES) ?>"
                          data-lrn="<?= htmlspecialchars($row['lrn'], ENT_QUOTES) ?>"> <!-- ✅ Add this -->


                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['user_id']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['username']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['lrn']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['created_at']) ?></p></td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5"><p class="text-muted text-center pt-3 pb-3 mb-0">No student data available</p></td>
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
                      <li class="page-item">
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
</body>
</html>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const rows = document.querySelectorAll('.clickable-row');
  rows.forEach(row => {
    row.addEventListener('click', () => {
      const sectionId = row.getAttribute('data-id');
      const fullName = row.getAttribute('data-fullname');
      const lrn = row.getAttribute('data-lrn'); // ✅ get LRN
      const encodedName = encodeURIComponent(fullName);
      const encodedLRN = encodeURIComponent(lrn); // ✅ encode

      window.location.href = `view_cor.php?id=${sectionId}&fullname=${encodedName}&lrn=${encodedLRN}&nav_drop=true`; // ✅ add lrn param
    });
  });
});
</script>
