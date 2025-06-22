<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once __DIR__ . '/../vendor/autoload.php';

class Mail
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

            $mail->Subject =  'Confirmation d’email';
            $mail->Body = 'Verify your account by clicking the link: ' .
                "http://localhost:8000/verify.php?token=$token";

            $mail->send();
            echo '✅ E-mail envoyé avec succès';
        } catch (Exception $e) {
            echo "❌ L’envoi de l’e-mail a échoué. Erreur : {$mail->ErrorInfo}";
        }

    }
}