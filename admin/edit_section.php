<?php 
include 'session_login.php'; 
include '../db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: sectioning.php?status=error');
    exit;
}

$id = (int)$_GET['id'];

// Fetch existing section
$stmt = $conn->prepare("SELECT * FROM sections WHERE section_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: sectioning.php?status=error');
    exit;
}

$row = $result->fetch_assoc();

// Fetch teachers
$teachers_result = mysqli_query($conn, "SELECT user_id, CONCAT(first_name, ' ', last_name) AS full_name FROM users WHERE acc_type = 'teacher'");
if (!$teachers_result) {
    die("Error fetching teachers: " . mysqli_error($conn));
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $section_name = trim($_POST['section_name']);
    $grade_level = trim($_POST['grade_level']);
    $strand = trim($_POST['strand'] ?? 'N/A');
    $teacher_id = intval($_POST['teacher_id']);
    $room = trim($_POST['room']);
    $capacity = intval($_POST['capacity']);
    $school_year = trim($_POST['school_year']);

    if ($section_name === '' || $grade_level === '' || $teacher_id <= 0 || $capacity <= 0) {
        $error = "Please fill in all required fields correctly.";
    } else {
        $update_stmt = $conn->prepare("UPDATE sections SET section_name = ?, grade_level = ?, strand = ?, teacher_id = ?, room = ?, capacity = ?, school_year = ? WHERE section_id = ?");
        $update_stmt->bind_param("sssisssi", $section_name, $grade_level, $strand, $teacher_id, $room, $capacity, $school_year, $id);

        if ($update_stmt->execute()) {
            header('Location: sectioning.php?status=updated&nav_drop=true');
            exit;
        } else {
            $error = "Failed to update section.";
        }
    }
}

// Helper
function isSelected($value, $selected) {
    return $value === $selected ? 'selected' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit Section</title>
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
              <h4>Edit Section - <?= htmlspecialchars($row['section_name']) ?></h4>

              <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
              <?php endif; ?>

              <form method="post" class="mt-3" style="max-width: 600px;">
                <div class="mb-3">
                  <label for="section_name" class="form-label">Section Name</label>
                  <input type="text" id="section_name" name="section_name" class="form-control" required value="<?= htmlspecialchars($row['section_name']) ?>" />
                </div>

                <div class="mb-3">
                  <label for="strand" class="form-label">Strand</label>
                  <select name="strand" id="strand" class="form-select" required>
                    <option value="">Select strand</option>
                    <?php
                      $strands = [
                        'N/A',
                        'GAS (General Academic Strand)',
                        'HUMMS (Humanities and Social Sciences)',
                        'STEM (Science, Technology, Engineering and Mathematics)',
                        'ABM (Accountancy, Business and Management)',
                        'TVL (Technical-Vocational-Livelihood)',
                        'SPORTS',
                        'ARTS and DESIGN'
                      ];

                      $current_strand = $row['strand'] ?? 'N/A';

                      foreach ($strands as $strand) {
                          $selected = ($strand === $current_strand) ? 'selected' : '';
                          echo "<option value=\"" . htmlspecialchars($strand) . "\" $selected>" . htmlspecialchars($strand) . "</option>";
                      }
                    ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="grade_level" class="form-label">Grade Level</label>
                  <select name="grade_level" id="grade_level" class="form-select" required>
                    <option value="">Select grade level</option>
                    <?php
                    $grades = [
                      "Nursery", "Kinder Garten", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6",
                      "Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12"
                    ];
                    foreach ($grades as $grade) {
                        echo '<option value="' . $grade . '" ' . isSelected($grade, $row['grade_level']) . '>' . $grade . '</option>';
                    }
                    ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="teacher_id" class="form-label">Advisory Class</label>
                  <select name="teacher_id" id="teacher_id" class="form-select" required>
                    <option value="">Select teacher</option>
                    <?php
                    // Re-run the query result pointer since we fetched before already
                    mysqli_data_seek($teachers_result, 0);
                    while ($teacher = mysqli_fetch_assoc($teachers_result)): ?>
                      <option value="<?= $teacher['user_id'] ?>" <?= $teacher['user_id'] == $row['teacher_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($teacher['full_name']) ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="room" class="form-label">Room</label>
                  <input type="text" id="room" name="room" class="form-control" value="<?= htmlspecialchars($row['room']) ?>" />
                </div>

                <div class="mb-3">
                  <label for="capacity" class="form-label">Capacity</label>
                  <input type="number" id="capacity" name="capacity" class="form-control" required min="1" value="<?= htmlspecialchars($row['capacity']) ?>" />
                </div>

                <div class="mb-3">
                  <label for="school_year" class="form-label">School Year</label>
                  <input type="text" id="school_year" name="school_year" class="form-control" required value="<?= htmlspecialchars($row['school_year']) ?>" />
                </div>

                <button type="submit" class="btn bg-main text-light">Update</button>
                <a href="sectioning.php?nav_drop=true" class="btn btn-secondary ms-2">Cancel</a>
              </form>

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
