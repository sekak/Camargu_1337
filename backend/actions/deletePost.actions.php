<?php 
include_once __DIR__ . '/../controllers/Post.controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postController = new Post_controller();
    $post_id = $_POST['id'] ?? null;
    
    if ($post_id) {
        $postController->deletePost($post_id);
        $_SESSION['success'] = "Post deleted successfully!";
        echo json_encode(['success' => true]);
    } else {
        $_SESSION['errors'] = "Post ID is required.";
        echo json_encode(['success' => false, 'message' => 'Post ID is required.']);
    }
} else {
    $_SESSION['errors'] = "Invalid request method.";
}

?>

