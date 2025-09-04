<?php 
include 'session_login.php'; 
include '../db_connection.php';

$student_id = isset($_GET['student_number']) ? trim($_GET['student_number']) : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_number = trim($_POST['student_number']);
    $school = trim($_POST['school']);
    $district = trim($_POST['district']);
    $division = trim($_POST['division']);
    $region = trim($_POST['region']);
    $school_id = trim($_POST['school_id']);
    $classified_grade = trim($_POST['classified_grade']);
    $section = trim($_POST['section']);
    $school_year = trim($_POST['school_year']);
    $adviser_name = trim($_POST['adviser_name']); // <-- changed
    $general_average = floatval($_POST['general_average']);
    $scholastic_json = $_POST['scholastic_json'] ?? '[]';

    // Validate required fields
    if ($school===''||$district===''||$division===''||$region===''||$school_id===''||
        $classified_grade===''||$section===''||$school_year===''||$adviser_name==='') {
        $error = "Please fill in all required fields.";
    } else {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO scholastic_records 
            (student_number, school, district, division, region, school_id, classified_grade, section, school_year, adviser_name, general_average, scholastic_json) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssssds", 
            $student_number, $school, $district, $division, $region, $school_id, $classified_grade, $section, $school_year, $adviser_name, $general_average, $scholastic_json
        );

        if ($stmt->execute()) {
            // Option 1: Using double quotes for variable interpolation
            header("Location: scholastic.php?status=created&student_number=$student_id");
            exit;

            // Option 2: Using concatenation
            // header('Location: scholastic.php?status=created&student_number=' . urlencode($student_id));
            // exit;
        } else {
            $error = "Failed to save record. " . $stmt->error;
        }

    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Create Scholastic Record</title>
<?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row">
<?php include 'navigation.php'; ?>
<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container my-4">
  <div class="rounded p-3 bg-white">
    <h4>Create Scholastic Record</h4>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" id="mainForm">
      <input type="hidden" name="scholastic_json" id="scholastic_json">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Student Number</label>
          <input type="text" name="student_number" class="form-control" required value="<?= htmlspecialchars($student_id) ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">School ID</label>
          <input type="text" name="school_id" class="form-control" required value="<?= htmlspecialchars($_POST['school_id'] ?? '') ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">School</label>
          <input type="text" name="school" class="form-control" required value="<?= htmlspecialchars($_POST['school'] ?? '') ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">District</label>
          <input type="text" name="district" class="form-control" required value="<?= htmlspecialchars($_POST['district'] ?? '') ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">Division</label>
          <input type="text" name="division" class="form-control" required value="<?= htmlspecialchars($_POST['division'] ?? '') ?>">
        </div>
        <div class="col-md-4">
          <label class="form-label">Region</label>
          <input type="text" name="region" class="form-control" required value="<?= htmlspecialchars($_POST['region'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">School Year</label>
          <?php $defaultSchoolYear = date('Y').'-'.(date('Y')+1); ?>
          <input type="text" name="school_year" class="form-control" required value="<?= htmlspecialchars($_POST['school_year'] ?? $defaultSchoolYear) ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Classified Grade</label>
          <input type="text" name="classified_grade" class="form-control" required value="<?= htmlspecialchars($_POST['classified_grade'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Section</label>
          <input type="text" name="section" class="form-control" required value="<?= htmlspecialchars($_POST['section'] ?? '') ?>">
        </div>
        <div class="col-md-3">
          <label class="form-label">Adviser</label>
          <input type="text" name="adviser_name" class="form-control" required value="<?= htmlspecialchars($_POST['adviser_name'] ?? '') ?>">
        </div>


        <!-- Scholastic Table -->
        <div class="col-12">
          <div class="d-flex mb-3 justify-content-between">
            <label class="form-label">Scholastic Record</label>
            <button type="button" class="btn border" data-bs-toggle="modal" data-bs-target="#addRecordModal">+ Add Record</button>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered text-center align-middle" id="recordTable">
              <thead class="table-light">
                <tr>
                  <th>Subject</th><th>Q1</th><th>Q2</th><th>Q3</th><th>Q4</th><th>Final</th><th>Remarks</th><th>Action</th>
                </tr>
              </thead>
              <tbody id="recordTableBody"></tbody>
            </table>
          </div>
        </div>

        <div class="col-md-6">
          <label class="form-label">General Average</label>
          <input type="number" step="0.01" name="general_average" class="form-control" required value="<?= htmlspecialchars($_POST['general_average'] ?? '') ?>">
        </div>
      </div>

      <div class="mt-4">
        <button type="submit" class="btn bg-main text-light">Save Record</button>
        <a href="scholastic.php" class="btn btn-outline-danger ms-2">Cancel</a>
      </div>
    </form>
  </div>
</div>
</div>

<!-- Add Record Modal -->
<div class="modal fade" id="addRecordModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Scholastic Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <form id="addRecordForm">
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-12"><label>Subject</label><input type="text" name="subject" class="form-control" required></div>
            <div class="col-md-3"><label>Q1</label><input type="number" name="q1" class="form-control" required></div>
            <div class="col-md-3"><label>Q2</label><input type="number" name="q2" class="form-control" required></div>
            <div class="col-md-3"><label>Q3</label><input type="number" name="q3" class="form-control" required></div>
            <div class="col-md-3"><label>Q4</label><input type="number" name="q4" class="form-control" required></div>
            <div class="col-md-6"><label>Final Rating</label><input type="number" name="final" class="form-control" required></div>
            <div class="col-md-6"><label>Remarks</label>
              <select name="remarks" class="form-select" required>
                <option value="Passed">Passed</option>
                <option value="Failed">Failed</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Add Record</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
const addRecordForm = document.getElementById("addRecordForm");
const recordTableBody = document.getElementById("recordTableBody");
const mainForm = document.getElementById("mainForm");

// Add row
addRecordForm.addEventListener("submit", function(e){
  e.preventDefault();
  const f = new FormData(addRecordForm);
  const tr = document.createElement("tr");
  tr.innerHTML = `
    <td>${f.get("subject")}</td>
    <td>${f.get("q1")}</td>
    <td>${f.get("q2")}</td>
    <td>${f.get("q3")}</td>
    <td>${f.get("q4")}</td>
    <td>${f.get("final")}</td>
    <td>${f.get("remarks")}</td>
    <td><button type="button" class="btn btn-sm removeRow"><i class="bi bi-trash"></i></button></td>
  `;
  recordTableBody.appendChild(tr);
  addRecordForm.reset();
  bootstrap.Modal.getInstance(document.getElementById("addRecordModal")).hide();
});

// Remove row
recordTableBody.addEventListener("click", function(e){
  const btn = e.target.closest(".removeRow");
  if(btn) btn.closest("tr").remove();
});


// Serialize to JSON on submit
mainForm.addEventListener("submit", function(){
  const rows = recordTableBody.querySelectorAll("tr");
  const data = Array.from(rows).map(row=>{
    const c = row.querySelectorAll("td");
    return {
      subject: c[0].innerText,
      q1: parseFloat(c[1].innerText),
      q2: parseFloat(c[2].innerText),
      q3: parseFloat(c[3].innerText),
      q4: parseFloat(c[4].innerText),
      final_rating: parseFloat(c[5].innerText),
      remarks: c[6].innerText
    };
  });
  document.getElementById("scholastic_json").value = JSON.stringify(data);
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>
