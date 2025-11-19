<div class="rounded" id="stream" role="tabpanel" aria-labelledby="stream-tab">
    <?php
        // Assuming session and $conn (database connection) are already established
        $user_id = $_SESSION['user_id'];

        // Prepare the SQL statement using the correct column names from the users table
        $stmt = $conn->prepare("SELECT first_name, last_name, acc_type, email FROM users WHERE user_id = ?");

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $full_name = htmlspecialchars($user['first_name'] . ' ' . $user['last_name']);
            $email = htmlspecialchars($user['email']);
        } else {
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
                <button onclick="window.print()" class="btn btn-danger rounded-4">
                    Print Grades
                </button>
            </div>
        </div>
    </div>

    <?php
        if (isset($_GET['status']) && isset($_GET['message'])) {
            $status = htmlspecialchars($_GET['status']);

            if ($status === '0') {
                $alert_class = 'alert-success';
                $message_1 = 'Account is joined the class';
            } elseif ($status === '1') {
                $alert_class = 'alert-warning';
                $message_1 = 'Account is already joined the class';
            } else {
                $alert_class = 'alert-danger';
                $message_1 = 'Error occurred';
            }

            echo "<div class='alert {$alert_class} mt-3 alert-dismissible fade show' role='alert'>";
            echo $message_1;
            echo "<button type='button' class='btn-close' data-bs-dismiss='alert'></button>";
            echo "</div>";
        }
    ?>

    <h5 class="fw-bold mt-5 mb-3">Grades</h5>

    <?php
        $course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $result = null;

        if ($course_id > 0) {
            // Fetch students + grades from course_students table
            $stmt = $conn->prepare("
                SELECT 
                    u.user_id, u.first_name, u.last_name, u.email, u.phone_number, 
                    u.profile, u.gender,
                    cs.q1, cs.q2, cs.q3, cs.q4
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
        <div class="list-group-item bg-white fw-bold">
            <div class="row">
                <div class="col-md-3">Student</div>
                <div class="col-md-2 text-center">Q1</div>
                <div class="col-md-2 text-center">Q2</div>
                <div class="col-md-2 text-center">Q3</div>
                <div class="col-md-2 text-center">Q4</div>
            </div>
        </div>

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
                                class="rounded-circle me-3" width="50" height="50">
                            <p class="mb-0 fs-6">
                                <?= htmlspecialchars($student['first_name'] . ' ' . $student['last_name']) ?>
                            </p>
                        </div>

                        <!-- REAL GRADES FROM DB -->
                        <div class="col-md-2 text-center fs-6"><?= htmlspecialchars($student['q1']) ?></div>
                        <div class="col-md-2 text-center fs-6"><?= htmlspecialchars($student['q2']) ?></div>
                        <div class="col-md-2 text-center fs-6"><?= htmlspecialchars($student['q3']) ?></div>
                        <div class="col-md-2 text-center fs-6"><?= htmlspecialchars($student['q4']) ?></div>

                    </div>
                </div>

            <?php endwhile; ?>

        <?php else: ?>
            <div class="list-group-item d-flex align-items-center text-secondary fs-5 py-4">
                <i class="bi bi-person-x me-3 fs-3 text-muted"></i>
                <span>No students enrolled in this course.</span>
            </div>
        <?php endif; ?>
    </div>
</div>
