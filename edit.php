<?php
session_start();
require_once 'query.php';
$userObj = new query();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $user = $userObj->getUserById($_GET['id']); 

    if (!$user) {
        die("User not found.");
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $room = $_POST['room'];

    $userObj->updateUser($id, $name, $email, $room);
    header("Location: allusers.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>

    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">

        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" required><br>

        <label>Room:</label><br>
        <select name="room">
            <option value="1" <?php echo ($user && $user['room'] == '1') ? 'selected' : ''; ?>>1</option>
            <option value="2" <?php echo ($user && $user['room'] == '2') ? 'selected' : ''; ?>>2</option>
            <option value="3" <?php echo ($user && $user['room'] == '3') ? 'selected' : ''; ?>>3</option>
        </select><br><br>

        <button type="submit">Update</button>
    </form>

    <p><a href="allusers.php">Back to Users List</a></p>
</body>
</html>
