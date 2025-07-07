
<style>
    .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        height: 80px;
        padding: 0px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .navbar .logo {
        font-size: 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        color: black;
    }

    .navbar .logout-btn {
        padding: 0.5rem 1rem;
        background:rgba(141, 141, 141, 0.86);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 0.9rem;
        font-weight: 600;
        cursor: pointer;
    }

    .navbar .logout-btn:hover {
        background: rgba(176, 176, 176, 0.86);
    }

    .navbar .nav-links form span{
        margin-right: 10px;
        font-size: 1rem;
        color: black;
    }

    .navbar .nav-links form{
        display: flex !important;
        align-items: center;
    }

    @media (max-width: 624px) {
        .navbar {
            padding: 0px 10px;
        }

        .navbar .logo {
            font-size: 1rem;
        }
    }
</style>

<nav class="navbar">
    <a href="/view/home.php" class="logo">Camargu</a>
    <div class="nav-links">
        <?php if (isset($_SESSION["user_profile"]['username'])): ?>
            <form action="/view/logout.php" method="POST" style="display: inline;">
                <span><?php echo htmlspecialchars($_SESSION['user_profile']['username'] ) ?></span>
                <button type="submit" class="logout-btn">Log Out</button>
            </form>
        <?php endif; ?>
    </div>
</nav>