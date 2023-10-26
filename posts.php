<?php
require_once('functions.php');
session_start();
header("Access-Control-Allow-Origin: http://localhost/");
header("Access-Control-Allow-Methods: GET");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $skip = test_input($_GET['page']);

    if (is_numeric($skip)) {
        // fetch posts from database - 10 posts per request and didn't repeat previous posts
        $sql = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 10 OFFSET $skip";

        include "database.php";
        $result = mysqli_query($conn, $sql);
        //loop through post result
        while ($row = mysqli_fetch_assoc($result)) {
            // change posted time format
            $timestamp = new DateTime($row['time']);
            $current_year = date('Y');
            $formatted_date = $timestamp->format('j F  \a\t H:i');
            if ($timestamp->format('Y') < $current_year) {
                $formatted_date = $timestamp->format('j F Y \a\t H:i');
            }
            // getting user details according to post like name
            $user_id = $row['user_id'];
            $sql2 = "SELECT * FROM `accounts` WHERE `user_id` = '$user_id'";
            $results = mysqli_query($conn, $sql2);
            $res = mysqli_fetch_assoc($results);
            // getting likes for particular post
            $post_id = $row['post_id'];
            $sql3 = "SELECT *  FROM `likes` WHERE `post_id` = '$post_id';";
            $result3 = mysqli_query($conn, $sql3);
            $like_button='<div class="like-button-container">
                <div id="'.$post_id.'"class="like button1"><i class="fa-regular fa-lg fa-thumbs-up"></i>Like</div>
                <div class="comment-post button1"><i class="fa-regular fa-lg fa-message"></i>Comment</div>
            </div>
            </div>';
            $like_container="";
            while($response=mysqli_fetch_assoc($result3)){
                if($response['user_id']==$_SESSION['userid']){
                    $like_button='<div class="like-button-container">
                    <div id="'.$post_id.'"class="liked like button1"><i class="fa-solid fa-lg fa-thumbs-up"></i>Like</div>
                    <div class="comment-post button1"><i class="fa-regular fa-lg fa-message"></i>Comment</div>
                </div>
                </div>';
                }
            }
            if (mysqli_num_rows($result3) == 0) {
                $like_container =$like_button;
            } else {
                $like_count = mysqli_num_rows($result3);
                $likes = '<img src="images/like.svg" id="like"><span>' . $like_count;
                $like_container = '<div class="like-container">
        <div class="like-count">' . $likes . '</span></div>
        <div class="comment-count"></div></div><hr id="hr">'.$like_button;
            }
            //*********************SESSION['USER_ID'] SE CHECK KARO LOGGEDIN USER NE POST LIKE KARI HAI YAA NAHI

            // displaying posts
            echo '<div class="post">
<i class="fa-solid fa-xmark cross remove_post"></i>
<i class="fa-solid fa-ellipsis cross"></i>
<div class="post-detail">
    <img id="profile" src="images/' . $res["image"] . '" alt="Profile Picture">
    <div class="post-name">
        <div class="posted-name">' . $res['fname'] . ' ' . $res['lname'] . '</div>
        <div class="posted-time">' . $formatted_date . '</div>
    </div>
</div>
<div class="post-content">' . $row["content"] . '</div>
<img src="images/' . $row["media"] . '" alt="image">
' . $like_container ;
        }
    } else {
        echo "error";
    }
}
