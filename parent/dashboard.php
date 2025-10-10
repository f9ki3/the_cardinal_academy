<?php include 'session_login.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Parent Dashboard | Student Overview</title>

<?php include 'header.php'; ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<style>
    .bg-accent-blue {
        background-color: #e8f2ff !important; /* soft light blue */
    }
</style>

</head>
<body>
<div class="d-flex">
    <?php include 'navigation.php'; ?>
    <div class="flex-grow-1">
        <?php include 'nav_top.php'; ?>

        <div class="container py-5">
            <!-- Student Card -->
            <div class="p-4 rounded-4 mb-4 position-relative">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Student Info -->
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <h4 class="fw-bold mb-3"><i class="fa-solid fa-graduation-cap me-2"></i>Juan Dela Cruz</h4>
                            <div class="row g-3">
                                <div class="col-md-4 col-6">
                                    <div class=" text-md-start">
                                        <span class="fw-semibold text-muted d-block">ID/Ref:</span>
                                        <span>#JDC-9876</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class=" text-md-start">
                                        <span class="fw-semibold text-muted d-block">Birthday:</span>
                                        <span>January 15, 2010</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class=" text-md-start">
                                        <span class="fw-semibold text-muted d-block">Gender:</span>
                                        <span>Male</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class=" text-md-start">
                                        <span class="fw-semibold text-muted d-block">Phone:</span>
                                        <span>0912-345-6789</span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <div class=" text-md-start">
                                        <span class="fw-semibold text-muted d-block">Email:</span>
                                        <span>juan.delacruz@email.com</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Overall Progress -->
                        <div class="col-lg-6 d-flex flex-column align-items-start align-items-lg-end">
    <div class="d-flex w-100 justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold text-secondary mb-0">Overall Progress</h6>
        <button class="btn btn-sm btn-outline-danger">
            <i class="bi bi-trash"></i> Delete
        </button>
    </div>

    <div class="row w-100 g-2 mt-2 justify-content-center justify-content-lg-end">
        <div class="col-4">
            <div class="text-center p-3 bg-accent-blue text-primary rounded w-100">
                <div class="fs-2 fw-bold">5</div>
                <div class="small">Assignments</div>
            </div>
        </div>
        <div class="col-4">
            <div class="text-center p-3 bg-accent-blue text-primary rounded w-100">
                <div class="fs-2 fw-bold">20</div>
                <div class="small">Lessons</div>
            </div>
        </div>
        <div class="col-4">
            <div class="text-center p-3 bg-accent-blue text-primary rounded w-100">
                <div class="fs-2 fw-bold">25</div>
                <div class="small">Attendance</div>
            </div>
        </div>
    </div>
</div>


                    </div>


                    <hr class="my-4">

                    <h6 class="fw-bold text-secondary mb-3"><i class="fa-solid fa-chart-line me-2"></i>Subjects Overview</h6>
                    <div class="table-responsive">
                        <table class="table table-striped mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-start">Subject</th>
                                    <th class="text-center">Lessons</th>
                                    <th class="text-center">Assignments Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-start fw-semibold text-secondary">Mathematics</td>
                                    <td class="text-center text-secondary">10</td>
                                    <td>
                                        <div class="mb-1 small fw-semibold text-secondary text-center">4 / 5 Submitted (80%)</div>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 80%;"></div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteStudent(studentId) {
    if (confirm("Are you sure you want to remove this student from your dashboard? This action cannot be undone.")) {
        window.location.href = `delete_student.php?id=${studentId}`;
    }
}
</script>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
