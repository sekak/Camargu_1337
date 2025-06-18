<?php

require_once './config/setup.php';
require_once './controllers/user.php';
require_once './test.user.php';

$database = new Database();
$db = $database->getConnection();

$controller = new UserController($db);
$controller->showUser("ahmed");