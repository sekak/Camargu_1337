<?php
require_once __DIR__ . '/../../controllers/Post.controller.php';
require_once __DIR__ . '/../../controllers/Comment.controller.php';

if (!isset($_GET['post_id']) || !is_numeric($_GET['post_id'])) {
  echo "Invalid post ID.";
  exit;
}

$postId = $_GET["post_id"];
$postController = new Post_controller();
$post = $postController->ShowPost($postId);

$commentController = new Comment_controller();
$comments = $commentController->getComments($postId);

// Add comment
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['comment'])) {
  $commentController->addComment(
    $postId,
    $_SESSION['user_profile']['id'],
    $_POST['comment']
  );
  header("Location: post.php?post_id=" . $postId);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo htmlspecialchars($post['title']); ?> - Camargu</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-y..." crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />

  <!-- Custom Styles -->
  <link href="/public/post.css" rel="stylesheet" />
  <link href="/public/navbar.css" rel="stylesheet" />
</head>
<style>
  * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
    font-family: 'Poppins', sans-serif;
  }

  body {
    background: linear-gradient(135deg, #f2f9ff, #ffe9f0);
    color: #333;
    padding: 2rem;
  }

  .post-page {
    max-width: 800px;
    margin: 90px auto;
    background: #fff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }

  .post-page h2 {
    font-size: 2rem;
    color: rgba(141, 141, 141, 0.86);
    margin-bottom: 0.5rem;
  }

  .post-page p {
    font-size: 1rem;
    margin: 0.3rem 0;
  }

  .post-content {
    margin-top: 1.5rem;
  }

  .post-content img {
    width: 100%;
    border-radius: 8px;
    margin-bottom: 1rem;
  }

  .post-content p {
    font-size: 1.1rem;
    line-height: 1.6;
    color: #444;
  }

  form {
    margin-top: 1.5rem;
  }

  textarea {
    width: 100%;
    padding: 0.8rem;
    font-size: 1rem;
    border-radius: 8px;
    border: 1px solid #ccc;
    resize: vertical;
    margin-bottom: 0.8rem;
  }

  button {
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
    background: #61abfa;
  }

  hr {
    margin: 2rem 0;
    border: none;
    height: 1px;
    background-color: #ddd;
  }

  .comments {
    margin-top: 1rem;
  }

  .comment {
    background: #f7f7f7;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1rem;
    border-left: 5px solid rgba(141, 141, 141, 0.86);
  }

  .comment strong {
    color: rgba(141, 141, 141, 0.86);
    display: block;
    margin-bottom: 0.3rem;
  }
</style>

<body>
  <?php require_once __DIR__ . '/navbar.php'; ?>

  <div class="post-page">
    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
    <p>
      By <?php echo htmlspecialchars($post['username']); ?> |
      <?php echo htmlspecialchars(date('F j, Y g:i A', strtotime($post['created_at']))); ?>
    </p>

    <div class="post-content">
      <img src="https://picsum.photos/seed/<?php echo $post['id']; ?>/800/400" alt="Post Image">
      <p><?php echo nl2br(htmlspecialchars($post['body'])); ?></p>
    </div>

    <!-- Like Button -->
    <form method="POST" action="/actions/like_post.php">
      <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
      <button type="submit">❤️ Like (<?php echo $post['likes'] ?? 0; ?>)</button>
    </form>

    <!-- Comments Section -->
    <hr>
    <h3>Comments</h3>
    <form method="POST">
      <textarea name="comment" required placeholder="Add a comment..." rows="3" style="width:100%"></textarea><br>
      <button type="submit">Post Comment</button>
    </form>

    <div class="comments">
      <?php foreach ($comments as $comment): ?>
        <div class="comment">
          <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
          <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>

</html>