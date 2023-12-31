<?php
require_once('functions.php');
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
    $content = test_input($_POST['content']);
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
        <?php
        include "main.css";
        include "header.css";
        ?>
    </style>
</head>

<body>
    <?php include "header.php"; ?>
    <div class="main-container">
        <div class="left-container">
            <a href="profile.php"><span class="left-list"><span><img src="images/<?php echo $image; ?>" alt="Profile Picture"></span><?php echo $user_name; ?></span></a>
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
            <span class="left-list"><span><i class="fa-brands fa-facebook-messenger fa-xl purple"></i></span>Messenger</span>
            <span class="left-list"><span><i class="fa-brands fa-facebook-messenger fa-xl yellow"></i></span>Messenger
                Kids</span>
            <span class="left-list"><span><i class="fa-solid fa-flag fa-xl orange"></i></span>Pages</span>
            <span class="left-list"><span><i class="fa-solid fa-gamepad fa-xl"></i></span>Play games</span>
            <span class="left-list"><span><i class="fa-solid fa-rectangle-ad fa-xl"></i></span>Recent ad activity</span>
            <span class="left-list"><span><i class="fa-solid fa-bookmark fa-xl purple"></i></span>Saved</span>
            <span class="left-list"><span><span id="less"><i class="fa-solid fa-angle-up fa-xl"></i></span></span>See less</span>
        </div>

        <div class="upload-pop">
            <div class="upload">
                <i class="fa-solid fa-xmark fa-xl close cancel"></i>
                <div class="upload-txt">Create post</div>
                <div class="line2"></div>
                <div class="upload-container">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
                        <input class='form' id="img-up" type="file" name="image" onchange="readURL(this);" />
                        <input class="upload-content" placeholder="What's on your mind, <?php echo $row['fname'] ?>?" type="text" name="content">
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
                    <a href="profile.php"> <img id="profile" src="images/<?php echo $image; ?>" alt="Profile Picture"></a>
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
            <span class="contacts">Contacts<i class="fa-solid fa-magnifying-glass"></i>
                <i class="fa-solid fa-ellipsis"></i></span>
            <?php
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
                echo '<span class="right-list" " data="' . $row['user_id'] . '"><span class="user-img"><img src="images/' . $image . '"alt="Profile Picture"></span><p>' . $row['fname'] . ' ' . $row['lname'] . '</p></span></a>';
            }
            ?>
        </div>
    </div>
    <div class="chat-container" id='myDiv' tabindex="0">
        <div class="chat-scroll"><i class="fa-solid fa-circle-arrow-down"></i></div>
        <div class="chat-header">
            <a href="">
                <div class="chat-receiver">
                    <div class="chat-img">
                        <img src="images/16profile.jpg" alt="">
                    </div>
                    <div class="chatname-container">
                        <div class="chat-name">Sumit Seth</div>
                        <div class="chat-status">Active now</div>
                    </div>
                    <i class="fa-solid fa-angle-down ml-8 blue"></i>
                </div>
            </a>
            <div class="chat-navs">
                <i class="fa-solid fa-phone blue"></i>
                <i class="fa-solid fa-video blue"></i>
                <i class="fa-solid fa-minus blue"></i>
                <i class="fa-solid fa-x blue chat-close"></i>
            </div>
        </div>
        <div class="chat-messages">

        </div>
        <div class="chat-footer">
            <div class="left-navs center">
                <i class="fa-solid fa-circle-plus blue"></i>
            </div>
            <div class="msg-input">

                <textarea name="message" id="message"></textarea>
                <i class="fa-solid fa-face-smile center blue"></i>
            </div>
            <div class="chat-send center"><i class="fa-solid fa-location-arrow blue"></i></div>
        </div>
    </div>


