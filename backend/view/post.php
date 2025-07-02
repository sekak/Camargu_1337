<?php
require_once __DIR__ . '/../config/session.php';
include_once("../controllers/Comment.controller.php");
include_once("../controllers/Post.controller.php");
include_once("../controllers/Like.controller.php");

if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
    $postId = $_GET["post_id"];
} else {
    die("Invalid post ID.");
}

$postController = new Post_controller();
$post = $postController->ShowPost($postId);

$commentController = new Comment_controller();
$comments = $commentController->getComments($postId);

$likeController = new Like_controller();
$likeData = $likeController->index($postId);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comment']) && !empty($_POST['comment'])) {
        $commentController->addComment($postId, $_POST['comment']);
        header("Location: /view/post.php?post_id=$postId");
        exit;
    }

    if (isset($_POST['like'])) {
        $likeController->addLike($postId);
        header("Location: /view/post.php?post_id=$postId");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- Font Awesome (Icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-y..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
    <script>
        function toggleComments() {
            const commentsSection = document.getElementById('comments');
            const button = document.getElementById('btn-comments')

            if (commentsSection.style.display === 'none' || commentsSection.style.display === '') {
                commentsSection.style.display = 'block';
                button.textContent = 'Hide';
            } else {
                commentsSection.style.display = 'none';
                button.textContent = 'Show';
            }
        }

        // check if likeController['liked'] is true if so add class btn-liked to the button
        document.addEventListener('DOMContentLoaded', function () {
            const likeButton = document.getElementById('like-btn');
            if (<?php echo isset($likeData['liked']) && $likeData['liked'] ? 'true' : 'false'; ?>) {
                likeButton.style.backgroundColor = 'rgba(255, 0, 0, 0.5)';
                likeButton.textContent = '❤️ Liked ' + (<?php echo $likeData['total_likes'] ?? 0; ?>);
            } else {
                likeButton.textContent = '❤️ Like ' + (<?php echo $likeData['total_likes'] ?? 0; ?>);
            }
        }); 
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
        }

        .post {
            display: flex;
            min-height: 100vh;
        }

        .sidebar_home {
            width: 250px;
            padding: 20px;
        }

        .main-content {
            flex: 1;
            padding: 20px;
            background-color: rgba(197, 197, 197, 0.28);
            margin-top: 80px;
        }

        @media (max-width: 920px) {
            .sidebar_home {
                width: 150px;
            }
        }

        @media (max-width: 624px) {
            .sidebar_home {
                width: 50px;
            }
        }

        .post-page {
            height: calc(100vh - 120px);
            display: flex;
            margin: 0 auto;
            background: #fff;
            padding: 3rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .post-page .post-img {
            flex: 1;
            margin-right: 2rem;
            height: 100%;
        }

        .post-page .post-img img {
            width: 100%;
            height: 100%;
            border-radius: 10px;
            object-fit: cover;
        }

        .post-page .post-info {
            flex: 1;
            font-size: 1.2rem;
            color: #333;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .post-info-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .post-info-header button {
            padding: 0.6rem 1.2rem;
            background: rgba(141, 141, 141, 0.86);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: rgba(176, 176, 176, 0.86);
        }

        .post-info-header .avatar {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .post-info-header .avatar img {
            width: 45px;
            height: 45px;
            border-radius: 50%;
        }

        .avatar .avatar-info {
            display: flex;
            flex-direction: column;
        }

        .avatar .avatar-info h3 {
            margin: 0;
            font-size: 1.5rem;
        }

        .avatar .avatar-info p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }

        .post-comments {
            height: 40%;
        }

        .post-comments-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            border-bottom: 1px solid #ddd;
            padding-bottom: 0.5rem;
        }

        .post-comments-header h4 {
            font-size: 16px;
            color: #333;
        }

        .post-comments-header button {
            padding: 0.4rem 1rem;
            background: transparent;
            border:1px solid rgba(0, 0, 0, 0.86);
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .post-comments-header button:hover {
            background: transparent;
            border:1px solid rgba(0, 0, 0, 0.86);
        }

        .post-comments ul {
            list-style: none;
            padding: 0px 20px;
            overflow-y: scroll;
            height: 100%;
        }

        .post-comments ul li {
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .post-comments ul li .info-user {
            display: flex;
            flex-direction: column;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .post-comments ul li p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .post-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 1.5rem;
            padding: 1rem;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .post-form .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .post-form .form-group label {
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }

        .post-form .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .post-form .form-group textarea:focus {
            outline: none;
            border-color: rgba(141, 141, 141, 0.86);
            box-shadow: 0 0 5px rgba(176, 176, 176, 0.86);
        }

        .post-form button {
            padding: 0.8rem 1.5rem;
            font-size: 15px;
            color: white;
            background: rgba(141, 141, 141, 0.86);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .post-form button:hover {
            background: rgba(176, 176, 176, 0.86);
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include_once("./includes/navbar.php"); ?>

    <!-- Page Layout -->
    <main class="post">
        <!-- Sidebar -->
        <div class="sidebar_home">
            <?php include_once("./includes/sidebar.php"); ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="post-page">
                <div class="post-img">
                    <img src="https://picsum.photos/600/400?random=3" alt="Post Image" />
                </div>
                <div class="post-info">
                    <div class="post-info-header">
                        <div class="avatar">
                            <img src="https://picsum.photos/50/50?random=1" alt="User Avatar" />
                            <div class="avatar-info">
                                <h3><?php echo htmlspecialchars($post['username']) ?></h3>
                                <p>Posted on: <span>
                                        <?php echo htmlspecialchars(date('F j, Y g:i A', strtotime($post['created_at']))); ?>
                                    </span></p>
                            </div>
                        </div>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="like" value="1">
                            <button id='like-btn' type="submit"></button>
                        </form>
                    </div>
                    <div class="post-comments">
                        <div class="post-comments-header">
                            <?php if (empty($comments)): ?>
                                <h4>No comments yet</h4>
                            <?php else: ?>
                                <h4><?php echo count($comments); ?> Comments</h4>
                                <button onclick="toggleComments()" id="btn-comments">Show</button>
                            <?php endif; ?>

                        </div>
                        <ul id="comments" style="display: none;">
                            <?php foreach ($comments as $comment): ?>
                                <li>
                                    <div class="info-user">
                                        <h3><?php echo nl2br(htmlspecialchars($comment['username'])) ?></h3>
                                        <span>
                                            <?php echo htmlspecialchars(date('F j, Y g:i A', strtotime($comment['created_at']))); ?>
                                        </span>
                                    </div>
                                    <p>
                                        <?php echo nl2br(htmlspecialchars($comment['comment'])) ?>
                                    </p>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <form class="post-form" action="" method="post">
                        <div class="form-group">
                            <label for="comment">Add a comment:</label>
                            <textarea name="comment" id="comment" rows="3"
                                placeholder="Write your comment here..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>

        </div>
    </main>

    <!-- Footer -->
    <footer style="text-align:center; padding:1rem; background:#eee;">Footer</footer>

</body>

</html>


