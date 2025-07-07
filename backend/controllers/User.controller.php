<?php

require_once __DIR__ . '/../models/User.model.php';
require_once __DIR__ . '/../config/database.php';

class User_controller
{

    private $db;
    private $userModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->userModel = new User($this->db);
    }

    public function getUserByEmail($email)
    {
        if (empty($email)) {
            return null;
        }

        $user = $this->userModel->findByEmail($email, true);
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    public function updateUserProfile($data)
    {
        if (empty($data['username']) || empty($data['email'])) {
            return ['success' => false, 'message' => 'Username and email are required.'];
        }

        $user = $this->userModel->findByEmail($_SESSION['user_profile']['email']);
        if (!$user) {
            return ['success' => false, 'message' => 'User not found.'];
        }

        // Check if the username already exists or email is already in use
        $existingUser = $this->userModel->findByUsername($data['username'], true);
        if ($existingUser && $existingUser['email'] !== $data['email'] && $existingUser['id'] !== $user['id']) {
            return ['success' => false, 'message' => 'Username already exists.'];
        }
        $existingEmailUser = $this->userModel->findByEmail($data['email'], true);
        if ($existingEmailUser && $existingEmailUser['username'] !== $data['username'] && $existingEmailUser['id'] !== $user['id']) {
            return ['success' => false, 'message' => 'Email already exists.'];
        }

        if (empty($data['password'])) {
            $hashedPassword = $user['password'];
        } else {
            // add strong password validation, just more than 6 characters and at least one uppercase letter,
            if (strlen($data['password']) < 6 || !preg_match('/[A-Z]/', $data['password'])) {
                $_SESSION['errors'] = "Password must be at least 6 characters long and contain at least one uppercase letter.";
                return ['success' => false, 'message' => 'Password must be at least 6 characters long and contain at least one uppercase letter.'];
            }

            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $updateSuccess = $this->userModel->update(
            $data['username'],
            $data['email'],
            $hashedPassword,
            $data['notify_comments'],
        );

        if ($updateSuccess) {
            return ['success' => true];
        } else {
            return ['success' => false, 'message' => 'Failed to update user profile.'];
        }
    }

    public function storeResetToken($userId, $token)
    {
        $this->userModel->storeResetToken($userId, $token);
    }

    public function getUserByToken($token)
    {
        if (empty($token)) {
            return null;
        }

        $user = $this->userModel->findByToken($token);
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    public function updatePassword($userId, $hashedPassword)
    {
        $this->userModel->updatePassword($userId, $hashedPassword);
    }

    public function clearResetToken($userId)
    {
        $this->userModel->clearResetToken($userId);
    }



}