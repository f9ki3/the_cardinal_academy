<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; // assumes $conn is defined here ?>

<?php
// -----------------------------------------------------------------------------
// ✅ Helpers (fixes: htmlspecialchars(null) deprecation)
// -----------------------------------------------------------------------------
function h($val): string {
    return htmlspecialchars((string)($val ?? ''), ENT_QUOTES, 'UTF-8');
}

// Search and Pagination
$limit  = 10;
$page   = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;
$page   = max(1, $page);
$search = isset($_GET['search']) ? trim((string)$_GET['search']) : '';

// --- SORTING ---
$default_sort_by    = 'admission_date';
$default_sort_order = 'DESC';

$sort_by    = isset($_GET['sort_by']) ? (string)$_GET['sort_by'] : $default_sort_by;
$sort_order = isset($_GET['sort_order']) ? strtoupper((string)$_GET['sort_order']) : $default_sort_order;

// Validate and map $sort_by to a database column
$allowed_sort_columns = [
    'fullname'       => 'fullname',       // CONCAT() field
    'grade_level'    => 'grade_level',
    'address'        => 'address',        // CONCAT() field
    'admission_date' => 'admission_date', // Default
    'lrn'            => 'lrn',
    'que_code'       => 'que_code',
];
$sort_column = $allowed_sort_columns[$sort_by] ?? $default_sort_by;

// Validate $sort_order
$sort_order = ($sort_order === 'ASC' || $sort_order === 'DESC') ? $sort_order : $default_sort_order;

$offset = ($page - 1) * $limit;

// Define CONCAT columns
$fullname_col = "CONCAT(firstname, ' ', lastname)";
$address_col  = "CONCAT(barangay, ', ', municipal, ', ', province)";

// Build ORDER BY clause
if ($sort_column === 'fullname') {
    $order_by_clause = "ORDER BY $fullname_col $sort_order";
} elseif ($sort_column === 'address') {
    $order_by_clause = "ORDER BY $address_col $sort_order";
} else {
    $order_by_clause = "ORDER BY $sort_column $sort_order";
}

// -----------------------------------------------------------------------------
// ✅ Use prepared statements (also safer vs SQL injection)
// -----------------------------------------------------------------------------
$search_like = "%{$search}%";

// Count total results
$count_sql = "
    SELECT COUNT(*) AS total
    FROM admission_form
    WHERE admission_status = 'pending'
      AND status = 'New Student'
      AND (
            lrn LIKE ?
         OR que_code LIKE ?
         OR CONCAT(firstname, ' ', lastname) LIKE ?
      )
";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->bind_param("sss", $search_like, $search_like, $search_like);
$count_stmt->execute();
$count_result = $count_stmt->get_result();
$total = 0;
if ($count_result && ($r = $count_result->fetch_assoc())) {
    $total = (int)($r['total'] ?? 0);
}
$count_stmt->close();

$total_pages = (int)ceil($total / $limit);

// Fetch paginated data
$data_sql = "
    SELECT
        id,
        que_code,
        lrn,
        $fullname_col AS fullname,
        $address_col  AS address,
        grade_level,
        status,
        DATE_FORMAT(admission_date, '%Y-%m-%d') AS admission_date_formatted,
        admission_date
    FROM admission_form
    WHERE admission_status = 'pending'
      AND status = 'New Student'
      AND (
            lrn LIKE ?
         OR que_code LIKE ?
         OR $fullname_col LIKE ?
      )
    $order_by_clause
    LIMIT ? OFFSET ?
";
$data_stmt = $conn->prepare($data_sql);
$data_stmt->bind_param("sssii", $search_like, $search_like, $search_like, $limit, $offset);
$data_stmt->execute();
$result = $data_stmt->get_result();

