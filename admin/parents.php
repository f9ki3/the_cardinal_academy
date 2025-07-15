<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

$search_escaped = mysqli_real_escape_string($conn, $search);

// Count total distinct parents
$count_sql = "SELECT COUNT(DISTINCT guardian_name) AS total 
              FROM admission_form 
              WHERE guardian_name LIKE '%$search_escaped%'";
$count_result = mysqli_query($conn, $count_sql);
$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// Get parent and student count
$sql = "SELECT guardian_name, COUNT(*) AS student_count 
        FROM admission_form 
        WHERE guardian_name LIKE '%$search_escaped%'
        GROUP BY guardian_name 
        ORDER BY guardian_name ASC 
        LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);
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

        <!-- Table -->
        <div class="table-responsive">
          <table class="table table-striped table-hover" style="cursor: pointer">
            <thead >
              <tr>
                <th>Full Name</th>
                <th>No. of enrolled</th>
                <th>User Name</th>
              </tr>
            </thead>
            <tbody>
              <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): 
                  $parent = $row['guardian_name'];
                  $escaped = mysqli_real_escape_string($conn, $parent);
                  $students_result = mysqli_query($conn, "SELECT firstname, lastname FROM admission_form WHERE guardian_name = '$escaped'");
                  $studentList = [];
                  while ($s = mysqli_fetch_assoc($students_result)) {
                    $studentList[] = $s['firstname'] . ' ' . $s['lastname'];
                  }
                  $studentJson = htmlspecialchars(json_encode($studentList), ENT_QUOTES);
                ?>
                <tr class="clickable-row" data-id="<?= htmlspecialchars($parent, ENT_QUOTES) ?>" 
                    data-students='<?= $studentJson ?>' style="cursor:pointer;">
                  <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($parent) ?></p></td>
                  <td><p class="text-muted pt-3 pb-3 mb-0"><?= $row['student_count'] ?></p></td>
                  <td><p class="text-muted pt-3 pb-3 mb-0"><?= strtolower(str_replace(' ', '_', $parent)) ?></p></td>
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
<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="studentModalLabel">Parent & Students</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="studentListContainer"></div>
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
        const parent = this.getAttribute('data-id');
        const students = JSON.parse(this.getAttribute('data-students') || '[]');

        const modal = new bootstrap.Modal(document.getElementById('studentModal'));
        document.getElementById('studentModalLabel').innerText = `👨 Parent: ${parent}`;
        const list = students.map(name => `<li>${name}</li>`).join('');
        document.getElementById('studentListContainer').innerHTML = `<ul>${list}</ul>`;
        modal.show();
      });
    });
  });
</script>
</body>
</html>
