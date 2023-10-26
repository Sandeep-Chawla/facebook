<?php
require_once('functions.php');
include 'database.php';
$signerror = "";
$fname = "";
$lname = "";
$mobile = "";
$password = "";
$day = "";
$month = "";
$year = "";
$gender = "";
$usercount = 0;
session_start();
if ($_SESSION["uname"] != "admin") {
    header("location:login.php");
};
// Set the current working directory
$directory = getcwd() . "/";
// Initialize filecount variable
$filecount = 0;

$files = glob($directory . "*");
if ($files) {
    $filecount = count($files);
}
$images = getcwd() . "/images/";
// Initialize filecount variable
$imagecount = 0;

$imagefiles = glob($images . "*");
if ($imagefiles) {
    $imagecount = count($imagefiles);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        if ($conn) {
            $fname = test_input($_POST['fname']);
            $lname = test_input($_POST['lname']);
            $mobile = test_input($_POST['mobile']);
            $password = password_hash(test_input($_POST['password']), PASSWORD_DEFAULT);
            $day = test_input($_POST['day']);
            $month = test_input($_POST['month']);
            $year = test_input($_POST['year']);
            $gender = test_input($_POST['sex']);

            $sql1 = "SELECT * FROM `accounts` WHERE `email` LIKE '$mobile'";
            $results = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($results) >= 1) {
                $signerror = "email or mobile number already exist please try another email or mobile number";
            } else {
                $query = "INSERT INTO `accounts` (`fname`, `lname`, `email`, `password`, `date`, `month`, `year`, `gender`,`image`) VALUES ('$fname', '$lname', '$mobile', '$password', '$day', '$month', '$year', '$gender','user.png')";
                $signup = mysqli_query($conn, $query);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="shortcut icon" href="images/fb.ico" type="image/x-icon">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <style>
        <?php include "style.css" ?>
    </style>
</head>

<body>
    <div class="header">
        <div class="head">
            <span><a href="logout.php">Logout</a></span>
        </div>
    </div>
    <div class="sidemenu">
        <span class="admin">Admin Panel</span>
        <span class="active side">Dashboard</span>
        <span class="side">Settings</span>
        <span class="side">Pages</span>
        <span class="side">Users</span>
        <span id='sign' class="side">Add User</span>

    </div>
    <div class="container">
        <div id="Users" class="Users">
            <h1>Users</h1>
            <table id="myTable" class="usertable">
                <thead>
                    <tr>
                        <th>first name</th>
                        <th>surname</th>
                        <th>email</th>
                        <th>password</th>
                        <th>date</th>
                        <th>month</th>
                        <th>year</th>
                        <th>gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `accounts`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $usercount++;
                        echo "<tr><td>" . $row['fname'] . "</td>
                <td>" . $row['lname'] . "</td>
                <td>" . $row['email'] . "</td>
                <td>" . $row['password'] . "</td>
                <td>" . $row['date'] . "</td>
                <td>" . $row['month'] . "</td>
                <td>" . $row['year'] . "</td>
                <td>" . $row['gender'] . "</td>
                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="Dashboard">
            <h1 class="inline">Dashboard</h1>
            <p class="inline">Control Panel</p>
            <div class="details">
                <span id="one">
                    <table class="tab">
                        <tr>
                            <td class="left" colspan="2">
                                <p>total visits </p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold">200</p>
                            </td>
                            <td><i class="fa-sharp fa-solid fa-chart-simple fa-2xl"></i></td>
                        </tr>
                    </table>
                </span>
                <span id="two">
                    <table class="tab">
                        <tr>
                            <td class="left" colspan="2">
                                <p>images</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"><?php echo $imagecount; ?></p>
                            </td>
                            <td><i class="fa-regular fa-images fa-2xl"></i></td>
                        </tr>
                    </table>
                </span>
                <span id="three">
                    <table class="tab">
                        <tr>
                            <td class="left" colspan="2">
                                <p>Users</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"><?php echo $usercount; ?></p>
                            </td>
                            <td><i class="fa-solid fa-users fa-2xl"></i></td>
                        </tr>
                    </table>
                </span>
                <span id="four">
                    <table class="tab">
                        <tr>
                            <td class="left" colspan="2">
                                <p>members</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold">18</p>
                            </td>
                            <td><i class="fa-solid fa-user-plus fa-2xl"></i></td>
                        </tr>
                    </table>
                </span>
                <span id="five">
                    <table class="tab">
                        <tr>
                            <td class="left" colspan="2">
                                <p>storage</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold">5.5GB</p>
                            </td>
                            <td><i class="fa-solid fa-database fa-2xl"></i></td>
                        </tr>
                    </table>
                </span>
                <span id="six">
                    <table class="tab">
                        <tr>
                            <td class="left" colspan="2">
                                <p>pages</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold"><?php echo $filecount; ?></p>
                            </td>
                            <td><i class="fa-brands fa-php fa-2xl"></i></td>
                        </tr>
                    </table>
                </span>
                <span id="seven">
                    <table class="tab">
                        <tr>
                            <td class="left" colspan="2">
                                <p>Mails</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="bold">78</p>
                            </td>
                            <td><i class="fa-solid fa-envelope fa-2xl"></i></td>
                        </tr>
                    </table>
                </span>
            </div>
        </div>
        <div class="Settings"></div>
        <div class="Pages">
            <?php
            $directory = getcwd() . "/";
            $files = glob($directory . "*");
            if ($files) {
                foreach ($files as $file) {
                    // $f = ltrim($file,"Cxampphtdocsloginsystem");
                    $f = explode("/", $file);
                    echo $f[1] . "<br>";
                }
            }
            ?>
        </div>
        <div class="AddUser">
            <div class="signup-pop">
                <div class="signup-form-container">
                    <i class="fa-solid fa-xmark fa-xl toggle cross"></i>
                    <div class="sign">Sign Up</div>
                    <p class="sign-tag">It's quick and easy</p>
                    <div class="line2"></div>
                    <form id="inputform" class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="fullname">
                            <input class="input-signup signup-text" type="text" value="<?php echo $fname; ?>" name="fname" id="firstname" placeholder="First name" required>
                            <input class="input-signup signup-text" type="text" name="lname" value="<?php echo $lname; ?>" id="lastname" placeholder="Last name" required>
                        </div>
                        <input class="input-signup" type="email" name="mobile" id="mobile" placeholder="Email address" required value="<?php echo $mobile; ?>">
                        <div id="signerror" class="loginerror bounce"><?php echo $signerror; ?></div>
                        <input class="input-signup" type="password" name="password" id="password" placeholder="New password" required value="<?php echo $password; ?>">
                        <div class="dob">
                            <p class="label">Date of birth <i class="fa-solid fa-circle-question"></i></p>
                            <select name="day" id="day" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31 </option>
                            </select>
                            <select name="month" id="month" required>
                                <option value="1">Jan</option>
                                <option value="2">Feb</option>
                                <option value="3">Mar</option>
                                <option value="4">Apr</option>
                                <option value="5">May</option>
                                <option value="6">Jun</option>
                                <option value="7">Jul</option>
                                <option value="8">Aug</option>
                                <option value="9">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                            <select name="year" id="year" required>
                                <option value="2023" selected="1">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                                <option value="2020">2020</option>
                                <option value="2019">2019</option>
                                <option value="2018">2018</option>
                                <option value="2017">2017</option>
                                <option value="2016">2016</option>
                                <option value="2015">2015</option>
                                <option value="2014">2014</option>
                                <option value="2013">2013</option>
                                <option value="2012">2012</option>
                                <option value="2011">2011</option>
                                <option value="2010">2010</option>
                                <option value="2009">2009</option>
                                <option value="2008">2008</option>
                                <option value="2007">2007</option>
                                <option value="2006">2006</option>
                                <option value="2005">2005</option>
                                <option value="2004">2004</option>
                                <option value="2003">2003</option>
                                <option value="2002">2002</option>
                                <option value="2001">2001</option>
                                <option value="2000">2000</option>
                                <option value="1999">1999</option>
                                <option value="1998">1998</option>
                                <option value="1997">1997</option>
                                <option value="1996">1996</option>
                                <option value="1995">1995</option>
                                <option value="1994">1994</option>
                                <option value="1993">1993</option>
                                <option value="1992">1992</option>
                                <option value="1991">1991</option>
                                <option value="1990">1990</option>
                                <option value="1989">1989</option>
                                <option value="1988">1988</option>
                                <option value="1987">1987</option>
                                <option value="1986">1986</option>
                                <option value="1985">1985</option>
                                <option value="1984">1984</option>
                                <option value="1983">1983</option>
                                <option value="1982">1982</option>
                                <option value="1981">1981</option>
                                <option value="1980">1980</option>
                                <option value="1979">1979</option>
                                <option value="1978">1978</option>
                                <option value="1977">1977</option>
                                <option value="1976">1976</option>
                                <option value="1975">1975</option>
                                <option value="1974">1974</option>
                                <option value="1973">1973</option>
                                <option value="1972">1972</option>
                                <option value="1971">1971</option>
                                <option value="1970">1970</option>
                                <option value="1969">1969</option>
                                <option value="1968">1968</option>
                                <option value="1967">1967</option>
                                <option value="1966">1966</option>
                                <option value="1965">1965</option>
                                <option value="1964">1964</option>
                                <option value="1963">1963</option>
                                <option value="1962">1962</option>
                                <option value="1961">1961</option>
                                <option value="1960">1960</option>
                                <option value="1959">1959</option>
                                <option value="1958">1958</option>
                                <option value="1957">1957</option>
                                <option value="1956">1956</option>
                                <option value="1955">1955</option>
                                <option value="1954">1954</option>
                                <option value="1953">1953</option>
                                <option value="1952">1952</option>
                                <option value="1951">1951</option>
                                <option value="1950">1950</option>
                                <option value="1949">1949</option>
                                <option value="1948">1948</option>
                                <option value="1947">1947</option>
                                <option value="1946">1946</option>
                                <option value="1945">1945</option>
                                <option value="1944">1944</option>
                                <option value="1943">1943</option>
                                <option value="1942">1942</option>
                                <option value="1941">1941</option>
                                <option value="1940">1940</option>
                                <option value="1939">1939</option>
                                <option value="1938">1938</option>
                                <option value="1937">1937</option>
                                <option value="1936">1936</option>
                                <option value="1935">1935</option>
                                <option value="1934">1934</option>
                                <option value="1933">1933</option>
                                <option value="1932">1932</option>
                                <option value="1931">1931</option>
                                <option value="1930">1930</option>
                                <option value="1929">1929</option>
                                <option value="1928">1928</option>
                                <option value="1927">1927</option>
                                <option value="1926">1926</option>
                                <option value="1925">1925</option>
                                <option value="1924">1924</option>
                            </select>
                        </div>
                        <div class="gender">
                            <p class="label">Gender <i class="fa-solid fa-circle-question"></i></p>
                            <span><label for="male">Male</label>
                                <input class="radio" type="radio" name="sex" value="male" id="male" checked required>
                            </span>
                            <span>
                                <label for="female">Female</label>
                                <input class="radio" type="radio" name="sex" value="female" id="female" required></span>
                        </div>
                        <div class="footer">
                            <p>People who use our service may have uploaded your contact information to Facebook. Learn more.
                            </p>
                        </div>
                        <div class="footer">
                            <p>By clicking Sign Up, you agree to our Terms, Privacy Policy and Cookies Policy. You may receive
                                SMS notifications from us and can opt out at any time.</p>
                        </div>
                        <button name="signup" class="signup-btn">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</body>
<script src="https://kit.fontawesome.com/b43c7b4525.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
    console.log("hello");
    $(document).ready(function() {
        $(".side").click(function() {
            $(".side").removeClass("active");
            var clas = $(this).text().replaceAll(' ', '');
            let text1 = ".";
            let text3 = text1.concat(clas);
            $(".Dashboard").hide();
            $(".Settings").hide();
            $(".Pages").hide();
            $(".Users").hide();
            $(".AddUser").hide();
            console.log(text3);
            $(text3).show();
            $(this).addClass("active");
        });
        $(".active").click();
        if ($("#signerror").text() != "") {
            console.log("hello sign");
            $(".AddUser").show();
            $("#sign").click();
        }
        $('#myTable').DataTable();
    });
</script>

</html>