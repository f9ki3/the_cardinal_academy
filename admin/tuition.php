<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; // assumes $conn is defined here ?>

<?php
// Search and Pagination setup
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$offset = ($page - 1) * $limit;

// Count total results for pagination
$count_query = "SELECT COUNT(*) as total FROM tuition_fees
                WHERE grade_level LIKE ?";
$stmt_count = $conn->prepare($count_query);
$search_param = "%$search%";
$stmt_count->bind_param('s', $search_param);
$stmt_count->execute();
$count_result = $stmt_count->get_result();
$total = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);

// Fetch paginated data
$query = "SELECT id, grade_level, tuition_fee, miscellaneous, total 
          FROM tuition_fees
          WHERE grade_level LIKE ?
          ORDER BY id ASC
          LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('sii', $search_param, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Tuition Fees</title>
  <?php include 'header.php' ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
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
                  <h4>Manage Tuition Fees</h4>
                </div>
                <div class="col-12 col-md-4">
                    <form method="get" class="mb-3 d-flex">
                        <input 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($search) ?>" 
                        placeholder="Search grade level..." 
                        class="rounded rounded-4 form-control me-2" 
                        />
                        <button type="submit" class="btn border rounded rounded-4">Search</button>
                    </form>
                </div>

                <div class="col-12 pt-3">
                  <?php
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];
                        if ($status === 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ✅ Tuition fees updated successfully!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        } elseif ($status === 'error') {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ❌ Something went wrong. Please try again.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>';
                        }
                    }
                  ?>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">Grade Level</th>
                      <th scope="col">Tuition Fee</th>
                      <th scope="col">Miscellaneous</th>
                      <th scope="col">Total</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result->num_rows > 0): ?>
                      <?php while ($row = $result->fetch_assoc()): ?>
                       <tr>
                          <td><p class="text-muted mb-0 pt-3 pb-3"><?= htmlspecialchars($row['grade_level']) ?></p></td>
                          <td><p class="text-muted mb-0 pt-3 pb-3"><?= number_format($row['tuition_fee'], 2) ?></p></td>
                          <td><p class="text-muted mb-0 pt-3 pb-3"><?= number_format($row['miscellaneous'], 2) ?></p></td>
                          <td><p class="text-muted mb-0 pt-3 pb-3"><?= number_format($row['total'], 2) ?></p></td>
                          <td>
                            <a href="update_tuition.php?id=<?= $row['id'] ?>" class="btn btn-sm border rounded-4">
                              Edit
                            </a>
                          </td>
                        </tr>

                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="4" class="text-center text-muted">No data available</td>
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
</body>
</html>
