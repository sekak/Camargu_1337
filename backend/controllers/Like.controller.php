<?php 
require_once __DIR__ . '/../models/Like.model.php';
require_once __DIR__ . '/../config/database.php';

class Like_controller{

    private $like_model;

    public function __construct(){
        $db = (new Database())->getConnection();
        $this->like_model = new Like_model($db);
    }

    public function index($postId){
        $userId = $_SESSION['user_profile']['id'] ?? null;
        if (!$userId || !$postId) {
            return;
        }
        
        $stmt = $this->like_model->countLike($postId);
        $total_likes = (int) $stmt;
        
        $stmt = $this->like_model->getLikeByUserAndPost($userId, $postId);
        $liked = $stmt ? true : false;
        
        return [
            'total_likes' => $total_likes,
            'liked' => $liked
        ];
    }

    public function addLike($postId){
        $userId = $_SESSION['user_profile']['id'] ?? null;
      
        if (!$userId || !$postId) {
            return;
        }

        $this->like_model->add_like($userId, $postId);
    }

}