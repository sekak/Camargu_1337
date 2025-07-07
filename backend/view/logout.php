<button

<?php 
    require_once __DIR__ . '/../config/session.php';
    session_destroy();
    header(header: "Location: /view/login.php");
    exit;
?>
