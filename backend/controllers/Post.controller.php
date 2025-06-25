

<?php

require_once __DIR__ . '/../models/Post.model.php';
require_once __DIR__ .'/../config/database.php';

class  Post_controller {

    private $db;
    private $user;
    private $postModel;


    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->postModel = new Post($this->db);
    }

    public function createPost() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $title = $_POST['title'] ?? '';
        $body = $_POST['body'] ?? '';
        $user_id = $_SESSION['user_id'] ?? null;

        if (empty($title) || empty($body)) {
            $_SESSION['errors'] = "Title and body are required.";
            return;
        }

        if (!$user_id) {
            $_SESSION['errors'] = "You must be logged in to create a post.";
            header('Location: /views/layout/login.php');
            return;
        }

        $this->postModel->create($title, $body, $user_id);
        $_SESSION['success'] = "Post created successfully!";
    }

    public function index() {
        session_start();
        if(!isset($_SESSION['user_profile'])) {
            header('Location: /views/layout/login.php');
            return;
        }
        return  $this->postModel->getAllPosts();
    }

    public function ShowPost($post_id) {
        session_start();
        if (!isset($_SESSION['user_profile'])) {
            echo "You must be logged in to view posts." . $_SESSION['user_profile']['username'] ?? '';
            header('Location: /views/layout/login.php');
            return;
        }

        $post = $this->postModel->getPostById($post_id);
        if (!$post) {
            // $_SESSION['errors'] = "Post not found.";
            header('Location: /index.php');
            return;
        }
        return $post;
    }
}