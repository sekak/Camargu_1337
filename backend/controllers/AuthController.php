<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Mail.php';


class AuthController
{
    public function register()
    {

        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }
    
        echo "Register Page";


        $db = (new Database())->getConnection();
        
        $userModel = new User($db);
        
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $hashed = password_hash($password, PASSWORD_BCRYPT);
        $token = bin2hex(random_bytes(32));

        $userModel->create($username, $email, $hashed, $token);

        $mail= new Mail();
        $mail->sendVerificationEmail($email, $token, $username);
    }


}