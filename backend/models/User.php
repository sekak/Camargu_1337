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
        $stmt = $this->db->prepare("INSERT INTO users (username, email, password, token) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$username, $email, $hashedPassword, $token]);
    }

    public function verifyToken($token)
    {
        $stmt = $this->db->prepare("UPDATE users SET is_verified = 1, token = NULL WHERE token = ?");
        return $stmt->execute([$token]);
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
