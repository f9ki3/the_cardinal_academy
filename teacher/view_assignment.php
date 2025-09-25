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
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 150px;
    }
    .attachment-box i {
      font-size: 36px;
      color: #0d6efd;
      margin-bottom: 10px;
    }
    .attachment-box a {
      text-decoration: none;
      font-weight: 500;
      word-break: break-word;
      text-align: center;
    }
    /* Make left and right columns equal height */
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
        $stmt->bind_param("i", $assignment_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $assignment = $result->fetch_assoc();
      ?>

      <?php if ($assignment): ?>
        <div class="assignment-card">
          <div class="assignment-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="fw-bold"><?= htmlspecialchars($assignment['title']) ?></h5>
                    <p class="assignment-meta">
                    Posted on <?= date("F j, Y g:i A", strtotime($assignment['created_at'])) ?> 
                    </p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="assignment.php?id=<?= $assignment['course_id'] ?>" class="btn rounded-4 btn-outline-danger me-2">Back</a>
                    <a class="btn rounded-4 btn-outline-danger me-2">Delete</a>
                    <a href="submit_assignment.php?id=<?= $assignment['assignment_id'] ?>" class="btn rounded-4 btn-danger">Open Assignment</a>
                </div>
            </div>
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
                  <p><?= $assignment['points'] ?></p>
                </div>
              </div>

              <div class="mb-3">
                <h6 class="fw-semibold">Instructions</h6>
                <p><?= nl2br(htmlspecialchars($assignment['instructions'])) ?></p>
              </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-4 d-flex">

              <h6 class="fw-semibold">Attachment</h6>
              <?php if (!empty($assignment['attachment'])): ?>
                <div class="attachment-box w-100">
                  <i class="fas fa-paperclip"></i>
                  <a href="../uploads/<?= $assignment['attachment'] ?>" target="_blank"><?= $assignment['attachment'] ?></a>
                </div>
                <?php else: ?>
                    <div class="attachment-box w-100 text-center text-muted d-flex flex-column align-items-center justify-content-center">
                    <i style="opacity: 50%;" class="fas text-muted fa-times-circle fa-2x mb-2"></i>
                    <span>No attachment</span>
                    </div>
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
