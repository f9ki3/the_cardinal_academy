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
body {
    background-color: #F7F7F7;
    color: #333;
    font-family: 'Segoe UI', sans-serif;
}
.record-section {
    background-color: #FFFFFF;
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
}
.is-invalid {
    border-color: #dc3545 !important;
}
.invalid-feedback {
    display: none;
    color: #dc3545;
    font-size: 0.85rem;
}
input.is-invalid ~ .invalid-feedback,
textarea.is-invalid ~ .invalid-feedback {
    display: block;
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

            <form id="medicalForm" action="create_medical.php" method="POST" class="row g-3 needs-validation" novalidate>
                <input type="hidden" name="medical_id" value="<?php echo uniqid('med_'); ?>">

                <div class="col-md-4">
                    <label for="studentID" class="form-label">Student ID</label>
                    <input type="text" name="student_id" class="form-control" id="studentID" 
                           value="<?php echo htmlspecialchars($student_id); ?>" readonly>
                </div>

                <!-- Height -->
                <div class="col-md-4">
                    <label for="height" class="form-label">Height (cm)</label>
                    <input type="number" name="height" class="form-control" id="height" min="50" max="250" required>
                    <small class="text-muted">e.g., 160</small>
                    <div class="invalid-feedback">Please enter a valid height between 50 and 250 cm.</div>
                </div>

                <!-- Weight -->
                <div class="col-md-4">
                    <label for="weight" class="form-label">Weight (kg)</label>
                    <input type="number" name="weight" class="form-control" id="weight" min="10" max="200" required>
                    <small class="text-muted">e.g., 55</small>
                    <div class="invalid-feedback">Please enter a valid weight between 10 and 200 kg.</div>
                </div>

                <!-- Blood Pressure -->
                <div class="col-md-4">
                    <label for="bloodPressure" class="form-label">Blood Pressure</label>
                    <input type="text" name="blood_pressure" class="form-control" id="bloodPressure" 
                           placeholder="e.g., 110/70" pattern="^\d{2,3}\/\d{2,3}$" required>
                    <small class="text-muted">e.g., 110/70</small>
                    <div class="invalid-feedback">Format must be like 120/80.</div>
                </div>

                <!-- Temperature -->
                <div class="col-md-4">
                    <label for="temperature" class="form-label">Temperature (°C)</label>
                    <input type="number" step="0.1" name="temperature" class="form-control" id="temperature" min="35" max="42" required>
                    <small class="text-muted">e.g., 36.6</small>
                    <div class="invalid-feedback">Temperature must be between 35°C and 42°C.</div>
                </div>

                <!-- Pulse -->
                <div class="col-md-4">
                    <label for="pulse" class="form-label">Pulse (bpm)</label>
                    <input type="number" name="pulse" class="form-control" id="pulse" min="40" max="200" required>
                    <small class="text-muted">e.g., 72</small>
                    <div class="invalid-feedback">Enter a pulse rate between 40 and 200 bpm.</div>
                </div>

                <!-- Respiration -->
                <div class="col-md-4">
                    <label for="respiration" class="form-label">Respiration (breaths/min)</label>
                    <input type="number" name="respiration" class="form-control" id="respiration" min="10" max="40" required>
                    <small class="text-muted">e.g., 18</small>
                    <div class="invalid-feedback">Respiration must be between 10 and 40.</div>
                </div>

                <!-- Textarea and other text fields -->
                <?php
                $textFields = [
                    'allergies' => 'Known allergies (e.g., peanuts, pollen)',
                    'medications' => 'Current medications (e.g., supplements)',
                    'conditions' => 'Chronic illnesses / conditions (e.g., asthma)',
                    'recentIllness' => 'Recent illnesses / injuries (past 6 months)',
                    'hospitalizations' => 'Hospitalizations / surgeries',
                    'vision' => 'Vision problems (e.g., uses glasses)',
                    'hearing' => 'Hearing problems (e.g., partial loss)',
                    'dental' => 'Dental issues (e.g., braces)',
                    'activity' => 'Physical activity (hours/week)',
                    'sleep' => 'Sleep (hours/night)',
                    'diet' => 'Dietary habits / restrictions',
                    'mentalHealth' => 'Mental health concerns',
                    'notes' => 'Additional notes / concerns',
                    'generalNote' => 'General note'
                ];
                ?>

                <?php foreach ($textFields as $id => $label): ?>
                    <div class="col-md-4">
                        <label for="<?= $id ?>" class="form-label"><?= $label ?></label>
                        <?php if (in_array($id, ['conditions', 'recentIllness', 'hospitalizations', 'mentalHealth', 'notes', 'generalNote'])): ?>
                            <textarea name="<?= $id ?>" id="<?= $id ?>" class="form-control" rows="2" required></textarea>
                        <?php else: ?>
                            <input type="text" name="<?= $id ?>" id="<?= $id ?>" class="form-control" required>
                        <?php endif; ?>
                        <div class="invalid-feedback">This field cannot be empty.</div>
                    </div>
                <?php endforeach; ?>

                <!-- Submit -->
                <div class="col-12 mt-3">
                    <button type="submit" class="btn btn-danger rounded-4">Submit Survey</button>
                    <a href="view_student_medical.php?student_id=<?php echo $student_id ?>" class="btn btn-outline-danger rounded-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script>
// Realtime field validation
document.querySelectorAll('#medicalForm input, #medicalForm textarea').forEach(field => {
    field.addEventListener('input', () => {
        if (field.checkValidity()) {
            field.classList.remove('is-invalid');
        } else {
            field.classList.add('is-invalid');
        }
    });
});

// Prevent submit if invalid
document.getElementById('medicalForm').addEventListener('submit', function(e) {
    let valid = true;
    this.querySelectorAll('input, textarea').forEach(field => {
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
