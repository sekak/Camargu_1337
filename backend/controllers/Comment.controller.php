<?php

require_once __DIR__ . '/../models/Comment.model.php';
require_once __DIR__ . '/../models/Mail.model.php';
require_once __DIR__ . '/../config/database.php';

class Comment_controller
{


    private $commentModel;
    private $db;
    private $mailModel;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->commentModel = new Comment_model($this->db);
        $this->mailModel = new Mail_model();
    }

    public function getComments($postId)
    {
        return $this->commentModel->get_comments($postId);
    }

    public function addComment($postId, $comment)
    {
        $userId = $_SESSION['user_profile']['id'] ?? null;

        if (!$userId || !$postId || empty($comment)) {
            return false; // Invalid input
        }

        // 1️⃣ Add the comment
        $this->commentModel->add_comment($postId, $userId, $comment);

        // 2️⃣ Get post owner's ID
        $stmt = $this->db->prepare("SELECT user_id FROM posts WHERE id = ?");
        $stmt->execute([$postId]);
        $postOwnerId = $stmt->fetchColumn();

        if (!$postOwnerId) {
            return false; // Post not found
        }
        // 3️⃣ Get post owner's email and notification preference
        $stmt = $this->db->prepare("SELECT email, notify_comments FROM users WHERE id = ?");
        $stmt->execute([$postOwnerId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['notify_comments']) {
            // 4️⃣ Send notification email
            $this->mailModel->sendNotificationEmail($user['email'], $comment);
        }

        return true;
    }

}