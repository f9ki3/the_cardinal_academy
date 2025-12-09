<?php 
include 'session_login.php'; 
include '../db_connection.php'; 

// --- SORTING PARAMETERS ---
$default_sort_by = 'fullname';
$default_sort_order = 'ASC'; 

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : $default_sort_by;
$sort_order = isset($_GET['sort_order']) ? strtoupper($_GET['sort_order']) : $default_sort_order;

// Validate and map $sort_by to a database column
$allowed_sort_columns = [
    'student_number' => 'student_number',
    'fullname' => 'fullname', // Alias for CONCAT
    'username' => 'username',
    'email' => 'email',
    // Added primary key for default stability if an unknown column is passed
];
$sort_column = $allowed_sort_columns[$sort_by] ?? $allowed_sort_columns[$default_sort_by];

// Validate $sort_order
$sort_order = ($sort_order === 'ASC' || $sort_order === 'DESC') ? $sort_order : $default_sort_order;

// Build the ORDER BY clause dynamically
$order_by_clause = "ORDER BY $sort_column $sort_order, student_number ASC"; 
// -----------------------------------------------------------------------------


// --- Helper functions for dynamic links (Restored get_sort_link) --------

// Helper function to build query string for pagination/sorting links
function build_query_string($page = null, $search = null, $sort_by = null, $sort_order = null) {
    
    $params = [];
    
    // Determine current values based on GET or defaults
    $current_search = $_GET['search'] ?? '';
    $current_sort_by = $_GET['sort_by'] ?? 'fullname';
    $current_sort_order = $_GET['sort_order'] ?? 'ASC';

    // Set parameters
    $params['page'] = $page !== null ? $page : ($_GET['page'] ?? 1);
    $params['search'] = $search !== null ? $search : $current_search;
    $params['sort_by'] = $sort_by !== null ? $sort_by : $current_sort_by;
    $params['sort_order'] = $sort_order !== null ? $sort_order : $current_sort_order;
    
    // Reset page to 1 if sorting/filtering parameters are explicitly passed or changed
    // NOTE: We don't reset page if $page !== null (used by pagination links)
    if ($page === null && ($sort_by !== null || $sort_order !== null || $search !== null)) {
        $params['page'] = 1;
    }

    // Filter out empty search to keep URLs cleaner
    $params = array_filter($params, fn($value, $key) => 
        ($key !== 'search') || 
        ($key === 'search' && $value !== ''), 
        ARRAY_FILTER_USE_BOTH
    );
    
    return '?' . http_build_query($params);
}

// Function to generate the sort link for a column header (Restored)
function get_sort_link($column_name, $current_sort_by, $current_sort_order, $search) {
    $new_order = 'ASC';
    // If we are currently sorting by this column, flip the order
    if ($current_sort_by === $column_name) {
        $new_order = ($current_sort_order === 'ASC') ? 'DESC' : 'ASC';
    }

    // Build the query string for the new sort (always set page to 1 for a new sort, passing null for $page)
    $query_string = build_query_string(1, $search, $column_name, $new_order);

    // Determine the icon to display (using Bootstrap Icons)
    $icon = 'bi-chevron-expand'; // Default icon
    if ($current_sort_by === $column_name) {
        $icon = ($current_sort_order === 'ASC') ? 'bi-chevron-up' : 'bi-chevron-down';
    }

    // Return the link and icon for the table header
    return '<a href="' . htmlspecialchars($query_string) . '" class="text-decoration-none text-body">
                <i class="bi ' . $icon . ' small"></i>
            </a>';
}
// -----------------------------------------------------------------------------


// --- Pagination & Search ---
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;
$searchEsc = mysqli_real_escape_string($conn, $search);


// Count total student users
$count_query = "SELECT COUNT(*) as total FROM users 
                WHERE acc_type = 'student' AND (
                    username LIKE '%$searchEsc%' 
                    OR CONCAT(first_name, ' ', last_name) LIKE '%$searchEsc%'
                )";

$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}

$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// Fetch student users (using ORDER BY clause)
$fullname_concat = "CONCAT(first_name, ' ', last_name)";
$query = "SELECT 
            student_number, 
            $fullname_concat AS fullname, 
            username, 
            email
          FROM users 
          WHERE acc_type = 'student' AND (
              username LIKE '%$searchEsc%' 
              OR $fullname_concat LIKE '%$searchEsc%'
          )
          $order_by_clause
          LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("<p style='color:red;'>Data Query Failed: " . mysqli_error($conn) . "</p>");
}

