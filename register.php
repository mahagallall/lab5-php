<?php
session_start();
require_once 'query.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new query();   
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);
    $room = $_POST["room"];
    $profile_pic = $_FILES["profile_pic"];

    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
    } else {
        $file_name = $name . "." . pathinfo($profile_picture["name"], PATHINFO_EXTENSION);
        $file_path = "upload/" . $file_name;
        move_uploaded_file($profile_picture["tmp_name"], $file_path);
        
        $user->createUser($name, $email, $password, $room, $file_path);
        $_SESSION["user"] = $name;
        $_SESSION["image"] = $file_path;

        header("Location: allusers.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(-45deg,rgb(240, 217, 217),rgb(139, 120, 115),rgb(226, 182, 186),rgb(138, 92, 101));
            background-size: 400% 400%;
            animation: gradientAnimation 8s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            backdrop-filter: blur(12px);
        }
        h2 {
            color: #444;
            font-size: 24px;
            margin-bottom: 20px;
        }
        label {
            font-weight: 600;
            display: block;
            margin-top: 12px;
            text-align: left;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            border: 1px solid #bbb;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
        }
        input:focus, select:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            outline: none;
        }
        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        button {
            padding: 14px;
            width: 48%;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s;
        }
        .submit-btn {
            background: linear-gradient(135deg, #28a745, #218838);
            color: white;
        }
        .submit-btn:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
        }
        .reset-btn {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
        }
        .reset-btn:hover {
            background: linear-gradient(135deg, #c82333, #a71d2a);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form method="post" enctype="multipart/form-data">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter a strong password" required>
            
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Re-enter password" required>
            
            <label for="room">Room Number:</label>
            <select id="room" name="room" required>
                <option value="">Select Room</option>
                <option value="Applicant 1">Applicant 1</option>
                <option value="Applicant 2">Applicanr 2</option>
                <option value="Cloud">Cloud</option>
            </select>
            
            <label for="ext">Extension Number:</label>
            <input type="text" id="ext" name="ext" placeholder="Enter extension number" required>
            
            <label for="profile_pic">Upload Profile Picture:</label>
            <input type="file" id="profile_pic" name="profile_pic" accept="image/*" required>
            
            <div class="buttons">
                <button type="submit" class="submit-btn">Submit</button>
                <button type="reset" class="reset-btn">Reset</button>
            </div>
        </form>
        <p><a href="allusers.php">View All Users</a></p>
    </div>
    
</body>

</html>


