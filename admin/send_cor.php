<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST values
    $corLink = $_POST['cor_link'] ?? '';
    $email = $_POST['email'] ?? '';

    // Extract tuition_id from cor_link (for redirect later)
    $tuitionId = 'N/A';
    if (!empty($corLink)) {
        $parsedUrl = parse_url($corLink);
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
            if (isset($queryParams['tuition_id'])) {
                $tuitionId = $queryParams['tuition_id'];
            }
        }
    }

    // Validate required fields
    if (empty($corLink) || empty($email)) {
        die('Missing required data: COR link or email.');
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email address.');
    }

    // Send email
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tca@acadesys.site'; // Your Hostinger email
        $mail->Password = '4koSiFyke123*';     // Your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('tca@acadesys.site', 'TCA');
        $mail->addAddress('floterina@gmail.com');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Your Certificate of Registration (COR)';
        $mail->Body = '
            Hi!<br><br>
            You may view your Certificate of Registration by clicking the link below:<br>
            <a href="' . htmlspecialchars($corLink) . '">' . htmlspecialchars($corLink) . '</a><br><br>
            Thank you!
        ';
        $mail->AltBody = 'Hi! View your COR here: ' . $corLink;

        $mail->send();

        // Redirect on success
        if ($tuitionId !== 'N/A') {
            header("Location: generate_cor.php?tuition_id=" . urlencode($tuitionId));
        } else {
            header("Location: generate_cor.php");
        }
        exit;

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
