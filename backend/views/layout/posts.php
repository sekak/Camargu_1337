<?php
require_once __DIR__ . '/../../controllers/Post.controller.php';

$postController = new Post_controller();
$posts = $postController->index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camargu - Feed</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="/public/posts.css" rel="stylesheet">
    <link href="/public/sidebar.css" rel="stylesheet">
    <link href="/public/navbar.css" rel="stylesheet">
</head>

<body>
    <div class="main-content">
        <h2>CAMARGU FEED</h2>

        <div class="feed-items">
            <?php if (empty($posts)): ?>
                <div class="feed-item">
                    <p>No posts available.</p>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post-container">
                        <div class="post-header">
                            <img src="https://picsum.photos/600/400?random=3" alt="Avatar" class="avatar">
                            <div class="user-info">
                                <p class="username"><?php echo htmlspecialchars($post['username']) ?></p>
                                <p class="email"><?php echo htmlspecialchars($post['email']) ?></p>
                            </div>
                        </div>
                        <div class="post-content">
                            <a href="/views/layout/post.php?post_id=<?php echo $post['id']; ?>">
                                <img src="https://picsum.photos/600/400?random=3" alt="Post Image">
                            </a>                        </div>
                        <div class="post-footer">
                            Posted on <?php echo htmlspecialchars(date('F j, Y g:i A', strtotime($post['created_at']))) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- Pagination -->
        <div class="pagination">
            <button disabled>Previous</button>
            <button class="active">1</button>
            <button>2</button>
            <button>3</button>
            <button>Next</button>
        </div>
    </div>
</body>

</html>