<?php
require_once __DIR__ . '/../controllers/User.controller.php';

header('Content-Type: application/json');

$userController = new User_controller();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $notify_comments = $_POST['notify_comments'];

    if (empty($username) || empty($email)) {
        echo json_encode(['success' => false, 'message' => 'Username and email are required.']);
        exit;
    }

    $data = [
        'username' => $username,
        'email' => $email,
        'notify_comments' => $notify_comments,
        'password' => $password,
    ];

    $result = $userController->updateUserProfile($data);

    if ($result['success']) {
        $_SESSION['user_profile']['username'] = $username;
        $_SESSION['user_profile']['email'] = $email;
        $_SESSION['user_profile']['notify_comments'] = $notify_comments;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => $result['message'] ?? 'Update failed']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit;
