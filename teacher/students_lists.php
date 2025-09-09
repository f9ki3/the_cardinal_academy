<div class="rounded" id="stream" role="tabpanel" aria-labelledby="stream-tab">
    <?php
        // Assuming session and $conn (database connection) are already established
        $user_id = $_SESSION['user_id'];

        // Prepare the SQL statement using the correct column names from the users table
        $stmt = $conn->prepare("SELECT first_name, last_name, acc_type, email FROM users WHERE user_id = ?");

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        // 'i' for integer, which is the type of user_id
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();

        // Check if a user was found
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $full_name = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
            $role = htmlspecialchars($user['acc_type']);
            $email = htmlspecialchars($user['email']);
        } else {
            // Handle the case where the user ID is not found in the database
            die("Error: User not found.");
        }

        $stmt->close();
        ?>

        <div class="rounded-4 p-4 text-white" style="
            background-image: url('../static/images/Front gate.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            min-height: 150px;
        ">
            <div style="
                position: absolute;
                top: 0; left: 0; right: 0; bottom: 0;
                background-color: rgba(0,0,0,0.5);
                border-radius: 1rem;
            "></div>

            <div class="row position-relative" style="z-index: 1;">
                <div class="col-12 col-md-10">
                    <h1 class="fw-bolder"><?= $full_name ?></h1>
                    <p class="mb-0"><?= $email ?></p>
                </div>
                <div class="col-12 col-md-2 d-flex align-items-center justify-content-md-end mt-2 mt-md-0">
                    <button data-bs-toggle="modal" data-bs-target="#createStudentModal" class="btn btn-danger rounded-4">Join Student</button>
                </div>
            </div>
        </div>
        <?php
        if (isset($_GET['status']) && isset($_GET['message'])) {
            $status = htmlspecialchars($_GET['status']);
            $message = htmlspecialchars($_GET['message']);

            // Alert type based on status
            if ($status === '0') {
                $alert_class = 'alert-success'; // all added
            } elseif ($status === '1') {
                $alert_class = 'alert-warning'; // already exists
            } else {
                $alert_class = 'alert-danger'; // error
            }

            echo "<div class='alert {$alert_class} mt-3 alert-dismissible fade show' role='alert'>";
            echo $message;
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }
        ?>


    <h5 class="fw-bold mt-5 mb-3">Students</h5>
    <?php
        $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $result = null; // Initialize $result to avoid warnings if no course ID is provided

        if ($course_id > 0) {
            // Fetch students joined to this course
            $stmt = $conn->prepare("
                SELECT u.user_id, u.first_name, u.last_name, u.email, u.phone_number, u.profile, u.gender
                FROM course_students cs
                INNER JOIN users u ON cs.student_id = u.user_id
                WHERE cs.course_id = ?
            ");

            if ($stmt) {
                $stmt->bind_param("i", $course_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();
            }
        }
    ?>

    <div class="list-group">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($student = $result->fetch_assoc()): ?>
                <?php 
                    $profile = trim($student['profile']);
                    $profilePath = !empty($profile) ? '../static/uploads/' . $profile : '../static/uploads/dummy.jpg';
                ?>
                <div class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-md-3 d-flex align-items-center">
                            <img src="<?= htmlspecialchars($profilePath) ?>" 
                                alt="<?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?>" 
                                class="rounded-circle me-3" width="60" height="60">
                            <p class="mb-0 fs-6"><?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?></p>
                        </div>

                        <div class="col-md-3">
                            <p class="mb-0 fs-6"><?= htmlspecialchars($student['email']) ?></p>
                        </div>

                        <div class="col-md-3">
                            <p class="mb-0 fs-6"><?= htmlspecialchars($student['phone_number']) ?></p>
                        </div>

                        <div class="col-md-2">
                            <p class="mb-0 fs-6 text-capitalize"><?= htmlspecialchars($student['gender']) ?></p>
                        </div>

                        <div class="col-md-1 text-end">
                            <button class="btn btn-sm d-flex align-items-center" onclick="deleteStudent(<?= $student['user_id'] ?>)">
                                <i class="bi bi-trash me-1"></i> 
                            </button>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="list-group-item text-muted fs-5">No students enrolled in this course.</div>
        <?php endif; ?>
    </div>

    <?php
    if ($conn && $conn->ping()) {
        $conn->close();
    }
    ?>

    <script>
    function deleteStudent(studentId) {
        if(confirm('Are you sure you want to remove this student?')) {
            fetch('delete_student.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ course_id: <?= $course_id ?>, student_id: studentId })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) location.reload();
                else alert('Failed to remove student.');
            });
        }
    }
    </script>
</div>
<?php include 'join_student_modal.php'?>