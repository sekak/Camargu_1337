<?php
require_once __DIR__ . '/../config/session.php';

class Like_model 
{
    private $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function deleteLike($userId, $postId)
    {
        $stmt = $this->db->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?");
        $stmt->execute([$userId, $postId]);
    }

    public function add_like($userId, $postId)
    {
        // Check if the like already exists
        $stmt = $this->db->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
        $stmt->execute([$userId, $postId]);
        $existingLike = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existingLike) {
            // If the like exists, remove it
            $this->deleteLike($userId, $postId);
        } else {
            // If the like does not exist, add a new like
            $stmt = $this->db->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
            $stmt->execute([$userId, $postId]);
        }
    }

    public function countLike($postId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM likes WHERE post_id = ?");
        $stmt->execute([$postId]);
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
    
    public function getLikeByUserAndPost($userId, $postId)
    {
        $stmt = $this->db->prepare("SELECT * FROM likes WHERE user_id = ? AND post_id = ?");
        $stmt->execute([$userId, $postId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}