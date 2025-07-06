<?php
include 'session_login.php';
include '../db_connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AcadeSys – Section Not Found</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-white">
  <?php include 'navigation.php'; ?>
  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>
    <div class="container my-4">
      <div class="row g-4">
        <div class="col-12">
          <div class="rounded p-5 text-center border shadow-sm">
            <img src="../static/images/email.svg" class="w-25" alt="">
            <h2 class="mb-3 mt-5">Certificate of registration emailed successfully.</h2>
            <p class="text-muted">Please wait to add schedule to view the certificate of registration.</p>
            <a href="cor_issuance.php" class="btn btn-danger rounded rounded-4 mt-3">Go Back</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
