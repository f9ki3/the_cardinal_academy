<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $corLink = isset($_POST['cor_link']) ? $_POST['cor_link'] : '';
    $email = 'N/A';

    // Parse email from the query string of the link
    if (!empty($corLink)) {
        $parsedUrl = parse_url($corLink);
        if (isset($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
            if (isset($queryParams['email'])) {
                $email = $queryParams['email'];
            }
        }
    }

    // Validate email before attempting to send
    if ($email !== 'N/A' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
            $mail->addAddress($email); // Send to extracted email

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Your Certificate of Registration (COR)';
            $mail->Body    = 'Hi!<br><br>You may view your Certificate of Registration by clicking the link below:<br><a href="' . htmlspecialchars($corLink) . '">' . htmlspecialchars($corLink) . '</a><br><br>Thank you!';
            $mail->AltBody = 'Hi! View your COR here: ' . $corLink;

            $mail->send();
            echo 'Message has been sent successfully to ' . htmlspecialchars($email);
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo 'Invalid or missing email address in link.';
    }
}
?>
