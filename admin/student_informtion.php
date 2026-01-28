<?php
include 'session_login.php';
include '../db_connection.php';

// --- SORTING PARAMETERS ---
$default_sort_by = 'student_number';
$default_sort_order = 'ASC';

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : $default_sort_by;
$sort_order = isset($_GET['sort_order']) ? strtoupper($_GET['sort_order']) : $default_sort_order;

// Validate and map $sort_by to a database column
$allowed_sort_columns = [
    'student_number' => 'si.student_number',
    'firstname' => 'si.firstname',
    'lastname' => 'si.lastname',
    'email' => 'si.email',
    'phone' => 'si.phone',
];
$sort_column = $allowed_sort_columns[$sort_by] ?? $allowed_sort_columns[$default_sort_by];

// Validate $sort_order
$sort_order = ($sort_order === 'ASC' || $sort_order === 'DESC') ? $sort_order : $default_sort_order;

// Build the ORDER BY clause dynamically
$order_by_clause = "ORDER BY $sort_column $sort_order";
// -----------------------------------------------------------------------------

// --- Pagination & search ----------------------------------------------------
$limit  = 10;
$page   = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;

$searchEsc = mysqli_real_escape_string($conn, $search);

// --- Helper functions for dynamic links --------------------------------------

// Helper function to build query string for pagination/sorting links
// Set $reset_page_for_sort = true only when building a sort header link (so page resets to 1).
function build_query_string($page = null, $search = null, $sort_by = null, $sort_order = null, $reset_page_for_sort = false) {
    $params = [];
    // Use current values as defaults
    $current_search = $_GET['search'] ?? '';
    $current_sort_by = $_GET['sort_by'] ?? 'student_number';
    $current_sort_order = $_GET['sort_order'] ?? 'ASC';

    // Set parameters
    $params['page'] = $page !== null ? $page : ($_GET['page'] ?? 1);
    $params['search'] = $search !== null ? $search : $current_search;
    $params['sort_by'] = $sort_by !== null ? $sort_by : $current_sort_by;
    $params['sort_order'] = $sort_order !== null ? $sort_order : $current_sort_order;
    
    // Reset page to 1 only when user is changing sort (sort header click), not for pagination links
    if ($reset_page_for_sort) {
        $params['page'] = 1;
    }

    return '?' . http_build_query($params);
}

// Function to generate the sort link for a column header
function get_sort_link($column_name, $current_sort_by, $current_sort_order, $search) {
    $new_order = 'ASC';
    // If we are currently sorting by this column, flip the order
    if ($current_sort_by === $column_name) {
        $new_order = ($current_sort_order === 'ASC') ? 'DESC' : 'ASC';
    }

    // Build the query string for the new sort (reset page to 1 when changing sort)
    $query_string = build_query_string(1, $search, $column_name, $new_order, true);

    // Determine the icon to display
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
    $order_by_clause
    LIMIT $limit OFFSET $offset
";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("<p style='color:red;'>Data Query Failed: " . mysqli_error($conn) . "</p>");
}

// Extract current sort parameters from the URL
$current_sort_by = $_GET['sort_by'] ?? $default_sort_by;
$current_sort_order = $_GET['sort_order'] ?? $default_sort_order;
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
          <div class="rounded p-3 bg-white">
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-4">
                  <h4>Student Information</h4>
                </div>
                <div class="col-12 col-md-8">
                  <form id="filterForm" method="GET" action="">
                    <input type="hidden" name="search" value="<?= htmlspecialchars($search) ?>">
                    <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">

                    <div class="d-flex align-items-center mb-3">
                      <label for="sort_column" class="me-2 text-muted text-nowrap d-none d-lg-block">Sort By:</label>
                      <select id="sort_by" name="sort_by" class="form-select me-2 w-50 rounded rounded-4 auto-submit-dropdown">
                          <option value="student_number" <?= $sort_by == 'student_number' ? 'selected' : '' ?>> Student Number</option>
                          <option value="lastname" <?= $sort_by == 'lastname' ? 'selected' : '' ?>>Lastname</option>
                          <option value="firstname" <?= $sort_by == 'firstname' ? 'selected' : '' ?>>Firstname</option>
                          <option value="email" <?= $sort_by == 'email' ? 'selected' : '' ?>>Email</option>
                      </select>
                      <select id="sort_order" name="sort_order" class="form-select me-2 w-50 rounded rounded-4 auto-submit-dropdown">
                          <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                          <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                      </select>
                      
                      <div class="input-group flex-grow-1">
                          <input 
                              class="form-control rounded rounded-4" 
                              type="text" 
                              name="search" 
                              value="<?= htmlspecialchars($search ?? '') ?>" 
                              placeholder="Search ...">
                          <button class="btn border ms-2 rounded rounded-4" type="submit">
                              <i class="bi bi-search"></i> Search
                          </button>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="col-12 pt-3">
                  <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'success'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Action successful!
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
                <table class="table table-striped table-hover" style="min-width: 800px;">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Student Number <?= get_sort_link('student_number', $current_sort_by, $current_sort_order, $search) ?></th>
                            <th style="width: 15%;">Firstname <?= get_sort_link('firstname', $current_sort_by, $current_sort_order, $search) ?></th>
                            <th style="width: 10%;">Middlename</th>
                            <th style="width: 15%;">Lastname <?= get_sort_link('lastname', $current_sort_by, $current_sort_order, $search) ?></th>
                            <th style="width: 25%;">Email <?= get_sort_link('email', $current_sort_by, $current_sort_order, $search) ?></th>
                            <th style="width: 20%;">Contact <?= get_sort_link('phone', $current_sort_by, $current_sort_order, $search) ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-href="view_student.php?student_id=<?= urlencode($row['student_number']) ?>">
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
                        // Note: Using the build_query_string function here to maintain sort/search state
                    ?>

                    <?php if ($page > 1): ?>
                        <li class="page-item">
                        <a class="page-link text-muted" 
                            href="<?= build_query_string($page - 1, $search, $sort_by, $sort_order) ?>">
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
                            href="<?= build_query_string($i, $search, $sort_by, $sort_order) ?>">
                            <?= $i ?>
                        </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                        <a class="page-link text-muted" 
                            href="<?= build_query_string($page + 1, $search, $sort_by, $sort_order) ?>">
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
    // --- Clickable Row navigation ---
    document.querySelectorAll(".clickable-row").forEach(function(row) {
        row.addEventListener("click", function() {
            window.location.href = this.dataset.href;
        });
    });

    // --- Auto-Submit Dropdowns ---
    const filterForm = document.getElementById('filterForm');
    const autoSubmitDropdowns = document.querySelectorAll('.auto-submit-dropdown');
    
    autoSubmitDropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', function() {
            // Set page back to 1 when changing sort parameters
            const pageInput = document.querySelector('input[name="page"]');
            if(pageInput) {
                pageInput.value = 1;
            }
            // Submit the form to trigger the sort/filter
            filterForm.submit();
        });
    });
});
</script>