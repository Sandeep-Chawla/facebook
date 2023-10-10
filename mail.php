<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Your GET request handling code
    echo "Ok";
} 
else{
    echo "Okay";
}
// header("Access-Control-Allow-Origin: http://localhost/loginsystem/mail.php");
// header("Access-Control-Allow-Methods: GET");



$page = $_GET['page'];

// Fetch posts from your database based on the page number
// Generate HTML for the posts and echo it
// Example:
echo '<div class="post">Post ' . ($page * 10 + 1) . '</div>';
echo '<div class="post">Post ' . ($page * 10 + 2) . '</div>';
// ...
?>


