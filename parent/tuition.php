<?php
include 'session_login.php';
include '../db_connection.php';

$parent_id = $_SESSION['user_id'];

// --- Get linked student numbers for this parent ---
$linked_students = [];
$link_query = "
    SELECT u.student_number 
    FROM parent_link pl
    JOIN users u ON pl.student_id = u.user_id
    WHERE pl.parent_id = ?
";
$stmt = $conn->prepare($link_query);
$stmt->bind_param("i", $parent_id);
$stmt->execute();
$result_link = $stmt->get_result();

while ($row = $result_link->fetch_assoc()) {
    $linked_students[] = $row['student_number'];
}

// Stop if no linked students found
if (empty($linked_students)) {
    $linked_students_list = "''"; // prevent SQL error
} else {
    $linked_students_list = "'" . implode("','", array_map('mysqli_real_escape_string', array_fill(0, count($linked_students), $conn), $linked_students)) . "'";
}

// --- Pagination & Search ---
$limit  = 10;
$page   = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$school_year = isset($_GET['school_year']) ? trim($_GET['school_year']) : '';
$offset = ($page - 1) * $limit;

$searchEsc = mysqli_real_escape_string($conn, $search);
$schoolYearEsc = mysqli_real_escape_string($conn, $school_year);

// --- Get All School Years ---
$sy_query = "SELECT DISTINCT school_year FROM sections ORDER BY school_year DESC";
$sy_result = mysqli_query($conn, $sy_query);
$school_years = [];
if ($sy_result && mysqli_num_rows($sy_result) > 0) {
    while ($row = mysqli_fetch_assoc($sy_result)) {
        $school_years[] = $row['school_year'];
    }
}

// --- Build WHERE Condition ---
$where = "st.student_number IN ($linked_students_list)";
if (!empty($school_year)) {
    $where .= " AND es.school_year = '$schoolYearEsc'";
}
if (!empty($search)) {
    $where .= " AND (
        st.account_number LIKE '%$searchEsc%' OR
        si.student_number LIKE '%$searchEsc%' OR
        CONCAT(si.firstname, ' ', COALESCE(si.middlename,''), ' ', si.lastname) LIKE '%$searchEsc%'
    )";
}

// --- Count Total Rows ---
$count_query = "
    SELECT COUNT(*) AS total
    FROM student_tuition st
    JOIN student_information si ON st.student_number = si.student_number
    JOIN sections es ON st.enrolled_section = es.section_id
    WHERE $where
";
$count_result = mysqli_query($conn, $count_query);
if (!$count_result) {
    die("<p style='color:red;'>Count Query Failed: " . mysqli_error($conn) . "</p>");
}
$total = (int) mysqli_fetch_assoc($count_result)['total'];
$total_pages = max(1, ceil($total / $limit));

