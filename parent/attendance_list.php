<?php
// ✅ Set timezone (optional but recommended)
date_default_timezone_set('Asia/Manila');

// ✅ Get the logged-in parent's user_id from session
$parent_id = $_SESSION['user_id'];

// ✅ Prepare SQL to fetch attendance records linked to this parent
$query = "
    SELECT date, time_in, rfid, first_name, last_name
    FROM attendance
    WHERE parent_id = ?
    ORDER BY date DESC, time_in DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $parent_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">

    <div class="container">
        <h3 class="mb-4 text-center">Attendance Records</h3>

        <table class="table table-striped table-bordered shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>RFID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['date']) ?></td>
                            <td><?= date('h:i A', strtotime($row['time_in'])) ?></td>
                            <td><?= htmlspecialchars($row['rfid']) ?></td>
                            <td><?= htmlspecialchars($row['first_name']) ?></td>
                            <td><?= htmlspecialchars($row['last_name']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">No attendance records found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
