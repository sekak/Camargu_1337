<?php 
require_once __DIR__ . '/../config/session.php';

function isAuthenticated(): bool {
    return isset($_SESSION['user_profile']);
}

function redirectIfNotAuthenticated(string $redirectUrl = '/view/login.php'): void {
    if (!isAuthenticated()) {
        header(header: "Location: $redirectUrl");
        exit;
    }
}

function redirectIfAuthenticated(string $redirectUrl = '/view/home.php'): void {
    if (isAuthenticated()) {
        header("Location: $redirectUrl");
        exit;
    }
}