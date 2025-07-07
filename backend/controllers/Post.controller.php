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

    public function createPost($image_url)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }
        $user_id = $_SESSION['user_profile']['id'] ?? null;

        if (!$user_id) {
            $_SESSION['errors'] = "You must be logged in to create a post.";
            header('Location: /view/login/login.php');
            return;
        }

        $this->postModel->create($user_id, $image_url);
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

    public function getPostsByUserId()
    {
        if (!isset($_SESSION['user_profile'])) {
            header('Location: /views/layout/login.php');
            return;
        }

        $user_id = $_SESSION['user_profile']['id'];
        return $this->postModel->getPostsByUserId($user_id);
    }

    public function deletePost($post_id)
    {
        if (!isset($_SESSION['user_profile'])) {
            header('Location: /view/login.php');
            exit;
        }

        $user_id = $_SESSION['user_profile']['id'];
        $post = $this->postModel->getPostById($post_id);

        if (!$post || $post['user_id'] !== $user_id) {
            $_SESSION['errors'] = "You do not have permission to delete this post.";
            return;
        }

        // Delete comments
        $stmtComments = $this->db->prepare("DELETE FROM comments WHERE post_id = ?");
        $stmtComments->execute([$post_id]);

        // Delete likes
        $stmtLikes = $this->db->prepare("DELETE FROM likes WHERE post_id = ?");
        $stmtLikes->execute([$post_id]);

        // Then delete the post
        $stmtPost = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        $stmtPost->execute([$post_id]);

        $_SESSION['success'] = "Post deleted successfully!";
    }

}