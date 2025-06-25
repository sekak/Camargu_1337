<?php
require_once '../../utils/authMiddleware.php';
require_once '../../controllers/Auth.controller.php';

redirectIfAuthenticated();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new Auth_controller();
    $controller->register();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camargu - Register</title>
    <style>
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
        .form-container h2 {
            text-align: center;
            margin-bottom: 1.8rem;
            color: #007bff;
            /* Sea green inspired by wetlands */
            font-size: 1.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Input fields with smooth transitions */
        input[type="text"],
        input[type="email"],
        input[type="password"] {
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

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #FF69B4;
            /* Hot pink for focus, flamingo-inspired */
            box-shadow: 0 0 8px rgba(255, 105, 180, 0.4);
        }

        input::placeholder {
            color: #778899;
            /* Light slate gray */
            font-style: italic;
        }

        /* Submit button with hover effect */
        button[type="submit"] {
            width: 100%;
            padding: 1rem;
            background: #007bff;
            /* Sea green */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        button[type="submit"]:hover {
            background: #228B22;
            /* Forest green */
            transform: translateY(-2px);
        }

        button[type="submit"]:active {
            transform: translateY(0);
        }

        /* Login link styling */
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }

        .login-link a {
            color: #FF69B4;
            /* Flamingo pink */
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 600;
            transition: color 0.3s;
        }

        .login-link a:hover {
            color: #C71585;
            /* Darker pink */
            text-decoration: underline;
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

            input[type="text"],
            input[type="email"],
            input[type="password"],
            button[type="submit"] {
                padding: 0.8rem;
                font-size: 0.95rem;
            }

            .login-link a {
                font-size: 0.9rem;
            }
        }

        .error {
            color: #FF69B4;
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>

</head>

<body>
    <div class="form-container">
        <h2>Camargu Register</h2>

        <?php if (isset($_SESSION['register_success'])): ?>
            <div
                style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; margin-bottom: 20px; border-radius: 5px; text-align: center;">
                <?= $_SESSION['register_success']; ?>
                <br><br>
                <a href="login.php" style="color: #155724; font-weight: bold;">Go to login</a>
            </div>
            <?php unset($_SESSION['register_success']); ?>

        <?php else: ?>
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Username" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" required />
                <?php if (isset($_SESSION['errors'])): ?>
                    <div class="error">
                        <?= $_SESSION['errors']; ?>
                        <?php unset($_SESSION['errors']); ?>
                    </div>
                <?php endif; ?>
                <button type="submit">Register</button>
            </form>
            <div class="login-link">
                <a href="login.php">Already have an account? Log in here</a>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>