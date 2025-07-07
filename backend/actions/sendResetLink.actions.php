<?php
require_once __DIR__ . '/../controllers/User.controller.php';
require_once __DIR__ . '/../models/Mail.model.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userController = new User_controller();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    $user = $userController->getUserByEmail($email);

    if (!$user) {
        $_SESSION['error'] = "No account found with that email.";
        header("Location: /view/forgot_password.php");
        exit;
    }

    $token = bin2hex(random_bytes(50));

    $userController->storeResetToken($user['id'], $token);

    $resetLink = "http://localhost:8000/view/reset_password.php?token=" . $token;

    $mailModel = new Mail_model();
    $mailModel->sendResetPasswordEmail($email, $resetLink);

    $_SESSION['message'] = "A password reset link has been sent to your email.";
    header("Location: /view/forgot_password.php");
    exit;
}
