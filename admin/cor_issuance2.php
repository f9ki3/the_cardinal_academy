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
    'student_number' => 'st.student_number',
    'fullname' => 'fullname', // Alias for CONCAT
    'grade_level' => 'es.grade_level',
    // 'status' => 'si.status', // Status column removed in previous step
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
$school_year = isset($_GET['school_year']) ? trim($_GET['school_year']) : '2025-2026';
$offset = ($page - 1) * $limit;

$searchEsc = mysqli_real_escape_string($conn, $search);

// --- MODIFIED: Hardcode the default school year ---
$hardcoded_default_sy = '2025-2026';

// --- Get all school years dynamically ---------------------------------------
$sy_query = "SELECT DISTINCT school_year FROM sections ORDER BY school_year DESC";
$sy_result = mysqli_query($conn, $sy_query);
$school_years = [];
while ($row = mysqli_fetch_assoc($sy_result)) {
    $school_years[] = $row['school_year'];
}

// --- MODIFIED: Set default school year filter ---
// The school_year is already set to '2025-2026' if not present in $_GET
if ($school_year === '') {
    $school_year = $hardcoded_default_sy; 
}
$schoolYearEsc = mysqli_real_escape_string($conn, $school_year);


// --- Build WHERE condition --------------------------------------------------
$schoolYearCondition = "es.school_year = '$schoolYearEsc'";


// --- Helper functions for dynamic links --------------------------------------

// Helper function to build query string for pagination/sorting links
function build_query_string($page = null, $search = null, $school_year = null, $sort_by = null, $sort_order = null) {
    // Access the global hardcoded default SY
    global $hardcoded_default_sy;
    
    $params = [];
    
    // Determine current values based on GET or defaults
    $current_search = $_GET['search'] ?? '';
    // Use the hardcoded default if 'school_year' is not in GET
    $current_sy = $_GET['school_year'] ?? $hardcoded_default_sy; 
    $current_sort_by = $_GET['sort_by'] ?? 'fullname';
    $current_sort_order = $_GET['sort_order'] ?? 'ASC';

    // Set parameters
    $params['page'] = $page !== null ? $page : ($_GET['page'] ?? 1);
    $params['search'] = $search !== null ? $search : $current_search;
    // Prioritize the passed $school_year, then the one in GET, then the hardcoded default
    $params['school_year'] = $school_year !== null ? $school_year : $current_sy;
    $params['sort_by'] = $sort_by !== null ? $sort_by : $current_sort_by;
    $params['sort_order'] = $sort_order !== null ? $sort_order : $current_sort_order;
    
    // Reset page to 1 if sorting parameters are explicitly passed
    if ($sort_by !== null || $sort_order !== null || $search !== null || ($school_year !== null && $school_year !== $current_sy)) {
        $params['page'] = 1;
    }

    // Filter out empty search/sy to keep URLs cleaner, but ensure school_year is kept if it's the hardcoded default.
    $params = array_filter($params, fn($value, $key) => 
        ($key !== 'search' && $key !== 'school_year') || 
        ($key === 'search' && $value !== '') || 
        ($key === 'school_year' && $value !== ''), 
        ARRAY_FILTER_USE_BOTH
    );
    
    // Ensure the hardcoded default SY is always included in the query string if no other year is selected
    if (!isset($params['school_year']) && $current_sy === $hardcoded_default_sy) {
        $params['school_year'] = $hardcoded_default_sy;
    }


    return '?' . http_build_query($params);
}

// Function to generate the sort link for a column header (Unchanged)
function get_sort_link($column_name, $current_sort_by, $current_sort_order, $search, $school_year) {
    $new_order = 'ASC';
    // If we are currently sorting by this column, flip the order
    if ($current_sort_by === $column_name) {
        $new_order = ($current_sort_order === 'ASC') ? 'DESC' : 'ASC';
    }

    // Build the query string for the new sort (always set page to 1 for a new sort)
    $query_string = build_query_string(1, $search, $school_year, $column_name, $new_order);

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
    SELECT COUNT(st.id) AS total
    FROM student_tuition st
    JOIN student_information si ON st.student_number = si.student_number
    JOIN sections es ON st.enrolled_section = es.section_id
    WHERE $schoolYearCondition
      AND (
          si.student_number LIKE '%$searchEsc%'
          OR CONCAT(si.firstname, ' ', COALESCE(si.middlename,''), ' ', si.lastname) LIKE '%$searchEsc%'
      )
";
$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}
$total        = mysqli_fetch_assoc($count_result)['total'];
$total_pages  = ceil($total / $limit);

// --- Fetch paginated rows (MODIFIED: Added es.section_name to SELECT) --------------------
$fullname_concat = "CONCAT(si.firstname, ' ', COALESCE(si.middlename,''), ' ', si.lastname)";

