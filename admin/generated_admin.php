<?php include 'session_login.php'; ?>
<?php include '../db_connection.php'; ?>

<?php 
// Get email and password from URL
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';
$password = isset($_GET['password']) ? htmlspecialchars($_GET['password']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Account Created</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container py-4">
        <div class="card mt-5 shadow-sm border-0 rounded-3 mx-auto" style="max-width: 500px;">
            <div class="card-body p-4">
                <h3 class="card-title text-success mb-3">
                    <i class="bi text-center bi-check-circle-fill"></i> Admin Account Created!
                </h3>
                <p class="text-muted mb-4">The account has been successfully created. You can copy the credentials below:</p>

                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="emailField" value="<?php echo $email; ?>" readonly>
                        <button class="btn border" type="button" onclick="copyToClipboard('emailField')">
                            <i class="bi bi-clipboard"></i> Copy
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Password</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="passwordField" value="<?php echo $password; ?>" readonly>
                        <button class="btn border" type="button" onclick="copyToClipboard('passwordField')">
                            <i class="bi bi-clipboard"></i> Copy
                        </button>
                    </div>
                </div>

                <a href="parents.php" class="btn btn-danger btn-lg w-100">
                    <i class="bi bi-arrow-left-circle"></i> Back to Parent List
                </a>
            </div>
        </div>

        <script>
        function copyToClipboard(fieldId) {
            const copyText = document.getElementById(fieldId);
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            navigator.clipboard.writeText(copyText.value).then(() => {
                alert('Copied to clipboard: ' + copyText.value);
            });
        }
        </script>

    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