// --- Fetch Paginated Rows ---
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
    WHERE $where
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
  <title>AcadeSys - Tuition Payment</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-white">
  <?php
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT first_name, last_name, profile FROM users WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result_user = $stmt->get_result();
    $user = $result_user->fetch_assoc();

    $full_name = htmlspecialchars($user['first_name'] . ', ' . $user['last_name']);
    $profile_image = !empty($user['profile']) ? '../static/uploads/' . htmlspecialchars($user['profile']) : '../static/uploads/dummy.jpg';
  ?>

  <!-- Sidebar -->
  <div id="nav_side" class="d-print-none sidebar p-3 border-end sticky-top d-none d-md-flex flex-column" 
      style="min-height: 100vh; width: 260px; background: #fff; box-shadow: 2px 0 6px rgba(0,0,0,0.05);">

      <!-- Profile Section -->
      <div class="profile-pic mb-3 w-100 text-center">
          <img src="<?= $profile_image ?>" alt="Profile" 
              class="rounded-circle shadow-sm img-fluid d-block mx-auto"
              style="width: 90px; height: 90px; object-fit: cover;">
          <h6 class="mt-2 fw-semibold text-dark mb-0"><?= $full_name ?></h6>
          <small class="text-muted">Parents</small>
      </div>

      <hr class="text-muted">

      <!-- Nav Menu -->
      <div class="flex-grow-1 overflow-auto" style="max-height: calc(100vh - 200px);">
      <ul class="nav flex-column gap-1">
          <li class="nav-item">
            <a href="#" class="nav-link d-flex align-items-center px-3 py-2 rounded-3"
               data-bs-toggle="modal" data-bs-target="#linkStudentModal">
               <i class="bi bi-plus-circle me-2"></i><span>Link Student</span>
            </a>
          </li>
          <li class="nav-item"><a href="dashboard.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3"><i class="bi bi-people me-2"></i>Students</a></li>
          <li class="nav-item"><a href="announcement.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3"><i class="bi bi-megaphone me-2"></i>Announcement</a></li>
          <li class="nav-item"><a href="tuition.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3"><i class="bi bi-credit-card me-2"></i>Tuition</a></li>
          <li class="nav-item"><a href="attendance.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3"><i class="bi bi-calendar-check me-2"></i>Attendance</a></li>
          <li class="nav-item"><a href="medical.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3"><i class="bi bi-heart-pulse me-2"></i>Medical</a></li>
          <li class="nav-item"><a href="disciplinary.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3"><i class="bi bi-exclamation-triangle me-2"></i>Disciplinary</a></li>
          <li class="nav-item"><a href="profile.php" class="nav-link d-flex align-items-center px-3 py-2 rounded-3"><i class="bi bi-person me-2"></i>My Account</a></li>
      </ul>
      </div>

      <div class="mt-auto pt-3 border-top">
          <a class="nav-link d-flex align-items-center px-3 py-2 rounded-3 text-danger fw-semibold" href="logout.php">
              <i class="bi bi-box-arrow-right me-2"></i>Logout
          </a>
      </div>
  </div>

  <!-- Sidebar Styles -->
  <style>
      #nav_side .nav-link {
          color: #333 !important;
          font-size: 0.95rem;
          transition: all 0.25s ease-in-out;
      }
      #nav_side .nav-link i {
          font-size: 1.1rem;
          transition: inherit;
      }
      #nav_side .nav-link:hover {
          background: #f1f5ff;
          color: #0d6efd !important;
          font-weight: 600;
      }
      #nav_side .nav-link.active {
          background: #e7f1ff;
          color: #0d6efd !important;
          font-weight: 700;
      }
  </style>

  <!-- Main Content -->
  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>
    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-3 bg-white">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <h4>Tuition Payment</h4>
            </div>

            <!-- Filters -->
            <form method="GET" class="mb-3">
              <div class="input-group">
                  <select name="school_year" class="form-select rounded rounded-4">
                      <option value="">All School Years</option>
                      <?php foreach ($school_years as $sy): ?>
                          <option value="<?= htmlspecialchars($sy) ?>" <?= ($school_year === $sy) ? 'selected' : '' ?>><?= htmlspecialchars($sy) ?></option>
                      <?php endforeach; ?>
                  </select>
                  <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control rounded rounded-4 ms-2" placeholder="Search Account Number or Student ID or Fullname">
                  <button class="btn border ms-2 rounded rounded-4" type="submit">Search</button>
              </div>
            </form>

            <!-- Table -->
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>Account Number</th>
                    <th>Student Number</th>
                    <th>Fullname</th>
                    <th>Status</th>
                    <th>Grade Level</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                      <tr class="clickable-row" data-id="<?= htmlspecialchars($row['tuition_id']) ?>">
                        <td class="py-3 text-muted"><?= htmlspecialchars($row['account_number']) ?></td>
                        <td class="py-3 text-muted"><?= htmlspecialchars($row['student_number']) ?></td>
                        <td class="py-3 text-muted"><?= htmlspecialchars($row['fullname']) ?></td>
                        <td class="py-3 text-muted"><?= htmlspecialchars($row['status']) ?></td>
                        <td class="py-3 text-muted"><?= htmlspecialchars($row['info_grade_level']) ?></td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr><td colspan="5" class="text-center text-muted">No student data available</td></tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>

            <!-- Click Redirect -->
            <script>
            document.addEventListener("DOMContentLoaded", () => {
              document.querySelectorAll(".clickable-row").forEach(row => {
                row.addEventListener("click", () => {
                  const id = row.dataset.id;
                  if (id) window.location.href = "view_tuition2.php?tuition_id=" + encodeURIComponent(id);
                });
              });
            });
            </script>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
            <nav>
              <ul class="pagination pagination-sm">
                <?php
                $query_params = ['search' => $search, 'school_year' => $school_year];
                $max_links = 5;
                $start = max(1, $page - floor($max_links / 2));
                $end = min($total_pages, $start + $max_links - 1);
                ?>
                <?php if ($page > 1): ?>
                  <li class="page-item"><a class="page-link text-muted" href="?<?= http_build_query(array_merge($query_params, ['page' => $page - 1])) ?>">Previous</a></li>
                <?php endif; ?>
                <?php for ($i = $start; $i <= $end; $i++): ?>
                  <li class="page-item">
                    <a class="page-link text-muted <?= $i == $page ? 'fw-bold' : '' ?>" href="?<?= http_build_query(array_merge($query_params, ['page' => $i])) ?>"><?= $i ?></a>
                  </li>
                <?php endfor; ?>
                <?php if ($page < $total_pages): ?>
                  <li class="page-item"><a class="page-link text-muted" href="?<?= http_build_query(array_merge($query_params, ['page' => $page + 1])) ?>">Next</a></li>
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

<?php include 'footer.php'; ?>
</body>
</html>
