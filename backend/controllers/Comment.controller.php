<?php 

require_once __DIR__ . '/../models/Comment.model.php';
require_once __DIR__ . '/../config/database.php';

class Comment_controller {


    private $commentModel;
    public function __construct() {
        $db = (new Database())->getConnection();
        $this->commentModel = new Comment_model($db);
    }

    public function getComments($postId) {
        return $this->commentModel->get_comments($postId);
    }

    public function addComment($postId, $userId, $comment) {
        return $this->commentModel->add_comment($postId, $userId, $comment);
    }
}