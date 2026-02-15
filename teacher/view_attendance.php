<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
date_default_timezone_set('Asia/Manila');

$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($course_id <= 0) die("Invalid course ID.");

$date = isset($_GET['date']) && $_GET['date'] !== '' ? $_GET['date'] : date('Y-m-d');

// ✅ Join table
$join_table = "course_students";

/**
 * ✅ Logic:
 * - Absent: no attendance row for that date
 * - Late: time_in > courses.start_time AND time_in <= courses.end_time
 * - Present: time_in <= start_time OR time_in > end_time (not late after end_time)
 */
$sql = "
  SELECT
    u.user_id,
    u.first_name,
    u.last_name,
    u.rfid,
    c.start_time,
    c.end_time,
    a.time_in AS time_in,
    CASE
      WHEN a.rfid IS NULL THEN 'Absent'
      WHEN TIME(a.time_in) > c.end_time THEN 'Present'
      WHEN TIME(a.time_in) > c.start_time THEN 'Late'
      ELSE 'Present'
    END AS attendance_status
  FROM {$join_table} cs
  INNER JOIN users u
    ON u.user_id = cs.student_id
  INNER JOIN courses c
    ON c.id = cs.course_id
  LEFT JOIN attendance a
    ON a.course_id = cs.course_id
   AND a.date = ?
   AND a.rfid = u.rfid
  WHERE cs.course_id = ?
  -- ✅ SORT BY LASTNAME FIRST (handles NULLs)
  ORDER BY COALESCE(u.last_name,'') ASC, COALESCE(u.first_name,'') ASC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $date, $course_id);
$stmt->execute();
$res = $stmt->get_result();

// ✅ counts + buffer rows
$rows = [];
$presentCount = 0; $lateCount = 0; $absentCount = 0;

