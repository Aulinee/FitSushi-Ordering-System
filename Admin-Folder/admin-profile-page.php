<?php
    include '../Login/sessionAdmin.php';

    $fnameErr = $usernameErr = $emailErr = $mobileNumErr = $passwordErr = "";
    $fname_edit = $username_edit = $email_edit = $mobileNum_edit = $gender_edit = $password_edit = "";
    $boolFname = $boolUsername = $boolEmail = $boolMobileNum = $boolPassword = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["update_Admin"]) ) {

            //full name validation
            $fname_edit = $_POST["fname"];
            if (empty($fname_edit)) {
                $fnameErr = "Full name is required";
            } else {
                $boolFname = true;
            }
            
            //username validation
            $username_edit = $_POST["usern"];
            if (empty($username_edit)) {
                $usernameErr = "Username is required";
            } elseif ($userObj->checkExistUsername($username_edit)) {
                $usernameErr = "This username already exist!";
            } else {
                $boolUsername = true;
            }

            //email validation
            if (empty($_POST["email"])) {
                $emailErr = "Email is required";
            } else {
                $email_edit = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email_edit, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Invalid email format";
                } else {
                    $boolEmail = true;
                }
            }

            //mobile number validation
            if (empty($_POST["phone"])) {
                $mobileNumErr = "Mobile number is required";
            } else {
                $mobileNum_edit = test_input($_POST["phone"]);
                // check if phone number is valid
                if (!preg_match("/^(0)(1)[0-9]\d{7,8}$/", $mobileNum_edit)) {
                    $mobileNumErr = "Invalid mobile number format";
                } else {
                    $boolMobileNum = true;
                }
            }

            //password validation
            if (empty($_POST["passw"])) {
                $passwordErr = "Password is required";
            } else {
                $password_edit = test_input($_POST["passw"]);
                $boolPassword = true;
            }

            //confirmation feedback
            if (($boolFname = $boolUsername = $boolEmail = $boolMobileNum = $boolPassword = true)) {
                $updateStatus = $adminObj->editProfile($adminid, $username_edit, $fname_edit, $email_edit, $password_edit, $mobileNum_edit);
                if ($updateStatus) {
                    echo "<script>
                    alert('Profile successfully edited! Please re-login!');
                    window.location.href='logout.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('Profile is not successfully edited! Please try again!');
                    window.location.href='admin-profile-page.php';
                    </script>";
                }
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poller+One&display=swap" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/nats" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="../style/admin.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>Customer Edit Page</title>
</head>
<body class="flex-col">
    <section class="admin-page flex-row">
        <div class="admin-page-sidebar flex-col">
            <div style="height:600px">
                <div class="logo-sidebar-div">
                    <img src="..\img\logo-title.png" alt="FitSushi logo" class="logo">
                </div>
                <div class="adminlogo-sidebar-div flex-row">
                    <div class="adminlogo-sidebar-div-1">
                        <img src="..\img\admin-img\admin-picture.png" alt="Admin picture" class="admin-pic left">
                    </div>
                    <div class="adminlogo-sidebar-div-2">
                        <h1><?php echo $username; ?></h1>
                        <h2>Admin</h2>
                    </div>
                </div>
                <br>
                <div class="admin-sidebar-tab-div">
                    <ul>
                        <li class="li-padding"><img src="../img/admin-img/home.png" alt="home" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="Dashboard.php"> HOME</a></li>
                        <li class="li-padding"><img src="../img/admin-img/profile.jpg" alt="profile" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="admin-profile-page.php"> PROFILE</a></li>
                        <li class="li-padding"><img src="../img/admin-img/store.png" alt="store" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="store-detail-page.php"> STORE</a></li>
                        <li class="li-padding"><img src="../img/admin-img/customer.jpg" alt="customer" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="customer-list-page.php"> CUSTOMER</a></li>
                        <li class="li-padding"><img src="../img/admin-img/product.png" alt="product" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="menu-list-page.php"> MENU</a></li>
                        <li class="li-padding"><img src="../img/admin-img/order.png" alt="order" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="order-list-page.php"> ORDER</a></li>
                        <li class="li-padding"><img src="../img/admin-img/sign-out.png" alt="sign-out" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="logout.php"> SIGN OUT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="admin-page-dashboard">
            <!-- Admin's Profile Tab-->
            <div  class="home-tab" id="Profile-div"> 
                <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Administrator Profile</h1>
                </div>
                <div class="profile-tbl">
                    <div class="sidebar-profile profile-width-20 flex-col">
                        <img src="../img/user-profile-border.png" alt="user-icon">
                        <h1><?php echo $username?></h1>   
                        <button id="viewbtn" class="sidebar-profile-btn sidebar-btn-active" onclick="viewProfile()">View Profile</button> 
                        <button id="editbtn" class="sidebar-profile-btn" onclick="editAdmin()">Edit Profile</button>        
                    </div>
                    <div class="main-profile profile-width-80">
                        <div class="main-profile-detail">
                            <div class="profile-width-5"></div>
                            <div class="main-profile-detail-left ">
                                <div class="user-detail">
                                    <h2>Username</h2>
                                    <input name="usern" class="input-detail" type="text" id="username" value="<?php echo $username?>">
                                </div>
                                <div class="user-detail">
                                    <h2>Full Name</h2>
                                    <div>
                                        <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h2>Email</h2>
                                    <input name="email" id="email" class="input-detail" type="text" value="<?php echo $email?>">
                                </div>
                                <div class="user-detail">
                                    <h2>Phone Number</h2>
                                    <input name="phone" id="phonenumber" class="input-detail" type="text" value="<?php echo $phonenum?>">
                                </div>
                            </div>
                            <div class="profile-width-20"></div>
                            <div class="main-profile-detail-right">
                                <div class="user-detail">
                                    <h2>Password</h2>
                                    <input name="passw" id="password" class="input-detail" type="password" value="<?php echo $password?>">
                                </div>
                                <br>
                                <div class="user-detail-btn">
                                    <button disabled id="save-edit" class="save-edit-btn red-bg">Save Changes</button>
                                </div>
                            </div>
                            <div class="profile-width-5"></div>
                        </div>
                    </div>
                </div>               
            </div>

            <!-- This div only visible when Edit Profile button is triggered-->
            <!-- Admin's Edit Profile Tab-->
            <div class="home-tab" id="Edit-Profile-div" style="display: none;"> 
                <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Administrator Profile</h1>
                </div>
                <div class="profile-tbl">
                    <div class="sidebar-profile profile-width-20 flex-col">
                        <img src="../img/user-profile-border.png" alt="user-icon">
                        <h1><?php echo $username?></h1>   
                        <button id="viewbtn" class="sidebar-profile-btn" onclick="viewProfile()">View Profile</button> 
                        <button id="editbtn" class="sidebar-profile-btn sidebar-btn-active" onclick="editAdmin()">Edit Profile</button>        
                    </div>
                    <div class="main-profile profile-width-80">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="main-profile-detail">
                                <div class="profile-width-5"></div>
                                <div class="main-profile-detail-left ">
                                    <div class="user-detail">
                                        <h2>Username</h2>
                                        <input name="usern" class="input-detail" type="text" id="username" value="<?php echo $username?>">
                                    </div>
                                    <div class="user-detail">
                                        <h2>Full Name</h2>
                                        <div>
                                            <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                                        </div>
                                    </div>
                                    <div class="user-detail">
                                        <h2>Email</h2>
                                        <input name="email" id="email" class="input-detail" type="text" value="<?php echo $email?>">
                                    </div>
                                    <div class="user-detail">
                                        <h2>Phone Number</h2>
                                        <input name="phone" id="phonenumber" class="input-detail" type="text" value="<?php echo $phonenum?>">
                                    </div>
                                </div>
                                <div class="profile-width-20"></div>
                                <div class="main-profile-detail-right">
                                    <div class="user-detail">
                                        <h2>Password</h2>
                                        <input name="passw" id="password" class="input-detail" type="password" value="<?php echo $password?>">
                                    </div>
                                    <br>
                                    <div class="user-detail-btn">
                                        <button class="save-edit-btn red-bg" type="submit" name="update_Admin">Save Changes</button>
                                    </div>
                                </div>
                                <div class="profile-width-5"></div>
                            </div>                      
                        </form>
                    </div>
                </div> 
            </div>   
        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
        //Disabling the input field
        document.getElementById("username").disabled = true;
        document.getElementById("fullname").disabled = true;
        document.getElementById("email").disabled = true;
        document.getElementById("phonenumber").disabled = true;
        document.getElementById("password").disabled = true;

        var profilediv = document.getElementById('Profile-div');
        var editprofilediv = document.getElementById('Edit-Profile-div');

         function viewProfile(){

            //Disabling the input field
            document.getElementById("username").disabled = true;
            document.getElementById("fullname").disabled = true;
            document.getElementById("email").disabled = true;
            document.getElementById("phonenumber").disabled = true;
            document.getElementById("password").disabled = true;

            document.getElementById("username").style.backgroundColor = "#f9f9f9";
            document.getElementById("fullname").style.backgroundColor = "#f9f9f9";
            document.getElementById("email").style.backgroundColor = "#f9f9f9";
            document.getElementById("phonenumber").style.backgroundColor = "#f9f9f9";
            document.getElementById("password").style.backgroundColor = "#f9f9f9";

            //Set div visibility
            profilediv.style.display = "block";
            editprofilediv.style.display = "none";

        }

        function editAdmin(){

            //Enabling the input field
            document.getElementById("username").disabled = false;
            document.getElementById("fullname").disabled = false;
            document.getElementById("email").disabled = false;
            document.getElementById("phonenumber").disabled = false;
            document.getElementById("password").disabled = false;

            //Set div visibility
            profilediv.style.display = "none";
            editprofilediv.style.display = "block";
        }
    </script>
</body>
</html>