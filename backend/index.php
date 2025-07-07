<?php
require_once __DIR__ .'/utils/authMiddleware.php';
redirectIfAuthenticated();
?>

<?php require_once './config/setup.php'; ?>
<?php require_once __DIR__ . '/view/register.php';?>