<?php 
include 'session_login.php'; 
include '../db_connection.php'; 

// --- FILTER PARAMETERS ---
$default_school_year = '2025-2026';
$school_year = isset($_GET['school_year']) ? $_GET['school_year'] : $default_school_year;
// -----------------------------------------------------------------------------

// --- SORTING PARAMETERS ---
$default_sort_by = 'grade_level'; 
$default_sort_order = 'ASC'; 

$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : $default_sort_by;
$sort_order = isset($_GET['sort_order']) ? strtoupper($_GET['sort_order']) : $default_sort_order;

// Validate and map $sort_by to a database column
$allowed_sort_columns = [
    'section_id' => 'sections.section_id',
    'section_name' => 'sections.section_name',
    'grade_level' => 'sections.grade_level',
    'teacher_name' => 'teacher_name', 
    'room' => 'sections.room',
    'capacity' => 'sections.capacity',
    'school_year' => 'sections.school_year',
];
$sort_column = $allowed_sort_columns[$sort_by] ?? $allowed_sort_columns[$default_sort_by];

// Validate $sort_order
$sort_order = ($sort_order === 'ASC' || $sort_order === 'DESC') ? $sort_order : $default_sort_order;

// Build the ORDER BY clause dynamically
$order_by_clause = "ORDER BY $sort_column $sort_order, sections.section_id ASC"; 
// -----------------------------------------------------------------------------


// --- Helper functions for dynamic links ---

