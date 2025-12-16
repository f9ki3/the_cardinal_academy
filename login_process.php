<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust path if needed (ensure you have PHPMailer installed via Composer)
require 'vendor/autoload.php'; 
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usernameOrEmail = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($usernameOrEmail) || empty($password)) {
        header("Location: login.php?status=1");
        exit;
    }

    // Find user by username or email
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1");
    $stmt->bind_param("ss", $usernameOrEmail, $usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            
            // --- CHECK AUTHENTICATION STATUS ---
            // Note: We check specifically for the string "True" as stored in your DB
            if (isset($user['authentication']) && $user['authentication'] === 'True') {
                
                // 1. Generate 6-digit OTP
                $otp = rand(100000, 999999);
                
                // 2. Store OTP and User Data in Temporary Session
                $_SESSION['2fa_otp'] = $otp;
                $_SESSION['2fa_user_data'] = [
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'acc_type' => $user['acc_type'],
                    'role' => $user['role']
                ];

                // 3. Send Email using PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Server settings
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.hostinger.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'tca@acadesys.site'; // Your Email
                    $mail->Password   = '4koSiFyke123*';     // Your Password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    // Recipients
                    $mail->setFrom('tca@acadesys.site', 'TCA Security');
                    $mail->addAddress($user['email']); 

                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Your Login Verification Code';
                    $mail->Body    = '<h3>Login Verification</h3><p>Your authentication code is: <b>' . $otp . '</b></p><p>Do not share this code.</p>';
                    $mail->AltBody = 'Your authentication code is: ' . $otp;

                    $mail->send();

                    // 4. Redirect to Verification Page
                    header("Location: verification.php");
                    exit;

                } catch (Exception $e) {
                    // Log error or redirect with error flag
                    error_log("Mailer Error: " . $mail->ErrorInfo);
                    header("Location: login.php?error=mail_failed");
                    exit;
                }

            } else {
                // --- AUTHENTICATION OFF: Login Immediately ---
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['acc_type'] = $user['acc_type'];
                $_SESSION['role'] = $user['role'];

                // Redirect based on account type
                redirectUser($user['acc_type']);
            }

        } else {
            // Incorrect password
            header("Location: login.php?status=1");
            exit;
        }
    } else {
        // User not found
        header("Location: login.php?status=1");
        exit;
    }
} else {
    // Direct access
    header("Location: login.php?status=1");
    exit;
}

// Helper function for redirection
function redirectUser($acc_type) {
    switch ($acc_type) {
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
            break;
    }
    exit;
}
?>