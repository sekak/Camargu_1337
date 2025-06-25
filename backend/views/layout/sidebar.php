<?php
session_start(); // Ensure session is started
if (isset($_SESSION["user_profile"]["username"])) : ?>
    <aside class="sidebar">
        
        <div class="user-info">
            <h3>User Profile</h3>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION["user_profile"]["username"]); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION["user_profile"]["email"]); ?></p>
        </div>
    </aside>
<?php endif; ?>