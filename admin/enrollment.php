<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; // assumes $conn is defined here ?>

<?php
// Search and Pagination
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// --- SORTING PARAMETERS ---
$default_sort_by = 'admission_date';
$default_sort_order = 'DESC';

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : $default_sort_by; // Default sort
$sort_order = isset($_GET['sort_order']) ? strtoupper($_GET['sort_order']) : $default_sort_order; // Default order

// Validate and map $sort_by to a database column
$allowed_sort_columns = [
    'fullname' => 'fullname', // CONCAT() field
    'grade_level' => 'grade_level',
    'address' => 'address', // CONCAT() field
    'admission_date' => 'admission_date', // Default (assuming this exists for sorting)
    'lrn' => 'lrn', 
    'que_code' => 'que_code'
];
$sort_column = $allowed_sort_columns[$sort_by] ?? $default_sort_by;

// Validate $sort_order
$sort_order = ($sort_order === 'ASC' || $sort_order === 'DESC') ? $sort_order : $default_sort_order;
// ---------------------------------

$search_safe = mysqli_real_escape_string($conn, $search); // sanitize search
$offset = ($page - 1) * $limit;

// Define the base columns for CONCAT
$fullname_col = "CONCAT(firstname, ' ', lastname)";
$address_col = "CONCAT(barangay, ', ', municipal, ', ', province)";


// Count total results for pagination
$count_query = "SELECT COUNT(*) as total 
                FROM admission_form 
                WHERE (admission_status = 'approved' OR admission_status = 'for_review') 
                  AND (
                    lrn LIKE '%$search_safe%' 
                    OR que_code LIKE '%$search_safe%' 
                    OR $fullname_col LIKE '%$search_safe%'
                  )";

$count_result = mysqli_query($conn, $count_query);
$total = mysqli_fetch_assoc($count_result)['total'] ?? 0;
$total_pages = ceil($total / $limit);

// Build the ORDER BY clause dynamically
$order_by_clause = "";
if ($sort_column === 'fullname') {
    $order_by_clause = "ORDER BY $fullname_col $sort_order";
} elseif ($sort_column === 'address') {
    // Sorting by address CONCAT field
    $order_by_clause = "ORDER BY $address_col $sort_order";
} else {
    // Sorting by other single column fields or default
    $order_by_clause = "ORDER BY $sort_column $sort_order";
}


// Fetch paginated data
$query = "SELECT 
            id,
            que_code, 
            lrn, 
            $fullname_col AS fullname, 
            $address_col AS address, 
            residential_address,
            grade_level,
            admission_status,
            DATE_FORMAT(admission_date, '%Y-%m-%d') AS admission_date_formatted,
            admission_date
          FROM admission_form
          WHERE (admission_status = 'approved' OR admission_status = 'for_review') 
            AND (
              lrn LIKE '%$search_safe%' 
              OR que_code LIKE '%$search_safe%' 
              OR $fullname_col LIKE '%$search_safe%'
            )
          $order_by_clause
          LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $query);

// Helper function to build query string for pagination/sorting links
// FIX: Added $is_new_sort parameter to control page reset
function build_query_string($page = null, $search = null, $sort_by = null, $sort_order = null, $is_new_sort = false) {
    $params = [];
    // Use current values as defaults
    $current_search = isset($_GET['search']) ? $_GET['search'] : '';
    $current_sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'admission_date';
    $current_sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'DESC';

    // Set parameters
    $params['page'] = $page !== null ? $page : (isset($_GET['page']) ? $_GET['page'] : 1);
    $params['search'] = $search !== null ? $search : $current_search;
    $params['sort_by'] = $sort_by !== null ? $sort_by : $current_sort_by;
    $params['sort_order'] = $sort_order !== null ? $sort_order : $current_sort_order;
    
    // FIX: Only reset page to 1 if $is_new_sort is explicitly true
    if ($is_new_sort === true) {
        $params['page'] = 1;
    }
    
    // Optional: Clean up empty search parameter
    if (empty($params['search'])) {
        unset($params['search']);
    }

    return '?' . http_build_query($params);
}

