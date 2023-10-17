<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost/loginsystem/");
header("Access-Control-Allow-Methods: GET");
include 'database.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sender=$_SESSION['userid'];
    $receiver=$_GET['receiver'];
$qry="SELECT * FROM `messages` WHERE `sender` IN ('$sender','$receiver') AND `receiver` IN ('$sender','$receiver')";
$result=mysqli_query($conn, $qry);
$qry2="SELECT * FROM `accounts` WHERE `user_id` = '$receiver'";
$result2=mysqli_query($conn,$qry2);
$row2=mysqli_fetch_assoc($result2);
$image=$row2["image"];
while($row=mysqli_fetch_assoc($result)){
    if($row['sender']==$sender){
        echo'<div class="chat outgoing">
        <div class="details">
            <p>'.$row['message'].'</p>
        </div>
    </div>';
    }
    else{
        echo' <div class="chat incoming">
        <img src="images/'.$image.'" alt="">
        <div class="details">
            <p>'.$row['message'].'</p>
        </div>
    </div>';
    }
}
}

?>   