<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: http://localhost/loginsystem/home.php");
}
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "sandeep";
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile|Facebook</title>
    <link rel="shortcut icon" href="images/fb.ico" type="image/x-icon">
    <style>
    <?php include "profile.css";
    ?><?php include "header.css";
    ?>
    </style>
</head>

<body>
    <?php include "header.php"?>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET['name'])){
        $user=$_GET['name'];
        $conn = new mysqli($servername, $username, $password, $dbname);
        $sql="SELECT * FROM `accounts` WHERE `user_id` = '$user'";
        $result=mysqli_query($conn,$sql);
        $row= mysqli_fetch_assoc($result);
        if($row['image']==""){
            $image='user.png';
        }
        else{
            $image=$row['image'];
        }
    }
}
    ?>
    <div class="container">
        <div class="image">
            <img src="images/banner.jpeg" alt="" srcset="">
            <div class="profile-img"><img src="images/<?php echo $image;?>" alt="" srcset=""></div>
        </div>
        <div class="user-name">
            <div class="name">
                <h1><?php echo $row['fname']." ".$row['lname'];?></h1>
                
                <p><?php //echo $number;?> 0 friends</p>
            </div>
            <div class="buttons">
                <div class="button follow"><i class="fa-solid fa-user-plus fa-xl"></i>Add friend</div>
                <div class="button"><i class="fa-brands fa-facebook-messenger fa-xl"></i>Message</div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/b43c7b4525.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script>
    $(document).ready(function() {
        $("#profile").click(function() {
            $(".profile-pop").toggle();
        });
        $(".container").click(function() {
            $(".profile-pop").hide();
        });
    });
    </script>

</body>

</html>