<?php
include 'session_login.php';
include '../db_connection.php';

// ✅ Set timezone
date_default_timezone_set('Asia/Manila');

// ✅ Logged-in parent ID
$parent_id = $_SESSION['user_id'] ?? null;
if (!$parent_id) {
    echo "<div class='alert alert-warning'>You must be logged in to view this page.</div>";
    exit;
}

// ✅ Pagination & search
$limit = 10;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// ✅ Get all students linked to parent
$query = "
  SELECT u.student_number, u.first_name, u.last_name
  FROM parent_link p
  INNER JOIN users u ON p.student_id = u.user_id
  WHERE p.parent_id = ?
";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $parent_id);
$stmt->execute();
$result = $stmt->get_result();
$students = [];
while ($row = $result->fetch_assoc()) {
    $students[$row['student_number']] = $row['first_name'] . ' ' . $row['last_name'];
}
$stmt->close();

if (empty($students)) {
    echo "<div class='alert alert-warning'>No students linked to this parent.</div>";
    exit;
}

// ✅ Prepare placeholders for IN clause
$student_numbers = array_keys($students);
$placeholders = implode(',', array_fill(0, count($student_numbers), '?'));
$types = str_repeat('s', count($student_numbers));
$params = $student_numbers;

// ✅ Base SQL
$sql = "SELECT * FROM student_health_records WHERE student_id IN ($placeholders)";

// ✅ Add search filter
if ($search !== '') {
    $sql .= " AND (medical_id LIKE ? OR student_id LIKE ?)";
    $types .= 'ss';
    $searchParam = "%$search%";
    $params[] = $searchParam;
    $params[] = $searchParam;
}

// ✅ Count total records for pagination
$countSql = "SELECT COUNT(*) as total FROM ($sql) AS temp";
$countStmt = $conn->prepare($countSql);
$countStmt->bind_param($types, ...$params);
$countStmt->execute();
$countResult = $countStmt->get_result()->fetch_assoc();
$totalRows = $countResult['total'];
$countStmt->close();
$totalPages = ceil($totalRows / $limit);

// ✅ Add limit & offset for current page
$sql .= " ORDER BY created_at DESC LIMIT ?, ?";
$types .= 'ii';
$params[] = $offset;
$params[] = $limit;

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$records = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Medical Records</title>
<?php include 'header.php'; ?>
<style>
  .clickable-row { cursor:pointer; }
  .clickable-row:hover { background-color:#f8f9fa; }
</style>
</head>
<body class="bg-light">
<div class="d-flex flex-row">
<?php include 'navigation.php'; ?>
<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container my-4">
  <div class="row g-4">
    <div class="col-12">
      <div class="container my-4">
        <div class="row align-items-center mb-3">
          <div class="col-md-6">
            <h4>Student Medical Records</h4>
            <p class="text-muted mb-0">You can now view student medical records here.</p>
          </div>
          <div class="col-md-6">
            <form method="get" class="d-flex">
              <input type="text" name="search" class="form-control me-2" placeholder="Search Student Record here" value="<?= htmlspecialchars($search) ?>">
              <button class="btn btn-danger">Search</button>
            </form>
          </div>
        </div>

        <div class="table-responsive p-4 bg-white rounded-4 mt-4 shadow-sm">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Date</th>
                <th>Medical ID</th>
                <th>Student Name</th>
                <th>Student Number</th>
                <th>Height (cm)</th>
                <th>Weight (kg)</th>
                <th>Blood Pressure</th>
                <th>Notes</th>
              </tr>
            </thead>
            <tbody>
              <?php if ($records->num_rows > 0): ?>
                <?php while ($row = $records->fetch_assoc()): ?>
                  <tr class="clickable-row" onclick="window.location='view_medical_detail.php?medical_id=<?= urlencode($row['medical_id']) ?>&student_id=<?= urlencode($row['student_id']) ?>'">
                    <td class="text-muted py-4"><?= htmlspecialchars(date("Y-m-d", strtotime($row['created_at']))) ?></td>
                    <td class="text-muted py-4"><?= htmlspecialchars($row['medical_id']) ?></td>
                    <td class="text-muted py-4"><?= htmlspecialchars($students[$row['student_id']] ?? 'Unknown Student') ?></td>
                    <td class="text-muted py-4"><?= htmlspecialchars($row['student_id']) ?></td>
                    <td class="text-muted py-4"><?= htmlspecialchars($row['height']) ?></td>
                    <td class="text-muted py-4"><?= htmlspecialchars($row['weight']) ?></td>
                    <td class="text-muted py-4"><?= htmlspecialchars($row['blood_pressure']) ?></td>
                    <td class="text-muted py-4"><?= htmlspecialchars($row['notes']) ?></td>
                  </tr>
                <?php endwhile; ?>
              <?php else: ?>
                <tr><td colspan="8" class="text-center text-muted">No medical records found.</td></tr>
              <?php endif; ?>
            </tbody>
          </table>

          <!-- Pagination -->
          <?php if ($totalPages > 1): ?>
            <nav>
              <ul class="pagination justify-content-center">
                <?php if($page > 1): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>&search=<?= urlencode($search) ?>">Previous</a></li>
                <?php endif; ?>

                <?php for($i=1; $i<=$totalPages; $i++): ?>
                  <li class="page-item <?= $i==$page?'active':'' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                  </li>
                <?php endfor; ?>

                <?php if($page < $totalPages): ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>&search=<?= urlencode($search) ?>">Next</a></li>
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

<?php
$stmt->close();
$conn->close();
?>
