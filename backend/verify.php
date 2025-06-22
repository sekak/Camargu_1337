<?php
require_once './config/database.php';
require_once './models/User.php';

$token = $_GET['token'];
$db = (new Database())->getConnection();
$userModel = new User($db);

$success = false;
$message = "";


if ($userModel->verifyToken($token)) {
    echo "✅ Account verified!";
    $message = "✅ Your account has been successfully verified!";
    $success = true;
} else {
    echo "";
    $message = "❌ Invalid or expired token.";
    $success = false;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            padding: 50px;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        .login-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2 class="<?= $success ? 'success' : 'error' ?>"><?= $message ?></h2>

    <?php if ($success): ?>
        <a href="login.php" class="login-btn">Go to Login</a>
    <?php endif; ?>
</body>
</html>