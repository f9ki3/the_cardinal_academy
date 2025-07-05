<?php
include 'session_login.php';
include '../db_connection.php';

$section_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$male_stmt = $conn->prepare("SELECT firstname, lastname FROM master_list WHERE section_id = ? AND gender = 'Male' ORDER BY lastname ASC");
$male_stmt->bind_param("i", $section_id);
$male_stmt->execute();
$male_result = $male_stmt->get_result();

$female_stmt = $conn->prepare("SELECT firstname, lastname FROM master_list WHERE section_id = ? AND gender = 'Female' ORDER BY lastname ASC");
$female_stmt->bind_param("i", $section_id);
$female_stmt->execute();
$female_result = $female_stmt->get_result();



$students_result = $conn->query("
    SELECT user_id,
           first_name,
           last_name,
           gender,
           CONCAT(first_name, ' ', last_name) AS full_name
    FROM   users
    WHERE  acc_type = 'student'
    ORDER  BY full_name ASC
");

/* ── 1. Validate & fetch ─────────────────────────────────────────── */
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys - Manage Teachers</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row ">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
  <div class="row g-4">
    <div class="col-12">
      <div class="rounded p-4 bg-white">

        <!-- Section Info -->
        <div class="mb-4 mt-4">
        <div class="row align-items-center mb-4">
            
            <div class="col-12 col-md-4 mb-2 mb-md-0">
                <h4 class="mb-0 d-print-none">Class Masterlist</h4>
            </div>

            <div class="col-12 col-md-8 d-flex flex-wrap gap-2 justify-content-md-end d-print-none">

                <a href="view_section.php?id=<?= $sectionId ?>&nav_drop=true" class="btn btn-sm btn-danger text-light border rounded rounded-4">
                  <i class="bi bi-calendar2-week me-1"></i> Class Masterlist
                </a>
                <a href="class_schedule.php?id=<?= $sectionId ?>&nav_drop=true" class="btn btn-sm border text-muted rounded rounded-4">
                  <i class="bi bi-calendar2-week me-1"></i> Class Schedule
                </a>

                <button data-bs-toggle="modal" data-bs-target="#addstudent" class="btn btn-sm border text-muted rounded rounded-4">
                <i class="bi bi-plus me-1"></i> Add Student to list
                </button>

                <!-- Print Button -->
                <button class="btn btn-sm border text-muted rounded rounded-4" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Print
                </button>

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
               <h3>Class Masterlist</h3>
              </div>

            </div>
            <!-- Modal -->
            <div class="modal fade" id="addstudent" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addStudentLabel">Add Student to List</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="add_student_to_list.php" method="POST">
                            <div class="modal-body">
                            <!-- Search / select -->
                             <input type="text" value="<?= htmlspecialchars($sectionId) ?>" name="section_id" hidden>
                            <div class="mb-3">
                                <label for="studentInput" class="form-label">Select or Search Student</label>
                                <input  class="form-control"
                                        list="studentDatalist"
                                        id="studentInput"
                                        placeholder="Type a student name…"
                                        autocomplete="off"
                                        required>
                                <datalist id="studentDatalist">
                                <?php while ($row = $students_result->fetch_assoc()): ?>
                                    <option value="<?= htmlspecialchars($row['full_name']) ?>"
                                            data-id="<?= $row['user_id'] ?>"
                                            data-first="<?= htmlspecialchars($row['first_name']) ?>"
                                            data-last="<?= htmlspecialchars($row['last_name']) ?>"
                                            data-gender="<?= htmlspecialchars($row['gender']) ?>">
                                    </option>
                                <?php endwhile; ?>
                                </datalist>
                            </div>

                            <!-- Auto-filled fields -->
                            <div class="row g-2">
                                <div class="col-md-6 mb-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="first_name" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="last_name" disabled>
                                </div>
                                <div class="col-md-12 mb-3">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" id="gender" name="gender" disabled>
                                </div>
                            </div>

                            <!-- hidden ID -->
                            <input type="hidden" id="studentId" name="student_id">
                            </div>

                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Student</button>
                            </div>
                        </form>

                        </div>
                    </div>
                    </div>

                    <script>
                    document.addEventListener('DOMContentLoaded', () => {
                    const input   = document.getElementById('studentInput');
                    const list    = document.getElementById('studentDatalist');
                    const fName   = document.getElementById('firstName');
                    const lName   = document.getElementById('lastName');
                    const gender  = document.getElementById('gender');
                    const studId  = document.getElementById('studentId');

                    input.addEventListener('input', () => {
                        const option = Array.from(list.options).find(o => o.value === input.value);
                        if (option) {
                        fName.value  = option.dataset.first;
                        lName.value  = option.dataset.last;
                        gender.value = option.dataset.gender;
                        studId.value = option.dataset.id;
                        } else {            // clear if no exact match
                        fName.value = lName.value = gender.value = studId.value = '';
                        }
                    });
                    });
                    </script>

        <hr>
        <div style="font-size:12px;">
  <div class="row">
    <!-- Row 1 -->
    <div class="col-md-4 mb-2"><strong>Adviser:</strong> <?= htmlspecialchars($section['adviser'] ?? 'N/A') ?></div>
    <div class="col-md-4 mb-2"><strong>Section Name:</strong> <?= htmlspecialchars($section['section_name']) ?></div>
    <div class="col-md-4 mb-2"><strong>Grade Level:</strong> <?= htmlspecialchars($section['grade_level']) ?></div>
     <?php if ($section['strand'] !== 'N/A'): ?>
        <div class="col-md-4"><strong>Strand:</strong> <?= htmlspecialchars($section['strand']) ?></div>
    <?php endif; ?>

    <!-- Row 2 -->
    <div class="col-md-4 mb-2"><strong>School Year:</strong> <?= htmlspecialchars($section['school_year']) ?></div>
    <div class="col-md-2 mb-2"><strong>Room:</strong> <?= htmlspecialchars($section['room'] ?: '—') ?></div>
    <div class="col-md-2 mb-2"><strong>Capacity:</strong> <?= htmlspecialchars($section['capacity']) ?></div>
  </div>
  <hr>
</div>

<!-- Student Lists -->
<div class="row text-muted" style="font-size:12px;">
  <!-- Male Students -->
  <div class="col-md-6 mb-4">
    <h5 class="mb-3">Male Students</h5>
    <table class="table table-sm table-striped align-middle">
      <thead class="text-center">
        <tr class="text-muted">
          <th style="width: 60px;">#</th>
          <th>Name</th>
          <th class="d-print-none">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $counter = 1;
        if ($male_result->num_rows > 0):
          while ($row = $male_result->fetch_assoc()):
        ?>
          <tr class="text-muted">
            <td class="text-center"><?= $counter++ ?></td>
            <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?></td>
            <td class="text-center">
              <div class="d-flex justify-content-center">
                <form method="POST" action="remove_student_from_list.php" class="d-inline">
                  <input type="hidden" name="section_id" value="<?= $sectionId ?>">
                  <input type="hidden" name="firstname" value="<?= htmlspecialchars($row['firstname']) ?>">
                  <input type="hidden" name="lastname" value="<?= htmlspecialchars($row['lastname']) ?>">
                  <input type="hidden" name="gender" value="Male">
                  <button type="submit" class="btn d-print-none btn-sm rounded border rounded-4">Remove</button>
                </form>
              </div>
            </td>
          </tr>
        <?php
          endwhile;
        else:
        ?>
          <tr class="text-muted">
            <td colspan="3" class="text-center fst-italic">No male students found.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Female Students -->
  <div class="col-md-6 mb-4">
    <h5 class="mb-3">Female Students</h5>
    <table class="table table-sm table-striped align-middle">
      <thead class="text-center">
        <tr class="text-muted">
          <th style="width: 60px;">#</th>
          <th>Name</th>
          <th class="d-print-none">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $counter = 1;
        if ($female_result->num_rows > 0):
          while ($row = $female_result->fetch_assoc()):
        ?>
          <tr class="text-muted">
            <td class="text-center"><?= $counter++ ?></td>
            <td><?= htmlspecialchars($row['firstname'] . ' ' . $row['lastname']) ?></td>
            <td class="text-center">
              <div class="d-flex justify-content-center">
                <form method="POST" action="remove_student_from_list.php" class="d-inline">
                  <input type="hidden" name="section_id" value="<?= $sectionId ?>">
                  <input type="hidden" name="firstname" value="<?= htmlspecialchars($row['firstname']) ?>">
                  <input type="hidden" name="lastname" value="<?= htmlspecialchars($row['lastname']) ?>">
                  <input type="hidden" name="gender" value="Female">
                  <button type="submit" class="btn d-print-none btn-sm rounded border rounded-4">Remove</button>
                </form>
              </div>
            </td>
          </tr>
        <?php
          endwhile;
        else:
        ?>
          <tr class="text-muted">
            <td colspan="3" class="text-center fst-italic">No female students found.</td>
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

<?php include 'footer.php'; ?>
</body>
</html>
