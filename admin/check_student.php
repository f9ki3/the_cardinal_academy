<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admission_id = intval($_POST['admission_id'] ?? 0);

    // Fetch admission data from admission_old
    $query = "SELECT * FROM admission_old WHERE id = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die("SQL prepare() failed (admission_old): " . $conn->error);
    }
    $stmt->bind_param("i", $admission_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admission_data = $result->fetch_assoc();
    $stmt->close();

    if (!$admission_data) {
        echo "<div class='alert alert-danger'>No admission record found.</div>";
        exit;
    }

    // Match column names from admission_old
    $student_id  = trim($admission_data['student_id']);   
    $first_name  = trim($admission_data['first_name']);   
    $last_name   = trim($admission_data['last_name']);    

    // Search in student_information table
    $sql = "SELECT * FROM student_information 
            WHERE student_number = ? 
               OR firstname LIKE ? 
               OR lastname LIKE ?
            LIMIT 10";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("SQL prepare() failed (student_information): " . $conn->error);
    }

    $like_first = "%{$first_name}%";
    $like_last  = "%{$last_name}%";

    $stmt->bind_param("sss", $student_id, $like_first, $like_last);
    $stmt->execute();
    $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>AcadeSys Dashboard</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container py-4">
        
        <div class="row">
            <div class="col-12 col-md-8">
                <h3>Check Student Result</h3>
                <p>Admission: <?= htmlspecialchars($first_name . " " . $last_name) ?> (ID: <?= htmlspecialchars($student_id) ?>)</p>
            </div>
            <div class="col-12 col-md-4">
                <a href="view_enrollement_old.php?id=<?= $admission_id; ?>" 
                    class="btn mb-4 text-muted border rounded rounded-4 mt-3">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student Number</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Grade Level</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="pt-4 pb-4"><?= htmlspecialchars($row['student_number']) ?></td>
                            <td class="pt-4 pb-4"><?= htmlspecialchars($row['lastname']) ?></td>
                            <td class="pt-4 pb-4"><?= htmlspecialchars($row['firstname']) ?></td>
                            <td class="pt-4 pb-4"><?= htmlspecialchars($row['middlename'] ?? 'N/A') ?></td>
                            <td class="pt-4 pb-4"><?= htmlspecialchars($row['grade_level'] ?? 'N/A') ?></td>
                            <td class="pt-4 pb-4"><?= htmlspecialchars($row['email'] ?? 'N/A') ?></td>
                            <td class="pt-4 pb-4">
                                <a href="payment_plan2.php?student_number=<?= urlencode($row['student_number']) ?>&grade=<?= htmlspecialchars($row['grade_level'] ?? 'N/A') ?>&id=<?= $admission_id; ?>" 
                                    class="btn border rounded rounded-4 text-muted">
                                    <i class="fas fa-user-graduate me-1"></i> Enroll
                                </a>
                                <a href="check_scholastic.php?id=<?= $admission_id ?>&student_number=<?= urlencode($row['student_number']) ?>" 
                                    class="btn border rounded rounded-4 text-muted">
                                    <i class="fas fa-book me-1"></i> Scholastic
                                </a>
                                <a href="billing2.php?school_year=&search=<?= urlencode($row['student_number']) ?>" 
                                    class="btn border rounded rounded-4 text-muted">
                                    <i class="fas fa-book me-1"></i> Tuition
                                </a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">No student found in student_information matching this admission record.</div>
        <?php endif; ?>
       
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
<?php
    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
