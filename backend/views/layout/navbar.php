<?php
require_once __DIR__ . '/../../utils/protectPartialFiles.php';
protectPartialFiles(realpath(__FILE__));
$username = $_SESSION['user_profile']['username'] ?? 'Guest';
?>

<nav class="navbar">
    <a href="index.php" class="logo">Camargu</a>
    <h2></h2>
    <div class="nav-links">
        <?php if (isset($_SESSION["user_profile"]['username'])): ?>
            <form action="/views/layout/logout.php" method="POST" style="display: inline;">
                <span><?= $username ?></span>
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        <?php endif; ?>
    </div>
</nav>