<?php
class Model {
    protected $db;
    public $conn;
    private $host = 'localhost:3306';
    private $username = 'root';
    private $password = 'root';
    private $db_name  = 'crud_barang';

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
