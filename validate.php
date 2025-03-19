<?php
require_once 'query.php';
class validate extends query {
    public function login($email, $password) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION["user"] = $user["name"];
            $_SESSION["image"] = isset($user["image"]) ? $user["image"] : "default.jpg";
            header("Location: allusers.php");
            exit(); 
        } else {
            echo "Invalid credentials";
        }
    }
    public function logout() {
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>