<?php 
include 'session_login.php'; 
include '../db_connection.php';

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

    // Basic validation
    if ($section_name === '' || $grade_level === '' || $teacher_id <= 0 || $capacity <= 0) {
        $error = "Please fill in all required fields correctly.";
    } else {
        $stmt = $conn->prepare("INSERT INTO sections (section_name, grade_level, strand, teacher_id, room, capacity, school_year) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssisis", $section_name, $grade_level, $strand, $teacher_id, $room, $capacity, $school_year);

        if ($stmt->execute()) {
            header('Location: sectioning.php?status=created&nav_drop=true');
            exit;
        } else {
            $error = "Failed to create section. " . $stmt->error;
        }
    }
}

$selected_grade = $_POST['grade_level'] ?? '';
$selected_strand = $_POST['strand'] ?? '';
function isSelected($value, $selected) {
    return $value === $selected ? 'selected' : '';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Create New Section</title>
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
              <h4>Create New Section</h4>

              <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
              <?php endif; ?>

              <form method="post" class="mt-3" style="max-width: 600px;">
                <div class="mb-3">
                  <label for="section_name" class="form-label">Section Name</label>
                  <input type="text" id="section_name" name="section_name" class="form-control" required value="<?= htmlspecialchars($_POST['section_name'] ?? '') ?>" />
                </div>

               <div class="mb-3">
                  <label for="strand" class="form-label">Strand</label>
                  <select name="strand" id="strand" class="form-select" required>
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
                      foreach ($strands as $strand_option) {
                          echo "<option value=\"" . htmlspecialchars($strand_option) . "\" " . isSelected($strand_option, $selected_strand) . ">" . htmlspecialchars($strand_option) . "</option>";
                      }
                    ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="grade_level" class="form-label">Grade Level</label>
                  <select name="grade_level" id="grade_level" class="form-select" required>
                    <option value="">Select grade level</option>
                    <?php
                      $grades = ["Nursery", "Kinder", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6", "Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12"];
                      foreach ($grades as $grade) {
                          echo "<option value=\"$grade\" " . isSelected($grade, $selected_grade) . ">$grade</option>";
                      }
                    ?>
                  </select>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function () {
                  const strandSelect = document.getElementById('strand');
                  const gradeLevelSelect = document.getElementById('grade_level');

                  function filterGradeOptions() {
                    const selectedStrand = strandSelect.value;
                    const options = gradeLevelSelect.querySelectorAll('option');

                    if (selectedStrand === 'N/A') {
                      // Show all options except Grade 11 and Grade 12
                      options.forEach(option => {
                        if (option.value === 'Grade 11' || option.value === 'Grade 12') {
                          option.style.display = 'none';
                          // If currently selected option is hidden, reset select
                          if (gradeLevelSelect.value === option.value) {
                            gradeLevelSelect.value = '';
                          }
                        } else {
                          option.style.display = '';
                        }
                      });
                    } else {
                      // Show only Grade 11 and Grade 12, hide others (except the empty "Select grade level")
                      options.forEach(option => {
                        if (option.value === '' || option.value === 'Grade 11' || option.value === 'Grade 12') {
                          option.style.display = '';
                        } else {
                          option.style.display = 'none';
                          // If currently selected option is hidden, reset select
                          if (gradeLevelSelect.value === option.value) {
                            gradeLevelSelect.value = '';
                          }
                        }
                      });

                      // If no grade selected or grade selected is hidden, auto-select Grade 11
                      if (gradeLevelSelect.value !== 'Grade 11' && gradeLevelSelect.value !== 'Grade 12') {
                        gradeLevelSelect.value = 'Grade 11';
                      }
                    }
                  }

                  // Run on page load
                  filterGradeOptions();

                  // Run when strand changes
                  strandSelect.addEventListener('change', filterGradeOptions);
                });
                </script>


                <div class="mb-3">
                  <label for="teacher_id" class="form-label">Advisory Class</label>
                  <select name="teacher_id" id="teacher_id" class="form-select" required>
                    <option value="">Select teacher</option>
                    <?php while ($row = mysqli_fetch_assoc($teachers_result)): ?>
                      <option value="<?= $row['user_id'] ?>" <?= (isset($_POST['teacher_id']) && $_POST['teacher_id'] == $row['user_id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($row['full_name']) ?>
                      </option>
                    <?php endwhile; ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label for="room" class="form-label">Room</label>
                  <input type="text" id="room" name="room" class="form-control" value="<?= htmlspecialchars($_POST['room'] ?? '') ?>" />
                </div>

                <div class="mb-3">
                  <label for="capacity" class="form-label">Capacity</label>
                  <input type="number" id="capacity" name="capacity" class="form-control" required min="1" value="<?= htmlspecialchars($_POST['capacity'] ?? '') ?>" />
                </div>

                <?php
                  $currentYear = date('Y');
                  $nextYear = $currentYear + 1;
                  $defaultSchoolYear = "$currentYear-$nextYear";
                  ?>

                  <div class="mb-3">
                    <label for="school_year" class="form-label">School Year</label>
                    <input type="text" id="school_year" name="school_year" class="form-control" required value="<?= htmlspecialchars($_POST['school_year'] ?? $defaultSchoolYear) ?>" />
                  </div>


                <button type="submit" class="btn bg-main text-light">Create</button>
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
