<?php
session_start();

if(!isset($_SESSION["user"])){
    header("Location: home.php");
}
       
        $user=$_SESSION['user'];
        include 'database.php';
        $sql="SELECT * FROM `accounts` WHERE `email` LIKE '$user'";
        $result=mysqli_query($conn,$sql);
        $row= mysqli_fetch_assoc($result);
        $user_id=$row["user_id"];
        $oldimage=$row['image'];

         if(isset($_FILES['image'])){
            $file_name = $_FILES['image']['name'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $image=$user_id . $file_name;
            move_uploaded_file($file_tmp,"images/".$image);
            $query="UPDATE `accounts` SET `image` = '$image' WHERE `accounts`.`email` = '$user'";
            mysqli_query($conn,$query);
            header("Location: profile.php");
   }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Facebook</title>
    <link rel="shortcut icon" href="images/fb.ico" type="image/x-icon">
    <style>
    <?php include "profile.css";
    ?><?php include "header.css";
    ?>
    </style>
</head>

<body>
    <?php include "header.php"?>
    <div class="container">
        <div class="image">
            <img src="images/image3.webp" alt="" srcset="">
            <div class="profile-img"><img src="images/<?php echo $image;?>" alt="" srcset="" /><i
                    class="fa-solid fa-camera fa-lg edit cancel"></i></div>
        </div>
        <div class="user-name">
            <div class="name">
                <h1>
                    <?php echo $row['fname']." ".$row['lname'];?>
                </h1>
                <p>
                0 friends
                </p>
            </div>
            <div class="buttons">
                <div class="button follow"><i class="fa-solid fa-plus fa-xl"></i>Add to story</div>
                <div class="button"><i class="fa-solid fa-pencil fa-xl"></i>Edit Profile</div>
            </div>
        </div>
    </div>

    <div class="upload-pop">
        <div class="upload">
            <i class="fa-solid fa-xmark fa-xl toggle cross cancel"></i>
            <div class="upload-txt">Update profile picture</div>
            <div class="line2"></div>
            <div class="upload-btn"><i class="fa-regular fa-plus fa-lg"></i>&nbsp;Upload Photo</div>
            <div class="upload-container">
                <img src="#" alt="image" class="upload-img image-prev" />
                <div class="img-shadow"></div>
                <img src="#" alt="image" class="upload-image image-prev" />
            </div>
            <div class="line2"></div>
            <div id="save" class="upload-button2">Save</div>
            <div class="upload-button1 cancel">Cancel</div>
        </div>
    </div>

    <form id="form" action="profile.php" method="POST" enctype="multipart/form-data">
        <input id="img-up" type="file" name="image" onchange="readURL(this);"/>
        <input id="up-btn" type="submit">
    </form>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/b43c7b4525.js" crossorigin="anonymous"></script>
    <script>
    function readURL(input) {
        $("#save").show();
        $('.upload-container').show();

        var filePath = input.value;
         
            // Allowing file type
            var allowedExtensions =/(\.jpg|\.jpeg|\.png|\.gif)$/i;
             
            if (!allowedExtensions.exec(filePath)) {
                alert('Invalid file type');
                input.value = '';
                $('.upload-container').hide();
                $("#save").hide();
                return false;
            }
            else{
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.image-prev').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }}
    $(document).ready(function() {
        $(".upload-pop").hide();
        $("#profile").click(function() {
            $(".profile-pop").toggle();
        });
        $(".container").click(function() {
            $(".profile-pop").hide();
        })
        $(document).keydown(function (event) {
                if (event.keyCode === 27) {
                    $("#img-up").val("");
            $("#save").hide();
            $(".upload-pop").hide();
            $('.upload-container').hide();
            $(".profile-pop").hide();
                }
        });
        $(".cancel").click(function() {
            $("#img-up").val("");
            $("#save").hide();
            $(".upload-pop").toggle();
            $('.upload-container').hide();
        })
        $(".upload-btn").click(function() {
            $("#img-up").click();
        })
        $(".upload-button2").click(function() {
            $("#up-btn").click();
        })
    })
    </script>

</body>

</html>