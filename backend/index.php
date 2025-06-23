<?php
require_once './utils/authMiddleware.php';
redirectIfNotAuthenticated();
?>

<?php require_once './config/setup.php'; ?>
<?php require_once __DIR__ . '/views/layout/feed.php';?>