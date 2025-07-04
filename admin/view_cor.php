<?php
include 'session_login.php';
include '../db_connection.php';

// Get the student's full name from the URL
$studentName = isset($_GET['fullname']) ? urldecode($_GET['fullname']) : 'N/A';
$lrn = isset($_GET['lrn']) ? urldecode($_GET['lrn']) : 'N/A';

// Fetch teachers
$teachers_result = mysqli_query($conn, "SELECT user_id, CONCAT(first_name, ' ', last_name) AS full_name FROM users WHERE acc_type = 'teacher'");
if (!$teachers_result) {
    die("Error fetching teachers: " . mysqli_error($conn));
}

// Fetch subjects
$subjStmt = $conn->query("SELECT subject_code, description FROM subjects ORDER BY description ASC");
$subjects = $subjStmt->fetch_all(MYSQLI_ASSOC);

// Validate section ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: sections.php?status=error');
    exit;
}
$sectionId = (int) $_GET['id'];

// Fetch section details
$sql = "
    SELECT s.*, CONCAT(u.first_name, ' ', u.last_name) AS adviser
    FROM sections s
    LEFT JOIN users u ON u.user_id = s.teacher_id
    WHERE s.section_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $sectionId);
$stmt->execute();
$section = $stmt->get_result()->fetch_assoc();

if (!$section) {
    echo '<div class="alert alert-warning">Section not found.</div>';
    exit;
}
// Get the student's full name from the URL
$studentName = isset($_GET['fullname']) ? urldecode($_GET['fullname']) : 'N/A';


