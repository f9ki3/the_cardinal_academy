<?php 
include 'session_login.php'; 
include '../db_connection.php'; 

$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';
$today = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Disciplinary Report</title>
<?php include 'header.php'; ?>
<style>
body { background-color: #F7F7F7; color: #333; font-family: 'Segoe UI', sans-serif; }
.record-section { background-color: #FFF; border-radius: 1rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 4px 10px rgba(0,0,0,0.08);}
.is-invalid { border-color: #dc3545 !important; }
.invalid-feedback { display: none; color: #dc3545; font-size: 0.85rem; }
input.is-invalid ~ .invalid-feedback,
textarea.is-invalid ~ .invalid-feedback,
select.is-invalid ~ .invalid-feedback { display: block; }
</style>
</head>
<body>
<div class="d-flex flex-row">
<?php include 'navigation.php'; ?>
<div class="content flex-grow-1">
<?php include 'nav_top.php'; ?>

<div class="container pt-3">
<div class="record-section">
<h5 class="fw-bolder mb-3">Student Disciplinary Report</h5>

<form id="disciplinaryForm" action="create_diciplinary.php" method="POST" class="row g-3 needs-validation" novalidate>
    <input type="hidden" name="disciplinary_id" value="<?= uniqid('DISC-') ?>">

    <div class="col-md-6">
        <label class="form-label">Student ID</label>
        <input type="text" class="form-control" name="student_id" value="<?= htmlspecialchars($student_id) ?>" readonly>
    </div>

    <div class="col-md-6">
        <label class="form-label">Date of Incident</label>
        <input type="date" class="form-control" name="incident_date" id="incidentDate" value="<?= $today ?>" required>
        <div class="invalid-feedback">Please select a valid date (cannot be future).</div>
    </div>

    <div class="col-md-12">
        <label class="form-label">Location of Incident</label>
        <input type="text" class="form-control" name="incident_location" id="incidentLocation" placeholder="Ex: Classroom 101, School Grounds" required>
        <div class="invalid-feedback">Location is required.</div>
    </div>

    <div class="col-12">
        <label class="form-label">Description of Incident</label>
        <textarea class="form-control" name="incident_description" id="incidentDescription" rows="3" placeholder="Briefly describe what happened..." required></textarea>
        <div class="invalid-feedback">Description is required.</div>
    </div>

    <div class="col-md-6">
        <label class="form-label">Type of Violation</label>
        <select class="form-select" name="violation_type" id="violationType" required>
            <option value="">Select (Ex: Tardiness)</option>
            <option value="Tardiness">Tardiness</option>
            <option value="Disrespect">Disrespect</option>
            <option value="Bullying">Bullying</option>
            <option value="Cheating">Cheating</option>
            <option value="Property Damage">Property Damage</option>
            <option value="Other">Other</option>
        </select>
        <div class="invalid-feedback">Please select a violation type.</div>
    </div>

    <div class="col-md-6">
        <label class="form-label">Recommended Disciplinary Action</label>
        <select class="form-select" name="disciplinary_action" id="disciplinaryAction" required>
            <option value="">Select (Ex: Warning)</option>
            <option value="Warning">Warning</option>
            <option value="Detention">Detention</option>
            <option value="Suspension">Suspension</option>
            <option value="Parent Conference">Parent Conference</option>
            <option value="Other">Other</option>
        </select>
        <div class="invalid-feedback">Please select a disciplinary action.</div>
    </div>

    <div class="col-12">
        <label class="form-label">Witnesses</label>
        <textarea class="form-control" name="witnesses" id="witnesses" rows="2" placeholder="List witnesses or N/A" required></textarea>
        <div class="invalid-feedback">Provide at least one witness or N/A.</div>
    </div>

    <div class="col-12">
        <label class="form-label">Additional Remarks</label>
        <textarea class="form-control" name="remarks" id="remarks" rows="3" placeholder="Any additional information or notes..." required></textarea>
        <div class="invalid-feedback">Remarks are required.</div>
    </div>

    <div class="col-12 mt-3">
        <button type="submit" class="btn btn-danger rounded-4">Submit Report</button>
        <a href="view_student_diciplinary.php?student_id=<?= $student_id ?>" class="btn btn-outline-danger rounded-4">Cancel</a>
    </div>
</form>
</div>
</div>
</div>
</div>

<script>
// Realtime validation similar to medical survey
document.querySelectorAll('#disciplinaryForm input, #disciplinaryForm textarea, #disciplinaryForm select').forEach(field => {
    field.addEventListener('input', () => {
        if (field.checkValidity()) field.classList.remove('is-invalid');
        else field.classList.add('is-invalid');
    });
    field.addEventListener('change', () => {
        if (field.checkValidity()) field.classList.remove('is-invalid');
        else field.classList.add('is-invalid');
    });
});

document.getElementById('disciplinaryForm').addEventListener('submit', function(e) {
    let valid = true;
    this.querySelectorAll('input, textarea, select').forEach(field => {
        if (!field.checkValidity()) {
            field.classList.add('is-invalid');
            valid = false;
        }
    });
    if (!valid) e.preventDefault();
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>
