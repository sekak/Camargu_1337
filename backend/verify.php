<?php
require_once './config/database.php';
require_once './models/User.php';

$token = $_GET['token'];
$db = (new Database())->getConnection();
$userModel = new User($db);

$success = false;
$message = "";


if ($userModel->verifyToken($token)) {
    $success = true;
    $message = "✅ Your account has been successfully verified!";
    
    
} else {
    echo "";
    $message = "❌ Invalid or expired token.";
    $success = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camargu - Verify Account</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #87CEEB 0%, #FFC1CC 100%);
            font-family: 'Poppins', sans-serif;
        }

        .message-container {
            background: rgba(255, 255, 255, 0.85);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .message {
            font-size: 1.2rem;
            color: <?php echo $success ? '#28a745' : '#dc3545'; ?>;
        }
    </style>
</head>
<body>
    <div class="message-container">
        <h2>Account Verification</h2>
        <p class="message"><?php echo $message; ?></p>
        <?php if ($success): ?>
            <a href="/views/layout/login.php" style="color: #155724; font-weight: bold;">Go to login</a>
            <?php endif; ?>
    </div>
</body>
</html>

