<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sandeep";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $user=$_POST['user'];
    $user2=$_POST['user2'];
    $userid=$_POST['userid'];
    $userid2=$_POST['userid2'];
    
    if(isset($_POST['click'])){
    $search="SELECT * FROM `$user` WHERE `friend_id` = '$userid2'";
    $result=mysqli_query($conn,$search);

    if(mysqli_num_rows($result)>=1){
    $del="DELETE FROM `$user` WHERE `friend_id` ='$userid2'";
    $del2="DELETE FROM `$user2` WHERE `friend_id` ='$userid'";
    mysqli_query($conn,$del);
    mysqli_query($conn,$del2);
    echo "remove";
    }
else{
    $qry1="INSERT INTO `$user` (`friend_id`) VALUES ('$userid2')";
    $qry2="INSERT INTO `$user2` (`friend_id`) VALUES ('$userid')";
    mysqli_query($conn,$qry2);
    mysqli_query($conn,$qry1);
    echo "add";
}
}
if(isset($_POST['load'])){
    $search="SELECT * FROM `$user` WHERE `friend_id` = '$userid2'";
    $result=mysqli_query($conn,$search);
    if(mysqli_num_rows($result)>=1){
        echo "friend";
    }
    else{
        echo "not";
    }
}
}
else{
    header("location: main.php");
}


?>