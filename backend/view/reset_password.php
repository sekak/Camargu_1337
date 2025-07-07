<?php
session_start();
$token = $_GET['token'] ?? '';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset-password</title>

    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Import Google Font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        /* Body styling with Camargue-inspired background */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #87CEEB 0%, #FFC1CC 100%);
            /* Sky blue to flamingo pink */
            overflow: hidden;
        }

        .reset-form {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
            animation: slideIn 0.6s ease-out;
        }

        /* Slide-in animation */
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Form heading with Camargu branding */
        .reset-form h2 {
            text-align: center;
            margin-bottom: 1.8rem;
            color: rgba(141, 141, 141, 0.86);
            /* Sea green inspired by wetlands */
            font-size: 1.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .reset-form label {
            font-weight: 600;
            color: #333;
        }

        .reset-form input[type="password"] {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.2rem;
            border: 2px solid #B0E0E6;
            /* Powder blue border */
            border-radius: 8px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="email"]:focus {
            outline: none;
            border-color: #007bb0;
            /* Hot pink for focus, flamingo-inspired */
            box-shadow: 0 0 8px rgba(141, 141, 141, 0.86);
        }

        .reset-form button[type="submit"] {
            width: 100%;
            padding: 1rem;
            background: rgba(141, 141, 141, 0.86);
            /* Sea green */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
        }

        .reset-form button[type="submit"]:hover {
            background: rgba(176, 176, 176, 0.86);
        }

        .reset-form input::placeholder {
            color: #778899;
            /* Light slate gray */
            font-style: italic;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .reset-form {
                padding: 1.5rem;
                width: 90%;
            }

            .reset-form h2 {
                font-size: 1.5rem;
            }

            .reset-form button {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    
    <form method="POST" action="/actions/resetPassword.actions.php" class="reset-form">
        <h2>Reset Your Password</h2>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <input type="password" name="password" required placeholder="New password"><br><br>
        <button type="submit">Reset Password</button>
        <a href="/view/login.php" style="display: block; text-align: center; margin-top: 1rem; color: #007bb0; text-decoration: none;">Back to Login</a>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></p>
        <?php endif; ?>
    </form>
</body>

</html>