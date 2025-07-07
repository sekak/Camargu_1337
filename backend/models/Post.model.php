<?php
require_once __DIR__ . '/../config/session.php';

class Post
{
    private $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function create($user_id, $image_url)
    {

        try {
            $stmt = $this->db->prepare("INSERT INTO posts (user_id, image_url) VALUES (?, ?)");
            $stmt->execute([
                $user_id,
                $image_url,
            ]);
            echo "Creating post...";
        } catch (PDOException $e) {
            echo "Error creating post: " . $e->getMessage();
        }

    }
    public function getAllPosts($limit = 5, $offset = 0)
    {
        $stmt = $this->db->prepare("
            SELECT posts.*, users.username, users.email 
            FROM posts 
            JOIN users ON posts.user_id = users.id 
            ORDER BY created_at DESC 
            LIMIT :limit OFFSET :offset
        ");

        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPostById($post_id)
    {
        $stmt = $this->db->prepare("SELECT posts.*, users.username, users.email FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
        $stmt->execute([$post_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function countAllPosts()
    {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM posts");
        return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getPostsByUserId($user_id)
    {
        $stmt = $this->db->prepare("SELECT posts.*, users.username, users.email FROM posts JOIN users ON posts.user_id = users.id WHERE posts.user_id = ? ORDER BY posts.created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

