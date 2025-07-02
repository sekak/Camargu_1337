<?php
require_once __DIR__ . '/../../controllers/Post.controller.php';

$postController = new Post_controller();
$posts = $postController->index();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Camargu - Feed</title>

    <!-- Font Awesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-y..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Custom Styles -->
    <link href="/public/posts.css" rel="stylesheet" />
    <link href="/public/navbar.css" rel="stylesheet" />
</head>

<body>
    <div class="main-content">
        <!-- Sidebar Navigation -->
        <?php include_once __DIR__ .'/sidebar.php';?>

        <!-- Feed Content -->
        <div class="content">
            <div class="feed-items">
                <?php if (empty($posts)): ?>
                    <div class="feed-item">
                        <p>No posts available.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="post-container">
                            <!-- Post Header -->
                            <div class="post-header">
                                <img src="https://picsum.photos/600/400?random=3" alt="Avatar" class="avatar" />
                                <div class="user-info">
                                    <p class="username"><?php echo htmlspecialchars($post['username']); ?></p>
                                    <p class="email"><?php echo htmlspecialchars($post['email']); ?></p>
                                </div>
                            </div>

                            <!-- Post Image -->
                            <div class="post-content">
                                <a href="/views/layout/post.php?post_id=<?php echo $post['id']; ?>">
                                    <img src="https://picsum.photos/600/400?random=3" alt="Post Image" />
                                </a>
                            </div>

                            <!-- Post Footer -->
                            <div class="post-footer">
                                Posted on <?php echo htmlspecialchars(date('F j, Y g:i A', strtotime($post['created_at']))); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pagination (Static) -->
            <div class="pagination">
                <button disabled>Previous</button>
                <button class="active">1</button>
                <button>2</button>
                <button>3</button>
                <button>Next</button>
            </div>
        </div>
    </div>
</body>

</html>
