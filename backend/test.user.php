<?php
require_once './config/database.php';

$database = new Database();
$db = $database->getConnection();

try {
    // Insert a new user (example)
    $stmt = $db->prepare("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
    $stmt->execute([
        ':username' => 'ahmed',
        ':password' => password_hash('ahmed', PASSWORD_DEFAULT),  // hashed password
        ':email' => 'ahmedsekak@gmail.com',
    ]);
    echo "User inserted successfully.\n";

    // Fetch users
    $stmt = $db->query("SELECT * FROM users");
    $users = $stmt->fetchAll();

    echo "Users in database:\n";
    print_r($users);

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}