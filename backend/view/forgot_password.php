<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
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

        .forget-form {
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
        .forget-form h2 {
            text-align: center;
            margin-bottom: 1.8rem;
            color: rgba(141, 141, 141, 0.86);
            /* Sea green inspired by wetlands */
            font-size: 1.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .forget-form label {
            font-weight: 600;
            color: #333;
        }

        .forget-form input[type="email"] {
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

        .forget-form button[type="submit"] {
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

        .forget-form button[type="submit"]:hover {
            background: rgba(176, 176, 176, 0.86);
        }

        .forget-form input::placeholder {
            color: #778899;
            /* Light slate gray */
            font-style: italic;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .forget-form {
                padding: 1.5rem;
                width: 90%;
            }

            .forget-form h2 {
                font-size: 1.5rem;
            }

            .forget-form button {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <form class="forget-form" method="POST" action="/actions/sendResetLink.actions.php">
        <h2>Reinitialisation password</h2>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <button type="submit">Send Reset Link</button>
        <?php if (isset($_SESSION['message'])): ?>
            <p style="color: green;"><?php echo $_SESSION['message'];
            unset($_SESSION['message']); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?></p>
        <?php endif; ?>
    </form>
</body>

</html>