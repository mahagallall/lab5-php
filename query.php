<?php
require_once 'config.php';

class query {
    protected $pdo;
    public function __construct() {
        $this->pdo = config::getInstance()->getConnection(); 
    }
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function createUser($name, $email, $password, $room, $imagePath) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, room, image_path ) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$name, $email, $hashed_password, $room, $imagePath]);
    }
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function updateUser($id, $name, $email, $room) {
        $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ?, room = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $room, $id]);
    }
}
