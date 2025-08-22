<?php include 'session_login.php'; ?>
<?php  include '../db_connection.php'; // assumes $conn is defined here?>
<?php
// Search and Pagination
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$offset = ($page - 1) * $limit;

// Count total results for pagination
$count_query = "SELECT COUNT(*) as total FROM admission_form 
                WHERE admission_status = 'pending' AND (
                    lrn LIKE '%$search%' 
                    OR que_code LIKE '%$search%' 
                    OR CONCAT(firstname, ' ', lastname) LIKE '%$search%'
                )";
$count_result = mysqli_query($conn, $count_query);
$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// Fetch paginated data
$query = "SELECT 
            id,
            que_code, 
            lrn, 
            CONCAT(firstname, ' ', lastname) AS fullname, 
            CONCAT(barangay, ', ', municipal, ', ', province) AS address, 
            grade_level,
            status 
          FROM admission_form
          WHERE admission_status = 'pending' AND (
              lrn LIKE '%$search%' 
              OR que_code LIKE '%$search%' 
              OR CONCAT(firstname, ' ', lastname) LIKE '%$search%'
          )
          ORDER BY admission_date DESC
          LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Admission</title>
  <?php include 'header.php' ?>
</head>
<body>
<div class="d-flex flex-row">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-8">
                  <h4>Student Admissions</h4>
                </div>
                <div class="col-12 col-md-4">
                  <form method="GET" action="">
                    <div class="input-group">
                      <input class="form-control rounded rounded-4" type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search LRN, CODE or Fullname">
                      <button class="btn border ms-2 rounded rounded-4" type="submit">Search</button>
                    </div>
                  </form>
                </div>
                <div class="col-12 pt-3">
                  <?php
                    // Check if 'status' parameter exists in the URL
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];

                        // Display Bootstrap alert based on the status
                        if ($status === 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ✅ Admission updated successfully!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } elseif ($status === 'error') {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ❌ Something went wrong. Please try again.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } elseif ($status === 'review') {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    ⚠️ Application is under review.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                    }
                    ?>

                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-hover" style="cursor: pointer">
                  <thead>
                    <tr>
                      <th scope="col">LRN</th>
                      <th scope="col">CODE</th>
                      <th scope="col">Fullname</th>
                      <th scope="col">Address</th>
                      <th scope="col">Grade Level</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-id="<?= $row['id'] ?>">
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= !empty($row['lrn']) ? htmlspecialchars($row['lrn']) : 'N/A' ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['que_code'] ?? '-') ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['address']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['grade_level']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['status']) ?></p></td>
                        </tr>

                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="6"><p class="text-muted text-center pt-3 pb-3 mb-0">No data available</p></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

              <!-- Pagination -->
              <?php if ($total_pages > 1): ?>
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-start pagination-sm">
      <!-- Previous Button -->
      <?php if ($page > 1): ?>
        <li class="page-item">
          <a class="page-link text-muted" href="?search=<?= urlencode($search) ?>&page=<?= $page - 1 ?>">Previous</a>
        </li>
      <?php endif; ?>

      <?php
        // Determine the start and end page numbers to show
        $max_links = 5;
        $start = max(1, $page - floor($max_links / 2));
        $end = min($total_pages, $start + $max_links - 1);

        // Adjust start again if we are near the end
        if ($end - $start < $max_links - 1) {
          $start = max(1, $end - $max_links + 1);
        }
      ?>

      <!-- Page Links -->
      <?php for ($i = $start; $i <= $end; $i++): ?>
        <li class="page-item">
          <a class="page-link text-muted <?= $i == $page ? 'fw-bold' : '' ?>" href="?search=<?= urlencode($search) ?>&page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <!-- Next Button -->
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
        const id = row.getAttribute('data-id');
        window.location.href = `view_admission.php?id=${id}`;
      });
    });
  });
</script>
