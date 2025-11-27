<?php
include 'session_login.php';
include '../db_connection.php';

// --- Pagination & search ----------------------------------------------------
$limit  = 10;
$page   = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

$searchEsc = mysqli_real_escape_string($conn, $search);

// --- Count total rows -------------------------------------------------------
$count_query = "
    SELECT COUNT(*) AS total
    FROM student_information si
    WHERE (
          si.student_number LIKE '%$searchEsc%'
          OR si.firstname LIKE '%$searchEsc%'
          OR si.middlename LIKE '%$searchEsc%'
          OR si.lastname LIKE '%$searchEsc%'
          OR si.email LIKE '%$searchEsc%'
          OR si.phone LIKE '%$searchEsc%'
      )
";
$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}
$total        = mysqli_fetch_assoc($count_result)['total'];
$total_pages  = ceil($total / $limit);

// --- Fetch paginated rows ---------------------------------------------------
$query = "
    SELECT 
        si.student_number,
        si.firstname,
        si.middlename,
        si.lastname,
        si.email,
        si.phone
    FROM student_information si
    WHERE (
          si.student_number LIKE '%$searchEsc%'
          OR si.firstname LIKE '%$searchEsc%'
          OR si.middlename LIKE '%$searchEsc%'
          OR si.lastname LIKE '%$searchEsc%'
          OR si.email LIKE '%$searchEsc%'
          OR si.phone LIKE '%$searchEsc%'
      )
    ORDER BY si.id DESC
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
  <title>AcadeSys - Students Information</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-white">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3">
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-6">
                  <h4>Student Grades</h4>
                </div>
                <div class="col-12 col-md-6">
                  <form method="GET" action="">
                    <div class="input-group">
                        <input 
                            class="form-control rounded rounded-4" 
                            type="text" 
                            name="search" 
                            value="<?= htmlspecialchars($search ?? '') ?>" 
                            placeholder="Search Student ID, Name, Email or Contact">
                        <button class="btn border ms-2 rounded rounded-4" type="submit">
                            Search
                        </button>
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
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Student Number</th>
                            <th>Firstname</th>
                            <th>Middlename</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-href="view_student_grades.php?student_id=<?= urlencode($row['student_number']) ?>">
                            <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['student_number'] ?? 'N/A') ?></p></td>
                            <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['firstname'] ?: 'N/A') ?></p></td>
                            <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['middlename'] ?: 'N/A') ?></p></td>
                            <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['lastname'] ?: 'N/A') ?></p></td>
                            <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['email'] ?: 'N/A') ?></p></td>
                            <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['phone'] ?: 'N/A') ?></p></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6"><p class="text-muted text-center pt-3 pb-3 mb-0">No student data available</p></td>
                        </tr>
                    <?php endif; ?>
                    </tbody>

                </table>
            </div>

              <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-start pagination-sm">
                    <?php 
                        $query_params = ['search' => $search];
                    ?>

                    <?php if ($page > 1): ?>
                        <li class="page-item">
                        <a class="page-link text-muted" 
                            href="?<?= http_build_query(array_merge($query_params, ['page' => $page - 1])) ?>">
                            Previous
                        </a>
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
                        <a class="page-link text-muted <?= $i == $page ? 'fw-bold' : '' ?>" 
                            href="?<?= http_build_query(array_merge($query_params, ['page' => $i])) ?>">
                            <?= $i ?>
                        </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                        <a class="page-link text-muted" 
                            href="?<?= http_build_query(array_merge($query_params, ['page' => $page + 1])) ?>">
                            Next
                        </a>
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
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".clickable-row").forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});
</script>
