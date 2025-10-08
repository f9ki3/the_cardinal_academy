<?php 
include 'session_login.php'; 
include '../db_connection.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>View Assignment</title>
  <?php include 'header.php'; ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    .assignment-card {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.08);
      padding: 30px;
      background: #fff;
      margin-bottom: 20px;
    }
    .assignment-header {
      border-bottom: 2px solid #f0f0f0;
      margin-bottom: 20px;
      padding-bottom: 10px;
    }
    .assignment-meta {
      font-size: 14px;
      color: #666;
    }
    .attachment-box {
      background: #f8f9fa;
      border-radius: 8px;
      padding: 20px;
      display: flex;
      align-items: center;
      gap: 10px;
      min-height: 80px;
    }
    .attachment-box i {
      font-size: 36px;
      color: #0d6efd;
    }
    .attachment-box a {
      text-decoration: none;
      font-weight: 500;
      word-break: break-word;
    }
    .row-eq-height {
      display: flex;
      flex-wrap: wrap;
    }
    .row-eq-height > [class*='col-'] {
      display: flex;
      flex-direction: column;
    }
  </style>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">

      <?php
        $assignment_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $sql = "SELECT * FROM assignments WHERE assignment_id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $assignment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $assignment = $result->fetch_assoc();
      ?>

      <?php if ($assignment): ?>
        <!-- Assignment Details -->
        <div class="assignment-card">
          <div class="assignment-header">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h5 class="fw-bold"><?= htmlspecialchars($assignment['title']) ?></h5>
                <p class="assignment-meta">
                  Posted on <?= date("F j, Y g:i A", strtotime($assignment['created_at'])) ?>
                </p>
              </div>
              <div class="col-md-4 text-end d-flex justify-content-end align-items-center gap-2">
                <a href="assignment.php?id=<?= $assignment['course_id'] ?>" class="btn rounded-4 btn-outline-danger">Back</a>
                <a href="delete_assignment.php?id=<?= $assignment['assignment_id'] ?>&course_id=<?= $assignment['course_id'] ?>" 
                    class="btn rounded-4 btn-outline-danger"
                    onclick="return confirm('Are you sure you want to delete this assignment?');">
                    Delete
                    </a>

                <form action="update_assignment_status.php" method="POST" class="d-inline">
                  <input type="hidden" name="assignment_id" value="<?= $assignment['assignment_id'] ?>">
                  <?php if ($assignment['accept'] == 1): ?>
                    <input type="hidden" name="new_accept" value="0">
                    <button type="submit" class="btn rounded-4 btn-outline-danger"
                      onclick="return confirm('Are you sure you want to open this assignment?');">
                      Open Assignment
                    </button>
                  <?php else: ?>
                    <input type="hidden" name="new_accept" value="1">
                    <button type="submit" class="btn rounded-4 btn-outline-danger"
                      onclick="return confirm('Are you sure you want to close this assignment?');">
                      Close Assignment
                    </button>
                  <?php endif; ?>
                </form>
              </div>
            </div>
          </div>
          <div class="py-3">
            <?php 
                  if (isset($_GET['status'])) {
                      switch ($_GET['status']) {
                          case '3':
                              $alert_message2 = 'The status is updated.';
                              $alert_type = 'danger';
                              break;
                      }

                      if (isset($alert_message2) && isset($alert_type)) {
                          echo "
                          <div class='alert alert-$alert_type alert-dismissible fade show' role='alert'>
                              $alert_message2
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                          </div>";
                      }
                  }
                ?>
          </div>

          <div class="row row-eq-height">
            <!-- Left Column -->
            <div class="col-md-8 mb-3 mb-md-0">
              <div class="row mb-3">
                <div class="col-md-6">
                  <h6 class="fw-semibold">Due Date</h6>
                  <p><?= date("F j, Y", strtotime($assignment['due_date'])) ?> at <?= date("g:i A", strtotime($assignment['due_time'])) ?></p>
                </div>
                <div class="col-md-3">
                  <h6 class="fw-semibold">Points</h6>
                  <p><?= $assignment['points'] ?></p>
                </div>
                <div class="col-md-3">
                  <h6 class="fw-semibold">Status</h6>
                  <p><?= $assignment['accept'] == 0 ? 'Open' : 'Close' ?></p>
                </div>
              </div>

              <div class="mb-3">
                <h6 class="fw-semibold">Instructions</h6>
                <p><?= nl2br(htmlspecialchars($assignment['instructions'])) ?></p>
              </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4 d-flex flex-column">
              <h6 class="fw-semibold">Attachment</h6>
              <?php if (!empty($assignment['attachment'])): ?>
                <div class="attachment-box w-100">
                  <i style="opacity: 80%;" class="fas text-muted fa-paperclip"></i>
                  <a class="text-muted" href="../static/uploads/<?= htmlspecialchars($assignment['attachment']) ?>" target="_blank"><?= htmlspecialchars($assignment['attachment']) ?></a>
                </div>
              <?php else: ?>
                <div class="attachment-box w-100 text-muted">
                  <i style="opacity: 50%;" class="fas text-muted fa-times-circle fa-2x"></i>
                  <span>No attachment</span>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- Student Submissions -->
        <?php
          $submission_sql = "SELECT s.*, u.first_name, u.last_name, u.email
                             FROM assignment_submissions s
                             JOIN users u ON s.student_id = u.user_id
                             WHERE s.assignment_id = ?";

          $submission_stmt = $conn->prepare($submission_sql);
          if (!$submission_stmt) {
              die("Prepare failed: " . $conn->error);
          }

          $submission_stmt->bind_param("i", $assignment_id);
          $submission_stmt->execute();
          $submission_result = $submission_stmt->get_result();
        ?>

        <div class="assignment-card">
          <div class="assignment-header">
            <div class="row align-items-center">
              <div class="col-md-8">
                <h5 class="fw-bold">Student Submissions</h5>
                <p class="assignment-meta">
                  You can now view all students who submitted this assignment.
                </p>
              </div>
              <div class="py">
                <?php 
                  if (isset($_GET['status'])) {
                      switch ($_GET['status']) {
                          case '2':
                              $alert_message = 'The post has been removed.';
                              $alert_type = 'danger';
                              break;
                          case '1':
                              $alert_message = 'Grade and Feedback added.';
                              $alert_type = 'success'; // ✅ fixed: Bootstrap has 'success' not 'status'
                              break;
                      }

                      if (isset($alert_message) && isset($alert_type)) {
                          echo "
                          <div class='alert alert-$alert_type alert-dismissible fade show' role='alert'>
                              $alert_message
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                          </div>";
                      }
                  }
                ?>

              </div>

            </div>
          </div>
          <?php include 'view_submit.php'?>
          <div class="row row-eq-height">
            <div class="col-12">
              <?php if ($submission_result->num_rows > 0): ?>
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Student Name</th>
                      <th>Email</th>
                      <th>Submission Date</th>
                      <th>Grade</th>
                      <th>Feedback</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 1; while ($row = $submission_result->fetch_assoc()): ?>
                  <?php 
                    $attachments = !empty($row['file_path']) ? json_decode($row['file_path'], true) : []; // decode JSON array safely
                    $fileUrl = !empty($row['file_url']) ? $row['file_url'] : '';
                    ?>
                    <tr class="submission-row"
                        data-submission-id="<?= $row['submission_id'] ?>"
                        data-fullname="<?= htmlspecialchars(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? '')) ?>"
                        data-email="<?= htmlspecialchars($row['email'] ?? '') ?>"
                        data-submission_date="<?= !empty($row['submission_date']) ? date('Y-m-d H:i:s', strtotime($row['submission_date'])) : '' ?>"
                        data-grade="<?= htmlspecialchars($row['grade'] ?? '') ?>"
                        data-feedback="<?= htmlspecialchars($row['feedback'] ?? '') ?>"
                        data-file-path='<?= htmlspecialchars($row['file_path'] ?? '') ?>'
                        data-file-url="<?= htmlspecialchars($fileUrl ?? '') ?>"
                        data-max-points="<?= $assignment['points'] ?>"
                    >
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? '')) ?></td>
                        <td><?= htmlspecialchars($row['email'] ?? '') ?></td>
                        <td><?= !empty($row['submission_date']) ? date("F j, Y g:i A", strtotime($row['submission_date'])) : 'Not Submitted Yet' ?></td>
                        <td><?= !empty($row['grade']) ? htmlspecialchars($row['grade']) : 'Not Graded Yet' ?></td>
                        <td><?= !empty($row['feedback']) ? htmlspecialchars($row['feedback']) : 'No Feedback yet' ?></td>
                    </tr>


                    <?php endwhile; ?>


                    </tbody>
                </table>
              <?php else: ?>
               <div class="d-flex flex-column justify-content-center align-items-center py-4"><p class="text-center mt-5 text-muted mb-3">No student has submitted this assignment yet!</p><img src="../static/images/art7.svg" alt="No records" style="max-width:300px; opacity:70%"></div>
              <?php endif; ?>
            </div>
          </div>
        </div>

      <?php else: ?>
        <div class="alert alert-warning">Assignment not found.</div>
      <?php endif; ?>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
