<?php $servername = "localhost";
$username = "root";
$password = "";
$dbname = "sandeep";
$user = $_SESSION['user'];
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT * FROM `accounts` WHERE `email` LIKE '$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if ($row['image'] == "") {
    $image = 'user.png';
} else {
    $image = $row['image'];
}
?>
<header class="fb-header">
    <div class="left-nav">
        <a href="main.php">
            <div class="fb-logo"> <img src="images/logo.webp" alt="" srcset=""></div>
        </a>
        <div class="fb-search">
            <i class="fa-solid fa-magnifying-glass"></i>
            <form action="#" method="post">
                <input type="text" placeholder="Search Facebook">
            </form>
        </div>
    </div>

    <nav class="fb-nav">
        <span class='nav-active'><a href="#"><i class="fa-solid fa-house fa-lg"></i></a></span>
        <span><a href="#"><i class="fa-solid fa-user-group fa-xl"></i></a></span>
        <span><a href="#"><i class="fa-brands fa-youtube fa-xl"></i></a></span>
        <span><a href="#"><i class="fa-solid fa-store fa-xl"></i></a></span>
        <span><a href="#"><i class="fa-solid fa-users fa-xl"></i></a></span>
        <span id='menu'><a href="#"><i class="fa-solid fa-bars fa-xl"></i></a></span>

    </nav>
    <div class="fb-profile">
        <div class="profile">
            <span><i class="fa-solid fa-bars fa-xl"></i></span>
            <span id="menu2"><i class="fa-solid fa-plus fa-xl"></i></span>
            <span id="messenger"><i class="fa-brands fa-facebook-messenger fa-xl"></i></span>
            <span><i class="fa-solid fa-bell fa-xl"></i></span>
            <img id="profile" src="images/<?php echo $image; ?>" alt="Profile Picture">
        </div>
    </div>
    <div class="profile-pop">
        <div class="user">
            <a href="profile.php">
                <div class="userflex">
                    <img src="images/<?php echo $image; ?>" alt="" srcset="">
                    <div class="username"><?php echo $row['fname'] . " " . $row['lname']; ?></div>
                </div>
            </a>
            <hr id="hr">
            <a href="profile.php">
                <div class="all-profile">See all profiles</div>
            </a>
        </div>
        <div class="profile-list">
            <div class="list">
                <span>
                    <i class="fa-solid fa-gear fa-xl"></i>
                </span>
                <div class="list-flex">
                    Settings & privacy
                    <i class="fa-solid fa-chevron-right fa-xl"></i>
                </div>
            </div>
            <div class="list">
                <span>
                    <i class="fa-solid fa-circle-question fa-xl"></i>
                </span>
                <div class="list-flex">
                    Help & support
                    <i class="fa-solid fa-chevron-right fa-xl"></i>
                </div>
            </div>
            <div class="list">
                <span>
                    <i class="fa-solid fa-moon fa-xl"></i>
                </span>
                <div class="list-flex">
                    Display & accessibility
                    <i class="fa-solid fa-chevron-right fa-xl"></i>
                </div>
            </div>
            <div class="list">
                <span>
                    <i class="fa-solid fa-comment-dots fa-xl"></i>
                </span>
                <div class="list-flex">
                    Give feedback
                </div>
            </div>
            <a href="user_logout.php">
                <div class="list">
                    <span>
                        <i class="fa-solid fa-door-open fa-xl"></i>
                    </span>
                    <div class="list-flex">
                        Log Out
                    </div>
                </div>
            </a>
            <div class="foot">Privacy · Terms · Advertising · Ad choices · Cookies · More · Meta © 2023
            </div>
        </div>
    </div>
</header>