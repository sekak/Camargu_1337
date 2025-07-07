<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.model.php';
require_once __DIR__ . '/../models/Mail.model.php';


class Auth_controller
{
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $db = (new Database())->getConnection();

        $userModel = new User($db);

        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($email) || empty($password)) {
            $_SESSION['errors'] = "All fields are required.";
            return;
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors'] = "Invalid email format.";
            return;
        }

        $usernameExists = $userModel->findByUsername($username, true);
        if($usernameExists) {
            $_SESSION['errors'] = "Username already exists.";
            return;
        }
        
        $emailExists = $userModel->findByEmail($email, true);
        if ($emailExists) {
            $_SESSION['errors'] = "Email already exists.";
            return;
        }

        // add strong password validation, just more than 6 characters and at least one uppercase letter,
        if (strlen($password) < 6 || !preg_match('/[A-Z]/', $password)) {
            $_SESSION['errors'] = "Password must be at least 6 characters long and contain at least one uppercase letter.";
            return;
        }

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(32));

        $userModel->create($username, $email, $hashed, $token);
        $_SESSION['register_success'] = "✅ Please check your email to confirm your account.";

        $mail = new Mail_model();
        $mail->sendVerificationEmail($email, $token, $username);

    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $db = (new Database())->getConnection();
        $userModel = new User($db);

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = $userModel->findByEmail($email);
        if ($user === null) {
            $_SESSION['errors'] = "User not found.";
            return;
        } else {
            if (password_verify($password, $user['password'])) {
                if ($user['is_verified']) {
                    $_SESSION['user_profile'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'notify_comments' => $user['notify_comments'],
                    ];
                    header("Location: /view/home.php?page=1");
                } else {
                    $_SESSION["errors"] = "please verify your email first.";
                }
            } else {
                $_SESSION["errors"] = "Invalid email or password.";
            }
        }
    }


}