while ($r = $res->fetch_assoc()) {
  $rows[] = $r;
  $st = $r['attendance_status'] ?? 'Absent';
  if ($st === 'Late') $lateCount++;
  else if ($st === 'Present') $presentCount++;
  else $absentCount++;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Start Attendance</title>
  <?php include 'header.php' ?>

  <style>
    :root{
      --accent: rgb(218, 64, 64);
      --border: #eef0f3;
      --text: #111827;
      --muted: #6b7280;

      --ok: #16a34a;
      --ok-soft: rgba(22, 163, 74, .12);

      --late: #f59e0b;
      --late-soft: rgba(245, 158, 11, .14);

      --absent: #ef4444;
      --absent-soft: rgba(239, 68, 68, .12);
    }

    .rounded-circle:hover{ background-color:rgb(240, 249, 255) !important; }

    /* Tabs */
    .tabs { display:flex; gap:30px; padding: 6px 0; border-bottom: 1px solid var(--border); margin-bottom: 14px; flex-wrap:wrap; }
    .tab { padding:10px 0; cursor:pointer; position:relative; }
    .tab a { text-decoration:none; color: var(--muted); font-weight: 600; letter-spacing: .2px; }
    .tab.active a { color: var(--text); }
    .tab.active::after{
      content:"";
      position:absolute;
      bottom:-2px;
      left:0;
      width:100%;
      height:3px;
      background: var(--accent);
      border-radius: 99px;
      box-shadow: 0 2px 10px rgba(218,64,64,.25);
    }

    /* Print */
    @media print {
      .print-hide { display:none !important; visibility:hidden !important; }
      .bg-light { background-color:white !important; }
      .bg-white { background-color:white !important; padding:0 !important; }
      .tabs, .att { display:none !important; }
      .card-att { border: none !important; box-shadow: none !important; }
      .card-att-header { border-bottom: 1px solid #ddd !important; }
    }

    /* Card */
    .card-att {
      background: #fff;
      border: 1px solid var(--border);
      border-radius: 18px;
      box-shadow: 0 10px 24px rgba(17,24,39,.06);
      overflow: hidden;
    }
    .card-att-header{
      padding: 18px 18px 10px 18px;
      display:flex;
      justify-content: space-between;
      align-items: flex-end;
      gap: 12px;
      border-bottom: 1px solid var(--border);
      background:
        radial-gradient(800px 200px at 20% 0%, rgba(218,64,64,.10), transparent 60%),
        linear-gradient(180deg, rgba(17,24,39,.02), transparent 70%);
    }
    .title h4{ margin:0; color: var(--text); font-weight: 800; letter-spacing: .2px; }
    .title small{ color: var(--muted); font-weight: 600; }

    .summary{
      display:flex;
      gap: 10px;
      flex-wrap: wrap;
      align-items:center;
      justify-content:flex-end;
    }
    .chip{
      display:inline-flex;
      align-items:center;
      gap: 8px;
      padding: 8px 10px;
      border-radius: 999px;
      border: 1px solid var(--border);
      background: rgba(255,255,255,.6);
      font-weight: 800;
      color: var(--text);
      white-space: nowrap;
    }
    .mini-dot{ width:8px; height:8px; border-radius: 99px; }
    .mini-dot.ok{ background: var(--ok); }
    .mini-dot.late{ background: var(--late); }
    .mini-dot.absent{ background: var(--absent); }

    /* Table */
    .table-wrap{ padding: 0 18px 18px 18px; }
    .table{ margin:0; }
    .table thead th{
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: .08em;
      color: var(--muted);
      border-bottom: 1px solid var(--border) !important;
      padding-top: 14px;
      padding-bottom: 14px;
    }
    .table tbody td{
      border-top: 1px solid var(--border);
      padding-top: 14px;
      padding-bottom: 14px;
      vertical-align: middle;
    }
    .table-hover tbody tr:hover{ background: rgba(218,64,64,.04); }

    .student-cell{ display:flex; align-items:center; gap: 12px; }
    .avatar{
      width: 38px; height: 38px; border-radius: 12px;
      display:grid; place-items:center;
      font-weight: 900; color: var(--text);
      background: linear-gradient(135deg, rgba(17,24,39,.06), rgba(17,24,39,.02));
      border: 1px solid var(--border);
    }
    .student-name{ font-weight: 800; color: var(--text); line-height: 1.15; }
    .student-sub{ font-weight: 650; color: var(--muted); font-size: 12px; }

    .status-pill{
      display:inline-flex; align-items:center; gap: 8px;
      padding: 8px 12px; border-radius: 999px;
      font-weight: 900; letter-spacing: .2px;
      border: 1px solid transparent;
      white-space: nowrap;
    }
    .dot{ width: 9px; height: 9px; border-radius: 99px; }

    .status-present{ color: var(--ok); background: var(--ok-soft); border-color: rgba(22, 163, 74, .25); }
    .status-present .dot{ background: var(--ok); box-shadow: 0 0 0 4px rgba(22,163,74,.12); }

    .status-late{ color: #92400e; background: var(--late-soft); border-color: rgba(245, 158, 11, .30); }
    .status-late .dot{ background: var(--late); box-shadow: 0 0 0 4px rgba(245,158,11,.14); }

    .status-absent{ color: var(--absent); background: var(--absent-soft); border-color: rgba(239, 68, 68, .25); }
    .status-absent .dot{ background: var(--absent); box-shadow: 0 0 0 4px rgba(239,68,68,.12); }

    .time-chip{
      display:inline-flex; align-items:center; gap: 8px;
      padding: 8px 10px; border-radius: 12px;
      border: 1px solid var(--border);
      background: rgba(17,24,39,.02);
      color: var(--text); font-weight: 800;
      white-space: nowrap;
    }
    .time-chip i{ color: var(--accent); }
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

          <div class="d-none d-print-flex justify-content-center">
            <div class="d-flex align-items-center mb-4">
              <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px; width: auto;" class="me-3">
              <div>
                <h5 class="mb-0 fw-bold text-center">The Cardinal Academy, Inc.</h5>
                <small class="d-block text-center">Sullera Street in Pandayan, Meycauayan, Bulacan</small>
                <small class="d-block text-center">Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
              </div>
            </div>
          </div>

          <div class="d-none d-print-flex justify-content-center">
            <h3 class="mb-4">Student Attendance as of <?php echo htmlspecialchars($date); ?></h3>
          </div>

          <div class="row mb-3">
            <div class="col-12 border-bottom col-md-12">
              <h4 class="att">Attendance</h4>
            </div>
          </div>

          <div class="row g-3">
            <div class="tabs d-flex">
              <div class="tab"><a href="course.php?id=<?= $course_id ?>" style="text-decoration:none;">Stream</a></div>
              <div class="tab active"><a href="attendance.php?id=<?= $course_id ?>" style="text-decoration:none;">Attendance</a></div>
              <div class="tab"><a href="assignment.php?id=<?= $course_id ?>" style="text-decoration:none;">Assignment</a></div>
              <div class="tab"><a href="student.php?id=<?= $course_id ?>" style="text-decoration:none;">Students</a></div>
              <div class="tab"><a href="settings.php?id=<?= $course_id ?>" style="text-decoration:none;">Settings</a></div>
            </div>

            <div class="col-12 col-md-12 bg-white rounded-4 p-0">
              <div class="card-att">

                <div class="card-att-header">
                  <div class="title">
                    <h4>Attendance as of <?php echo htmlspecialchars($date); ?></h4>
                  </div>

                  <div class="summary print-hide">
                    <span class="chip"><span class="mini-dot ok"></span> Present: <?= (int)$presentCount ?></span>
                    <span class="chip"><span class="mini-dot late"></span> Late: <?= (int)$lateCount ?></span>
                    <span class="chip"><span class="mini-dot absent"></span> Absent: <?= (int)$absentCount ?></span>
                  </div>
                </div>

                <div class="p-3 print-hide">
                  <div class="row align-items-center g-2">
                    <div class="col-12 col-md-2 d-flex gap-2">
                      <a href="attendance.php?id=<?php echo $course_id; ?>" class="btn w-100 btn-outline-danger rounded-4">
                        <i class="bi bi-arrow-left"></i> Back
                      </a>
                      <a href="#" class="btn w-100 btn-outline-danger rounded-4" onclick="window.print(); return false;">
                        <i class="bi bi-printer"></i> Print
                      </a>
                    </div>
                  </div>
                </div>

                <?php if (isset($_GET['message'])): ?>
                  <?php
                    $message = htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8');
                    $alertType = isset($_GET['alertType']) ? htmlspecialchars($_GET['alertType'], ENT_QUOTES, 'UTF-8') : 'info';
                  ?>
                  <div class="alert alert-<?= $alertType ?> alert-dismissible fade show mt-3 mx-3 print-hide" role="alert">
                    <?= $message ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                <?php endif; ?>

                <div class="table-wrap">
                  <div class="table-responsive">
                    <table class="table table-hover align-middle">
                      <thead>
                        <tr>
                          <th>Student</th>
                          <th>RFID</th>
                          <th>Status</th>
                          <th>Time In</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if (!empty($rows)): ?>
                          <?php foreach ($rows as $row): ?>
                            <?php
                              $rfid = $row['rfid'] ?? '';
                              $status = $row['attendance_status'] ?? 'Absent';
                              $time_in = $row['time_in'] ?? null;

                              $initials = '';
                              if (!empty($row['first_name'])) $initials .= strtoupper(substr($row['first_name'], 0, 1));
                              if (!empty($row['last_name']))  $initials .= strtoupper(substr($row['last_name'], 0, 1));
                              if ($initials === '') $initials = 'S';

                              $statusClass = 'status-absent';
                              if ($status === 'Late') $statusClass = 'status-late';
                              if ($status === 'Present') $statusClass = 'status-present';
                            ?>
                            <tr>
                              <td>
                                <div class="student-cell">
                                  <div class="avatar"><?= htmlspecialchars($initials) ?></div>
                                  <div>
                                    <!-- ✅ same display format as your other page -->
                                    <div class="student-name">
                                      <?= htmlspecialchars(($row['last_name'] ?? '') . ', ' . ($row['first_name'] ?? '')) ?>
                                    </div>
                                    <div class="student-sub">Joined student</div>
                                  </div>
                                </div>
                              </td>

                              <td class="text-muted fw-semibold"><?= htmlspecialchars($rfid) ?></td>

                              <td>
                                <span class="status-pill <?= $statusClass ?>">
                                  <span class="dot"></span>
                                  <?= htmlspecialchars($status) ?>
                                </span>
                              </td>

                              <td>
                                <?php if ($time_in): ?>
                                  <span class="time-chip">
                                    <i class="bi bi-clock"></i>
                                    <?= htmlspecialchars(date('h:i A', strtotime($time_in))) ?>
                                  </span>
                                <?php else: ?>
                                  <span class="text-muted fw-semibold">—</span>
                                <?php endif; ?>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        <?php else: ?>
                          <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                              No students joined in this course yet.
                            </td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div><!-- /card-att -->
            </div><!-- /col -->
          </div><!-- /row g-3 -->

        </div>
      </div>
    </div>
  </div>
</div>

<?php
$stmt->close();
// $conn->close(); // optional
?>

<?php include 'footer.php'; ?>
</body>
</html>
