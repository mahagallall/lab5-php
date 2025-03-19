<?php
class config {
    private static $instance = null;
    private $pdo;
    private function __construct() {
        $username = 'root';
        $password = 'maha@147';
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=php5", $username, $password);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new config();
        }
        return self::$instance;
    }
    public function getConnection() {
        return $this->pdo;
    }
}