// Helper to build query string for pagination/sorting links
function build_query_string($page = null, $search = null, $sort_by = null, $sort_order = null, $is_new_sort = false) {
    $params = [];

    $current_search     = isset($_GET['search']) ? (string)$_GET['search'] : '';
    $current_sort_by    = isset($_GET['sort_by']) ? (string)$_GET['sort_by'] : 'admission_date';
    $current_sort_order = isset($_GET['sort_order']) ? (string)$_GET['sort_order'] : 'DESC';

    $params['page']       = $page !== null ? $page : (isset($_GET['page']) ? (int)$_GET['page'] : 1);
    $params['search']     = $search !== null ? (string)$search : $current_search;
    $params['sort_by']    = $sort_by !== null ? (string)$sort_by : $current_sort_by;
    $params['sort_order'] = $sort_order !== null ? (string)$sort_order : $current_sort_order;

    if ($is_new_sort === true) $params['page'] = 1;

    if (empty($params['search'])) unset($params['search']);

    return '?' . http_build_query($params);
}

function get_sort_link($column_name, $current_sort_by, $current_sort_order, $search) {
    $new_order = 'ASC';
    if ($current_sort_by === $column_name) {
        $new_order = ($current_sort_order === 'ASC') ? 'DESC' : 'ASC';
    }

    $query_string = build_query_string(null, $search, $column_name, $new_order, true);

    $icon = 'bi-chevron-expand';
    if ($current_sort_by === $column_name) {
        $icon = ($current_sort_order === 'ASC') ? 'bi-chevron-up' : 'bi-chevron-down';
    }

    return '<a href="' . h($query_string) . '" class="text-decoration-none text-body">
              <i class="bi ' . h($icon) . ' small"></i>
            </a>';
}

