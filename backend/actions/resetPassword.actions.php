<?php
require_once __DIR__ . '/../controllers/User.controller.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$userController = new User_controller();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($token) || empty($password)) {
        $_SESSION['error'] = "Invalid request.";
        header("Location: /view/reset_password.php?token=" . urlencode($token));
        exit;
    }

    if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password)) {
        $_SESSION['error'] = "Password must be at least 6 characters long and contain at least one uppercase letter.";
        header("Location: /view/reset_password.php?token=" . urlencode($token));
        exit;
    }

    $user = $userController->getUserByToken($token);

    if (!$user) {
        $_SESSION['error'] = "Invalid or expired token.";
        header("Location: /view/reset_password.php?token=" . urlencode($token));
        exit;
    }

    // Update password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $userController->updatePassword($user['id'], $hashedPassword);

    // Clear token
    $userController->clearResetToken($user['id']);

    $_SESSION['message'] = "Password has been reset successfully. You can now log in.";
    header("Location: /view/login.php");
    exit;
}
