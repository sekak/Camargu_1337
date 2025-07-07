<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/session.php';

class Mail_model
{

    public function sendVerificationEmail($to, $token, $name)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mailhog';
            $mail->Port = 1025;
            $mail->SMTPAuth = false;

            $mail->setFrom('asekkak@camagru.local', 'Camagru');
            $mail->addAddress($to, $name);

            $mail->Subject = 'Confirmation d’email';
            $mail->Body = 'Verify your account by clicking the link: ' .
                "http://localhost:8000/verify.php?token=$token";

            $mail->send();
        } catch (Exception $e) {
            echo "❌ L’envoi de l’e-mail a échoué. Erreur : {$mail->ErrorInfo}";
        }
    }

    public function sendNotificationEmail($fromEmail, $comment)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mailhog';
            $mail->Port = 1025;
            $mail->SMTPAuth = false;

            $mail->setFrom($fromEmail, 'Camagru');

            $mail->addAddress($_SESSION['user_profile']['email'], $_SESSION['user_profile']['username']);

            $mail->Subject = 'New Comment Notification';
            $mail->Body = "Hello,\n\nYou have a new comment:\n\n" . htmlspecialchars($comment);

            $mail->send();
        } catch (Exception $e) {
            echo "❌ L’envoi de l’e-mail a échoué. Erreur : {$mail->ErrorInfo}";
        }
    }

    public function sendResetPasswordEmail($to, $resetLink)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'mailhog';
            $mail->Port = 1025;
            $mail->SMTPAuth = false;

            $mail->setFrom('camagru@gmail.com', 'Camagru');
            $mail->addAddress($to);
            $mail->Subject = 'Reset your password';
            $mail->Body = "Hello,\n\nPlease click the link below to reset your password:\n\n$resetLink\n\nThis link will expire in 1 hour.";

            $mail->send();
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }
    }


}