<?php
session_start();
require_once 'query.php';

if (isset($_GET['id'])) {
    $user = new query();
    $user->deleteUser($_GET['id']);
    header("Location: allusers.php");
    exit();
} else {
    echo "Invalid request!";
}
