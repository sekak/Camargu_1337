<?php 
session_start();

function isAuthenticated(): bool {
    return isset($_SESSION['user_profile']);
}

function redirectIfNotAuthenticated(string $redirectUrl = '/views/layout/login.php'): void {
    if (!isAuthenticated()) {
        header("Location: $redirectUrl");
        exit;
    }
}

function redirectIfAuthenticated(string $redirectUrl = '/index.php'): void {
    if (isAuthenticated()) {
        header("Location: $redirectUrl");
        exit;
    }
}