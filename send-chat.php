<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost/loginsystem/");
header("Access-Control-Allow-Methods: POST");
include "database.php";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $sender=$_SESSION['userid'];
    $message=$_POST['message'];
    $receiver=$_POST['receiver'];

    $qry="INSERT INTO `messages` ( `sender`, `receiver`, `message`) VALUES ('$sender', '$receiver', '$message')";
    if(mysqli_query($conn,$qry)){
        echo"sucess";
    };
}
?>