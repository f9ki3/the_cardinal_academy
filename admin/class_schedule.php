<?php
include 'session_login.php';
include '../db_connection.php';

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
  <title>AcadeSys – Class Schedule</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row">
  <?php include 'navigation.php'; ?>
  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>
    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-4 bg-white">

            <div class="row mt-4 align-items-center mb-4">
              <div class="col-md-4 mb-2">
                <h4 class="mb-0 d-print-none">Class Schedule</h4>
              </div>
              <div class="col-md-8 d-flex flex-wrap gap-2 justify-content-md-end d-print-none">
                <a href="view_section.php?id=&nav_drop=true" class="btn btn-sm text-muted border rounded rounded-4">
                  <i class="bi bi-calendar2-week me-1"></i> Class Masterlist
                </a>
                <a href="class_schedule.php?id=<?= $sectionId ?>&nav_drop=true" class="btn btn-sm border btn-danger text-light rounded rounded-4">
                  <i class="bi bi-calendar2-week me-1"></i> Class Schedule
                </a>
                <button data-bs-toggle="modal" data-bs-target="#addSchedule" class="btn btn-sm border text-muted rounded-4">
                  <i class="bi bi-plus me-1"></i> Add Schedule Entry
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

              <div class="d-none d-print-flex justify-content-center">
               <h3>Class Schedule</h3>
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

                      <!-- Visible input to show combined time -->
                      <input type="hidden" id="timeDisplay" class="form-control" placeholder="e.g. 08:00 AM – 09:00 AM" required readonly>

                      <div class="d-flex gap-2 mt-2">
                        <!-- Start Time -->
                        <input type="time" id="startTime" class="form-control" required>

                        <!-- End Time -->
                        <input type="time" id="endTime" class="form-control" required>
                      </div>

                      <!-- Hidden input to store value for submission -->
                      <input type="hidden" name="time" id="timeInput">
                    </div>

                    <script>
                    const startTime = document.getElementById('startTime');
                    const endTime = document.getElementById('endTime');
                    const timeDisplay = document.getElementById('timeDisplay');
                    const timeInput = document.getElementById('timeInput');

                    // Convert 24-hour HH:MM to 12-hour format with AM/PM
                    function format12Hour(time) {
                      const [h, m] = time.split(':');
                      let hour = parseInt(h);
                      const ampm = hour >= 12 ? 'PM' : 'AM';
                      hour = hour % 12 || 12; // Convert 0 -> 12
                      return `${hour.toString().padStart(2,'0')}:${m} ${ampm}`;
                    }

                    // Update visible and hidden input
                    function updateTimeInput() {
                      if (startTime.value && endTime.value) {
                        // Validate end time is not earlier than start
                        if (endTime.value <= startTime.value) {
                          alert('End time cannot be earlier than or equal to start time.');
                          endTime.value = '';
                          timeDisplay.value = '';
                          timeInput.value = '';
                          return;
                        }

                        const formatted = `${format12Hour(startTime.value)} – ${format12Hour(endTime.value)}`;
                        timeDisplay.value = formatted;
                        timeInput.value = formatted;
                      }
                    }

                    // Listen for changes
                    [startTime, endTime].forEach(el => el.addEventListener('change', updateTimeInput));
                    </script>

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
                <div class="col-md-4 mb-2"><strong>Adviser:</strong> <?= htmlspecialchars($section['adviser'] ?? 'N/A') ?></div>
                <div class="col-md-4 mb-2"><strong>Section Name:</strong> <?= htmlspecialchars($section['section_name']) ?></div>
                <div class="col-md-4 mb-2"><strong>Grade Level:</strong> <?= htmlspecialchars($section['grade_level']) ?></div>
                <?php if ($section['strand'] !== 'N/A'): ?>
                    <div class="col-md-4"><strong>Strand:</strong> <?= htmlspecialchars($section['strand']) ?></div>
                <?php endif; ?>
                <div class="col-md-4 mb-2"><strong>School Year:</strong> <?= htmlspecialchars($section['school_year']) ?></div>
                <div class="col-md-2 mb-2"><strong>Room:</strong> <?= htmlspecialchars($section['room'] ?: '—') ?></div>
                <div class="col-md-2 mb-2"><strong>Capacity:</strong> <?= htmlspecialchars($section['capacity']) ?></div>
              </div>
              <hr>

              <div class="table-responsive" style="font-size: 12px;">
                <table class="table table-sm table-striped align-middle">
                  <thead class="text-start text-muted">
                    <tr>
                      <th>#</th>
                      <th>Subject&nbsp;Code</th>
                      <th>Description</th>
                      <th>Time</th>
                      <th>Teacher</th>
                      <th>Room</th>
                      <th class="d-print-none">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if ($schedule->num_rows): ?>
                      <?php $i = 1; while ($row = $schedule->fetch_assoc()): ?>
                        <tr class="text-muted">
                          <td><?= $i++ ?></td>
                          <td><?= htmlspecialchars($row['subject_code']) ?></td>
                          <td><?= htmlspecialchars($row['description']) ?></td>
                          <td><?= htmlspecialchars($row['time']) ?></td>
                          <td><?= htmlspecialchars($row['teacher']) ?></td>
                          <td><?= htmlspecialchars($row['room']) ?></td>
                          <td>
                            <form action="remove_schedule.php" method="POST" onsubmit="return confirm('Are you sure you want to remove this schedule?');">
                              <input type="hidden" name="schedule_id" value="<?= $row['id'] ?>">
                              <button type="submit" class="d-print-none btn btn-sm btn-sm rounded rounded-4 border">Remove</button>
                            </form>
                          </td>
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


          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
