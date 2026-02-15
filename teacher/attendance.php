<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
// ------------------------------------------------------------
// ✅ Secure DELETE handler (AJAX) for: attendance.course_id + attendance.date
// ------------------------------------------------------------
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_attendance') {
  header('Content-Type: application/json; charset=utf-8');

  // CSRF check
  $csrf = $_POST['csrf_token'] ?? '';
  if (!hash_equals($_SESSION['csrf_token'], $csrf)) {
    http_response_code(403);
    echo json_encode(["ok" => false, "error" => "Invalid CSRF token."]);
    exit;
  }

  // Validate inputs
  $course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
  $date = isset($_POST['date']) ? trim($_POST['date']) : '';

  if ($course_id <= 0) {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "Invalid course_id."]);
    exit;
  }

  // Expect YYYY-MM-DD
  if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    http_response_code(400);
    echo json_encode(["ok" => false, "error" => "Invalid date format. Use YYYY-MM-DD."]);
    exit;
  }

  try {
    // Delete all attendance rows for that course + date
    $stmt = $conn->prepare("DELETE FROM attendance WHERE course_id = ? AND date = ?");
    if (!$stmt) {
      throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("is", $course_id, $date);
    $stmt->execute();

    $affected = $stmt->affected_rows;
    $stmt->close();

    echo json_encode(["ok" => true, "deleted" => $affected]);
    exit;
  } catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(["ok" => false, "error" => "Server error deleting attendance."]);
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Attendance Records</title>
  <?php include 'header.php' ?>
  <style>
    .rounded-circle:hover{
      background-color:rgb(240, 249, 255) !important;
    }
    .tabs {
      display: flex;
      gap: 30px;
      padding: 5px;
    }
    .tab {
      padding: 8px 0;
      cursor: pointer;
      position: relative;
    }
    .tab p {
      margin: 0;
      font-weight: 500;
      color: #555;
    }
    .tab.active p { color: #000; }
    .tab.active::after {
      content: "";
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 3px;
      background:rgb(218, 64, 64);
      border-radius: 2px;
    }
  </style>
</head>

<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php' ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php' ?>

    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div>
            <div class="container my-4">
              <div class="row mb-3">
                <div class="col-12 border-bottom col-md-12">
                  <h4>Attendance Records</h4>
                </div>
              </div>

              <!-- Courses Grid -->
              <div class="row g-3">
                <?php $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0; ?>

                <div class="tabs d-flex">
                  <div class="tab">
                    <a href="course.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Stream</a>
                  </div>
                  <div class="tab active">
                    <a href="attendance.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Attendance</a>
                  </div>
                  <div class="tab">
                    <a href="assignment.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Assignment</a>
                  </div>
                  <div class="tab">
                    <a href="student.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Students</a>
                  </div>
                  <div class="tab">
                    <a href="grades.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Grades</a>
                  </div>
                  <div class="tab">
                    <a href="settings.php?id=<?= $course_id ?>" style="text-decoration: none; color: black">Settings</a>
                  </div>
                </div>

                <?php
                  // Fetch distinct attendance dates for the course
                  $stmt = $conn->prepare("
                    SELECT date, COUNT(*) as count
                    FROM attendance
                    WHERE course_id = ?
                    GROUP BY date
                    ORDER BY date DESC
                  ");
                  $stmt->bind_param("i", $course_id);
                  $stmt->execute();
                  $result = $stmt->get_result();
                ?>

                <div class="col-12 col-md-12 p-4 bg-white rounded-4">
                  <div class="row align-items-center mb-4">
                    <div class="col-12 col-md-10">
                      <div class="input-group w-50">
                        <input type="text" id="searchDateInput" class="form-control" placeholder="Search date here...">
                        <button class="btn border" type="button" onclick="filterTable()">
                          <i class="bi bi-search"></i>
                        </button>
                      </div>
                    </div>
                    <div class="col-12 col-md-2 mt-2 mt-md-0">
                      <a href="start_attendance.php?id=<?= $course_id ?>" class="btn btn-danger rounded rounded-4 w-100">
                        <i class="bi bi-play-circle me-2"></i> Start
                      </a>
                    </div>
                  </div>

                  <div class="table-responsive">
                    <table class="table table-hover" id="attendanceTable">
                      <thead>
                        <tr>
                          <th scope="col" class="text-muted">Date</th>
                          <th scope="col" class="text-muted">Present</th>
                          <th scope="col" class="text-muted" style="width: 120px;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($result->num_rows > 0): ?>
                          <?php while ($row = $result->fetch_assoc()): ?>
                            <?php $dateVal = $row['date']; ?>
                            <tr class="text-muted" style="cursor:pointer"
                                onclick="window.location.href='view_attendance.php?id=<?= $course_id ?>&date=<?= urlencode($dateVal) ?>'">
                              <td class="text-muted"><?= htmlspecialchars($dateVal) ?></td>
                              <td class="text-muted"><?= intval($row['count']) ?></td>
                              <td>
                                <button
                                  type="button"
                                  class="btn rounded rounded-circle btn-border btn-sm text-muted"
                                  style="color: inherit;"
                                  onclick="event.stopPropagation(); deleteAttendance('<?= htmlspecialchars($dateVal, ENT_QUOTES) ?>');"
                                  title="Delete"
                                >
                                  <i class="bi bi-trash text-muted" style="color: inherit;"></i>
                                </button>
                              </td>
                            </tr>
                          <?php endwhile; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="3" class="text-center text-muted">No attendance records found.</td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <script>
                  const COURSE_ID = <?= (int)$course_id ?>;
                  const CSRF_TOKEN = "<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES) ?>";

                  // Simple filter function to filter attendance by date in the table
                  function filterTable() {
                    const input = document.getElementById("searchDateInput").value.toLowerCase();
                    const table = document.getElementById("attendanceTable");
                    const trs = table.tBodies[0].getElementsByTagName("tr");

                    for (let i = 0; i < trs.length; i++) {
                      const dateCell = trs[i].getElementsByTagName("td")[0];
                      if (dateCell) {
                        const dateText = dateCell.textContent || dateCell.innerText;
                        trs[i].style.display = dateText.toLowerCase().indexOf(input) > -1 ? "" : "none";
                      }
                    }
                  }

                  // ✅ Real delete: attendance.course_id == ?id=40 AND attendance.date == selected date
                  async function deleteAttendance(date) {
                    if (!COURSE_ID || COURSE_ID <= 0) {
                      alert("Invalid course ID.");
                      return;
                    }

                    if (!confirm(`Are you sure you want to delete attendance for ${date}?`)) return;

                    const form = new FormData();
                    form.append("action", "delete_attendance");
                    form.append("course_id", String(COURSE_ID));
                    form.append("date", date);
                    form.append("csrf_token", CSRF_TOKEN);

                    try {
                      const res = await fetch(window.location.href, {
                        method: "POST",
                        body: form,
                        credentials: "same-origin"
                      });

                      const data = await res.json().catch(() => null);

                      if (!res.ok || !data || data.ok !== true) {
                        const msg = (data && data.error) ? data.error : "Delete failed.";
                        alert(msg);
                        return;
                      }

                      // Optional: show how many rows were deleted (each student record = 1 row)
                      // alert(`Deleted ${data.deleted} attendance row(s) for ${date}.`);

                      // Refresh list
                      window.location.reload();
                    } catch (err) {
                      alert("Network/server error. Please try again.");
                    }
                  }
                </script>

              </div>
            </div> <!-- end inner container -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
