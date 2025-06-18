<?php 
// This file is used to set up tables and initial data

require_once './config/database.php';

$database = new Database();
$db = $database->getConnection();

try {
    $q = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
    ";

    $db->exec($q);
    echo "Users table created successfully.\n";

} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}