<form action="" method="POST">
  <input type="text" name="username" placeholder="Username" required />
  <input type="email" name="email" placeholder="Email" required />
  <input type="password" name="password" placeholder="Password" required />
  <button type="submit">Register</button>
</form>

<?php
  require_once '../../controllers/AuthController.php';
  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Processing registration...";
    $controller = new AuthController();
    $controller->register();
}
  
