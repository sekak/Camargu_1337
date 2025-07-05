<?php
// include_once __DIR__ . "../controllers/Post.controller.php" ;
include_once __DIR__ . "../config/setup.php";
// $postController = new Post_controller();
// $posts = $postController->index();


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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
        }

        .home {
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
            margin-top: 80px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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

        .posts-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        .post-container {
            width: 300px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(16, 39, 255, 0.42);
            margin: 20px;
            overflow: hidden;
            transition: transform 0.3s ease;
            padding: 10px;
        }

        .post-container .post-header {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 10px
        }

        .post-container .post-header .username {
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .post-container .post-header .email {
            color: #666;
            margin: 0;
        }

        .post-container .post-header img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .post-container .post-content img {
            width: 100%;
            max-height: 200px;
            overflow: hidden;
            object-fit: cover;
            border-radius: 5px;
        }

        .post-container .post-footer {
            padding: 10px 0px 0px;
            font-size: 14px;
            color: #666;
        }

        .btn-create{
            color: black;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            border: 1px solid gray;
            padding: 8px;
            margin-top:10px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <?php include_once __DIR__ ."/includes/navbar.php" ?>

    <!-- Page Layout -->
    <main class="home">
        <!-- Sidebar -->
        <div class="sidebar_home">
        <?php include_once __DIR__ ."/includes/sidebar.php" ?>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="posts-container">
                <?php if (empty($posts)): ?>
                    <div style="display:flex;flex-direction:column;align-items:center;">
                        <p>No posts available.</p>
                        <a href='/view/gallery.php' class='btn-create'>Create one</a>
                    </div>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <!-- Post -->
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
                                <a href="/view/post.php?post_id=<?php echo $post['id']; ?>">
                                    <img src="https://picsum.photos/600/400?random=3" alt="Post Image" />
                                </a>
                            </div>

                            <!-- Post Footer -->
                            <div class="post-footer">
                                Posted on <?php echo htmlspecialchars(date('F j, Y g:i A', strtotime($post['created_at']))); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                </div>
                <!-- Pagination (Static) -->
                <?php include_once __DIR__ ."/includes/pagination.php" ?>
                <?php endif; ?>
            </div>
    </main>

    <!-- Footer -->
    <footer style="text-align:center; padding:1rem; background:#eee;">Footer</footer>

</body>

</html>