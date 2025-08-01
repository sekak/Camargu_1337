<?php
require_once __DIR__ .'/../utils/authMiddleware.php';
require_once __DIR__ .'/../controllers/Auth.controller.php';
include_once __DIR__ ."/../config/setup.php";

redirectIfAuthenticated();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new Auth_controller();
    $controller->login();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camargu - Login</title>
    
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
            background: linear-gradient(135deg, #87CEEB 0%, #FFC1CC 100%); /* Sky blue to flamingo pink */
            overflow: hidden;
        }

        /* Form container with glassmorphism effect */
        .form-container {
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
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        /* Form heading with Camargu branding */
        .form-container h2 {
            text-align: center;
            margin-bottom: 1.8rem;
            color: rgba(141, 141, 141, 0.86); /* Sea green inspired by wetlands */
            font-size: 1.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Input fields with smooth transitions */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 1rem;
            margin-bottom: 1.2rem;
            border: 2px solid #B0E0E6; /* Powder blue border */
            border-radius: 8px;
            font-size: 1rem;
            background: rgba(255, 255, 255, 0.9);
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #007bb0; /* Hot pink for focus, flamingo-inspired */
            box-shadow: 0 0 8px rgba(141, 141, 141, 0.86);
        }

        input::placeholder {
            color: #778899; /* Light slate gray */
            font-style: italic;
        }

        /* Submit button with hover effect */
        button[type="submit"] {
            width: 100%;
            padding: 1rem;
            background: rgba(141, 141, 141, 0.86); /* Sea green */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background: rgba(176, 176, 176, 0.86); /* Forest green */
        }

        /* Login link styling */
        .register-link {
            display: flex;
            flex-direction: column;
            text-align: center;
            margin-top: 1rem;
        }

        .register-link a {
            color: #007bb0; /* Flamingo pink */
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #007bb0; /* Darker pink */
            text-decoration: underline;
        }

        /* Error message styling */
        .error {
            color: #007bb0;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        /* Subtle Camargue-inspired decoration */
        .form-container::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            width: 40px;
            height: 40px;
            background: url('https://img.icons8.com/color/48/000000/flamingo.png') no-repeat center;
            background-size: contain;
            opacity: 0.3;
        }

        /* Responsive design */
        @media (max-width: 500px) {
            .form-container {
                margin: 1rem;
                padding: 2rem;
            }

            .form-container h2 {
                font-size: 1.5rem;
            }

            input[type="email"],
            input[type="password"],
            button[type="submit"] {
                padding: 0.8rem;
                font-size: 0.95rem;
            }

            .register-link a {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Camargu Login</h2>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required />
            <input type="password" name="password" placeholder="Password" required />
            <?php if (isset($_SESSION['errors'])): ?>
                <div class="error">
                    <?= $_SESSION['errors']; ?>
                    <?php unset($_SESSION['errors']); ?>
                </div>
            <?php endif; ?>
            <button type="submit">Log In</button>
        </form>
        <div class="register-link">
            <a href="register.php">Need an account? Register here</a>
            <a href="forgot_password.php" style="margin-left: 10px;">Forgot Password?</a>
        </div>
    </div>
</body>
</html>