</body>
<script src="https://kit.fontawesome.com/b43c7b4525.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<script>
    let myInterval;
    // posts displaying script    ********************************
    var page = 0; // Initial page number
    var load = true;

    function loadMorePosts() {
        load = false;
        $.ajax({
            url: 'posts.php',
            type: 'GET',
            data: {
                page: page
            },
            success: function(data) {
                if (data.length <= 0) {
                    $('.center-container').append(
                        '<p id="no_result">There are no more posts to show right now</p>'
                    ); // Append no more post message
                    load = false;
                } else {
                    $('.center-container').append(data); // Append the loaded posts to the container
                    page = page + 10; // Increment the page number
                    load = true;

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
        // profile click to show profile menu
        $("#profile").click(function() {
            $(".profile-pop").toggle();
        });
        // hide profile menu
        $(".main-container").click(function() {
            $(".profile-pop").hide();
        });
        // remove post from dom not from database
        $(document).on("click", '.remove_post', function(event) {
            let text = "Do you want to Remove Post";
            if (confirm(text) == true) {
                $(this).parent().hide();
            }
        });

        //post uploading script

        // if escape key on keyboard is pressed upload container and profile menu will hide also chat will hide if in focus
        $(document).keydown(function(event) {
            if (event.keyCode === 27) {
                if ($('.chat-container').is(':focus') || $('#message').is(':focus')) {
                    $('.chat-container').hide();
                    clearInterval(myInterval);
                }
                // $("#img-up").val("");
                $(".upload-pop").removeClass("flex");
                // $('.upload-img-container').hide();
                $(".profile-pop").hide();
            }
        });
        $('.chat-close').click(function() {
            $('.chat-container').hide();
            clearInterval(myInterval);
        })
        // show upload container on click
        $(".show").click(function() {
            $(".upload-pop").addClass("flex");
        })
        // hide upload container on click
        $(".cancel").click(function() {
            // $("#img-up").val("");
            $(".upload-pop").removeClass("flex");
            // $('.upload-img-container').hide();
        })
        // click to trigger file input for post upload
        $(".upload-btn").click(function() {
            $("#img-up").click();
        })
        // trigger submit upload post form
        $(document).on("click", '.upload-button2', function(event) {
            $("#up-btn").click();
        });
        // prement upload form submission on enter key of keyboard
        $('.upload-content').keydown(function(event) {
            if (event.keyCode == 13) {
                event.preventDefault();
                return false;
            }
        });
        $('.chat-send').click(function() {

        })
        // hide and remove image choosen for upload and also change uplaod trigger button class to disable form submission
        $('.remove-img').click(function() {
            $("#img-up").val("");
            $('.upload-img-container').hide();
            $(".upload-button2").addClass('save');
            $(".save").removeClass('upload-button2');
        })
        // script for liking and disliking post
        $(document).on("click", '.like', function(event) {
            $(this).addClass('disable'); //disable click event while calling like request
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
                    if (!isLiked) {
                        $(this).toggleClass('liked', !isLiked);
                        $(this).children().removeClass('fa-regular');
                        $(this).children().addClass('fa-solid');
                    } else {
                        $(this).toggleClass('liked', !isLiked);
                        $(this).children().removeClass('fa-solid');
                        $(this).children().addClass('fa-regular');
                    }
                    if (response == 0) {
                        $(this).parent().siblings('.like-container').remove();
                        $(this).parent().siblings('#hr').remove();
                    }
                    if (response == 1) {
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

        $('.right-list').click(function() {
            let receiver = $(this).attr('data');
            $(".chat-header a").attr("href", `profiles.php?name=${receiver}`);
            let name = $(this).find('p').text()
            let img = $(this).find('.user-img').html()
            $('.chat-name').text(name)
            $('.chat-img').html(img)
            $('.chat-container').show();
            $('#message').focus();
            let chat = document.querySelector(".chat-messages")
            myInterval = setInterval(messageload, 500);

            function messageload() {
                $.ajax({
                    url: 'messages.php',
                    type: 'GET',
                    data: {
                        receiver: receiver,
                    },
                    success: function(data) {
                        $('.chat-messages').html(data)
                    }
                });
                $('.chat-scroll').click(function() {
                    chat.scrollTop = chat.scrollHeight
                    chat.classList.remove("active");

                })

                if (chat.scrollHeight > chat.scrollTop + 400) {
                    $('.chat-scroll').show()
                } else {
                    $('.chat-scroll').hide()
                }
                chat.onmouseenter = () => {
                    chat.classList.add("active");
                }

                chat.onmouseleave = () => {
                    if (chat.scrollHeight == Math.ceil(chat.scrollTop) + chat.offsetHeight) {
                        chat.classList.remove("active");
                    }
                }
                if (!chat.classList.contains("active")) {
                    chat.scrollTop = chat.scrollHeight;
                }
            }
            $('.chat-send').click(function() {
                let message = $('#message').val();
                if (message != "") {
                    $.ajax({
                        url: 'send-chat.php',
                        type: 'POST',
                        data: {
                            receiver: receiver,
                            message: message
                        },
                        success: function(data) {

                        }
                    });

                }
                $('#message').val("")
            })
            $('#message').keydown(function(e) {

                if (e.keyCode == 13) {
                    if (e.keyCode == 13 && e.ctrlKey) {
                        $(this).val(function(i, val) {
                            return val + "\n"
                        })
                    } else {
                        e.preventDefault();
                        $('.chat-send').click()
                    }
                }
            })
            $('#message').keyup(function(e) {
                this.style.height = '20px';
                this.style.height = 20;
                this.style.height = (this.scrollHeight > 124 ? 124 : this.scrollHeight) + "px";
            })
        })
    });


    // enable upload trigger button when image is selected for uploading
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