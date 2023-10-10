<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: home.php");
}
$user = $_SESSION['user'];
include "database.php";
$sql = "SELECT * FROM `accounts` WHERE `email` LIKE '$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$image = $row['image'];
$user_name = $row['fname'] . " " . $row['lname'];
$user_id = $_SESSION['userid'];
//post upload script
if (isset($_FILES['image'])) {
    $content = $_POST['content'];
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $uploadimage = $user_id . date("j\ofFYh-i-s") . $file_name;
    move_uploaded_file($file_tmp, "images/" . $uploadimage);
    $query = "INSERT INTO `posts` (`user_id`, `content`, `media`) VALUES ('$user_id', '$content', '$uploadimage')";
    mysqli_query($conn, $query);
    header("Location: main.php");
}

//****************************************************************         
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Facebook</title>
    <link rel="shortcut icon" href="images/fb.ico" type="image/x-icon">
    <style>
    <?php include "main.css";
    ?><?php include "header.css";
    ?>
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="main-container">
        <div class="left-container">
            <a href="profile.php"><span class="left-list"><span><img src="images/<?php echo $image; ?>"
                            alt="Profile Picture"></span><?php echo $row['fname'] . " " . $row['lname']; ?></span></a>
            <span class="left-list"><span><i class="fa-solid fa-user-group fa-xl"></i></span>Friends</span>
            <span class="left-list"><span><i class="fa-solid fa-clock-rotate-left fa-xl"></i></span>Most Recent</span>
            <span class="left-list"><span><i class="fa-solid fa-users fa-lg"></i></span>Groups</span>
            <span class="left-list"><span><i class="fa-solid fa-store fa-xl"></i></span>Marketplace</span>
            <span class="left-list"><span><i class="fa-brands fa-youtube fa-xl blood"></i></span>Watch</span>
            <span class="left-list"><span><i class="fa-solid fa-bullhorn fa-xl"></i></span>Ad Centre</span>
            <span class="left-list"><span><i class="fa-solid fa-chart-simple fa-xl"></i></span>Ads Manager</span>
            <span class="left-list"><span><i class="fa-solid fa-droplet fa-xl blood"></i></span>Blood Donations</span>
            <span class="left-list"><span><i class="fa-solid fa-earth-asia fa-xl earth"></i></span>Climate Science
                Centre</span>
            <span class="left-list"><span><i class="fa-solid fa-triangle-exclamation fa-xl"></i></span>Crisis
                Response</span>
            <span class="left-list"><span><i class="fa-solid fa-calendar-days fa-xl blood"></i></span>Events</span>
            <span class="left-list"><span><i class="fa-solid fa-star fa-xl yellow"></i></span>Favourites</span>
            <span class="left-list"><span><i class="fa-brands fa-gratipay fa-xl blood"></i></span>Fundraisers</span>
            <span class="left-list"><span><i class="fa-solid fa-gamepad fa-xl"></i></span>Gaming Video</span>
            <span class="left-list"><span><i class="fa-brands fa-youtube fa-xl blood"></i></span>Live video</span>
            <span class="left-list"><span><i class="fa-regular fa-clock fa-xl "></i></span>Memories</span>
            <span class="left-list"><span><i
                        class="fa-brands fa-facebook-messenger fa-xl purple"></i></span>Messenger</span>
            <span class="left-list"><span><i class="fa-brands fa-facebook-messenger fa-xl yellow"></i></span>Messenger
                Kids</span>
            <span class="left-list"><span><i class="fa-solid fa-flag fa-xl orange"></i></span>Pages</span>
            <span class="left-list"><span><i class="fa-solid fa-gamepad fa-xl"></i></span>Play games</span>
            <span class="left-list"><span><i class="fa-solid fa-rectangle-ad fa-xl"></i></span>Recent ad activity</span>
            <span class="left-list"><span><i class="fa-solid fa-bookmark fa-xl purple"></i></span>Saved</span>
            <span class="left-list"><span><span id="less"><i class="fa-solid fa-angle-up fa-xl"></i></span></span>See
                less</span>
        </div>

        <div class="upload-pop">
            <div class="upload">
                <i class="fa-solid fa-xmark fa-xl close cancel"></i>
                <div class="upload-txt">Create post</div>
                <div class="line2"></div>
                <div class="upload-container">
                    <form action="main.php" method="POST" enctype="multipart/form-data">
                        <input class='form' id="img-up" type="file" name="image" onchange="readURL(this);" />
                        <input class="upload-content" placeholder="What's on your mind, <?php echo $row['fname'] ?>?"
                            type="text" name="content">
                        <input class='form' id="up-btn" type="submit">
                    </form>


                    <div class="upload-img-container">
                        <i class="fa-solid fa-xmark fa-xl close remove-img"></i>
                        <img src="#" alt="image" class="upload-img image-prev" />
                    </div>
                </div>
                <div class="upload-btn"><i class="fa-regular fa-plus fa-lg"></i>&nbsp;Add to your post</div>
                <div class="save">Post</div>
            </div>
        </div>
        <div class="center-container">

            <div class="post">
                <div class="post-detail">
                    <a href="profile.php"> <img id="profile" src="images/<?php echo $image; ?>"
                            alt="Profile Picture"></a>
                    <div class="upload-trigger show">What's on your mind, <?php echo $row['fname'] ?>?</div>
                </div>
                <div class="post-content"></div>
                <hr id="hr">
                <div class="like-button-container">
                    <div class="button1 show"><i class="fa-solid fa-video red"></i>Live Video</div>
                    <div class="button1 show"><i class="fa-regular fa-images green"></i>Photo</div>
                    <div class="button1 show"><i class="fa-regular fa-face-laugh-wink yellow"></i>Feeling/activity</div>
                </div>
            </div>
        </div>
        <div class="right-container">
            <span class="right-list contacts">Contacts<i class="fa-solid fa-magnifying-glass"></i>
                <i class="fa-solid fa-ellipsis"></i></span>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "sandeep";
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT * FROM `accounts`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['email'] == $_SESSION['user']) {
                    continue;
                }
                if ($row['image'] == "") {
                    $image = 'user.png';
                } else {
                    $image = $row['image'];
                }
                echo '<a href="profiles.php?name=' . $row['email'] . '"><span class="right-list"><span><span class="user-img"><img src="images/' . $image . '"alt="Profile Picture"></span></span>' . $row['fname'] . ' ' . $row['lname'] . '</span></a>';
            }
            ?>
        </div>
    </div>


