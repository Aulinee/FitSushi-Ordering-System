<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
include '../Login/sessionCustomer.php';

$fnameErr = $usernameErr = $emailErr = $mobileNumErr = $genderErr = $addressErr = $postcodeErr = $cityErr = $stateErr = $passwordErr = $confirmPassErr = "";
$fname_edit = $username_edit = $email_edit = $mobileNum_edit = $gender_edit = $address_edit = $postcode_edit = $city_edit = $state_edit = $password_edit = "";
$boolFname = $boolUsername = $boolEmail = $boolMobileNum = $boolGender = $boolAddress = $boolPostcode = $boolCity = $boolState = $boolPassword = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //header('location:sign-in-user.php');
    //full name validation
    $fname_edit = $_POST["fname_edit"];
    if (empty($fname_edit)) {
        $fnameErr = "Full name is required";
    } else {
        $boolFname = true;
    }
    
    //username validation
    $username_edit = $_POST["usern_edit"];
    if (empty($username_edit)) {
        $usernameErr = "Username is required";
    }else if($userObj->checkExistUsername($username_edit)){
        $usernameErr = "This username already exist!";
    }else {
        $boolUsername = true;
    }

    //email validation
    if (empty($_POST["email_edit"])) {
        $emailErr = "Email is required";
    } else {
        $email_edit = test_input($_POST["email_edit"]);
        // check if e-mail address is well-formed
        if (!filter_var($email_edit, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            $boolEmail = true;
        }
    }

    //mobile number validation
    if (empty($_POST["phone_edit"])) {
        $mobileNumErr = "Mobile number is required";
    } else {
        $mobileNum_edit = test_input($_POST["phone_edit"]);
        // check if phone number is valid
        if (!preg_match("/^(0)(1)[0-9]\d{7,8}$/", $mobileNum_edit)) {
            $mobileNumErr = "Invalid mobile number format";
        } else {
            $boolMobileNum = true;
        }
    }

    //empty button validation
    //gender
    if (!isset($_POST["gender"])) {
        $genderErr = "Gender is required";
    } else {
        $gender_edit = $_POST["gender"];
        $boolGender = true;
    }

    //address
    $address_edit = $_POST["add-1_edit"];
    if (empty($address_edit)) {
      $addressErr = "Address Line is required!";
    } else {
      $boolAddress= true;
    }

    //postcode
    $postcode_edit = $_POST["post_edit"];
    if (empty($postcode_edit)) {
      $postcodeErr = "Postcode is required";
    } else {
      $boolPostcode = true;
    }

    //city
    $city_edit = $_POST["city_edit"];
    if (empty($city_edit)) {
        $cityErr = "City name is required";
    } else {
        $boolCity = true;
    }

    //state
    $state_edit = $_POST['state_edit'];
    if ($state_edit === "select") {
        $stateErr = "Please select your state.";
    } else {
        $boolState = true;
    }

    //password validation
    if (empty($_POST["passw_edit"])) {
        $passwordErr = "Password is required";
    } else {
        $password_edit = test_input($_POST["passw_edit"]);
        $boolPassword = true;
    }

    //confirmation feedback
    if (isset($_POST["update_edit"]) && ($boolFname = $boolUsername = $boolEmail = $boolMobileNum = $boolGender = $boolAddress = $boolPostcode = $boolCity = $boolState = $boolPassword = true) ) {
        $updateStatus = $userObj->updateProfile($userid, $username_edit, $fname_edit, $email_edit, $password_edit, $mobileNum_edit, $gender_edit, $address_edit, $postcode_edit, $city_edit, $state_edit);
        if ($updateStatus){
            echo "<script>
            window.location.href='profile-page.php';
            </script>";
        } else {
            echo "<script>
            window.location.href='profile-page.php';
            </script>";
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neucha&family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="../style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>User Profile</title>
</head>
<body>
    <div>
        <header id="navbar" class="">
            <div class="container">
                <img class="word-logo left" src="../img/title.png" alt="logo">
                <ul class="right">
                    <li><a class="home-tab" href="main-page.php">Home</a></li>
                    <li><a class="home-tab" href="menu-page.php">Menu</a></li>
                    <li><a class="home-tab" href="sushibox-page.php">SushiBox</a></li>
                    <li><a class="home-tab current" href="profile-page.php"><i style="font-size:30px" class="fa fa-user" aria-hidden="true"></i>  <?php echo $username?></a></li>
                    <li><a class="home-tab" href="logout.php">Sign Out</a></li>
                </ul>
            </div>
        </header>
        <div class="profile-detail">
            <h1>MY PROFILE</h1>
            <div class="profile-tbl">
                <div class="sidebar-profile profile-width-20 flex-col">
                    <i class="fa fa-user"></i>
                    <h1>redscarf</h1> 
                    <button id="myorder" class="sidebar-profile-btn sidebar-btn-active" onclick="myOrder()">Order History</button>  
                    <button id="viewbtn" class="sidebar-profile-btn" onclick="viewProfile()">View Profile</button> 
                    <button id="editbtn" class="sidebar-profile-btn" onclick="editProfile()">Edit Profile</button>        
                </div>
                <div class="main-profile profile-width-80">
                    <div id="user-purchase-div">
                        <br>
                        <div class="order-status-filter">
                            <h3 id="allbtn" class="status-active" onclick="allOrder()"><a href="javascript:;">All</a></h3>
                            <h3 id="pendingbtn" onclick="pendingOrder()"><a href="javascript:;">Pending</a></h3>
                            <h3 id="deliverybtn" onclick="deliveryOrder()"><a href="javascript:;">On Delivery/Self-Pickup</a></h3>
                            <h3 id="completebtn" onclick="completeOrder()"><a href="javascript:;">Completed</a></h3>
                            <h3 id="cancelbtn" onclick="cancelOrder()"><a href="javascript:;">Cancel</a></h3>
                        </div>
                        <br>
                        <!-- all order section -->
                        <div id="all-order">
                            <div class="order-content-all flex-col">
                                <div class="set-layout">
                                    <div class="set-layout-header-1 red-bg">
                                        <div class="status-div">
                                            <h3 class="white-txt">Completed</h3>
                                        </div>
                                        <div class="flex-row set-layout-header">
                                            <h3 class="set-name white-txt uppercase margin-0">Ala Carte</h3>
                                            <h3 class="order-date-txt margin-0">Order Date: 29-Oct-2021</h3>
                                        </div>
                                    </div>
                                    <div class="flex-row set-layout-content">
                                        <div class="sushi-order-img">
                                            <img class="" src="img/sushi.png" alt="logo">
                                        </div>
                                        <div class="sushi-order-detail">
                                            <div class="">
                                                <div class="sushi-order-detail-1 flex-row ">
                                                    <h3>Basic Sushi x4</h3>
                                                    <h3>RM 5.00</h3>
                                                </div>
                                                <h3 class="sushi-order-dsc"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                            </div>
                                            <hr class="hr-line">
                                            <div class="">
                                                <h2 class="sushi-order-subtotal margin-0">Subtotal: RM 20.00</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sushi-order-total flex-row">
                                    <h2>Order Total: RM 20.00</h2>
                                    <a class="buy-again-btn white-txt" href="">Buy Again</a>
                                </div>
                            </div>
                            <div class="order-content-all flex-col">
                                <div class="set-layout">
                                    <div class="set-layout-header-1 red-bg">
                                        <div class="status-div">
                                            <h3 class="white-txt">Pending</h3>
                                        </div>
                                        <div class="flex-row set-layout-header">
                                            <h3 class="set-name white-txt uppercase margin-0">Ala Carte</h3>
                                            <h3 class="order-date-txt margin-0">Order Date: 29-Oct-2021</h3>
                                        </div>
                                    </div>
                                    <div class="flex-row set-layout-content">
                                        <div class="sushi-order-img">
                                            <img class="" src="img/sushi.png" alt="logo">
                                        </div>
                                        <div class="sushi-order-detail">
                                            <div class="">
                                                <div class="sushi-order-detail-1 flex-row ">
                                                    <h3>Basic Sushi x4</h3>
                                                    <h3>RM 5.00</h3>
                                                </div>
                                                <h3 class="sushi-order-dsc"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                            </div>
                                            <hr class="hr-line">
                                            <div class="">
                                                <h2 class="sushi-order-subtotal margin-0">Subtotal: RM 20.00</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sushi-order-total flex-row">
                                    <h2>Order Total: RM 20.00</h2>
                                    <a class="buy-again-btn white-txt" href="">Buy Again</a>
                                </div>
                            </div>
                        </div>
                        <!-- pending order section -->
                        <div id="pending-order" class="none">
                            <div class="order-content-all flex-col">
                                <div class="set-layout">
                                    <div class="set-layout-header-1 red-bg">
                                        <div class="status-div">
                                            <h3 class="white-txt">Pending</h3>
                                        </div>
                                        <div class="flex-row set-layout-header">
                                            <h3 class="set-name white-txt uppercase margin-0">Rindok Set</h3>
                                            <h3 class="order-date-txt margin-0">Order Date: 29-Oct-2021</h3>
                                        </div>
                                    </div>
                                    <div class="flex-row set-layout-content">
                                        <div class="sushi-order-img">
                                            <img class="" src="img/sushi.png" alt="logo">
                                        </div>
                                        <div class="sushi-order-detail">
                                            <div class="">
                                                <div class="sushi-order-detail-1 flex-row ">
                                                    <h3>Basic Sushi x4</h3>
                                                    <h3>RM 5.00</h3>
                                                </div>
                                                <h3 class="sushi-order-dsc"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                            </div>
                                            <hr class="hr-line">
                                            <div class="">
                                                <h2 class="sushi-order-subtotal margin-0">Subtotal: RM 20.00</h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex-row set-layout-content">
                                        <div class="sushi-order-img">
                                            <img class="" src="img/sushi.png" alt="logo">
                                        </div>
                                        <div class="sushi-order-detail">
                                            <div class="">
                                                <div class="sushi-order-detail-1 flex-row ">
                                                    <h3>Basic Sushi x4</h3>
                                                    <h3>RM 5.00</h3>
                                                </div>
                                                <h3 class="sushi-order-dsc"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                            </div>
                                            <hr class="hr-line">
                                            <div class="">
                                                <h2 class="sushi-order-subtotal margin-0">Subtotal: RM 20.00</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="set-layout">
                                    <div class="set-layout-header-1 red-bg">
                                        <div class="flex-row set-layout-header">
                                            <h3 class="set-name white-txt uppercase margin-0">Ala Carte</h3>
                                        </div>
                                    </div>
                                    <div class="flex-row set-layout-content">
                                        <div class="sushi-order-img">
                                            <img class="" src="img/sushi.png" alt="logo">
                                        </div>
                                        <div class="sushi-order-detail">
                                            <div class="">
                                                <div class="sushi-order-detail-1 flex-row ">
                                                    <h3>Basic Sushi x4</h3>
                                                    <h3>RM 5.00</h3>
                                                </div>
                                                <h3 class="sushi-order-dsc"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                            </div>
                                            <hr class="hr-line">
                                            <div class="">
                                                <h2 class="sushi-order-subtotal margin-0">Subtotal: RM 20.00</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sushi-order-total flex-row">
                                    <h2>Order Total: RM 40.00</h2>
                                    <a class="buy-again-btn white-txt" href="">Buy Again</a>
                                </div>
                            </div>
                        </div>
                        <!-- delivery order section -->
                        <div id="delivery-order" class="none">
                            <div class="order-content-all flex-col">
                                <div class="set-layout">
                                    <div class="set-layout-header-1 red-bg">
                                        <div class="status-div">
                                            <h3 class="white-txt">On Delivery</h3>
                                        </div>
                                        <div class="flex-row set-layout-header">
                                            <h3 class="set-name white-txt uppercase margin-0">Ala Carte</h3>
                                            <h3 class="order-date-txt margin-0">Order Date: 29-Oct-2021</h3>
                                        </div>
                                    </div>
                                    <div class="flex-row set-layout-content">
                                        <div class="sushi-order-img">
                                            <img class="" src="img/sushi.png" alt="logo">
                                        </div>
                                        <div class="sushi-order-detail">
                                            <div class="">
                                                <div class="sushi-order-detail-1 flex-row ">
                                                    <h3>Basic Sushi x4</h3>
                                                    <h3>RM 5.00</h3>
                                                </div>
                                                <h3 class="sushi-order-dsc"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                            </div>
                                            <hr class="hr-line">
                                            <div class="">
                                                <h2 class="sushi-order-subtotal margin-0">Subtotal: RM 20.00</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sushi-order-total flex-row">
                                    <h2>Order Total: RM 20.00</h2>
                                    <a class="buy-again-btn white-txt" href="">Buy Again</a>
                                </div>
                            </div>
                        </div>
                        <!-- complete order section -->
                        <div id="complete-order" class="none">
                            <div class="order-content-all flex-col">
                                <div class="set-layout">
                                    <div class="set-layout-header-1 red-bg">
                                        <div class="status-div">
                                            <h3 class="white-txt">Completed</h3>
                                        </div>
                                        <div class="flex-row set-layout-header">
                                            <h3 class="set-name white-txt uppercase margin-0">Ala Carte</h3>
                                            <h3 class="order-date-txt margin-0">Order Date: 29-Oct-2021</h3>
                                        </div>
                                    </div>
                                    <div class="flex-row set-layout-content">
                                        <div class="sushi-order-img">
                                            <img class="" src="img/sushi.png" alt="logo">
                                        </div>
                                        <div class="sushi-order-detail">
                                            <div class="">
                                                <div class="sushi-order-detail-1 flex-row ">
                                                    <h3>Basic Sushi x4</h3>
                                                    <h3>RM 5.00</h3>
                                                </div>
                                                <h3 class="sushi-order-dsc"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                            </div>
                                            <hr class="hr-line">
                                            <div class="">
                                                <h2 class="sushi-order-subtotal margin-0">Subtotal: RM 20.00</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sushi-order-total flex-row">
                                    <h2>Order Total: RM 20.00</h2>
                                    <a class="buy-again-btn white-txt" href="">Buy Again</a>
                                </div>
                            </div>
                        </div>
                        <!-- cancel order section -->
                        <div id="cancel-order" class="none">
                            <div class="order-content-all flex-col">
                                <div class="set-layout">
                                    <div class="set-layout-header-1 red-bg">
                                        <div class="status-div">
                                            <h3 class="white-txt">Cancel</h3>
                                        </div>
                                        <div class="flex-row set-layout-header">
                                            <h3 class="set-name white-txt uppercase margin-0">Ala Carte</h3>
                                            <h3 class="order-date-txt margin-0">Order Date: 29-Oct-2021</h3>
                                        </div>
                                    </div>
                                    <div class="flex-row set-layout-content">
                                        <div class="sushi-order-img">
                                            <img class="" src="img/sushi.png" alt="logo">
                                        </div>
                                        <div class="sushi-order-detail">
                                            <div class="">
                                                <div class="sushi-order-detail-1 flex-row ">
                                                    <h3>Basic Sushi x4</h3>
                                                    <h3>RM 5.00</h3>
                                                </div>
                                                <h3 class="sushi-order-dsc"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                            </div>
                                            <hr class="hr-line">
                                            <div class="">
                                                <h2 class="sushi-order-subtotal margin-0">Subtotal: RM 20.00</h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sushi-order-total flex-row">
                                    <h2>Order Total: RM 20.00</h2>
                                    <a class="buy-again-btn white-txt" href="">Buy Again</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="view-profile-div" class="none">
                        <div class="main-profile-detail">
                            <div class="profile-width-5"></div>
                            <div class="main-profile-detail-left ">
                                <div class="user-detail">
                                    <h3>Username</h3>
                                    <input name="usern" class="input-detail" type="text" id="username" value="<?php echo $username?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Full Name</h3>
                                    <div>
                                        <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h3>Email</h3>
                                    <input name="email" id="email" class="input-detail" type="text" value="<?php echo $email?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Gender</h3>
                                    <div>
                                        <div class="gender-detail">
                                            <input id="gender-1" name="gender-1" type="radio" value="male" <?php if($gender == 'male') echo 'checked=checked';?>/>
                                            <label for="gender">Male</label>
                                        </div>
                                        <div class="gender-detail">
                                            <input id="gender-1" name="gender-1" type="radio" value="female" <?php if($gender == 'female') echo 'checked=checked';?>/>
                                            <label for="gender">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h3>Phone Number</h3>
                                    <input name="phone" id="phonenumber" class="input-detail" type="text" value="<?php echo $phonenum?>">
                                </div>
                            </div>
                            <div class="profile-width-20"></div>
                            <div class="main-profile-detail-right">
                                <div class="user-detail">
                                    <h3>Address Line</h3>
                                    <input name="add-1" id="addressline" class="input-detail" type="textarea" value="<?php echo $addressline?>">
                                </div>
                                <div class="user-detail flex-row">
                                    <div class="user-detail-col profile-margin-3">
                                        <h3>City</h3>
                                        <input name="city" id="city" class="input-detail" type="text" value="<?php echo $area?>">
                                    </div>
                                    <div class="user-detail-col">
                                        <h3>Postcode</h3>
                                        <input name="post" id="postcode" class="input-detail" type="number" value="<?php echo $postalcode?>">
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h3>State</h3>
                                    <select class="input-detail-2" name="state" id="state">
                                        <option <?php if($state=="") echo 'selected="selected"'; ?> value="">SELECT A STATE</option>
                                        <option <?php if($state=="Melaka") echo 'selected="selected"'; ?> value="Melaka">Melaka</option>
                                        <option <?php if($state=="Terengganu") echo 'selected="selected"'; ?> value="Terengganu">Terengganu</option>
                                        <option <?php if($state=="Selangor") echo 'selected="selected"'; ?> value="Selangor">Selangor</option>
                                        <option <?php if($state=="Sarawak") echo 'selected="selected"'; ?> value="Sarawak">Sarawak</option>
                                        <option <?php if($state=="Sabah") echo 'selected="selected"'; ?> value="Sabah">Sabah</option>
                                        <option <?php if($state=="Perlis") echo 'selected="selected"'; ?> value="Perlis">Perlis</option>
                                        <option <?php if($state=="Perak") echo 'selected="selected"'; ?> value="Perak">Perak</option>
                                        <option <?php if($state=="Pahang") echo 'selected="selected"'; ?> value="Pahang">Pahang</option>
                                        <option <?php if($state=="Negeri Sembilan") echo 'selected="selected"'; ?> value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option <?php if($state=="Kelantan") echo 'selected="selected"'; ?> value="Kelantan">Kelantan</option>
                                        <option <?php if($state=="Kuala Lumpur") echo 'selected="selected"'; ?> value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option <?php if($state=="Pulau Pinang") echo 'selected="selected"'; ?> value="Pulau Pinang">Pulau Pinang</option>
                                        <option <?php if($state=="Kedah") echo 'selected="selected"'; ?> value="Kedah">Kedah</option>
                                        <option <?php if($state=="Johor") echo 'selected="selected"'; ?> value="Johor">Johor</option>
                                        <option <?php if($state=="Labuan") echo 'selected="selected"'; ?> value="Labuan">Labuan</option>
                                        <option <?php if($state=="Putrajaya") echo 'selected="selected"'; ?> value="Putrajaya">Putrajaya</option>
                                    </select>
                                </div>
                                <div class="user-detail">
                                    <h3>Password</h3>
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

                    <div id="edit-profile-div" class="none">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="main-profile-detail" >
                                <div class="profile-width-5"></div>
                                <div class="main-profile-detail-left ">
                                    <div class="user-detail">
                                        <h3>Username</h3>
                                        <input name="usern_edit" class="input-detail" type="text" id="username" value="<?php echo $username?>">
                                    </div>
                                    <div class="user-detail">
                                        <h3>Full Name</h3>
                                        <div>
                                            <input name="fname_edit" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                                        </div>
                                    </div>
                                    <div class="user-detail">
                                        <h3>Email</h3>
                                        <input name="email_edit" id="email" class="input-detail" type="text" value="<?php echo $email?>">
                                    </div>
                                    <div class="user-detail">
                                        <h3>Gender</h3>
                                        <div>
                                            <div class="gender-detail">
                                                <input id="gender" name="gender" type="radio" value="male" <?php if($gender == 'male') echo 'checked=checked';?>/>
                                                <label for="gender">Male</label>
                                            </div>
                                            <div class="gender-detail">
                                                <input id="gender" name="gender" type="radio" value="female" <?php if($gender == 'female') echo 'checked=checked';?>/>
                                                <label for="gender">Female</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-detail">
                                        <h3>Phone Number</h3>
                                        <input name="phone_edit" id="phonenumber" class="input-detail" type="text" value="<?php echo $phonenum?>">
                                    </div>
                                </div>
                                <div class="profile-width-20"></div>
                                <div class="main-profile-detail-right">
                                    <div class="user-detail">
                                        <h3>Address Line</h3>
                                        <input name="add-1_edit" id="addressline" class="input-detail" type="textarea" value="<?php echo $addressline?>">
                                    </div>
                                    <div class="user-detail flex-row">
                                        <div class="user-detail-col profile-margin-3">
                                            <h3>City</h3>
                                            <input name="city_edit" id="city" class="input-detail" type="text" value="<?php echo $area?>">
                                        </div>
                                        <div class="user-detail-col">
                                            <h3>Postcode</h3>
                                            <input name="post_edit" id="postcode" class="input-detail" type="number" value="<?php echo $postalcode?>">
                                        </div>
                                    </div>
                                    <div class="user-detail">
                                        <h3>State</h3>
                                        <select class="input-detail-2" name="state_edit" id="state">
                                            <option <?php if($state=="select") echo 'selected="selected"'; ?> value="">SELECT A STATE</option>
                                            <option <?php if($state=="Melaka") echo 'selected="selected"'; ?> value="Melaka">Melaka</option>
                                            <option <?php if($state=="Terengganu") echo 'selected="selected"'; ?> value="Terengganu">Terengganu</option>
                                            <option <?php if($state=="Selangor") echo 'selected="selected"'; ?> value="Selangor">Selangor</option>
                                            <option <?php if($state=="Sarawak") echo 'selected="selected"'; ?> value="Sarawak">Sarawak</option>
                                            <option <?php if($state=="Sabah") echo 'selected="selected"'; ?> value="Sabah">Sabah</option>
                                            <option <?php if($state=="Perlis") echo 'selected="selected"'; ?> value="Perlis">Perlis</option>
                                            <option <?php if($state=="Perak") echo 'selected="selected"'; ?> value="Perak">Perak</option>
                                            <option <?php if($state=="Pahang") echo 'selected="selected"'; ?> value="Pahang">Pahang</option>
                                            <option <?php if($state=="Negeri Sembilan") echo 'selected="selected"'; ?> value="Negeri Sembilan">Negeri Sembilan</option>
                                            <option <?php if($state=="Kelantan") echo 'selected="selected"'; ?> value="Kelantan">Kelantan</option>
                                            <option <?php if($state=="Kuala Lumpur") echo 'selected="selected"'; ?> value="Kuala Lumpur">Kuala Lumpur</option>
                                            <option <?php if($state=="Pulau Pinang") echo 'selected="selected"'; ?> value="Pulau Pinang">Pulau Pinang</option>
                                            <option <?php if($state=="Kedah") echo 'selected="selected"'; ?> value="Kedah">Kedah</option>
                                            <option <?php if($state=="Johor") echo 'selected="selected"'; ?> value="Johor">Johor</option>
                                            <option <?php if($state=="Labuan") echo 'selected="selected"'; ?> value="Labuan">Labuan</option>
                                            <option <?php if($state=="Putrajaya") echo 'selected="selected"'; ?> value="Putrajaya">Putrajaya</option>
                                        </select>
                                    </div>
                                    <div class="user-detail">
                                        <h3>Password</h3>
                                        <input name="passw_edit" id="password" class="input-detail" type="password" value="<?php echo $password?>">
                                    </div>
                                    <br>
                                    <div class="user-detail-btn">
                                        <button name="update_edit" type="submit" class="save-edit-btn red-bg">Save Changes</button>
                                    </div>
                                </div>
                                <div class="profile-width-5"></div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <h1>&copy; Copyright 2021 FitSushi</h1>
        </footer>
    </div>
    <script>
        //Disable edit input field
        document.getElementById("username").disabled = true;
        document.getElementById("fullname").disabled = true;
        document.getElementById("email").disabled = true;
        document.getElementById("gender-1").disabled = true;
        document.getElementById("phonenumber").disabled = true;
        document.getElementById("addressline").disabled = true;
        document.getElementById("city").disabled = true;
        document.getElementById("postcode").disabled = true;
        document.getElementById("state").disabled = true;
        document.getElementById("password").disabled = true;

        //change field colour to differenciate disable input
        document.getElementById("username").style.backgroundColor = "#f9f9f9";
        document.getElementById("fullname").style.backgroundColor = "#f9f9f9";
        document.getElementById("email").style.backgroundColor = "#f9f9f9";
        document.getElementById("gender-1").style.backgroundColor = "#f9f9f9";
        document.getElementById("phonenumber").style.backgroundColor = "#f9f9f9";
        document.getElementById("addressline").style.backgroundColor = "#f9f9f9";
        document.getElementById("city").style.backgroundColor = "#f9f9f9";
        document.getElementById("postcode").style.backgroundColor = "#f9f9f9";
        document.getElementById("state").style.backgroundColor = "#f9f9f9";
        document.getElementById("password").style.backgroundColor = "#f9f9f9";

        //Edit hidden div
        var viewbtn = document.getElementById('viewbtn');
        var editbtn = document.getElementById('editbtn');
        var orderbtn = document.getElementById('myorder');

        var viewdiv = document.getElementById('view-profile-div');
        var editdiv = document.getElementById('edit-profile-div');
        var orderdiv = document.getElementById('user-purchase-div');

        function viewProfile(){
            document.getElementById("username").disabled = true;
            document.getElementById("fullname").disabled = true;
            document.getElementById("email").disabled = true;
            document.getElementById("gender-1").disabled = true;
            document.getElementById("phonenumber").disabled = true;
            document.getElementById("addressline").disabled = true;
            document.getElementById("city").disabled = true;
            document.getElementById("postcode").disabled = true;
            document.getElementById("state").disabled = true;
            document.getElementById("password").disabled = true;


            document.getElementById("username").style.backgroundColor = "#f9f9f9";
            document.getElementById("fullname").style.backgroundColor = "#f9f9f9";
            document.getElementById("email").style.backgroundColor = "#f9f9f9";
            document.getElementById("gender-1").style.backgroundColor = "#f9f9f9";
            document.getElementById("phonenumber").style.backgroundColor = "#f9f9f9";
            document.getElementById("addressline").style.backgroundColor = "#f9f9f9";
            document.getElementById("city").style.backgroundColor = "#f9f9f9";
            document.getElementById("postcode").style.backgroundColor = "#f9f9f9";
            document.getElementById("state").style.backgroundColor = "#f9f9f9";
            document.getElementById("password").style.backgroundColor = "#f9f9f9";

            viewdiv.style.display = "block";
            editdiv.style.display = "none";
            orderdiv.style.display = "none";

            viewbtn.classList.add('sidebar-btn-active');
            editbtn.classList.remove('sidebar-btn-active');
            orderbtn.classList.remove('sidebar-btn-active');
        }

        function editProfile(){
            document.getElementById("username").disabled = false;
            document.getElementById("fullname").disabled = false;
            document.getElementById("email").disabled = false;
            document.getElementById("gender-1").disabled = false;
            document.getElementById("phonenumber").disabled = false;
            document.getElementById("addressline").disabled = false;
            document.getElementById("city").disabled = false;
            document.getElementById("postcode").disabled = false;
            document.getElementById("state").disabled = false;
            document.getElementById("password").disabled = false;


            document.getElementById("username").style.backgroundColor = "white";
            document.getElementById("fullname").style.backgroundColor = "white";
            document.getElementById("email").style.backgroundColor = "white";
            document.getElementById("gender-1").style.backgroundColor = "white";
            document.getElementById("phonenumber").style.backgroundColor = "white";
            document.getElementById("addressline").style.backgroundColor = "white";
            document.getElementById("city").style.backgroundColor = "white";
            document.getElementById("postcode").style.backgroundColor = "white";
            document.getElementById("state").style.backgroundColor = "white";
            document.getElementById("password").style.backgroundColor = "white";

            viewdiv.style.display = "none";
            editdiv.style.display = "block";
            orderdiv.style.display = "none";

            viewbtn.classList.remove('sidebar-btn-active');
            editbtn.classList.add('sidebar-btn-active');
            orderbtn.classList.remove('sidebar-btn-active');
        }

        function myOrder(){
            viewdiv.style.display = "none";
            editdiv.style.display = "none";
            orderdiv.style.display = "block";

            viewbtn.classList.remove('sidebar-btn-active');
            editbtn.classList.remove('sidebar-btn-active');
            orderbtn.classList.add('sidebar-btn-active');
        }

        //My order section
        var allorder = document.getElementById('all-order');
        var pendingorder = document.getElementById('pending-order');
        var deliveryorder = document.getElementById('delivery-order');
        var completeorder = document.getElementById('complete-order');
        var cancelorder = document.getElementById('cancel-order');

        var allbtn = document.getElementById("allbtn");
        var pendingbtn = document.getElementById("pendingbtn");
        var deliverybtn = document.getElementById("deliverybtn");
        var completebtn = document.getElementById("completebtn");
        var cancelbtn = document.getElementById("cancelbtn");

        function allOrder(){
            allbtn.classList.add('status-active');
            pendingbtn.classList.remove('status-active');
            deliverybtn.classList.remove('status-active');
            completebtn.classList.remove('status-active');
            cancelbtn.classList.remove('status-active');

            allorder.style.display = "block";
            pendingorder.style.display = "none";
            deliveryorder.style.display = "none";
            completeorder.style.display = "none";
            cancelorder.style.display = "none";
        }

        function pendingOrder(){
            allbtn.classList.remove('status-active');
            pendingbtn.classList.add('status-active');
            deliverybtn.classList.remove('status-active');
            completebtn.classList.remove('status-active');
            cancelbtn.classList.remove('status-active');

            allorder.style.display = "none";
            pendingorder.style.display = "block";
            deliveryorder.style.display = "none";
            completeorder.style.display = "none";
            cancelorder.style.display = "none";
        }

        function deliveryOrder(){
            allbtn.classList.remove('status-active');
            pendingbtn.classList.remove('status-active');
            deliverybtn.classList.add('status-active');
            completebtn.classList.remove('status-active');
            cancelbtn.classList.remove('status-active');

            allorder.style.display = "none";
            pendingorder.style.display = "none";
            deliveryorder.style.display = "block";
            completeorder.style.display = "none";
            cancelorder.style.display = "none";
        }

        function completeOrder(){
            allbtn.classList.remove('status-active');
            pendingbtn.classList.remove('status-active');
            deliverybtn.classList.remove('status-active');
            completebtn.classList.add('status-active');
            cancelbtn.classList.remove('status-active');

            allorder.style.display = "none";
            pendingorder.style.display = "none";
            deliveryorder.style.display = "none";
            completeorder.style.display = "block";
            cancelorder.style.display = "none";
        }

        function cancelOrder(){
            allbtn.classList.remove('status-active');
            pendingbtn.classList.remove('status-active');
            deliverybtn.classList.remove('status-active');
            completebtn.classList.remove('status-active');
            cancelbtn.classList.add('status-active');

            allorder.style.display = "none";
            pendingorder.style.display = "none";
            deliveryorder.style.display = "none";
            completeorder.style.display = "none";
            cancelorder.style.display = "block";
        }

    </script>
</body>
</html>