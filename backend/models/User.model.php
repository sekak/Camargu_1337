<?php
require_once __DIR__ . '/../config/session.php';

class User
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create($username, $email, $hashedPassword, $token)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, token, notify_comments) VALUES (?, ?, ?, ?, ?)");
        $notify_comments = 1; // Default value for notify_comments
        return $stmt->execute([$username, $email, $hashedPassword, $token, $notify_comments]);
    }

    public function verifyToken($token)
    {
        $stmt = $this->db->prepare("UPDATE users SET is_verified = 1, token = NULL WHERE token = ?");
        return $stmt->execute([$token]);
    }

    public function findByEmail($email, $withPassword = false)
    {
        $query = "SELECT * FROM users WHERE email = ?";
        if (!$withPassword) {
            $query .= " AND password IS NOT NULL";
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(mode: PDO::FETCH_ASSOC);
        if ($user && $withPassword && isset($user['password'])) {
            unset($user['password']);
        }
        return $user;
    }

    public function findByUsername($username, $withPassword = false)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        if (!$withPassword) {
            $query .= " AND password IS NOT NULL";
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch(mode: PDO::FETCH_ASSOC);
        if ($user && $withPassword && isset($user['password'])) {
            unset($user['password']);
        }
        return $user;
    }

    public function update($username, $email, $hashedPassword, $notify_comments)
    {
        $currentEmail = $_SESSION['user_profile']['email'];
        $stmt = $this->db->prepare("UPDATE users SET username = ?, email = ?, password = ?, notify_comments = ? WHERE email = ?");
        return $stmt->execute([$username, $email, $hashedPassword, $notify_comments, $currentEmail]);
    }

    public function storeResetToken($userId, $token)
    {
        $stmt = $this->db->prepare("UPDATE users SET reset_token = ?, reset_expires = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE id = ?");
        $stmt->execute([$token, $userId]);
    }

    public function updatePassword($userId, $hashedPassword)
    {
        $stmt = $this->db->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$hashedPassword, $userId]);
    }

    public function clearResetToken($userId)
    {
        $stmt = $this->db->prepare("UPDATE users SET reset_token = NULL, reset_expires = NULL WHERE id = ?");
        $stmt->execute([$userId]);
    }

    public function findByToken($token)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE reset_token = ? AND reset_expires > NOW()");
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
