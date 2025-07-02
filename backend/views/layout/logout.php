<button

<?php 
    require_once __DIR__ . '/../config/session.php';
    session_destroy();
    header(header: "Location: /views/layout/login.php");
    exit;
?>
