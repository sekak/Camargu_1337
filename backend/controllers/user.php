<?php
require_once './models/User.php';

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new User($db);
    }

    public function showUser($username)
    {
        $user = $this->userModel->getUserByUsername($username);
        if ($user) {
            require './views/index.php';
        } else {
            echo "User not found.";
        }
    }
}
