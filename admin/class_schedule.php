<?php
include 'session_login.php';
include '../db_connection.php';

/* ── 1. Validate & fetch section ─────────────────────────────── */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: sections.php?status=error');
    exit;
}
$sectionId = (int) $_GET['id'];

$sql = "
    SELECT s.*,
           CONCAT(u.first_name, ' ', u.last_name) AS adviser
    FROM   sections s
    LEFT JOIN users u ON u.user_id = s.teacher_id
    WHERE  s.section_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $sectionId);
$stmt->execute();
$section = $stmt->get_result()->fetch_assoc();

if (!$section) {
    echo '<div class="alert alert-warning">Section not found.</div>';
    exit;
}

/* ── 2. Get class schedule for this section ──────────────────── */
$sched_stmt = $conn->prepare("
    SELECT *
    FROM   class_schedule
    WHERE  section_id = ?
    ORDER  BY time ASC
");
$sched_stmt->bind_param('i', $sectionId);
$sched_stmt->execute();
$schedule = $sched_stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys – Class Schedule</title>
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
          <div class="rounded p-4 bg-white">

            <!-- Header / toolbar --------------------------------------------------->
            <div class="row mt-4 align-items-center mb-4">
              <div class="col-12 col-md-4 mb-2 mb-md-0">
                  <h4 class="mb-0">Class Schedule</h4>
              </div>

              <div class="col-12 col-md-8 d-flex flex-wrap gap-2 justify-content-md-end d-print-none">

                <a href="view_section.php?id=<?= $sectionId ?>&nav_drop=true" class="btn btn-sm text-muted border rounded rounded-4">
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

            <!-- Add-Schedule Modal -------------------------------------------------->
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
                        <label class="form-label">Subject Code</label>
                        <input type="text" name="subject_code" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Time</label>
                        <input type="text" name="time" class="form-control" placeholder="e.g. 08:00 AM – 09:00 AM" required>
                      </div>
                      <div class="row g-2">
                        <div class="col-md-6 mb-3">
                          <label class="form-label">Teacher</label>
                          <input type="text" name="teacher" class="form-control" required>
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
            </div><!-- /modal -->

            <!-- Section information ----------------------------------------------->
            <hr>
            <div class="row">
              <div class="col-md-4 mb-2"><strong>Adviser:</strong> <?= htmlspecialchars($section['adviser'] ?? 'N/A') ?></div>
              <div class="col-md-4 mb-2"><strong>Section Name:</strong> <?= htmlspecialchars($section['section_name']) ?></div>
              <div class="col-md-4 mb-2"><strong>Grade Level:</strong> <?= htmlspecialchars($section['grade_level']) ?></div>

              <div class="col-md-4 mb-2"><strong>School Year:</strong> <?= htmlspecialchars($section['school_year']) ?></div>
              <div class="col-md-4 mb-2"><strong>Room:</strong> <?= htmlspecialchars($section['room'] ?: '—') ?></div>
              <div class="col-md-4 mb-2"><strong>Capacity:</strong> <?= htmlspecialchars($section['capacity']) ?></div>
            </div>
            <hr>

            <!-- Schedule table ----------------------------------------------------->
            <div class="table-responsive">
              <table class="table table-sm table-striped align-middle">
                <thead class="text-center text-muted">
                  <tr>
                    <th style="width:60px;">#</th>
                    <th>Subject&nbsp;Code</th>
                    <th>Description</th>
                    <th>Time</th>
                    <th>Teacher</th>
                    <th>Room</th>
                  </tr>
                </thead>
                <tbody>
                <?php if ($schedule->num_rows): ?>
                  <?php $i = 1; while ($row = $schedule->fetch_assoc()): ?>
                    <tr class="text-muted">
                      <td class="text-center"><?= $i++ ?></td>
                      <td><?= htmlspecialchars($row['subject_code']) ?></td>
                      <td><?= htmlspecialchars($row['description']) ?></td>
                      <td><?= htmlspecialchars($row['time']) ?></td>
                      <td><?= htmlspecialchars($row['teacher']) ?></td>
                      <td><?= htmlspecialchars($row['room']) ?></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                    <tr class="text-muted">
                      <td colspan="6" class="text-center fst-italic">No schedule entries yet.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
              </table>
            </div><!-- /table -->

          </div><!-- /card -->
        </div>
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.content -->
</div><!-- /.page wrapper -->
<?php include 'footer.php'; ?>
</body>
</html>
