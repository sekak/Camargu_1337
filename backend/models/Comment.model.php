<?php
require_once __DIR__ . '/../config/session.php';

class Comment_model
{
    private $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }


    public function get_comments($postId)
    {
        // Fetch comments for a specific post and order them by creation date and username and email and img
        $stmt = $this->db->prepare("
            SELECT c.id, c.comment, c.created_at, u.username, u.email
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.post_id = ?
            ORDER BY c.created_at DESC, u.username ASC, u.email ASC
        ");
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add_comment($postId, $userId, $comment)
    {
        $stmt = $this->db->prepare("INSERT INTO comments (post_id, user_id, comment) VALUES (?, ?, ?)");
        return $stmt->execute([$postId, $userId, $comment]);
    }
}