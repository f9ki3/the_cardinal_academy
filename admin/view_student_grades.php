<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php
$student_id = isset($_GET['student_id']) ? trim($_GET['student_id']) : '';

$data = [];
if ($student_id > 0) {
    $query = "SELECT * FROM student_information WHERE student_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Student Grades Records</title>
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

/* Section headings */
.record-section h5 {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    padding-bottom: 0.25rem;
    color: #2C3E50; /* deep but soft heading */
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

    
    <!-- Student Details -->
    <div class="record-section">
        <h5 class="fw-bolder">Student Details</h5>
        <div class="row">
            <div class="col-md-4 record-item">
                <label>Student Number</label>
                <div class="data"><?= htmlspecialchars($data['student_number'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Full Name</label>
                <div class="data"><?= htmlspecialchars($data['firstname'] . ' ' . $data['middlename'] . ' ' . $data['lastname'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Email</label>
                <div class="data"><?= htmlspecialchars($data['email'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Phone</label>
                <div class="data"><?= htmlspecialchars($data['phone'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Gender</label>
                <div class="data"><?= htmlspecialchars($data['gender'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Birth Date</label>
                <div class="data"><?= htmlspecialchars($data['birthday'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Age</label>
                <div class="data"><?= htmlspecialchars($data['age'] ?? '-') ?></div>
            </div>
            <div class="col-md-4 record-item">
                <label>Address</label>
                <div class="data"><?= htmlspecialchars($data['residential_address'] ?? '-') ?></div>
            </div>
        </div>
        <hr class="text-muted">
        <h5 class="fw-bolder mb-3">Student Grades</h5>

<table class="table table-sm align-middle">
    <thead class="table-light">
        <tr>
            <th>Subject</th>
            <th>Q1</th>
            <th>Q2</th>
            <th>Q3</th>
            <th>Q4</th>
            <th>Final Grade</th>
            <th>Average</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Mathematics</td>
            <td>92</td>
            <td>90</td>
            <td>93</td>
            <td>94</td>
            <td class="fw-bold">92.25</td>
            <td class="fw-bold">1.25</td>
        </tr>

        <tr>
            <td>Science</td>
            <td>89</td>
            <td>90</td>
            <td>88</td>
            <td>91</td>
            <td class="fw-bold">89.50</td>
            <td class="fw-bold">1.50</td>
        </tr>

        <tr>
            <td>English</td>
            <td>94</td>
            <td>95</td>
            <td>93</td>
            <td>96</td>
            <td class="fw-bold">94.50</td>
            <td class="fw-bold">1.00</td>
        </tr>

        <tr>
            <td>Filipino</td>
            <td>88</td>
            <td>87</td>
            <td>90</td>
            <td>89</td>
            <td class="fw-bold">88.50</td>
            <td class="fw-bold">1.75</td>
        </tr>

        <tr>
            <td>Araling Panlipunan</td>
            <td>91</td>
            <td>90</td>
            <td>92</td>
            <td>93</td>
            <td class="fw-bold">91.50</td>
            <td class="fw-bold">1.25</td>
        </tr>

        <tr>
            <td>MAPEH</td>
            <td>95</td>
            <td>96</td>
            <td>94</td>
            <td>97</td>
            <td class="fw-bold">95.50</td>
            <td class="fw-bold">1.00</td>
        </tr>

        <tr>
            <td>ESP</td>
            <td>93</td>
            <td>92</td>
            <td>94</td>
            <td>95</td>
            <td class="fw-bold">93.50</td>
            <td class="fw-bold">1.25</td>
        </tr>
    </tbody>
</table>

<!-- GWA -->
<div class="mt-2">
    <label class="fw-bold">General Weighted Average (GWA):</label>
    <span class="fw-bold fs-5">1.29</span>
</div>

    </div>
    

</div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