</body>
<script src="https://kit.fontawesome.com/b43c7b4525.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
// post displaying script    ********************************
var page = 0; // Initial page number
var load = true;

function loadMorePosts() {
    load = false;
    $.ajax({
        url: 'posts.php', // Replace with your server-side script
        type: 'GET',
        data: {
            page: page
        },
        success: function(data) {
            if (data.length <= 0) {
                $('.center-container').append(
                    '<p id="no_result">There are no more posts to show right now</p>'
                ); // Append the loaded posts to the container
                load = false;
            } else {
                $('.center-container').append(data); // Append the loaded posts to the container
                page = page + 10; // Increment the page number
                load= true;

            }
        }
    });
}

// Initial load
loadMorePosts();

// Load more on scroll
$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
        if (load) {
            loadMorePosts();
        }
    }
});

$(document).ready(function() {
    // profile click
    $("#profile").click(function() {
        $(".profile-pop").toggle();
    });
    $(".main-container").click(function() {
        $(".profile-pop").hide();
    });
    // remove post
    $(document).on("click", '.remove_post', function(event) {
        let text = "Do you want to Remove Post";
        if (confirm(text) == true) {
            $(this).parent().hide();
        }
    });

    //post uploading script


    $(document).keydown(function(event) {
        if (event.keyCode === 27) {
            // $("#img-up").val("");
            $(".upload-pop").removeClass("flex");
            // $('.upload-img-container').hide();
            $(".profile-pop").hide();
        }
    });
    $(".show").click(function() {
        $(".upload-pop").addClass("flex");
    })
    $(".cancel").click(function() {
        // $("#img-up").val("");
        $(".upload-pop").removeClass("flex");
        // $('.upload-img-container').hide();
    })
    $(".upload-btn").click(function() {
        $("#img-up").click();
    })

    $(document).on("click", '.upload-button2', function(event) {
        $("#up-btn").click();
    });

    $('.upload-content').keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    $('.remove-img').click(function() {
        $("#img-up").val("");
        $('.upload-img-container').hide();
        $(".upload-button2").addClass('save');
        $(".save").removeClass('upload-button2');
    })

    $(document).on("click", '.like', function(event) {
        $(this).addClass('disable');
        var postId = $(this).attr('id');
        var likeCountElement = $(this).parent().siblings('.like-container').find('span');
        // Check if the post is liked or not
        var isLiked = $(this).hasClass('liked');
        // Perform an AJAX request to the PHP backend
        $.ajax({
            url: 'like_post.php', // Replace with your PHP backend endpoint
            method: 'POST',
            data: {
                post_id: postId,
                action: isLiked ? 'dislike' : 'like'
            },
            success: function(response) {
                // if (response.success) {
                    // Toggle the 'liked' class on the button
                    if(!isLiked){
                        $(this).toggleClass('liked', !isLiked);
                        $(this).children().removeClass('fa-regular');
                        $(this).children().addClass('fa-solid');
                    }
                    else{
                        $(this).toggleClass('liked', !isLiked);
                        $(this).children().removeClass('fa-solid');
                        $(this).children().addClass('fa-regular');
                    }
                    if(response==0){
                        $(this).parent().siblings('.like-container').remove();
                        $(this).parent().siblings('#hr').remove();
                    }
                    if(response==1){
                        $(this).parent().siblings('.like-container').remove();
                        $(this).parent().siblings('#hr').remove();
                        $(this).parent().before(`<div class="like-container">
                        <div class="like-count"><img src="images/like.svg" id="like"><span>${response}</span></div>
                        <div class="comment-count"></div></div><hr id="hr">`)
                    }
                    // Update the like count
                    var likeCountElement = $(this).parent().siblings('.like-container').find('span');
                    likeCountElement.text(response);
                    $(this).removeClass('disable');
            }.bind(this)
        });
    });
});


function readURL(input) {
    $(".save").addClass('upload-button2');
    $(".upload-button2").removeClass('save');
    $('.upload-img-container').show();

    var filePath = input.value;

    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!allowedExtensions.exec(filePath)) {
        alert('Invalid file type');
        input.value = '';
        $('.upload-img-container').hide();
        $(".upload-button2").addClass('save');
        $(".save").removeClass('upload-button2');
        return false;
    } else {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.image-prev').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
}
</script>

</html>