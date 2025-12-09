<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; // assumes $conn is defined here ?>

<?php
// --- SORTING PARAMETERS ---
$default_sort_by = 'grade_level'; 
$default_sort_order = 'ASC'; 

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : $default_sort_by;
$sort_order = isset($_GET['sort_order']) ? strtoupper($_GET['sort_order']) : $default_sort_order;

// Validate and map $sort_by to a database column
$allowed_sort_columns = [
    'grade_level' => 'grade_level',
    'tuition_fee' => 'tuition_fee',
    'miscellaneous' => 'miscellaneous',
    'total' => 'total',
];
$sort_column = $allowed_sort_columns[$sort_by] ?? $allowed_sort_columns[$default_sort_by];

// Validate $sort_order
$sort_order = ($sort_order === 'ASC' || $sort_order === 'DESC') ? $sort_order : $default_sort_order;

// Build the ORDER BY clause dynamically
$order_by_clause = "ORDER BY $sort_column $sort_order, id ASC"; 
// -----------------------------------------------------------------------------


// --- Helper functions for dynamic links ---

// Helper function to build query string for pagination/sorting links
function build_query_string($page = null, $search = null, $sort_by = null, $sort_order = null) {
    
    $params = [];
    
    // Determine current values based on GET or defaults
    $current_search = $_GET['search'] ?? '';
    $current_sort_by = $_GET['sort_by'] ?? 'grade_level';
    $current_sort_order = $_GET['sort_order'] ?? 'ASC';

    // Set parameters
    $params['page'] = $page !== null ? $page : ($_GET['page'] ?? 1);
    $params['search'] = $search !== null ? $search : $current_search;
    $params['sort_by'] = $sort_by !== null ? $sort_by : $current_sort_by;
    $params['sort_order'] = $sort_order !== null ? $sort_order : $current_sort_order;
    
    // Handle page reset for new sort/search actions
    if ($page === null) {
        if ($sort_by !== null || $sort_order !== null || $search !== null) {
            $params['page'] = 1;
        }
    }

    // Filter out empty search to keep URLs cleaner
    $params = array_filter($params, fn($value, $key) => 
        ($key !== 'search') || 
        ($key === 'search' && $value !== ''), 
        ARRAY_FILTER_USE_BOTH
    );
    
    return '?' . http_build_query($params);
}

// Function to generate the sort link for a column header
function get_sort_link($column_name, $current_sort_by, $current_sort_order, $search) {
    $new_order = 'ASC';
    // If we are currently sorting by this column, flip the order
    if ($current_sort_by === $column_name) {
        $new_order = ($current_sort_order === 'ASC') ? 'DESC' : 'ASC';
    }

    // Build the query string for the new sort (passing 1 explicitly to reset page)
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
$stmt_count->close();


// Fetch paginated data (UPDATED to include sorting)
$query = "SELECT id, grade_level, tuition_fee, miscellaneous, total 
          FROM tuition_fees
          WHERE grade_level LIKE ?
          $order_by_clause
          LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('sii', $search_param, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Extract current sort parameters (kept for UI state)
$current_sort_by = $_GET['sort_by'] ?? $default_sort_by;
$current_sort_order = $_GET['sort_order'] ?? $default_sort_order;

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
              <div class="row mb-3 align-items-center">

                <div class="col-12 col-md-3">
                  <h4>Manage Tuition Fees</h4>
                </div>
                
                <div class="col-12 col-md-9 d-flex justify-content-end align-items-center flex-wrap gap-2">
                    <form id="filterForm" method="GET" action="" class="flex-grow-1">
                        <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">
                        
                        <div class="row g-2 align-items-center">
                            
                            <div class="col-12 col-lg-6">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="text-muted text-nowrap d-none d-xl-block">Sort By:</label>

                                    <select id="sort_by" name="sort_by" class="form-select rounded-4 auto-submit-dropdown">
                                        <option value="grade_level" <?= $sort_by == 'grade_level' ? 'selected' : '' ?>>Grade Level</option>
                                        <option value="tuition_fee" <?= $sort_by == 'tuition_fee' ? 'selected' : '' ?>>Tuition Fee</option>
                                        <option value="miscellaneous" <?= $sort_by == 'miscellaneous' ? 'selected' : '' ?>>Miscellaneous</option>
                                        <option value="total" <?= $sort_by == 'total' ? 'selected' : '' ?>>Total</option>
                                    </select>

                                    <select id="sort_order" name="sort_order" class="form-select rounded-4 auto-submit-dropdown flex-grow-1">
                                        <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                                        <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="input-group">
                                    <input 
                                        class="form-control rounded-4" 
                                        type="text" 
                                        name="search" 
                                        value="<?= htmlspecialchars($search ?? '') ?>" 
                                        placeholder="Search ..."
                                    >
                                    <button class="btn border ms-2 rounded-4" type="submit">
                                        <i class="bi bi-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
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
                      <th scope="col" width="20%">
                        Grade Level
                        <?= get_sort_link('grade_level', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th scope="col" width="25%">
                        Tuition Fee
                        <?= get_sort_link('tuition_fee', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th scope="col" width="25%">
                        Miscellaneous
                        <?= get_sort_link('miscellaneous', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th scope="col" width="20%">
                        Total
                        <?= get_sort_link('total', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th scope="col" width="10%">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                          <tr class="text-muted">
                            <td><p class="text-muted"><?= htmlspecialchars($row['grade_level']) ?></p></td>
                            <td><p class="text-muted"><?= number_format($row['tuition_fee'], 2) ?></p></td>
                            <td><p class="text-muted"><?= number_format($row['miscellaneous'], 2) ?></p></td>
                            <td><p class="text-muted"><?= number_format($row['total'], 2) ?></p></td>
                            <td>
                              <a href="update_tuition.php?id=<?= $row['id'] ?>" class="btn btn-sm border rounded-4">Edit</a>
                            </td>
                          </tr>
                        <?php endwhile; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="5" class="text-center text-muted">No data available</td>
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
                    <li class="page-item <?= $i == $page ? '' : '' ?>">
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
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
</body>
</html>