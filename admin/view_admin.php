<?php 
include 'session_login.php'; 
include '../db_connection.php';

// Get user ID
$user_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch user data (Admin)
$data = [];
if ($user_id > 0 && $conn) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ? AND acc_type = 'admin'");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();

        if (!$data) {
            die("<div class='alert alert-warning p-3'>❌ No admin account found with this ID.</div>");
        }
    } else {
        die("<div class='alert alert-danger p-3'>❌ Database error: " . $conn->error . "</div>");
    }
} elseif (!$conn) {
    die("<div class='alert alert-danger p-3'>❌ DB connection error.</div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>AcadeSys Dashboard - View Admin</title>
<?php include 'header.php'; ?>
</head>
<body>
<div class="d-flex flex-row bg-light min-vh-100">
    <?php include 'navigation.php'; ?>

    <div class="content flex-grow-1">
        <?php include 'nav_top.php'; ?>

        <div class="container py-4">
            <form action="update_admin.php" method="POST" enctype="multipart/form-data">
                <div class="bg-white p-4 rounded-4 shadow-sm">

                    <h2 class="mb-3">View Admin Account</h2>
                    <p class="text-muted mb-4">Review all information before making changes.</p>
                    <hr>

                    <?php if (isset($_GET['status'])): ?>
                        <?php if ($_GET['status'] === 'success'): ?>
                            <div class="alert alert-success alert-dismissible fade show">✅ Updated admin account successfully!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php elseif ($_GET['status'] === 'error'): ?>
                            <div class="alert alert-danger alert-dismissible fade show">❌ Something went wrong. Please try again.
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php elseif ($_GET['status'] === 'password_changed'): ?>
                            <div class="alert alert-success alert-dismissible fade show">⚠️ Password changed!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <h4 class="mb-3"><strong>Account Information</strong></h4>
                    <div class="row g-3">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars((string)($data['user_id'] ?? '')) ?>">

                        <!-- Account Type -->
                        <div class="col-md-6">
                            <label class="form-label">Account Type</label>
                            <input type="text" class="form-control" value="Admin" disabled>
                        </div>

                        <!-- Username -->
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars((string)($data['username'] ?? '')) ?>" disabled>
                        </div>

                        <!-- Email -->
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars((string)($data['email'] ?? '')) ?>" required>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars((string)($data['first_name'] ?? '')) ?>" required>
                        </div>

                        <!-- Last Name -->
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars((string)($data['last_name'] ?? '')) ?>" required>
                        </div>

                        <!-- Phone Number -->
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" value="<?= htmlspecialchars((string)($data['phone_number'] ?? '')) ?>">
                        </div>

                        <!-- Address -->
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars((string)($data['address'] ?? '')) ?></textarea>
                        </div>

                        <!-- Profile Picture -->
                        <div class="col-md-6">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile" class="form-control">
                        </div>

                        <!-- Action Buttons -->
                        <div class="col-12 text-start pt-3">
                            <button type="submit" class="btn btn-danger me-2">Save Admin</button>
                            <a href="admin.php?nav_drop=true" class="btn btn-secondary me-2">Back</a>
                            <a href="change_password_admin.php?id=<?= urlencode($data['user_id']) ?>&nav_drop=true" class="btn btn-secondary">Change Password</a>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
