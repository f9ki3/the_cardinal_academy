<?php
include 'session_login.php';
include '../db_connection.php';

// --- Pagination & search ----------------------------------------------------
$limit  = 10;
$page   = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$school_year = isset($_GET['school_year']) ? trim($_GET['school_year']) : '';
$offset = ($page - 1) * $limit;

$searchEsc = mysqli_real_escape_string($conn, $search);
$schoolYearEsc = mysqli_real_escape_string($conn, $school_year);

// --- Get all school years dynamically ---------------------------------------
$sy_query = "SELECT DISTINCT school_year FROM sections ORDER BY school_year DESC";
$sy_result = mysqli_query($conn, $sy_query);
$school_years = [];
while ($row = mysqli_fetch_assoc($sy_result)) {
    $school_years[] = $row['school_year'];
}

// --- Build WHERE condition --------------------------------------------------
if ($school_year !== '') {
    // If a specific school year is selected
    $schoolYearCondition = "es.school_year = '$schoolYearEsc'";
} else {
    // Default: current year and next year
    $schoolYearCondition = "es.school_year IN (YEAR(CURDATE()), YEAR(CURDATE()) + 1)";
}

// --- Count total rows -------------------------------------------------------
$count_query = "
    SELECT COUNT(*) AS total
    FROM student_tuition st
    JOIN student_information si ON st.student_number = si.student_number
    JOIN sections es ON st.enrolled_section = es.section_id
    WHERE $schoolYearCondition
      AND (
          st.account_number LIKE '%$searchEsc%'
          OR si.student_number LIKE '%$searchEsc%'
          OR CONCAT(si.firstname, ' ', si.middlename, ' ', si.lastname) LIKE '%$searchEsc%'
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
        st.id AS tuition_id,
        st.account_number,
        st.student_number,
        CONCAT(si.firstname, ' ', COALESCE(si.middlename,''), ' ', si.lastname) AS fullname,
        si.status,
        si.grade_level AS info_grade_level
    FROM student_tuition st
    JOIN student_information si ON st.student_number = si.student_number
    JOIN sections es ON st.enrolled_section = es.section_id
    WHERE $schoolYearCondition
      AND (
          st.account_number LIKE '%$searchEsc%'
          OR si.student_number LIKE '%$searchEsc%'
          OR CONCAT(si.firstname, ' ', si.middlename, ' ', si.lastname) LIKE '%$searchEsc%'
      )
    ORDER BY st.id DESC
    LIMIT $limit OFFSET $offset
";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("<p style='color:red;'>Data Query Failed: " . mysqli_error($conn) . "</p>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - COR Inssuance</title>
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
          <div class="rounded p-3">
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 col-md-6">
                  <h4>Tuition Payment</h4>
                </div>
                <div class="col-12 col-md-6">
                  <form method="GET" action="">
                    <div class="input-group">
                        <!-- School Year Dropdown -->
                        <select name="school_year" id="school_year" class="form-select rounded rounded-4">
                        <option value="">All Current/Next Year</option>
                        <?php foreach ($school_years as $sy): ?>
                            <option value="<?= htmlspecialchars($sy) ?>" 
                            <?= ($school_year === $sy) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($sy) ?>
                            </option>
                        <?php endforeach; ?>
                        </select>

                        <!-- Search Box -->
                        <input 
                        class="form-control rounded rounded-4 ms-2" 
                        type="text" 
                        name="search" 
                        value="<?= htmlspecialchars($search ?? '') ?>" 
                        placeholder="Search Student ID or Fullname">

                        <!-- Search Button -->
                        <button class="btn border ms-2 rounded rounded-4" type="submit">
                        Search
                        </button>
                    </div>
                  </form>
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
                <table class="table table-striped table-hover" style="cursor: pointer">
                  <thead>
                        <tr>
                            <th>Account Number</th>
                            <th>Student Number</th>
                            <th>Fullname</th>
                            <th>Status</th>
                            <th>Info Grade Level</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr class="clickable-row" data-id="<?= htmlspecialchars($row['tuition_id']) ?>">
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['account_number']) ?></p></td>
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['student_number']) ?></p></td>
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['fullname']) ?></p></td>
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['status']) ?></p></td>
                                    <td><p class="text-muted pt-3 pb-3 mb-0"><?= htmlspecialchars($row['info_grade_level']) ?></p></td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5"><p class="text-muted text-center pt-3 pb-3 mb-0">No student data available</p></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                document.querySelectorAll(".clickable-row").forEach(row => {
                                    row.addEventListener("click", () => {
                                        const tuitionId = row.dataset.id;
                                        if (tuitionId) {
                                            window.location.href = "view_tuition2.php?tuition_id=" + tuitionId;
                                        }
                                    });
                                });
                            });
                        </script>



                </table>
              </div>

              <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-start pagination-sm">
                    <?php 
                        // Preserve filters
                        $query_params = [
                        'search' => $search,
                        'school_year' => $school_year
                        ];
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
</body>
</html>