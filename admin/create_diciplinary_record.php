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
.record-card, .record-section { background-color: #FFF; border-radius: 1rem; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 4px 10px rgba(0,0,0,0.08);}
.record-item { margin-bottom: 1rem; }
.record-item label { display:block; font-weight:600; font-size:0.875rem; color:#6C757D;}
.text-danger { font-size:0.85rem; margin-top:0.25rem; }
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

<form id="disciplinaryForm" action="create_diciplinary.php" method="POST" class="row g-3" novalidate>
    <div class="col-md-6 record-item">
        <label>Student ID</label>
        <input type="text" class="form-control" name="student_id" value="<?= htmlspecialchars($student_id) ?>" readonly>
        <div class="text-danger" id="studentIDError"></div>
    </div>

    <div class="col-md-6 record-item">
        <label>Date of Incident</label>
        <input type="date" class="form-control" name="incident_date" id="incidentDate" value="<?= $today ?>" required>
        <div class="text-danger" id="incidentDateError">Select the date of incident (default today).</div>
    </div>

    <div class="col-md-12 record-item">
        <label>Location of Incident</label>
        <input type="text" class="form-control" name="incident_location" id="incidentLocation" placeholder="Ex: Classroom 101, School Grounds" required>
        <div class="text-danger" id="incidentLocationError">Please provide the location.</div>
    </div>

    <div class="col-12 record-item">
        <label>Description of Incident</label>
        <textarea class="form-control" name="incident_description" id="incidentDescription" rows="3" placeholder="Briefly describe what happened..." required></textarea>
        <div class="text-danger" id="incidentDescriptionError">Description is required.</div>
    </div>

    <div class="col-md-6 record-item">
        <label>Type of Violation</label>
        <select class="form-select" name="violation_type" id="violationType" required>
            <option value="">Select (Ex: Tardiness)</option>
            <option value="Tardiness">Tardiness</option>
            <option value="Disrespect">Disrespect</option>
            <option value="Bullying">Bullying</option>
            <option value="Cheating">Cheating</option>
            <option value="Property Damage">Property Damage</option>
            <option value="Other">Other</option>
        </select>
        <div class="text-danger" id="violationTypeError">Select a violation type.</div>
    </div>

    <div class="col-md-6 record-item">
        <label>Recommended Disciplinary Action</label>
        <select class="form-select" name="disciplinary_action" id="disciplinaryAction" required>
            <option value="">Select (Ex: Warning)</option>
            <option value="Warning">Warning</option>
            <option value="Detention">Detention</option>
            <option value="Suspension">Suspension</option>
            <option value="Parent Conference">Parent Conference</option>
            <option value="Other">Other</option>
        </select>
        <div class="text-danger" id="disciplinaryActionError">Select a disciplinary action.</div>
    </div>

    <div class="col-12 record-item">
        <label>Witnesses</label>
        <textarea class="form-control" name="witnesses" id="witnesses" rows="2" placeholder="List names of witnesses if any..." required></textarea>
        <div class="text-danger" id="witnessesError">Provide at least one witness or N/A.</div>
    </div>

    <div class="col-12 record-item">
        <label>Additional Remarks</label>
        <textarea class="form-control" name="remarks" id="remarks" rows="3" placeholder="Any additional information or notes..." required></textarea>
        <div class="text-danger" id="remarksError">Remarks are required.</div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-danger rounded-4">Submit Report</button>
        <a href="view_student_disciplinary.php?student_id=<?= $student_id ?>" class="btn btn-outline-danger rounded-4">Cancel</a>
    </div>
</form>
</div>
</div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('disciplinaryForm');

    const fields = [
        {id: 'incidentDate', message: 'Please select a valid date.'},
        {id: 'incidentLocation', message: 'Location is required.'},
        {id: 'incidentDescription', message: 'Description is required.'},
        {id: 'violationType', message: 'Select a violation type.'},
        {id: 'disciplinaryAction', message: 'Select a disciplinary action.'},
        {id: 'witnesses', message: 'Witnesses field is required.'},
        {id: 'remarks', message: 'Remarks field is required.'}
    ];

    fields.forEach(f => {
        const el = document.getElementById(f.id);
        const errorEl = document.getElementById(f.id + 'Error');

        el.addEventListener('input', () => {
            if (el.value.trim() === '' || (el.tagName === 'SELECT' && el.value === '')) {
                errorEl.textContent = f.message;
            } else {
                errorEl.textContent = '';
            }
        });

        if (el.tagName === 'SELECT') {
            el.addEventListener('change', () => {
                if (el.value === '') errorEl.textContent = f.message;
                else errorEl.textContent = '';
            });
        }
    });

    form.addEventListener('submit', (e) => {
        let valid = true;
        fields.forEach(f => {
            const el = document.getElementById(f.id);
            const errorEl = document.getElementById(f.id + 'Error');
            if (el.value.trim() === '' || (el.tagName === 'SELECT' && el.value === '')) {
                errorEl.textContent = f.message;
                valid = false;
            }
        });
        if (!valid) e.preventDefault();
    });
});
</script>

<?php include 'footer.php'; ?>
</body>
</html>
