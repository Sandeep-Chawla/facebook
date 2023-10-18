<?php
include 'database.php';
if($conn){
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $sql="SELECT * FROM `user` WHERE `user_name`='$user'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num >= 1){
        while($row=mysqli_fetch_assoc($result)){
            if ($pass==$row['password']){ 
                session_start();
                $_SESSION["uname"] = "admin";
                header("Location: http://localhost/loginsystem/index.php");}
            else{
                echo "wrong password";
            }
            }}
        else{
            echo "wrong username";
        }}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style><?php include "login.css"; ?></style>
</head>
<body>
    <div class="container">
        <form method = "post" action="login.php" class="form">
            <h1 class="head">Login</h1>
            <label for="user">Username</label>
            <input type="text" name="user" id="user" placeholder="Username" autofocus="1">
            <label for="pass">Password</label>
            <input type="password" name="pass" id="pass" placeholder="Password">
            <button class="submit">Login</button>
</div>
    </div>
</body>
</html>