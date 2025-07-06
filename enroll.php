<?php
  $hideHome = true;
  $pageTitle = 'Services';
  $breadcrumbs = [
  ['label' => 'Home', 'url' => 'index.php'],
  ['label' => 'Enroll']];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>The Cardinal Academy - Registration</title>
  <?php include 'header.php'; ?>
</head>

<?php include 'navigation.php'; ?>
<body class="bg-light">

<div class="container py-5">
  <div class="bg-white p-4 rounded-4 shadow-sm">
      <p class="text-center">Choose your child's upcoming grade level to proceed with the enrollment process. Click on the three image above. </p>

  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