// Helper function to build query string for pagination/sorting links
// UPDATED to include $school_year
function build_query_string($page = null, $search = null, $sort_by = null, $sort_order = null, $school_year = null) {
    
    $params = ['nav_drop' => 'true']; // Always include nav_drop
    
    // Determine current values based on GET or defaults
    $current_search = $_GET['search'] ?? '';
    $current_sort_by = $_GET['sort_by'] ?? 'grade_level';
    $current_sort_order = $_GET['sort_order'] ?? 'ASC';
    $current_school_year = $_GET['school_year'] ?? '2025-2026'; // Use the default from PHP logic

    // Set parameters
    $params['page'] = $page !== null ? $page : ($_GET['page'] ?? 1);
    $params['search'] = $search !== null ? $search : $current_search;
    $params['sort_by'] = $sort_by !== null ? $sort_by : $current_sort_by;
    $params['sort_order'] = $sort_order !== null ? $sort_order : $current_sort_order;
    $params['school_year'] = $school_year !== null ? $school_year : $current_school_year;
    
    // Handle page reset for new filter/sort/search actions
    if ($page === null) {
        if ($sort_by !== null || $sort_order !== null || $search !== null || $school_year !== null) {
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
function get_sort_link($column_name, $current_sort_by, $current_sort_order, $search, $school_year) {
    $new_order = 'ASC';
    // If we are currently sorting by this column, flip the order
    if ($current_sort_by === $column_name) {
        $new_order = ($current_sort_order === 'ASC') ? 'DESC' : 'ASC';
    }

    // Build the query string for the new sort (passing 1 explicitly to reset page)
    // UPDATED to include $school_year
    $query_string = build_query_string(1, $search, $column_name, $new_order, $school_year);

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


// Pagination and Search
$limit = 10;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$offset = ($page - 1) * $limit;
$searchEsc = mysqli_real_escape_string($conn, $search);

// Build the base WHERE clause for counting and fetching (UPDATED to include school_year filter)
$where_clause = "
    WHERE sections.school_year = '$school_year'
      AND (sections.section_name LIKE '%$searchEsc%' 
       OR sections.grade_level LIKE '%$searchEsc%' 
       OR sections.room LIKE '%$searchEsc%' 
       OR CONCAT(users.first_name, ' ', users.last_name) LIKE '%$searchEsc%')
";

// Count total sections
$count_query = "SELECT COUNT(sections.section_id) as total 
                FROM sections
                LEFT JOIN users ON sections.teacher_id = users.user_id
                $where_clause";

$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}

$total = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total / $limit);

// Fetch sections
$query = "SELECT 
            sections.section_id,
            sections.section_name,
            sections.grade_level,
            sections.room,
            sections.capacity,
            sections.school_year,
            CONCAT(users.first_name, ' ', users.last_name) AS teacher_name
          FROM sections
          LEFT JOIN users ON sections.teacher_id = users.user_id
          $where_clause
          $order_by_clause
          LIMIT $limit OFFSET $offset";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("<p style='color:red;'>Data Query Failed: " . mysqli_error($conn) . "</p>");
}

// Extract current sort parameters (kept for UI state)
$current_sort_by = $_GET['sort_by'] ?? $default_sort_by;
$current_sort_order = $_GET['sort_order'] ?? $default_sort_order;

// --- Fetch Distinct School Years for Dropdown ---
$year_query = "SELECT DISTINCT school_year FROM sections ORDER BY school_year DESC";
$year_result = mysqli_query($conn, $year_query);
$school_years = [];
if ($year_result) {
    while ($row = mysqli_fetch_assoc($year_result)) {
        $school_years[] = $row['school_year'];
    }
}
// Ensure the default year is available if no data exists or it's not the top year
if (!in_array($default_school_year, $school_years)) {
    array_unshift($school_years, $default_school_year);
    $school_years = array_unique($school_years);
    sort($school_years); // Re-sort to maintain order
}
// -----------------------------------------------

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Manage Sections</title>
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
                <div class="col-12 col-md-2">
                  <h4>Class Sections</h4>
                </div>
                
                <div class="col-12 col-md-10 d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <form id="filterForm" method="GET" action="" class="flex-grow-1">
                        <input type="hidden" name="page" value="<?= htmlspecialchars($page) ?>">
                        <input type="hidden" name="nav_drop" value="true">
                        
                        <div class="d-flex align-items-center gap-2 flex-nowrap">
                            
                            <div class="d-flex align-items-center gap-2 flex-grow-0">
                                <label class="text-muted text-nowrap d-none d-lg-block">Sort By:</label>
                                <select id="sort_by" name="sort_by" class="form-select rounded-4 auto-submit-dropdown" style="width: 150px;">
                                    <option value="grade_level" <?= $sort_by == 'grade_level' ? 'selected' : '' ?>>Grade Level</option>
                                    <option value="section_name" <?= $sort_by == 'section_name' ? 'selected' : '' ?>>Section Name</option>
                                    <option value="teacher_name" <?= $sort_by == 'teacher_name' ? 'selected' : '' ?>>Adviser</option>
                                    <option value="school_year" <?= $sort_by == 'school_year' ? 'selected' : '' ?>>School Year</option>
                                    <option value="room" <?= $sort_by == 'room' ? 'selected' : '' ?>>Room</option>
                                    <option value="capacity" <?= $sort_by == 'capacity' ? 'selected' : '' ?>>Capacity</option>
                                    <option value="section_id" <?= $sort_by == 'section_id' ? 'selected' : '' ?>>ID</option>
                                </select>
                            </div>
                            
                            <div style="width: 300px;">
                                <select id="sort_order" name="sort_order" class="form-select rounded-4 auto-submit-dropdown">
                                    <option value="ASC" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ascending</option>
                                    <option value="DESC" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Descending</option>
                                </select>
                            </div>
                            
                            <div style="width: 300px;">
                                <select id="school_year" name="school_year" class="form-select rounded-4 auto-submit-dropdown">
                                    <?php foreach ($school_years as $year): ?>
                                        <option value="<?= htmlspecialchars($year) ?>" <?= $school_year == $year ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($year) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="input-group" width="100px">
                                <input 
                                    class="form-control rounded-4"  
                                    type="text" 
                                    name="search" 
                                    value="<?= htmlspecialchars($search ?? '') ?>" 
                                    placeholder="Search ..."
                                >
                                <button class="btn border me-2 ms-2 rounded-4 text-nowrap" type="submit">
                                    <i class="bi bi-search"></i> Search
                                </button>
                                <a href="create_sections.php?nav_drop=true" class="btn bg-main text-light rounded rounded-4 px-4 text-nowrap">
                                    + Create
                                </a>
                            </div>
                        </div>
                        </form>
                </div>
                <div class="col-12 pt-3">
                  <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] === 'created'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Created sections successfully!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'updated'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ✅ Updated sections successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php elseif ($_GET['status'] === 'deleted'): ?>
                      <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ⚠️ Removed section successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-hover table-striped" style="cursor: pointer">
                  <thead>
                    <tr>
                      <th width="5%">
                        ID
                        <?= get_sort_link('section_id', $current_sort_by, $current_sort_order, $search, $school_year) ?>
                      </th>
                      <th width="15%">
                        Section Name
                        <?= get_sort_link('section_name', $current_sort_by, $current_sort_order, $search, $school_year) ?>
                      </th>
                      <th width="10%">
                        Grade Level
                        <?= get_sort_link('grade_level', $current_sort_by, $current_sort_order, $search, $school_year) ?>
                      </th>
                      <th width="20%">
                        Adviser
                        <?= get_sort_link('teacher_name', $current_sort_by, $current_sort_order, $search, $school_year) ?>
                      </th>
                      <th width="10%">
                        Room
                        <?= get_sort_link('room', $current_sort_by, $current_sort_order, $search, $school_year) ?>
                      </th>
                      <th width="10%">
                        Capacity
                        <?= get_sort_link('capacity', $current_sort_by, $current_sort_order, $search, $school_year) ?>
                      </th>
                      <th width="10%">
                        School Year
                        <?= get_sort_link('school_year', $current_sort_by, $current_sort_order, $search, $school_year) ?>
                      </th>
                      <th width="10%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (mysqli_num_rows($result) > 0): ?>
                      <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr class="clickable-row" 
                            data-id="<?= $row['section_id'] ?>" 
                            data-grade="<?= htmlspecialchars($row['grade_level']) ?>">
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['section_id']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['section_name']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['grade_level']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['teacher_name'] ?? 'Unassigned') ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['room']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['capacity']) ?></p></td>
                          <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['school_year']) ?></p></td>
                          <td>
                            <a href="delete_section.php?id=<?= urlencode($row['section_id']) ?>&search=<?= urlencode($search) ?>&sort_by=<?= urlencode($current_sort_by) ?>&sort_order=<?= urlencode($current_sort_order) ?>&page=<?= urlencode($page) ?>&school_year=<?= urlencode($school_year) ?>&nav_drop=true"
                              class="btn border rounded rounded-4 btn-sm"
                              onclick="return confirm('Are you sure you want to delete this section?');">
                              Remove
                            </a>
                          </td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="8">
                          <p class="text-muted text-center pt-3 pb-3 mb-0">No section data available for the selected filters</p>
                        </td>
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
                    <a class="page-link text-muted" href="<?= build_query_string($page - 1, $search, $current_sort_by, $current_sort_order, $school_year) ?>">Previous</a>
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
                    <a class="page-link text-muted <?= $i == $page ? 'fw-bold' : '' ?>" href="<?= build_query_string($i, $search, $current_sort_by, $current_sort_order, $school_year) ?>"><?= $i ?></a>
                  </li>
                  <?php endfor; ?>

                  <?php if ($page < $total_pages): ?>
                  <li class="page-item">
                    <a class="page-link text-muted" href="<?= build_query_string($page + 1, $search, $current_sort_by, $current_sort_order, $school_year) ?>">Next</a>
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

    // --- Clickable Row navigation ---
    const rows = document.querySelectorAll('.clickable-row');
    rows.forEach(row => {
        row.addEventListener('click', (event) => {
            // Prevent navigation if the Edit/Remove link/button was clicked
            if (event.target.closest('a') || event.target.closest('button')) {
                return;
            }
            const id = row.getAttribute('data-id');
            const grade = row.getAttribute('data-grade');
            // Include school_year in the redirect for context
            const schoolYear = document.getElementById('school_year').value;
            window.location.href = `class_schedule.php?id=${id}&grade_level=${encodeURIComponent(grade)}&school_year=${encodeURIComponent(schoolYear)}&nav_drop=true`;
        });
    });
});
</script>
</body>
</html>