<?php include 'session_login.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Parent Dashboard - Demo</title>

<?php include 'header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
.student-card {
    border-radius: 1rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    background-color: #fff;
    padding: 1.5rem;
    margin-bottom: 2rem;
}
.student-card h5 {
    font-weight: 600;
}
.subject-table th, .subject-table td {
    vertical-align: middle;
}
</style>
</head>
<body class="bg-light">
<div class="d-flex">
    <?php include 'navigation.php'; ?>
    <div class="flex-grow-1">
        <?php include 'nav_top.php'; ?>

        <div class="container py-4">
            <h4 class="mb-4">Your Children (Demo)</h4>

            <!-- Hard-coded student 1 -->
            <div class="student-card">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Juan Dela Cruz</h5>
                        <p class="mb-1"><strong>Age:</strong> 15</p>
                        <p class="mb-1"><strong>Email:</strong> juan@example.com</p>
                        <p class="mb-1"><strong>Contact:</strong> 09123456789</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-1"><strong>Total Assignments:</strong> 12</p>
                        <p class="mb-1"><strong>Total Lessons:</strong> 30</p>
                        <p class="mb-1"><strong>Total Attendance:</strong> 28</p>
                    </div>
                </div>

                <h6>Subjects Overview</h6>
                <div class="table-responsive">
                    <table class="table table-bordered subject-table">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Lessons</th>
                                <th>Assignments</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mathematics</td>
                                <td>10</td>
                                <td>4</td>
                                <td>9</td>
                            </tr>
                            <tr>
                                <td>Science</td>
                                <td>8</td>
                                <td>3</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>English</td>
                                <td>12</td>
                                <td>5</td>
                                <td>11</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Hard-coded student 2 -->
            <div class="student-card">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5>Maria Santos</h5>
                        <p class="mb-1"><strong>Age:</strong> 13</p>
                        <p class="mb-1"><strong>Email:</strong> maria@example.com</p>
                        <p class="mb-1"><strong>Contact:</strong> 09987654321</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-1"><strong>Total Assignments:</strong> 8</p>
                        <p class="mb-1"><strong>Total Lessons:</strong> 25</p>
                        <p class="mb-1"><strong>Total Attendance:</strong> 24</p>
                    </div>
                </div>

                <h6>Subjects Overview</h6>
                <div class="table-responsive">
                    <table class="table table-bordered subject-table">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Lessons</th>
                                <th>Assignments</th>
                                <th>Attendance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Mathematics</td>
                                <td>9</td>
                                <td>3</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>Science</td>
                                <td>8</td>
                                <td>2</td>
                                <td>8</td>
                            </tr>
                            <tr>
                                <td>English</td>
                                <td>8</td>
                                <td>3</td>
                                <td>8</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
