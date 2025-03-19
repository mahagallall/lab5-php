<?php
session_start();
require_once 'validate.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auth = new validate();
    $auth->login($_POST["email"], $_POST["password"]);
}
?>
<form method="post">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
<p>Don't have an account? <a href="register.php">Register here</a></p>
