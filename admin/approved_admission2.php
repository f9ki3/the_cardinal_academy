<?php
include 'session_login.php';
include '../db_connection.php';

date_default_timezone_set('Asia/Manila'); // Set timezone

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admission_id = intval($_POST['admission_id'] ?? 0);
    $action = $_POST['action'] ?? '';

    if ($admission_id > 0 && in_array($action, ['approved', 'for_review'])) {
        $status = $action;

        // ✅ Fetch student info from admission_old
        $fetch_query = "SELECT email, que_code, CONCAT(first_name, ' ', last_name) AS fullname 
                        FROM admission_old 
                        WHERE id = ?";
        $fetch_stmt = $conn->prepare($fetch_query);
        $fetch_stmt->bind_param("i", $admission_id);
        $fetch_stmt->execute();
        $result = $fetch_stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $email = $row['email'];
            $que_code = $row['que_code'];
            $fullname = $row['fullname'];
            $fetch_stmt->close();

            // ✅ Update admission status
            $update_query = "UPDATE admission_old SET admission_status = ? WHERE id = ?";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bind_param("si", $status, $admission_id);

            if ($update_stmt->execute()) {
                // ✅ Send email notification
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.hostinger.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'tca@acadesys.site';
                        $mail->Password = '4koSiFyke123*';
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $mail->setFrom('tca@acadesys.site', 'TCA Admission');
                        $mail->addAddress($email, $fullname);

                        $mail->isHTML(true);
                        $mail->Subject = "Your Admission is $status";

                        $visit_msg_html = "";
                        $visit_msg_text = "";
                        if (in_array($status, ['approved', 'for_review'])) {
                            $visit_msg_html = "<p style='font-size:16px;'>Please visit the registrar tomorrow between <span style='color:green;'>8:00 AM to 5:00 PM</span> to correct or update your credentials.</p>";
                            $visit_msg_text = "Please visit the school registrar tomorrow between 8:00 AM and 5:00 PM to correct or update your credentials.\n";
                        }

                        // ✅ Convert status text for display (replace underscore with space)
                        $display_status = ucfirst(str_replace('_', ' ', $status));

                        $mail->Body = '
                        <table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:sans-serif;">
                        <tr>
                            <td style="padding:20px; font-size:16px; line-height:1.6;">
                            <p>Hi <strong>' . htmlspecialchars($fullname) . '</strong>,</p>
                            <p>Your admission application has been 
                                <strong style="color:green;">' . htmlspecialchars($display_status) . '</strong>.
                            </p>
                            <p>Queuing Code: <strong>' . htmlspecialchars($que_code) . '</strong></p>
                            ' . $visit_msg_html . '
                            <br>
                            <p>Thank you,<br><strong>The Cardinal Academy</strong></p>
                            <br>
                            <p><strong>Note:</strong> Please bring the following:</p>
                            <ul style="font-size:16px; padding-left:20px; margin:0;">
                                <li>PHP 2,500 for the registration fee</li>
                            </ul>
                            </td>
                        </tr>
                        </table>';

                        $mail->AltBody = "Hello $fullname,\nYour admission is $display_status.\nCode: $que_code\n" .
                                         $visit_msg_text .
                                         "\nThank you.";

                        $mail->send();
                    } catch (Exception $e) {
                        error_log("Email Error: {$mail->ErrorInfo}");
                    }
                }

                header("Location: admission.php?id=$admission_id&status=success");
                exit();
            } else {
                echo "Failed to update status.";
            }

            $update_stmt->close();
        } else {
            echo "Student not found.";
        }
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid access method.";
}
?>
