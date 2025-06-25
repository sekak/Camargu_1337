<?php

class Post
{
    private $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function create(string $title, string $body, int $user_id)
    {
        $stmt = $this->db->prepare("INSERT INTO posts (title, body, user_id) VALUES VALUES (?, ?, ?)");
        $stmt->execute([
            $title,
            $body,
            $user_id
        ]);

    }
    public function getAllPosts()
    {
        $stmt = $this->db->query("SELECT posts.*, users.username, users.email FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPostById($post_id)
    {
        $stmt = $this->db->prepare("SELECT posts.*, users.username, users.email FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
        $stmt->execute([$post_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

