<?php 
include 'session_login.php'; 
include '../db_connection.php'; 

$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Disciplinary Report</title>
<?php include 'header.php'; ?>
<style>
body {
    background-color: #F7F7F7;
    color: #333;
    font-family: 'Segoe UI', sans-serif;
}
.record-card, .record-section {
    background-color: #FFFFFF;
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
}
.record-item {
    margin-bottom: 1rem;
}
.record-item label {
    display: block;
    font-weight: 600;
    font-size: 0.875rem;
    color: #6C757D;
}
.record-item .data {
    font-size: 0.95rem;
    font-weight: 500;
    color: #2C3E50;
}
.table-responsive {
    margin-top: 1.5rem;
}
.table {
    background-color: #FFFFFF;
    color: #2C3E50;
    border-radius: 0.5rem;
    overflow: hidden;
}
.table th, .table td {
    vertical-align: middle;
    padding: 0.6rem 0.75rem;
}
.table thead {
    background-color: #F1F3F6;
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #FAFAFA;
}
.table th {
    font-weight: 600;
    color: #2C3E50;
}
.row > [class*='col-'] {
    margin-bottom: 1rem;
}
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

        <form class="row g-3">
            <div class="col-md-6">
                <label for="studentID" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentID" value="<?php echo htmlspecialchars($student_id); ?>" readonly>
            </div>

            <!-- Incident Details -->
            <div class="col-md-6">
                <label for="incidentDate" class="form-label">Date of Incident</label>
                <input type="date" class="form-control" id="incidentDate" required>
            </div>
            <div class="col-md-12">
                <label for="incidentLocation" class="form-label">Location of Incident</label>
                <input type="text" class="form-control" id="incidentLocation" required>
                <small class="text-muted">e.g., Classroom, Library</small>
            </div>
            <div class="col-12">
                <label for="incidentDescription" class="form-label">Description of Incident</label>
                <textarea class="form-control" id="incidentDescription" rows="3" required></textarea>
                <small class="text-muted">Provide detailed description of the behavior</small>
            </div>

            <!-- Violation Type -->
            <div class="col-md-6">
                <label for="violationType" class="form-label">Type of Violation</label>
                <select class="form-select" id="violationType" required>
                    <option value="">Select</option>
                    <option value="Tardiness">Tardiness</option>
                    <option value="Disrespect">Disrespect</option>
                    <option value="Bullying">Bullying</option>
                    <option value="Cheating">Cheating</option>
                    <option value="Property Damage">Property Damage</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="disciplinaryAction" class="form-label">Recommended Disciplinary Action</label>
                <select class="form-select" id="disciplinaryAction" required>
                    <option value="">Select</option>
                    <option value="Warning">Warning</option>
                    <option value="Detention">Detention</option>
                    <option value="Suspension">Suspension</option>
                    <option value="Parent Conference">Parent Conference</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Witnesses -->
            <div class="col-12">
                <label for="witnesses" class="form-label">Witnesses</label>
                <textarea class="form-control" id="witnesses" rows="2" required></textarea>
                <small class="text-muted">Names of witnesses, if any</small>
            </div>

            <!-- Remarks -->
            <div class="col-12">
                <label for="remarks" class="form-label">Additional Remarks</label>
                <textarea class="form-control" id="remarks" rows="3" required></textarea>
                <small class="text-muted">Other notes or comments</small>
            </div>

            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn-danger rounded-4">Submit Report</button>
                <a href="view_student_disciplinary.php?student_id=<?php echo $student_id?>" class="btn btn-outline-danger rounded-4">Cancel</a>
            </div>
        </form>
    </div>
</div>

</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
