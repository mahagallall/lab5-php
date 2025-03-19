<?php
session_start();
require_once 'query.php';
$user = new query();
$users = $user->getAllUsers();
?>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Room</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?php echo $u['name']; ?></td>
            <td><?php echo $u['email']; ?></td>
            <td><?php echo $u['room']; ?></td>
            <td><img src='<?php echo $u["image"]; ?>' width="50"></td>
            <td>
                <a href="edit.php?id=<?php echo $u['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $u['id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>