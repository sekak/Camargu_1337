<html>
<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
login
    <?php if ($success): ?>
        <a href="login.php" class="login-btn">Go to Login</a>
    <?php endif; ?>
</body>

</html>
</html>