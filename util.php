<?php
// count files in php working directory
// Set the current working directory
$images = getcwd()."/images/";
 
// Initialize filecount variable
$imagecount = 0;
 
$imagefiles = glob( $images ."*" );
if( $imagefiles ) {
    $imagecount = count($imagefiles);
}
 
echo $imagecount . "files ";
 

// INSERT INTO `user` (`user_id`, `user_name`, `password`, `date`) VALUES (NULL, 'admin', 'admin', current_timestamp());
?>


<script>
    //follow unfollow button

    $(document).ready(function(){
        $(".unfollow").hide();
        var num = 0;
        $(".follow").click(function(){
            num++;
            $("p").text("followers : "+num);
            $(".follow").hide();
            $(".unfollow").show();
        });
        $(".unfollow").click(function(){
            num--;
            $("p").text("followers : "+num);
            $(".unfollow").hide();
            $(".follow").show();
        });
    });
    </script>


//to fetch some data from another page by jquery
$("button").click(function(){
        $("#box").load("/examples/html/test-content.html #hint");
}); 

The email address or mobile number you entered isn't connected to an account. Find your account and log in.



<?php
// otp verification on email

// mail TO
$new_psw=substr(str_shuffle("1234567890"), 0,8); 
$message='Your Password is : '.$new_psw;      
$subject = "harsh it solutions";
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers = "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers = "From: harshitsolutionss@gmail.com" . "\r\n";
mail("harshbnasal@gmail.com",$subject,$message,$headers);
 
if (mail("harshbnasal@gmail.com",$subject,$message,$headers)) { 
echo "Mail Successfully Sent"; 
} 
else { echo "Failed"; }





?>