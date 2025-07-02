<?php

require_once __DIR__ . '/../models/Post.model.php';
require_once __DIR__ . '/../config/database.php';

class Post_controller
{

    private $db;
    private $user;
    private $postModel;


    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->postModel = new Post($this->db);
    }

    public function createPost()
    {
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

    public function index()
    {
        if (!isset($_SESSION['user_profile'])) {
            header('Location: /views/layout/login.php');
            return;
        }

        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        $limit = 5;
        $offset = ($page - 1) * $limit;

        $counts = $this->postModel->countAllPosts();
        if ($counts === 0) {
            return []; // No posts available
        }
        $total_pages = ceil($counts / $limit);
        $_SESSION['total_pages'] = $total_pages;

        return $this->postModel->getAllPosts($limit, $offset);
    }

    public function ShowPost($post_id)
    {
        if (!isset($_SESSION['user_profile'])) {
            header('Location: /views/layout/login.php');
            return;
        }

        $post = $this->postModel->getPostById($post_id);
        if (!$post) {
            header('Location: /index.php');
            return;
        }
        return $post;
    }
}