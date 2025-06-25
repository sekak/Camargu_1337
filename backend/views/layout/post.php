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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['comment']) {
  $commentController->addComment(
    $postId,
    $_SESSION['user_profile']['id']
    ,
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
  <title><?php echo htmlspecialchars($post['title']); ?> - Camargu</title>
  <link rel="stylesheet" href="/public/navbar.css">
  <link rel="stylesheet" href="/public/post.css">
</head>

<body>
  <?php require_once __DIR__ . '/navbar.php'; ?>
  <div class="post-page">
    <h2><?php echo htmlspecialchars($post['title']); ?></h2>
    <p>By <?php echo htmlspecialchars($post['username']); ?> |
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