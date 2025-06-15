<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // adjust path if not using composer

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; // Hostinger SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'tca@acadesys.site'; // your Hostinger email
    $mail->Password = '4koSiFyke123*';     // your email password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // or 'tls'
    $mail->Port = 587; // TLS port

    // Recipients
    $mail->setFrom('tca@acadesys.site', 'TCA');
    $mail->addAddress('floterina@gmail.com', 'Fyke Lleva');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test email from Hostinger + PHPMailer';
    $mail->Body    = '<strong>Hello!</strong> This is a test email using Hostinger SMTP with PHPMailer.';
    $mail->AltBody = 'Hello! This is a test email using Hostinger SMTP with PHPMailer.';

    $mail->send();
    echo 'Message has been sent successfully';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
