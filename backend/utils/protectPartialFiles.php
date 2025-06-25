<?php 

function protectPartialFiles(string $realpath) {
    if($realpath === realpath($_SERVER['SCRIPT_FILENAME'])) {
        header('Location: /index.php');
        exit;
    }
}