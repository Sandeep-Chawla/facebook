<?php
session_start();
header("Access-Control-Allow-Origin: http://localhost/loginsystem/");
header("Access-Control-Allow-Methods: POST");
// Include database connection and necessary functions
include "database.php";
if($_SERVER['REQUEST_METHOD']=="POST"){

    $user_id=$_SESSION['userid'];
    // Get the post_id and action from the POST request
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];
    
    $like_query="INSERT INTO `likes` (`user_id`, `post_id`) VALUES ('$user_id', '$post_id')";
    $dislike_query="DELETE from likes WHERE user_id='$user_id' AND post_id='$post_id'";
    // Perform the like or dislike operation in the database
    if($action=='like'){
        $result = mysqli_query($conn, $like_query);
    }
    if($action=="dislike"){
        $result = mysqli_query($conn, $dislike_query);
    }
    
    // Simulate the database update and like count retrieval
     // Replace with the actual updated like count
     $sql3 = "SELECT *  FROM `likes` WHERE `post_id` = '$post_id'";
     $result3 = mysqli_query($conn, $sql3);
     $like_count = mysqli_num_rows($result3);
    echo $like_count;
}
?>
