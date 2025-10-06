<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Medical Records</title>
<?php include 'header.php'; ?>
<style>
/* Overall background and text */
body {
    background-color: #F7F7F7; /* soft off-white */
    color: #333; /* smooth dark text */
    font-family: 'Segoe UI', sans-serif;
}

/* Container cards */
.record-card, .record-section {
    background-color: #FFFFFF; /* pure white card */
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08); /* subtle shadow */
}


/* Individual items */
.record-item {
    margin-bottom: 1rem;
}
.record-item label {
    display: block;
    font-weight: 600;
    font-size: 0.875rem;
    color: #6C757D; /* muted gray for labels */
}
.record-item .data {
    font-size: 0.95rem;
    font-weight: 500;
    color: #2C3E50; /* smooth dark for data */
}


/* Table styling */
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
    background-color: #F1F3F6; /* soft header */
}
.table-striped tbody tr:nth-of-type(odd) {
    background-color: #FAFAFA; /* subtle stripe */
}
.table th {
    font-weight: 600;
    color: #2C3E50;
}


/* Responsive spacing for columns */
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
                <h5 class="fw-bolder mb-3">Student Medical Survey</h5>

                <form class="row g-3">
                    <!-- Health Measurements -->
                    <div class="col-md-4">
                        <label for="height" class="form-label">Height (cm)</label>
                        <input type="number" class="form-control" id="height" min="50" max="250" required>
                        <small class="text-muted">e.g., 160</small>
                    </div>
                    <div class="col-md-4">
                        <label for="weight" class="form-label">Weight (kg)</label>
                        <input type="number" class="form-control" id="weight" min="10" max="200" required>
                        <small class="text-muted">e.g., 55</small>
                    </div>
                    <div class="col-md-4">
                        <label for="bloodPressure" class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" id="bloodPressure" placeholder="e.g., 110/70" required>
                        <small class="text-muted">e.g., 110/70</small>
                    </div>
                    <div class="col-md-4">
                        <label for="temperature" class="form-label">Temperature (°C)</label>
                        <input type="number" step="0.1" class="form-control" id="temperature" min="35" max="42" required>
                        <small class="text-muted">e.g., 36.6</small>
                    </div>
                    <div class="col-md-4">
                        <label for="pulse" class="form-label">Pulse (bpm)</label>
                        <input type="number" class="form-control" id="pulse" min="40" max="200" required>
                        <small class="text-muted">e.g., 72</small>
                    </div>
                    <div class="col-md-4">
                        <label for="respiration" class="form-label">Respiration (breaths/min)</label>
                        <input type="number" class="form-control" id="respiration" min="10" max="40" required>
                        <small class="text-muted">e.g., 18</small>
                    </div>

                    <!-- Allergies & Medications -->
                    <div class="col-md-4">
                        <label class="form-label">Known allergies</label>
                        <input type="text" class="form-control" id="allergies" required>
                        <small class="text-muted">e.g., peanuts, pollen</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Current medications</label>
                        <input type="text" class="form-control" id="medications" required>
                        <small class="text-muted">e.g., vitamin supplements</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Chronic illnesses / conditions</label>
                        <textarea class="form-control" id="conditions" rows="2" required></textarea>
                        <small class="text-muted">e.g., asthma, diabetes</small>
                    </div>

                    <!-- Illnesses & Injuries -->
                    <div class="col-md-6">
                        <label class="form-label">Recent illnesses / injuries (past 6 months)</label>
                        <textarea class="form-control" id="recentIllness" rows="2" required></textarea>
                        <small class="text-muted">e.g., flu, broken arm</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Hospitalizations / surgeries</label>
                        <textarea class="form-control" id="hospitalizations" rows="2" required></textarea>
                        <small class="text-muted">e.g., appendix removal, tonsil surgery</small>
                    </div>

                    <!-- Vision & Hearing -->
                    <div class="col-md-4">
                        <label class="form-label">Vision problems</label>
                        <input type="text" class="form-control" id="vision" required>
                        <small class="text-muted">e.g., nearsighted, uses glasses</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Hearing problems</label>
                        <input type="text" class="form-control" id="hearing" required>
                        <small class="text-muted">e.g., partial hearing loss</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dental issues</label>
                        <input type="text" class="form-control" id="dental" required>
                        <small class="text-muted">e.g., braces, cavities</small>
                    </div>

                    <!-- Lifestyle -->
                    <div class="col-md-4">
                        <label class="form-label">Physical activity (hours/week)</label>
                        <input type="number" class="form-control" id="activity" min="0" max="40" required>
                        <small class="text-muted">e.g., 5</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Sleep (hours/night)</label>
                        <input type="number" class="form-control" id="sleep" min="0" max="16" required>
                        <small class="text-muted">e.g., 8</small>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Dietary habits / restrictions</label>
                        <input type="text" class="form-control" id="diet" required>
                        <small class="text-muted">e.g., vegetarian, gluten-free</small>
                    </div>

                    <!-- Mental Health & Concerns -->
                    <div class="col-md-6">
                        <label class="form-label">Mental health concerns</label>
                        <textarea class="form-control" id="mentalHealth" rows="2" required></textarea>
                        <small class="text-muted">e.g., anxiety, ADHD</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Additional notes / concerns</label>
                        <textarea class="form-control" id="notes" rows="2" required></textarea>
                        <small class="text-muted">Any other concerns</small>
                    </div>

                    <!-- General Note -->
                    <div class="col-12">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" id="generalNote" rows="3" placeholder="Any other general remarks" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-danger rounded-4">Submit Survey</button>
                        <a href="view_student_medical.php?student_id=<?php echo $student_id?>" class="btn btn-outline-danger rounded-4">Cancel</a>
                    </div>
                </form>
            </div>
        </div>


    </div>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
