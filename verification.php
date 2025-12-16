<?php 
session_start();

// --- 1. Security Check ---
// If no OTP is pending, kick them back to login
if (!isset($_SESSION['2fa_otp']) || !isset($_SESSION['2fa_user_data'])) {
    header("Location: login.php");
    exit;
}

$error = "";

// --- 2. Handle Form Submission ---
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entered_code = $_POST['otp_code'];

    // Check if code matches (loose comparison allows string vs int match)
    if ($entered_code == $_SESSION['2fa_otp']) {
        
        // --- SUCCESS: Log the user in ---
        $userData = $_SESSION['2fa_user_data'];
        
        // Set real session variables
        $_SESSION['user_id']  = $userData['user_id'];
        $_SESSION['username'] = $userData['username'];
        $_SESSION['acc_type'] = $userData['acc_type'];
        $_SESSION['role']     = $userData['role'];

        // Clear temporary OTP session data
        unset($_SESSION['2fa_otp']);
        unset($_SESSION['2fa_user_data']);

        // Redirect based on account type
        switch ($userData['acc_type']) {
            case 'teacher': 
                header("Location: teacher/dashboard.php");
                break;
            case 'parent':
                header("Location: parent/dashboard.php");
                break;
            case 'student':
                header("Location: student/dashboard.php");
                break;
            default:
                header("Location: login.php?status=1");
        }
        exit;
    } else {
        $error = "Invalid code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Verification - AcadeSys</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* Responsive hiding of image */
    @media (max-width: 767.98px) {
      .login-image {
        display: none;
      }
    }

    .navbar-sticky-wrapper {
      position: sticky;
      top: 0;
      z-index: 1030;
    }

    .main-navbar {
      background-color: #b72029;
    }

    .main-navbar .nav-link,
    .main-navbar .navbar-brand {
      color: #fff !important;
    }

    .main-navbar .nav-link:hover {
      text-decoration: underline;
    }

    .navbar-brand img {
      height: 40px;
      width: auto;
      object-fit: contain;
    }

    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23ffffff' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    /* ======= BACKGROUND ======= */
    body {
      position: relative;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      margin: 0;
      z-index: 0;
      overflow-x: hidden;
    }

    /* Background image with blur */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-image: url('static/images/basketball2.webp');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      filter: blur(8px);  /* Gaussian blur */
      z-index: -2;
      pointer-events: none;
    }

    /* Dim gradient overlay */
    body::after {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.3)); 
      z-index: -1;
      pointer-events: none;
    }

    /* Card Style */
    .login-card {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }

    /* =========================================
       FIX: REMOVE ARROWS FROM NUMBER INPUT 
       ========================================= */
    /* Chrome, Safari, Edge, Opera */
    input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
  </style>
</head>
<body>

  <div class="navbar-sticky-wrapper">
    <nav class="navbar navbar-expand-lg main-navbar px-4">
      <a class="navbar-brand fw-bold d-flex align-items-center" href="index.php">
        <img src="static/uploads/logo.png" alt="TCA Logo" />
        <span class="ms-2">The Cardinal Academy</span>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain"
              aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="navbarMain">
        <ul class="navbar-nav me-3 mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
        </ul>
      </div>
    </nav>
  </div>

  <div class="container-fluid flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="row justify-content-center w-100" style="margin-top: 120px; margin-bottom: 120px;">
      <div class="col-12 col-md-4 d-flex align-items-center justify-content-center">
        <div class="p-4 login-card w-100" style="max-width: 500px;">
          
          <div class="text-center mb-3">
            <img src="static/uploads/logo.png" alt="Logo" style="width: 100px; height: 100px;">
          </div>
          
          <h3 class="text-center mb-2">Security Verification</h3>
          <p class="text-center text-muted mb-4">
            We sent a 6-digit code to your email.<br>
            <small>Please enter it below to continue.</small>
          </p>

          <form action="" method="POST" class="p-3">
            
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger alert-dismissible fade show d-flex align-items-start" role="alert">
                <div>
                  <strong>Authentication Failed:</strong>
                  <p class="mb-0"><?php echo htmlspecialchars($error); ?></p>
                </div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <div class="mb-4">
              <label for="otp_code" class="form-label fw-bold">One-Time Password (OTP)</label>
              <input type="number" 
                     name="otp_code" 
                     id="otp_code" 
                     class="form-control form-control-lg text-center letter-spacing-2" 
                     placeholder="000000" 
                     required 
                     autofocus
                     inputmode="numeric" 
                     style="letter-spacing: 5px; font-weight: bold; font-size: 1.5rem;">
            </div>

            <button type="submit" class="btn btn-danger text-light w-100 mb-3 py-2">
              <i class="bi bi-shield-lock me-2"></i> VERIFY CODE
            </button>

            <a href="login.php" class="btn btn-outline-secondary w-100 mb-3 text-center text-decoration-none">
              <i class="bi bi-arrow-left me-2"></i> Cancel & Return to Login
            </a>

          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>