// Function to generate the sort link for a column header
// FIX: Updated call to build_query_string to signal a new sort
function get_sort_link($column_name, $current_sort_by, $current_sort_order, $search) {
    $new_order = 'ASC';
    // If we are currently sorting by this column, flip the order
    if ($current_sort_by === $column_name) {
        $new_order = ($current_sort_order === 'ASC') ? 'DESC' : 'ASC';
    }

    // Build the query string for the new sort, passing true for $is_new_sort
    // Passing 'null' for page lets the function determine the current page number, which will then be reset by the 'true' flag.
    $query_string = build_query_string(null, $search, $column_name, $new_order, true);

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

// Extract current sort parameters from the URL
$current_sort_by = $_GET['sort_by'] ?? $default_sort_by;
$current_sort_order = $_GET['sort_order'] ?? $default_sort_order;
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Enrollment</title>
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
                  <h4>Student Enrollment - New</h4>
                </div>
                <div class="col-12 col-md-8">
                  <form id="filterForm" method="GET" action="">
                      <input type="hidden" name="search" value="<?= htmlspecialchars($search) ?>">
                      <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">

                      <div class="d-flex align-items-center mb-3">
                        <label for="sort_column" class="me-2 text-muted text-nowrap d-none d-lg-block">Sort By:</label>
                        <select id="sort_by" name="sort_by" class="form-select me-2 w-50 rounded rounded-4 auto-submit-dropdown">
                            <option value="admission_date" <?= $sort_by == 'admission_date' ? 'selected' : '' ?>> Date</option>
                            <option value="fullname" <?= $sort_by == 'fullname' ? 'selected' : '' ?>>Fullname</option>
                            <option value="grade_level" <?= $sort_by == 'grade_level' ? 'selected' : '' ?>>Grade Level</option>
                            <option value="address" <?= $sort_by == 'address' ? 'selected' : '' ?>>Address</option>
                        </select>
                        <select id="sort_order" name="sort_order" class="form-select me-2 w-50 rounded rounded-4 auto-submit-dropdown">
                                <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                                <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                            </select>
                          <div class="w-75 me-2">
                              <?php
                              // Determine the current page filename
                              $currentPage = basename($_SERVER['PHP_SELF']);
                              ?>
                              <select id="studentTypeSelect" class="form-select rounded rounded-4" onchange="window.location.href=this.value;">
                                  <option
                                      value="enrollment_old.php"
                                      <?= ($currentPage == 'enrollment_old.php') ? 'selected' : '' ?>
                                  >
                                      Old Student
                                  </option>
                                  <option
                                      value="enrollment.php"
                                      <?= ($currentPage == 'enrollment.php') ? 'selected' : '' ?>
                                  >
                                      New Student
                                  </option>
                              </select>
                          </div>
                          <div class="input-group flex-grow-1 me-2">
                              <input class="form-control rounded rounded-4" type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Search ...">
                              <button class="btn border rounded-4 ms-2" type="submit">
                                  <i class="bi bi-search"></i> Search
                              </button>
                          </div>

                      </div>
                  </form>
              </div>

              <script>
              document.addEventListener('DOMContentLoaded', function() {
                  const studentTypeSelect = document.getElementById('studentTypeSelect');
                  if (studentTypeSelect) {
                      studentTypeSelect.addEventListener('change', function() {
                          if (this.value) {
                              window.location.href = this.value;
                          }
                      });
                  }

                  // --- SCRIPT FOR AUTO-RELOAD SORTING DROPDOWNS ---
                  const filterForm = document.getElementById('filterForm');
                  const autoSubmitDropdowns = document.querySelectorAll('.auto-submit-dropdown');
                  
                  autoSubmitDropdowns.forEach(dropdown => {
                      dropdown.addEventListener('change', function() {
                          // Crucially, when sorting/filtering via dropdowns, we must reset the page to 1
                          filterForm.querySelector('input[name="page"]').value = 1; 
                          filterForm.submit();
                      });
                  });
              });
              </script>
                <div class="col-12 pt-3">
                  <?php
                    // Check if 'status' parameter exists in the URL
                    if (isset($_GET['status'])) {
                        $status = $_GET['status'];

                        // Display Bootstrap alert based on the status
                        if ($status === 'success') {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ✅ Enrollment updated successfully!
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
                      <th scope="col" style="width: 15%">LRN <?= get_sort_link('lrn', $current_sort_by, $current_sort_order, $search) ?></th>
                      <th scope="col" style="width: 25%">Fullname <?= get_sort_link('fullname', $current_sort_by, $current_sort_order, $search) ?></th>
                      <th scope="col" style="width: 15%">Grade Level <?= get_sort_link('grade_level', $current_sort_by, $current_sort_order, $search) ?></th>
                      <th scope="col" style="width: 13%">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-id="<?= $row['id'] ?>">
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['admission_date_formatted'] ?? 'N/A') ?></p></td>
                          
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['que_code'] ?? '-') ?></p></td>
                          <td>
                            <p class="text-muted pt-3 pb-3 mb-0">
                              <?= !empty($row['lrn']) ? htmlspecialchars($row['lrn']) : 'N/A' ?>
                            </p>
                          </td>

                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['grade_level']) ?></p></td>
                          <td>
                            <?php
                              $status = htmlspecialchars($row['admission_status']);
                              if ($status === 'for_review') {
                                  $label = 'For Review';
                                  $class = 'badge bg-warning text-dark';
                              } elseif ($status === 'approved') {
                                  $label = 'Approved';
                                  $class = 'badge bg-success';
                              } else {
                                  $label = ucfirst($status); // fallback
                                  $class = 'badge bg-secondary';
                              }
                            ?>
                            <p class="pt-3 pb-3 mb-0">
                              <span class="<?= $class ?>"><?= $label ?></span>
                            </p>
                          </td>
                        </tr>

                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="7"><p class="text-muted text-center pt-3 pb-3 mb-0">No records pending enrollment</p></td>
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
          <a class="page-link text-muted" href="<?= build_query_string($page - 1, $search, $sort_by, $sort_order, false) ?>">Previous</a>
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

      <?php for ($i = $start; $i <= $end; $i++): ?>
        <li class="page-item">
          <a class="page-link text-muted <?= $i == $page ? 'fw-bold' : '' ?>" href="<?= build_query_string($i, $search, $sort_by, $sort_order, false) ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <li class="page-item">
          <a class="page-link text-muted" href="<?= build_query_string($page + 1, $search, $sort_by, $sort_order, false) ?>">Next</a>
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
      row.addEventListener('click', (event) => {
        // Find the closest parent <tr> to ensure we get the data-id
        const tr = event.currentTarget;
        const id = tr.getAttribute('data-id');
        
        // Prevent navigation if the click target is the 'Enroll' button or its parent link/anchor
        // The check for 'btn-primary' is specific and might need adjusting if the button class changes.
        if (event.target.closest('a')) {
             // Let the anchor link handle the navigation (to enroll_action.php, or whatever the link is)
             return; 
        }

        // Navigate to view_enrollment.php if the click is not on a specific link/button/anchor
        if (!event.target.closest('a')) {
             window.location.href = `view_enrollment.php?id=${id}`;
        }
      });
    });
  });
</script>