$current_sort_by    = $_GET['sort_by'] ?? $default_sort_by;
$current_sort_order = $_GET['sort_order'] ?? $default_sort_order;
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
                <div class="col-12 col-md-4">
                  <h4>Student Admissions - New</h4>
                </div>

                <div class="col-12 col-md-8">
                  <form id="filterForm" method="GET" action="">
                    <!-- ✅ FIX: never pass null to htmlspecialchars -->
                    <input type="hidden" name="search" value="<?= h($search) ?>">
                    <input type="hidden" name="page" value="<?= h($page) ?>">

                    <div class="d-flex align-items-center mb-3">
                      <label for="sort_by" class="me-2 text-muted text-nowrap d-none d-lg-block">Sort By:</label>

                      <select id="sort_by" name="sort_by" class="form-select me-2 w-50 rounded-4 auto-submit-dropdown">
                        <option value="admission_date" <?= $sort_by === 'admission_date' ? 'selected' : '' ?>>Date</option>
                        <option value="fullname" <?= $sort_by === 'fullname' ? 'selected' : '' ?>>Fullname</option>
                        <option value="grade_level" <?= $sort_by === 'grade_level' ? 'selected' : '' ?>>Grade Level</option>
                        <option value="address" <?= $sort_by === 'address' ? 'selected' : '' ?>>Address</option>
                        <option value="lrn" <?= $sort_by === 'lrn' ? 'selected' : '' ?>>LRN</option>
                        <option value="que_code" <?= $sort_by === 'que_code' ? 'selected' : '' ?>>CODE</option>
                      </select>

                      <select id="sort_order" name="sort_order" class="form-select me-2 w-50 rounded-4 auto-submit-dropdown">
                        <option value="DESC" <?= $sort_order === 'DESC' ? 'selected' : '' ?>>Descending</option>
                        <option value="ASC" <?= $sort_order === 'ASC' ? 'selected' : '' ?>>Ascending</option>
                      </select>

                      <div class="w-75 me-2">
                        <?php $currentPage = basename((string)($_SERVER['PHP_SELF'] ?? 'admission.php')); ?>
                        <select id="studentTypeSelect" class="form-select rounded-4" onchange="window.location.href=this.value;">
                          <option value="admission_old.php" <?= ($currentPage === 'admission_old.php') ? 'selected' : '' ?>>Old Student</option>
                          <option value="admission.php" <?= ($currentPage === 'admission.php') ? 'selected' : '' ?>>New Student</option>
                        </select>
                      </div>

                      <div class="input-group flex-grow-1 me-2">
                        <input class="form-control rounded-4" type="text" name="search" value="<?= h($search) ?>" placeholder="Search ...">
                        <button class="btn border rounded-4 ms-2" type="submit">
                          <i class="bi bi-search"></i> Search
                        </button>
                      </div>
                    </div>
                  </form>
                </div>

                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    const filterForm = document.getElementById('filterForm');
                    const autoSubmitDropdowns = document.querySelectorAll('.auto-submit-dropdown');

                    autoSubmitDropdowns.forEach(dropdown => {
                      dropdown.addEventListener('change', function() {
                        // Reset page to 1 on sort change
                        const pageInput = filterForm.querySelector('input[name="page"]');
                        if (pageInput) pageInput.value = 1;
                        filterForm.submit();
                      });
                    });
                  });
                </script>

                <div class="col-12 pt-3">
                  <?php
                    if (isset($_GET['status'])) {
                      $status = (string)$_GET['status'];
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
                <table class="table table-striped table-hover" style="cursor: pointer; min-width: 800px;">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 12%;">Date <?= get_sort_link('admission_date', $current_sort_by, $current_sort_order, $search) ?></th>
                      <th scope="col" style="width: 10%;">CODE <?= get_sort_link('que_code', $current_sort_by, $current_sort_order, $search) ?></th>
                      <th scope="col" style="width: 15%;">LRN <?= get_sort_link('lrn', $current_sort_by, $current_sort_order, $search) ?></th>
                      <th scope="col" style="width: 20%;">Fullname <?= get_sort_link('fullname', $current_sort_by, $current_sort_order, $search) ?></th>
                      <th scope="col" style="width: 23%;">Address <?= get_sort_link('address', $current_sort_by, $current_sort_order, $search) ?></th>
                      <th scope="col" style="width: 15%;">Grade Level <?= get_sort_link('grade_level', $current_sort_by, $current_sort_order, $search) ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                      <?php while ($row = $result->fetch_assoc()): ?>
                        <tr class="clickable-row" data-id="<?= h($row['id'] ?? '') ?>">
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= h($row['admission_date_formatted'] ?? 'N/A') ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= h($row['que_code'] ?? '-') ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= !empty($row['lrn']) ? h($row['lrn']) : 'N/A' ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= h($row['fullname'] ?? '') ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= h($row['address'] ?? '') ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= h($row['grade_level'] ?? '') ?></p></td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="7"><p class="text-muted text-center pt-3 pb-3 mb-0">No data available</p></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>

              <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-start pagination-sm">
                    <?php if ($page > 1): ?>
                      <li class="page-item">
                        <a class="page-link text-muted" href="<?= h(build_query_string($page - 1, $search, $sort_by, $sort_order, false)) ?>">Previous</a>
                      </li>
                    <?php endif; ?>

                    <?php
                      $max_links = 5;
                      $start = max(1, $page - (int)floor($max_links / 2));
                      $end = min($total_pages, $start + $max_links - 1);
                      if ($end - $start < $max_links - 1) {
                        $start = max(1, $end - $max_links + 1);
                      }
                    ?>

                    <?php for ($i = $start; $i <= $end; $i++): ?>
                      <li class="page-item">
                        <a class="page-link text-muted <?= $i == $page ? 'fw-bold' : '' ?>"
                           href="<?= h(build_query_string($i, $search, $sort_by, $sort_order, false)) ?>">
                          <?= h($i) ?>
                        </a>
                      </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                      <li class="page-item">
                        <a class="page-link text-muted" href="<?= h(build_query_string($page + 1, $search, $sort_by, $sort_order, false)) ?>">Next</a>
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

<?php
// close stmt used for data
if (isset($data_stmt) && $data_stmt) $data_stmt->close();
?>

<?php include 'footer.php'; ?>
</body>
</html>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('.clickable-row');
    rows.forEach(row => {
      row.addEventListener('click', (event) => {
        const id = row.getAttribute('data-id');
        if (!event.target.closest('a')) {
          window.location.href = `view_admission.php?id=${id}`;
        }
      });
    });
  });
</script>