$query = "
    SELECT 
        st.id AS tuition_id,
        st.student_number,
        st.account_number,
        $fullname_concat AS fullname,
        es.school_year,
        es.grade_level AS enrolled_grade_level,
        es.section_name -- ADDED SECTION NAME
    FROM student_tuition st
    JOIN student_information si ON st.student_number = si.student_number
    JOIN sections es ON st.enrolled_section = es.section_id
    WHERE $schoolYearCondition
      AND (
          si.student_number LIKE '%$searchEsc%'
          OR $fullname_concat LIKE '%$searchEsc%'
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
  <title>AcadeSys - COR Issuance</title>
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
                <div class="col-12 col-md-3">
                  <h4>Certificate of Registration</h4>
                </div>
                <div class="col-12 col-md-9">
                  <form id="filterForm" method="GET" action="">
                      <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">

                      <div class="row g-2 mb-3 align-items-center">

                          <div class="col-12 col-lg-7">
                              <div class="d-flex align-items-center gap-2">
                                  <label class="text-muted text-nowrap d-none d-xl-block">Sort By:</label>

                                  <select id="sort_by" name="sort_by" class="form-select rounded-4 auto-submit-dropdown" style="min-width: 100px;">
                                      <option value="fullname" <?= $sort_by == 'fullname' ? 'selected' : '' ?>>Fullname</option>
                                      <option value="student_number" <?= $sort_by == 'student_number' ? 'selected' : '' ?>>Student ID</option>
                                      <option value="grade_level" <?= $sort_by == 'grade_level' ? 'selected' : '' ?>>Grade Level</option>
                                  </select>

                                  <select id="sort_order" name="sort_order" class="form-select rounded-4 auto-submit-dropdown" style="max-width: 120px;">
                                      <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                                      <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Desc</option>
                                  </select>

                                  <select name="school_year" id="school_year" class="form-select rounded-4 auto-submit-dropdown" style="min-width: 120px;">
                                      <?php foreach ($school_years as $sy): ?>
                                          <option value="<?= htmlspecialchars($sy) ?>" <?= ($school_year === $sy) ? 'selected' : '' ?>>
                                              SY <?= htmlspecialchars($sy) ?>
                                          </option>
                                      <?php endforeach; ?>
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
                                      placeholder="Search Student ID or Fullname..."
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
                    <?php if ($_GET['status'] === 'success'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ COR action successful!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'error'): ?>
                      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ❌ Something went wrong. Please try again.
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
                            <th style="width: 10%;">Account No.</th>
                            <th style="width: 15%;">Student No. <?= get_sort_link('student_number', $current_sort_by, $current_sort_order, $search, $school_year) ?></th>
                            <th style="width: 25%;">Fullname <?= get_sort_link('fullname', $current_sort_by, $current_sort_order, $search, $school_year) ?></th>
                            <th style="width: 15%;">Grade Level <?= get_sort_link('grade_level', $current_sort_by, $current_sort_order, $search, $school_year) ?></th>
                            <th style="width: 15%;">Section Name</th> <th style="width: 15%;">School Year</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr class="clickable-row" data-id="<?= htmlspecialchars($row['tuition_id']) ?>">
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['account_number']) ?></p></td>
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['student_number']) ?></p></td>
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['enrolled_grade_level']) ?></p></td>
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['section_name']) ?></p></td> <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['school_year']) ?></p></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6"><p class="text-muted text-center pt-3 pb-3 mb-0">No enrolled students found for SY <?= htmlspecialchars($school_year) ?></p></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                </table>
              </div>

              <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-start pagination-sm">
                    <?php 
                        // Preserve filters, including sort parameters
                    ?>

                    <?php if ($page > 1): ?>
                        <li class="page-item">
                        <a class="page-link text-muted" 
                            href="<?= build_query_string($page - 1, $search, $school_year, $sort_by, $sort_order) ?>">
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
                            href="<?= build_query_string($i, $search, $school_year, $sort_by, $sort_order) ?>">
                            <?= $i ?>
                        </a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                        <a class="page-link text-muted" 
                            href="<?= build_query_string($page + 1, $search, $school_year, $sort_by, $sort_order) ?>">
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
                const tuitionId = row.dataset.id;
                
                // Prevent navigation if the click target is the 'View/Print' button
                if (event.target.closest('a') && event.target.closest('a').classList.contains('btn-primary')) {
                    return; 
                }

                // Navigate to the view/generate COR page if the click is on the row body
                if (tuitionId && !event.target.closest('a')) {
                    window.location.href = "generate_cor.php?create=no&tuition_id=" + tuitionId;
                }
            });
        });

        // --- Auto-Submit Dropdowns ---
        const filterForm = document.getElementById('filterForm');
        const autoSubmitDropdowns = document.querySelectorAll('.auto-submit-dropdown');
        
        autoSubmitDropdowns.forEach(dropdown => {
            dropdown.addEventListener('change', function() {
                // Set page back to 1 when changing filters/sorts
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