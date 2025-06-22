<?php
class Model {
    protected $db;
    private $host = 'localhost:3306';
    private $username = 'root';
    private $password = 'root';
    private $db_name  = 'crud_barang';

    public function __construct() {
        $this->db = $this->connect(); // ✅ Automatically set $db
    }

    public function connect() {
        $conn = new PDO("mysql:host=localhost;dbname=crud_barang;charset=binary", $this->username, $this->password);

        $conn = null;
        try {
            $conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $conn;
    
    }

    protected function getActiveAccountId() {
        if(session_status() === PHP_SESSION_NONE) session_start();
        return $_SESSION['active_account_id'] ?? null;
    }
}
