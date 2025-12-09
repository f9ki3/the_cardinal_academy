<?php 
include 'session_login.php'; 
include '../db_connection.php'; 

// --- SORTING PARAMETERS ---
$default_sort_by = 'created_at'; 
$default_sort_order = 'DESC'; 

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : $default_sort_by;
$sort_order = isset($_GET['sort_order']) ? strtoupper($_GET['sort_order']) : $default_sort_order;

// Validate and map $sort_by to a database column
$allowed_sort_columns = [
    'fullname' => 'fullname', // Alias for CONCAT
    'username' => 'username',
    'role' => 'role',
    'created_at' => 'created_at',
];
$sort_column = $allowed_sort_columns[$sort_by] ?? $allowed_sort_columns[$default_sort_by];

// Validate $sort_order
$sort_order = ($sort_order === 'ASC' || $sort_order === 'DESC') ? $sort_order : $default_sort_order;

// Build the ORDER BY clause dynamically
// Using created_at as a secondary sort for stability if the primary sort values are identical
$order_by_clause = "ORDER BY $sort_column $sort_order, created_at DESC"; 
// -----------------------------------------------------------------------------


// --- Helper functions for dynamic links ---

// Helper function to build query string for pagination/sorting links
function build_query_string($page = null, $search = null, $sort_by = null, $sort_order = null) {
    
    $params = [];
    
    // Determine current values based on GET or defaults
    $current_search = $_GET['search'] ?? '';
    $current_sort_by = $_GET['sort_by'] ?? 'created_at';
    $current_sort_order = $_GET['sort_order'] ?? 'DESC';

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


// --- Pagination & Search ---
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;
$searchEsc = mysqli_real_escape_string($conn, $search);

$fullname_concat = "CONCAT(first_name, ' ', last_name)";

// Count total admin users
$count_query = "SELECT COUNT(*) as total FROM users 
                WHERE acc_type = 'admin' AND (
                    username LIKE '%$searchEsc%' 
                    OR $fullname_concat LIKE '%$searchEsc%'
                )";
$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}
$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// Fetch admin users (with sorting applied)
$query = "SELECT 
            user_id, 
            $fullname_concat AS fullname, 
            username, 
            role,
            created_at
          FROM users 
          WHERE acc_type = 'admin' AND (
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

// Handle delete action
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $delete_id = (int) $_GET['delete'];

    $delete_query = "DELETE FROM users WHERE user_id = ? AND acc_type = 'admin'";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        // Redirect to clear the GET parameter, using status for feedback
        echo "<script>
                window.location.href = 'admin.php?status=deleted';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Failed to delete admin account.');
              </script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Admin Overview</title>
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
                <div class="col-12 col-md-3">
                  <h4>Admin Accounts</h4>
                </div>
                
                <div class="col-12 col-md-9 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <form id="filterForm" method="GET" action="" class="flex-grow-1">
                        <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">
                        
                        <div class="row g-2 align-items-center">
                            
                            <div class="col-12 col-lg-7">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="text-muted text-nowrap d-none d-xl-block">Sort By:</label>

                                    <select id="sort_by" name="sort_by" class="form-select rounded-4 auto-submit-dropdown">
                                        <option value="fullname" <?= $sort_by == 'fullname' ? 'selected' : '' ?>>Fullname</option>
                                        <option value="role" <?= $sort_by == 'role' ? 'selected' : '' ?>>Role</option>
                                        <option value="username" <?= $sort_by == 'username' ? 'selected' : '' ?>>Username</option>
                                        <option value="created_at" <?= $sort_by == 'created_at' ? 'selected' : '' ?>>Created At</option>
                                    </select>

                                    <select id="sort_order" name="sort_order" class="form-select rounded-4 auto-submit-dropdown flex-grow-1">
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
                                    <button class="btn border ms-2 rounded-4" type="submit">
                                        <i class="bi bi-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <a 
                      href="create_admin.php" 
                      class="btn bg-main text-light rounded rounded-4 px-4 text-nowrap"
                    >
                      + Create
                    </a>
                </div>
                </div>

              <div class="col-12 pt-3">
                  <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'created'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Created admin account successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ❌ Something went wrong. Please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'deleted'): ?>
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        ⚠️ Admin account removed successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
              </div>

              <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                  <thead class="text-muted">
                    <tr>
                      <th class="py-3" width="30%">
                        Full Name
                        <?= get_sort_link('fullname', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th class="py-3" width="15%">
                        Role
                        <?= get_sort_link('role', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th class="py-3" width="25%">
                        Username
                        <?= get_sort_link('username', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th class="py-3" width="20%">
                        Created At
                        <?= get_sort_link('created_at', $current_sort_by, $current_sort_order, $search) ?>
                      </th>
                      <th class="text-center py-3" width="10%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" data-id="<?= htmlspecialchars($row['user_id'], ENT_QUOTES) ?>" style="cursor:pointer;">
                          <td class="text-muted py-3"><?= htmlspecialchars($row['fullname']) ?></td>
                          <td class="text-muted py-3"><?= htmlspecialchars($row['role']) ?></td>
                          <td class="text-muted py-3"><?= htmlspecialchars($row['username']) ?></td>
                          <td class="text-muted py-3"><?= htmlspecialchars($row['created_at']) ?></td>
                          <td class="text-center py-3">
                            <a href="?delete=<?= $row['user_id'] ?>&search=<?= urlencode($search) ?>&sort_by=<?= urlencode($current_sort_by) ?>&sort_order=<?= urlencode($current_sort_order) ?>&page=<?= urlencode($page) ?>"
                              class="btn btn-sm btn-outline-secondary"
                              title="Delete Admin"
                              onclick="return confirm('Are you sure you want to delete this admin account?');">
                              <i class="bi bi-trash"></i> Delete
                            </a>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5" class="text-center text-muted py-3">No records found.</td>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    // --- Clickable Row navigation ---
    const rows = document.querySelectorAll('.clickable-row');
    rows.forEach(row => {
      row.addEventListener('click', function (event) {
        // Prevent navigation if the delete button/link was clicked
        if (event.target.closest('a') || event.target.closest('button')) {
            return;
        }
        const id = this.getAttribute('data-id');
        window.location.href = `view_admin.php?id=${id}&nav_drop=true`;
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
</body>
</html>