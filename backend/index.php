<?php

require_once './utils/authMiddleware.php';
redirectIfNotAuthenticated();

if (isset($_SESSION['username']) && isset($_SESSION['email'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];

    echo "Welcome, $username! Your email is $email.";
} else {
    echo "User not found in session.";
}
?>
<?php require_once './config/setup.php'; ?>
