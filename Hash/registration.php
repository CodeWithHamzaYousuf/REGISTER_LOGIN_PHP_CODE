<?php
require('connection.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedpassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("insert into users (username, password) value (?,?)");

    $stmt->bind_param("ss",$username , $hashedpassword);

    if($stmt->execute()){
        echo "registration Successfull";
    }
    else{
        echo "Error".$stmt->error;
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
    <form action="registration.php" method="post">
        Username<input type="text" name="username" required /><br>
        Password<input type=" password" name="password" required />
        <input type="submit" name="register"/>
    </form>
    
</body>
</html>