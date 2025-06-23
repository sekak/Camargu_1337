<button

<?php 
    session_start();
    session_destroy();
    header(header: "Location: /views/layout/login.php");
    exit;
?>
