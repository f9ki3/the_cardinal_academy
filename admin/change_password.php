<?php 
include 'session_login.php'; 
include '../db_connection.php';

// Validate user ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: tuition.php?status=error');
    exit;
}

$user_id = (int)$_GET['id'];

// Fetch user data
$user = null;
$error = '';
$success = '';

$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        header('Location: view_user.php?status=not_found');
        exit;
    }
    $stmt->close();
} else {
    die("❌ Failed to prepare user fetch statement.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password     = trim($_POST['new_password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if (strlen($new_password) < 6) {
        $error = "❌ Password must be at least 6 characters.";
    } elseif ($new_password !== $confirm_password) {
        $error = "❌ Passwords do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $update_stmt = $conn->prepare("UPDATE users SET password = ?, updated_at = CURRENT_TIMESTAMP WHERE user_id = ?");
        if ($update_stmt) {
            $update_stmt->bind_param("si", $hashed_password, $user_id);
            if ($update_stmt->execute()) {
                header("Location: view_user.php?id=$user_id&status=password_changed");
                exit;
            } else {
                $error = "❌ Failed to update password. MySQL Error: " . $update_stmt->error;
            }
            $update_stmt->close();
        } else {
            $error = "❌ Failed to prepare password update statement. MySQL Error: " . $conn->error;
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Change Password</title>
  <?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light">
  <?php include 'navigation.php'; ?>

  <div class="content flex-grow-1">
    <?php include 'nav_top.php'; ?>

    <div class="container my-4">
      <div class="row g-4 bg-white rounded mt-3 shadow-sm">
        <div class="col-12 col-md-6">
          <div class="p-4">
            <h4>Change Password</h4>

            <?php if (!empty($error)): ?>
              <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
            <?php elseif (!empty($success)): ?>
              <div class="alert alert-success mt-3"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>

            <form method="post" class="mt-3">
              <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required minlength="6" />
              </div>
              <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required />
              </div>
              <button type="submit" class="btn bg-main text-light">Save Password</button>
              <a href="view_user.php?id=<?= urlencode($user_id) ?>&nav_drop=true" class="btn btn-secondary ms-2">Cancel</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
