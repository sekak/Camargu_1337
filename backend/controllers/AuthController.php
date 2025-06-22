<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Mail.php';


class AuthController
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

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(32));

        $userModel->create($username, $email, $hashed, $token);

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
            echo "Invalid email or password.";
            return;
        } else {
            if (password_verify($password, $user['password'])) {
                if ($user['is_verified']) {
                    $_SESSION['user_profile'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                    ];
                    header(header: "Location: /index.php");
                    exit;
                } else {
                    echo "Please verify your email first.";
                }
            } else {
                echo "Invalid email or password.";
            }
        }
    }


}