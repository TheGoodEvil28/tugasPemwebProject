<?php
class Model {
    protected $db;

    public function __construct() {
        $hostname = 'localhost:3307';
        $username = 'root';
        $password = '';
        $dbname   = 'thriftin2';

        $this->db = new mysqli($hostname, $username, $password, $dbname);

        if ($this->db->connect_error) {
            die('Database error: ' . $this->db->connect_error);
        }

        $this->db->set_charset('utf8');
    }

    public function getConnection() {
        return $this->db;
    }

    protected function getActiveAccountId() {
        if(session_status() === PHP_SESSION_NONE) session_start();
        return $_SESSION['active_account_id'] ?? null;
    }
}