
<!-- Profile Update Form -->
<form action="update_profile.php" method="POST" enctype="multipart/form-data">
<div class="col-12 col-md-12 p-4 bg-white rounded-4">

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="firstName" class="form-label">First name</label>
                <input type="text" class="form-control" id="firstName" name="first_name"
                       value="<?php echo htmlspecialchars((string)($user['first_name'] ?? '')); ?>" required>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="lastName" class="form-label">Last name</label>
                <input type="text" class="form-control" id="lastName" name="last_name"
                       value="<?php echo htmlspecialchars((string)($user['last_name'] ?? '')); ?>" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?php echo htmlspecialchars((string)($user['email'] ?? '')); ?>" required>
            </div>
        </div>
        <div class="col-6">
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone_number"
                       value="<?php echo htmlspecialchars((string)($user['phone_number'] ?? '')); ?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="mb-3">
                <label for="birthdate" class="form-label">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" name="birthdate"
                       value="<?php echo htmlspecialchars((string)($user['birthdate'] ?? '')); ?>">
            </div>
        </div>
        <div class="col-3">
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="">Select gender</option>
                    <option value="male" <?php echo ((string)($user['gender'] ?? '') === 'male') ? 'selected' : ''; ?>>Male</option>
                    <option value="female" <?php echo ((string)($user['gender'] ?? '') === 'female') ? 'selected' : ''; ?>>Female</option>
                    <option value="other" <?php echo ((string)($user['gender'] ?? '') === 'other') ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="mb-3">
                <label for="profile" class="form-label">Profile Picture</label>
                <input type="file" class="form-control" id="profile" name="profile">
            </div>
        </div>
        <div class="col-3">
          <div class="mb-3">
              <label for="authentication" class="form-label">Authentication</label>
              <select class="form-select" id="authentication" name="authentication">
                  
                  <option value="True" <?php echo (isset($user['authentication']) && $user['authentication'] === 'True') ? 'selected' : ''; ?>>
                      On
                  </option>
                  
                  <option value="False" <?php echo (!isset($user['authentication']) || $user['authentication'] !== 'True') ? 'selected' : ''; ?>>
                      Off
                  </option>
                  
              </select>
          </div>
      </div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3"><?php echo htmlspecialchars((string)($user['address'] ?? '')); ?></textarea>
    </div>

    <input type="hidden" name="user_id" value="<?php echo intval($user_id ?? 0); ?>">

    <!-- Action buttons -->
    <div class="mt-3">
        <button type="submit" class="btn btn-danger rounded-4 px-4">
            <i class="bi bi-check-circle me-2"></i> Save Profile
        </button>
        <button type="button" class="btn btn-outline-danger rounded-4 px-4" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
            Change Password
        </button>
    </div>
</div>

</form>
<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Form -->
      <form id="changePasswordForm" action="change_password copy.php" method="POST" novalidate>
        <div class="modal-body">
         <input type="hidden" name="user_id" value="<?php echo intval($user_id); ?>">


          <!-- New Password -->
          <div class="mb-3">
            <label for="newPassword" class="form-label">New Password</label>
            <div class="input-group">
              <input 
                type="password" 
                class="form-control" 
                id="newPassword" 
                name="new_password" 
                required 
                minlength="8" 
                aria-describedby="newPasswordHelp"
              >
              <button 
                class="btn border toggle-password" 
                type="button" 
                data-target="newPassword" 
                aria-label="Toggle show/hide new password"
              >
                <i class="bi bi-eye-slash"></i>
              </button>
              <div class="invalid-feedback">Password must be at least 8 characters long.</div>
            </div>
            <div id="newPasswordHelp" class="form-text">Must be at least 8 characters.</div>
          </div>

          <!-- Confirm Password -->
          <div class="mb-3">
            <label for="confirmPassword" class="form-label">Confirm Password</label>
            <div class="input-group">
              <input 
                type="password" 
                class="form-control" 
                id="confirmPassword" 
                name="confirm_password" 
                required
              >
              <button 
                class="btn border toggle-password" 
                type="button" 
                data-target="confirmPassword" 
                aria-label="Toggle show/hide confirm password"
              >
                <i class="bi bi-eye-slash"></i>
              </button>
              <div class="invalid-feedback">Passwords do not match.</div>
            </div>
          </div>

        </div>

        <!-- Footer Buttons -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary rounded-4" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger rounded-4" id="submitBtn" disabled>Update Password</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
  // Show/hide password toggles
  document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function () {
      const input = document.getElementById(this.getAttribute('data-target'));
      const icon = this.querySelector('i');

      if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
      } else {
        input.type = 'password';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
      }
    });
  });

  // Elements
  const form = document.getElementById('changePasswordForm');
  const newPassword = document.getElementById('newPassword');
  const confirmPassword = document.getElementById('confirmPassword');
  const submitBtn = document.getElementById('submitBtn');

  // Validate inputs function
  function validatePasswords() {
    const newPassVal = newPassword.value.trim();
    const confirmPassVal = confirmPassword.value.trim();

    // Reset validation styles
    newPassword.classList.remove('is-invalid');
    confirmPassword.classList.remove('is-invalid');
    submitBtn.disabled = true;

    let isValid = true;

    // Check new password length
    if (newPassVal.length < 8) {
      newPassword.classList.add('is-invalid');
      isValid = false;
    }

    // Check passwords match (only if new password length is ok)
    if (newPassVal.length >= 8 && newPassVal !== confirmPassVal) {
      confirmPassword.classList.add('is-invalid');
      isValid = false;
    }

    // Enable submit button only if valid
    submitBtn.disabled = !isValid;
  }

  // Run validation on input events for real-time feedback
  newPassword.addEventListener('input', validatePasswords);
  confirmPassword.addEventListener('input', validatePasswords);

  // Final check on submit to prevent form submission if invalid (extra safety)
  form.addEventListener('submit', function(e) {
    validatePasswords();
    if (submitBtn.disabled) {
      e.preventDefault();
    }
  });
</script>
