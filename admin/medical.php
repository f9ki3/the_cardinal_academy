<?php
include 'session_login.php';
include '../db_connection.php';

// --- Pagination & search ----------------------------------------------------
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
// The filter_by variable is no longer needed in the form, but we reset it to 'all' for the query logic.
$filter_by = 'all'; 
$sort_column = isset($_GET['sort_column']) ? $_GET['sort_column'] : 'student_number'; // New: Sort column
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC'; // New: Sort order

// Sanitize sort column and order to prevent SQL injection (whitelist allowed values)
$allowed_columns = ['student_number', 'firstname', 'lastname', 'email', 'phone'];
$sort_column = in_array($sort_column, $allowed_columns) ? $sort_column : 'student_number';
$sort_order = ($sort_order === 'DESC') ? 'DESC' : 'ASC';

$offset = ($page - 1) * $limit;

$searchEsc = mysqli_real_escape_string($conn, $search);

// --- Build WHERE clause for standard broad searching --------------------
$where_clauses = [];
if (!empty($search)) {
    // Reverted to original broad search across multiple fields
    $where_clauses[] = "
        (
            si.student_number LIKE '%$searchEsc%'
            OR si.firstname LIKE '%$searchEsc%'
            OR si.middlename LIKE '%$searchEsc%'
            OR si.lastname LIKE '%$searchEsc%'
            OR si.email LIKE '%$searchEsc%'
            OR si.phone LIKE '%$searchEsc%'
        )
    ";
}
$where_sql = count($where_clauses) > 0 ? "WHERE " . implode(' AND ', $where_clauses) : "";


// --- Count total rows -------------------------------------------------------
$count_query = "
    SELECT COUNT(*) AS total
    FROM student_information si
    $where_sql
";
$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}
$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// --- Fetch paginated and sorted rows ----------------------------------------
$query = "
    SELECT 
        si.student_number,
        si.firstname,
        si.middlename,
        si.lastname,
        si.email,
        si.phone
    FROM student_information si
    $where_sql
    ORDER BY si.$sort_column $sort_order
    LIMIT $limit OFFSET $offset
";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("<p style='color:red;'>Data Query Failed: " . mysqli_error($conn) . "</p>");
}

// Prepare current query parameters for form submission
$current_params = [
    'search' => $search,
    // 'filter_by' is removed from parameters
    'sort_column' => $sort_column,
    'sort_order' => $sort_order,
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Medical Information</title>
  <?php include 'header.php'; ?>
  <style>
    /* Add a subtle pointer cursor to clickable rows */
    .clickable-row {
        cursor: pointer;
    }
  </style>
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
                <div class="col-12 col-md-4">
                  <h4>Medical Records</h4>
                </div>

                <div class="col-12 col-md-8">
                  <div class="d-flex flex-column flex-md-row gap-3">

                      <form method="GET" action="" id="sort_form" class="d-flex align-items-center flex-grow-1 justify-content-end">
                          <?php 
                              // Only include search parameter
                              if (!empty($search)) {
                                  echo '<input type="hidden" name="search" value="' . htmlspecialchars($search) . '">';
                              }
                          ?>

                          <label for="sort_column" class="me-2 text-muted text-nowrap d-none d-lg-block">Sort By:</label>
                          <select 
                              class="form-select me-2 rounded rounded-4" 
                              id="sort_column" 
                              name="sort_column" 
                              onchange="document.getElementById('sort_form').submit()"
                          >
                              <option disabled selected>Sort By Column</option> 
                              <option value="student_number" <?= $sort_column == 'student_number' ? 'selected' : '' ?>>Student Number</option>
                              <option value="firstname" <?= $sort_column == 'firstname' ? 'selected' : '' ?>>Firstname</option>
                              <option value="lastname" <?= $sort_column == 'lastname' ? 'selected' : '' ?>>Lastname</option>
                              <option value="email" <?= $sort_column == 'email' ? 'selected' : '' ?>>Email</option>
                              <option value="phone" <?= $sort_column == 'phone' ? 'selected' : '' ?>>Contact</option>
                          </select>

                          <select 
                              class="form-select rounded rounded-4" 
                              id="sort_order" 
                              name="sort_order" 
                              onchange="document.getElementById('sort_form').submit()"
                          >
                              <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                              <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                          </select>
                      </form>

                      <form method="GET" action="" id="search_form" class="flex-grow-1">
                          <?php 
                              // Preserve sorting parameters
                              foreach ($current_params as $key => $value) {
                                  if ($key !== 'search') {
                                      echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
                                  }
                              }
                          ?>
                          
                          <div class="input-group">
                              <input 
                                  class="form-control rounded rounded-4" 
                                  type="text" 
                                  name="search" 
                                  value="<?= htmlspecialchars($search ?? '') ?>" 
                                  placeholder="Search ..."
                              >
                              <button class="btn border ms-2 rounded rounded-4" type="submit">
                                  Search
                              </button>
                          </div>
                      </form>
                  </div>
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
                          <tr class="clickable-row" data-href="view_student_medical.php?student_id=<?= urlencode($row['student_number'] ?? '-') ?>">
                              <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['student_number'] ?? '-') ?></p></td>
                              <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['firstname'] ?? '-') ?></p></td>
                              <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['middlename'] ?? '-') ?></p></td>
                              <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['lastname'] ?? '-') ?></p></td>
                              <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['email'] ?? '-') ?></p></td>
                              <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['phone'] ?? '-') ?></p></td>
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
                        // Include all filter/sort parameters for pagination links
                        $query_params = $current_params;
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> 
</body>
</html>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Clickable row functionality
    document.querySelectorAll(".clickable-row").forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });
});
</script>