// Extract current sort parameters (kept for UI state)
$current_sort_by = $_GET['sort_by'] ?? $default_sort_by;
$current_sort_order = $_GET['sort_order'] ?? $default_sort_order;
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
                <div class="col-12 col-md-5">
                  <h4>Student Grades</h4>
                </div>
                
                <div class="col-12 col-md-7 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <form id="filterForm" method="GET" action="" class="w-100">
                        <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">
                        
                        <div class="row g-2 mb-3 align-items-center">
                            <div class="col-12 col-lg-7">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="text-muted text-nowrap d-none d-xl-block">Sort By:</label>

                                    <select id="sort_by" name="sort_by" class="form-select rounded-4 auto-submit-dropdown" style="min-width: 100px;">
                                        <option value="fullname" <?= $sort_by == 'fullname' ? 'selected' : '' ?>>Fullname</option>
                                        <option value="student_number" <?= $sort_by == 'student_number' ? 'selected' : '' ?>>Student Number</option>
                                        <option value="username" <?= $sort_by == 'username' ? 'selected' : '' ?>>Username</option>
                                        <option value="email" <?= $sort_by == 'email' ? 'selected' : '' ?>>Email</option>
                                    </select>

                                    <select id="sort_order" name="sort_order" class="form-select rounded-4 auto-submit-dropdown" style="max-width: 120px;">
                                        <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                                        <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-5">
                                <div class="input-group">
                                    <input 
                                        class="form-control rounded-4" 
                                        type="text" 
                                        name="search" 
                                        value="<?= htmlspecialchars($search ?? '') ?>" 
                                        placeholder="Search ..."
                                    >
                                    <button class="btn border rounded-4 ms-2" type="submit">
                                        <i class="bi bi-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    </div>

                <div class="col-12 pt-3">
                  <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'created'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Created account successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ❌ Something went wrong. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'deleted'): ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ⚠️ Remove account successfully.
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
                      <th>
                        Student Number
                        <?= get_sort_link('student_number', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th>
                        Fullname
                        <?= get_sort_link('fullname', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th>
                        Username
                        <?= get_sort_link('username', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th>
                        Email
                        <?= get_sort_link('email', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-id="<?= htmlspecialchars($row['student_number']) ?>">
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['student_number']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['username']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['email']) ?></p></td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="4"><p class="text-muted text-center pt-3 pb-3 mb-0">No student data available</p></td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>

              </div>

              <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                  <ul class="pagination justify-content-start pagination-sm">
                    <?php 
                        // Re-fetch current params including sort
                        $query_params = [
                            'search' => $search,
                            'sort_by' => $current_sort_by,
                            'sort_order' => $current_sort_order,
                        ];
                    ?>

                    <?php if ($page > 1): ?>
                      <li class="page-item">
                        <a class="page-link text-muted" 
                            href="<?= build_query_string($page - 1, $search, $current_sort_by, $current_sort_order) ?>">
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
                            href="<?= build_query_string($i, $search, $current_sort_by, $current_sort_order) ?>">
                            <?= $i ?>
                        </a>
                      </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                      <li class="page-item">
                        <a class="page-link text-muted" 
                            href="<?= build_query_string($page + 1, $search, $current_sort_by, $current_sort_order) ?>">
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
    document.addEventListener("DOMContentLoaded", () => {
        // --- Clickable Row navigation ---
        document.querySelectorAll(".clickable-row").forEach(row => {
            row.addEventListener("click", (event) => {
                const studentId = row.dataset.id;
                // Navigate to the view student grades page
                if (studentId) {
                    window.location.href = `view_student_grades.php?student_id=${studentId}&nav_drop=true`;
                }
            });
        });

        // --- Auto-Submit Dropdowns ---
        const filterForm = document.getElementById('filterForm');
        const autoSubmitDropdowns = document.querySelectorAll('.auto-submit-dropdown');
        
        autoSubmitDropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', function() {
                // Set the hidden page input to 1 when changing filters/sorts
                const pageInput = document.querySelector('input[name="page"]');
                if(pageInput) {
                    pageInput.value = 1;
                }
                // Submit the form
                filterForm.submit();
            });
        });
    });
</script>