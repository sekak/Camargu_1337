<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Mail.php';


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

        $userExists = $userModel->findByEmail($email);
        if ($userExists) {
            $_SESSION['errors'] = "Email already exists.";
            return;
        }
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(32));

        $userModel->create($username, $email, $hashed, $token);
        $_SESSION['register_success'] = "✅ Please check your email to confirm your account.";

        $mail = new Mail();
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