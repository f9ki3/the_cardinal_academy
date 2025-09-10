<?php

// Kunin user info
$user_id = $_SESSION['user_id'];

$query = "SELECT 
            CONCAT(first_name, ' ', last_name) AS fullname, 
            email, 
            gender, 
            phone_number, 
            profile 
          FROM users 
          WHERE user_id = ?";

$stmt = $conn->prepare($query);

if (!$stmt) {
    die("SQL Error: " . $conn->error . " | Query: " . $query);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
?>

<div class="col-12 col-md-12 p-4 bg-white rounded rounded-4">

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="postTitle" class="form-label">First name</label>
                <input type="text" class="form-control" id="postTitle" name="title" placeholder="Enter post title" required>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="videoLink" class="form-label">Last name</label>
                <input type="text" class="form-control" id="videoLink" name="video_link" placeholder="Enter last name">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="birthdate" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address </label>
        <textarea class="form-control" id="address" name="address" rows="5" placeholder="Write your address here."></textarea>
    </div>

    <input type="hidden" name="teacher_id" value="<?php echo isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : 0; ?>">

    <div class="mt-3">
        <button type="submit" class="btn btn-outline-danger rounded-4 px-4">
            <i class="bi bi-check-circle me-2"></i> Save Profile
        </button>
        <!-- Trigger Modal -->
        <button type="button" class="btn btn-outline-danger rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
            Change Password
        </button>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="change_password.php" method="POST">
                <div class="modal-body">
                    <div class="mb-3 position-relative">
                        <label for="newPassword" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" data-target="newPassword" style="cursor: pointer;"></i>
                    </div>
                    <div class="mb-3 position-relative">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" data-target="confirmPassword" style="cursor: pointer;"></i>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-4">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Toggle show/hide password
document.querySelectorAll('.toggle-password').forEach(icon => {
    icon.addEventListener('click', function () {
        const input = document.getElementById(this.getAttribute('data-target'));
        if (input.type === "password") {
            input.type = "text";
            this.classList.remove("bi-eye-slash");
            this.classList.add("bi-eye");
        } else {
            input.type = "password";
            this.classList.remove("bi-eye");
            this.classList.add("bi-eye-slash");
        }
    });
});
</script>
