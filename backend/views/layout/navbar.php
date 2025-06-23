<?php

require_once __DIR__ . '/../../utils/protectPartialFiles.php';
protectPartialFiles(realpath(__FILE__));
$username = $_SESSION['user_profile']['username'] ?? 'Guest';
?>


<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    /* Import Google Font */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

    /* Navbar styling */
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .navbar .logo {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2E8B57;
        /* Sea green */
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
    }

    .navbar .logout-btn {
        padding: 0.5rem 1rem;
        background: #2E8B57;
        /* Sea green */
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }

    .navbar .logout-btn:hover {
        background: #228B22;
        /* Forest green */
        transform: translateY(-2px);
    }

    .navbar .logout-btn:active {
        transform: translateY(0);
    }
</style>

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