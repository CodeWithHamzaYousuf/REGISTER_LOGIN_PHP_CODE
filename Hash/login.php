<?php
session_start();

require('connection.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("select id, password from users where username = ?");

    $stmt->bind_param("s",$username);

    $stmt->execute();

    $stmt->bind_result($userid, $hashedpassword);

    $stmt->fetch();

    if($hashedpassword && password_verify($password, $hashedpassword)){
        $_SESSION['id'] = $userid;
        $_SESSION['username'] = $username;

        header("location:dashboard.php");
        exit();
    }
    else{
        echo "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="login.php" method="post">
        username: <input type="text" name="username" required>
        password: <input type="password" name="password" required>
        <input type="submit" value="login">
    </form>
    
    
</body>
</html>