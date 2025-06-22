<?php
class Database
{
    private $host;
    private $db;
    private $user;
    private $pass;
    private $charset;

    public function __construct()
    {

        $this->host = getenv('DB_HOST');
        $this->db = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->pass = getenv('DB_PASS');
        $this->charset = "utf8mb4";
    }

    public function getConnection(): PDO
    {
        $host = $this->host;
        $db = $this->db;
        $user = $this->user;
        $pass = $this->pass;
        $charset = $this->charset;

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        // echo "Connecting to MariaDB at $dsn...\n";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;  // 🔴 Stop execution if database fails
        }
    }
}