// Fetch class schedule
$sched_stmt = $conn->prepare("SELECT * FROM class_schedule WHERE section_id = ? ORDER BY time ASC");
$sched_stmt->bind_param('i', $sectionId);
$sched_stmt->execute();
$schedule = $sched_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AcadeSys – Certificate of Registration</title>
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
          <div class="rounded p-4 bg-white">

            <div class="row mt-4 align-items-center mb-4">
              <div class="col-md-4 mb-2">
                <h4 class="mb-0 d-print-none">Certificate of Registration</h4>
              </div>
              <div class="col-md-8 d-flex flex-wrap gap-2 justify-content-md-end d-print-none">
                <button class="btn btn-sm border text-muted rounded-4" onclick="sendEmail()">
                    <i class="bi bi-envelope me-1"></i> Send Email
                </button>
                <button class="btn btn-sm border text-muted rounded-4" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print
                </button>
                </div>
            </div>
            <div class="d-none d-print-flex justify-content-center">
                <div class="d-flex align-items-center mb-4">
                  <img src="../static/uploads/logo.png" alt="Logo" style="height: 70px; width: auto;" class="me-3">
                  <div>
                    <h5 class="mb-0 fw-bold text-center">The Cardinal Academy, Inc.</h5>
                    <small class="d-block text-center">Sullera Street in Pandayan, Meycauayan, Bulacan </small>
                    <small class="d-block text-center">Phone: (0912) 345-6789 | Email: info@cardinalacademy.edu.ph</small>
                  </div>
                </div>
              </div>


            <!-- Modal -->
            <div class="modal fade" id="addSchedule" tabindex="-1" aria-labelledby="addScheduleLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addScheduleLabel">Add Class Schedule</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <form action="add_class_schedule.php" method="POST">
                    <input type="hidden" name="section_id" value="<?= htmlspecialchars($sectionId) ?>">
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" id="subjectDescInput" name="description" class="form-control" list="subjectList" autocomplete="off" required>
                        <datalist id="subjectList">
                          <?php foreach ($subjects as $s): ?>
                            <option value="<?= htmlspecialchars($s['description']) ?>" data-code="<?= htmlspecialchars($s['subject_code']) ?>"></option>
                          <?php endforeach; ?>
                        </datalist>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Subject Code</label>
                        <input type="text" id="subjectCodeInput" name="subject_code" class="form-control" readonly required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Time</label>
                        <input type="text" name="time" class="form-control" placeholder="e.g. 08:00 AM – 09:00 AM" required>
                      </div>
                      <div class="row g-2">
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Advisory Class</label>
                          <select name="teacher_id" id="teacher_id" class="form-select" required>
                            <option value="">Select teacher</option>
                            <?php while ($row = mysqli_fetch_assoc($teachers_result)): ?>
                              <option value="<?= $row['full_name'] ?>"><?= htmlspecialchars($row['full_name']) ?></option>
                            <?php endwhile; ?>
                          </select>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Room</label>
                          <input type="text" name="room" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>

            <script>
              (function () {
                const descInput = document.getElementById('subjectDescInput');
                const codeInput = document.getElementById('subjectCodeInput');
                const options = [...document.getElementById('subjectList').options];

                function syncCode() {
                  const opt = options.find(o => o.value === descInput.value);
                  codeInput.value = opt ? opt.dataset.code : '';
                }

                document.addEventListener('DOMContentLoaded', syncCode);
                descInput.addEventListener('input', syncCode);
                descInput.addEventListener('change', syncCode);
              })();
            </script>

            <hr>
           <div class="row" style="font-size: 12px;">
            <div class="col-md-4"><strong>Student Name:</strong> <?= htmlspecialchars($studentName) ?></div>
            <div class="col-md-4"><strong>LRN:</strong> <?= htmlspecialchars($lrn) ?></div>
            <div class="col-md-4"><strong>Adviser:</strong> <?= htmlspecialchars($section['adviser'] ?? 'N/A') ?></div>
            <div class="col-md-4"><strong>Section Name:</strong> <?= htmlspecialchars($section['section_name']) ?></div>
            <div class="col-md-4"><strong>Grade Level:</strong> <?= htmlspecialchars($section['grade_level']) ?></div>
            <div class="col-md-4"><strong>School Year:</strong> <?= htmlspecialchars($section['school_year']) ?></div>
            <div class="col-md-4"><strong>Room:</strong> <?= htmlspecialchars($section['room'] ?: '—') ?></div>
          </div>

            <hr>

            <div class="table-responsive">
             <table class="table table-sm table-striped align-middle">
                <thead class="text-start text-muted">
                  <tr>
                    <th>#</th>
                    <th>Subject&nbsp;Code</th>
                    <th>Description</th>
                    <th>Time</th>
                    <th>Teacher</th>
                    <th>Room</th>
                  </tr>
                </thead>
                <tbody style="font-size: 12px">
                  <?php if ($schedule->num_rows): ?>
                    <?php $i = 1; while ($row = $schedule->fetch_assoc()): ?>
                      <tr class="text-muted">
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['subject_code']) ?></td>
                        <td><?= htmlspecialchars($row['description']) ?></td>
                        <td><?= htmlspecialchars($row['time']) ?></td>
                        <td><?= htmlspecialchars($row['teacher']) ?></td>
                        <td><?= htmlspecialchars($row['room']) ?></td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else: ?>
                    <tr class="text-muted">
                      <td colspan="7" class="text-start fst-italic">No schedule entries yet.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>


            </div>
            <div class="row">
              <div class="col-12 col-md-4 mb-3" style="font-size: 12px;">
                <div style="background-color: #b72029;" class="p-2 mb-3">
                  <h6 class="mb-1 fw-bolder text-light text-center">School Expense</h6>
                </div>

                <div class="d-flex justify-content-between">
                  <span><strong>Payment Plan</strong></span>
                  <span>Full Payment</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span><strong>Tuition Fee</strong></span>
                  <span>₱15,000.00</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span><strong>Registration Fee</strong></span>
                  <span>₱1,000.00</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span><strong>Miscellaneous</strong></span>
                  <span>₱3,000.00</span>
                </div>
                <div class="d-flex justify-content-between">
                  <span><strong>Discount</strong></span>
                  <span>-₱2,000.00</span>
                </div>
              </div>

            <div class="col-12 col-md-8 d-flex justify-content-end" style="font-size: 12px;">
              <div class="d-flex align-items-center flex-column" style="font-size: 12px; width: 50%">
                <p class="mb-0 mb-3 mt-3"><strong>Approved by:</strong></p>
                <h6 class="mb-0 fw-bolder text-uppercase">MR. CJ A. Escalora</h6>
                <p class="mb-0">______________________________________</p>
                <p class="mb-0 fw-bolder">Head Registrar</p>
              </div>


            </div>

            </div>

            <div class="d-flex justify-content-center" style="background-color: #b72029;" >
              <div class="p-2 text-center text-light" >
                <p class="mb-0">Keep this certificate. you will be required to present this on your class. thank you.</p>
              </div>
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
