<?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    include '../Login/sessionAdmin.php';

    $username = $_SESSION['login_user'];
    $password = $_SESSION['login_pass'];

    $fnameErr = $usernameErr = $emailErr = $mobileNumErr = $passwordErr = "";
    $fname_edit = $username_edit = $email_edit = $mobileNum_edit = $gender_edit = $password_edit = "";
    $boolFname = $boolUsername = $boolEmail = $boolMobileNum = $boolPassword = false;

    $locErr = $opnHrsErr = $WAErr = $IGErr = $FBErr = "";
    $loc_edit = $opnHrs_edit = $WA_edit = $IG_edit = $FB_edit = "";
    $boolloc= $boolopnHrs = $boolWA = $boolIG = $boolFB = false;

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
                    alert('Successfully updated! Please relogin.');
                    window.location.href='../Login/sign-in-admin.php';
                    </script>";
                } else {
                    echo "<script>
                    window.location.href='dashboard.php';
                    </script>";
                }
            }
        }else if(isset($_POST["SaveContactInfo-btn"])){

            $temp_storeID = $_POST["storeidtext"];

            //echo '<script>alert('.$temp_storeID.');</script>'; //Trial-and-error
            //Location 
            $loc_edit = $_POST["locationtext"];
            if (empty($loc_edit)) {
                $locErr = "Location is required";
            } else {
                $boolloc = true;
            }

            //Open hours
            $opnHrs_edit = $_POST["OpHrstext"];
            if (empty($opnHrs_edit)) {
                $opnHrsErr = "Open hours is required";
            } else {
                $boolopnHrs = true;
            }

            //WA
            $WA_edit = $_POST["WAtext"];
            if (empty($WA_edit)) {
                $WAErr = "Whatsapp is required";
            } else {
                $boolWA = true;
            }            

            //IG
            $IG_edit = $_POST["IGtext"];
            if (empty($IG_edit)) {
                $IGErr = "Instagram is required";
            } else {
                $boolIG = true;
            }

            //FB
            $FB_edit = $_POST["FBtext"];
            if (empty($FB_edit)) {
                $FBErr = "Facebook is required";
            } else {
                $boolFB = true;
            }

            //confirmation feedback
            if (($boolloc = $boolopnHrs = $boolWA = $boolIG = $boolFB = true)) {
                $updateStoreStatus = $adminObj->editStore($temp_storeID, $loc_edit, $opnHrs_edit, $WA_edit, $IG_edit, $FB_edit);
                echo "<script>window.location.href='dashboard.php';</script>";
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
    <style>
        table, th, td {
            border: 1px solid black;
        }
        table{
            overflow-y:scroll;
            height:300px;
            display:block;
        }
    </style>
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
    <link rel="stylesheet" href="../style/admin.css">
    <title>Home</title>
</head>
<body>
    <section class="admin-page">
        <div class="admin-page-sidebar">
            <div class="padding">
                <img src="..\img\logo-title.png" alt="FitSushi logo" class="logo">
            </div>
            <div class="padding">
                <img src="..\img\admin-img\admin-picture.png" alt="Admin picture" class="admin-pic left">
                <h1><?php echo $username; ?></h1><h2>Admin</h2>
            </div>
            <br><br>
            <script>Home();</script>
            <div>
                <ul>
                    <li class="li-padding"><img src="../img/admin-img/home.png" alt="home" class="size"><a class="left-nav" style="cursor: pointer;" onclick="Home()"> HOME</a></li>
                    <li class="li-padding"><img src="../img/admin-img/profile.jpg" alt="profile" class="size"><a class="left-nav" style="cursor: pointer;" onclick="viewProfile()"> PROFILE</a></li>
                    <li class="li-padding"><img src="../img/admin-img/store.png" alt="store" class="size"><a class="left-nav" style="cursor: pointer;" onclick="viewStore()"> STORE</a></li>
                    <li class="li-padding"><img src="../img/admin-img/customer.jpg" alt="customer" class="size"><a class="left-nav" style="cursor: pointer;" onclick="viewCustomer()"> CUSTOMER</a></li>
                    <li class="li-padding"><img src="../img/admin-img/product.png" alt="product" class="size"><a class="left-nav" style="cursor: pointer;" onclick="viewProduct()"> PRODUCT</a></li>
                    <li class="li-padding"><img src="../img/admin-img/order.png" alt="order" class="size"><a class="left-nav" style="cursor: pointer;" onclick="viewOrder()"> ORDER</a></li>
                    <li class="li-padding"><img src="../img/admin-img/sign-out.png" alt="sign-out" class="size"><a class="left-nav" style="cursor: pointer;" onclick="SignOut()"> SIGN OUT</a></li>
                </ul>
            </div>
        </div>
        <div class="admin-page-dashboard">

            <!-- Home Tab -->
            <div id="Home-div" style="display: block;">
                <h1 class="h1-dashboard">Sales Report</h1>
                <div class="calendar">
                    <form action="/action_page.php"></form>
                    <label for="month"><img src="img/admin-img/calendar.jpg" alt="calendar" width="39" height="52"><b>:</b></label>
                    <select id="month" name="month" class="cal">
                        <option value=" "><em>-- select a month --</em></option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div class="flex-container1">
                    <div>
                        <h2 class="h2-dashboard">Overview</h2>

                    </div>
                    <div>
                        <h2 class="h2-dashboard">Top Buyer</h2>
                        <ul class="ul1">
                            <li class="li2">lorem ipsum</li>
                            <li class="li2">lorem ipsum</li>
                            <li class="li2">lorem ipsum</li>
                            <li class="li2">lorem ipsum</li>
                            <li class="li2">lorem ipsum</li>
                        </ul>

                    </div>
                    <div>
                        <h2 class="h2-dashboard">Top product</h2>

                    </div>            
                </div>
                <div class="flex-container2">
                    <div>
                        <h2 class="h2-dashboard">Sales Revenue</h2>
                        <label for="year" class="year"><b>Year:</b></label>
                        <select id="year" name="year" class="select-year">
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                    <div>
                        <h2 class="h2-dashboard">New User Data</h2>
                        <label for="month" class="month"><b>Month:</b></label>
                        <select id="month" name="month" class="select-month">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                        <label for="year" class="year"><b>Year:</b></label>
                        <select id="year" name="year" class="select-year">
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Admin's Profile Tab-->
            <div id="Profile-div" style="display: none;"> 
                <h1>Profile   <a  onclick="editAdmin()"> (Edit Profile)</a></h1>
                <div id="view-profile-div">
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

            <!-- This div only visible when Edit Profile button is triggered!!! -->
            <!-- Admin's Edit Profile Tab-->
            <div id="Edit-Profile-div" style="display: none;"> 
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h1>Profile   <a  onclick="viewProfile()"> (View Profile)</a></h1>
                    <div id="view-profile-div">
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
                                    <button name="update_Admin" id="save-edit" class="save-edit-btn red-bg">Save Changes</button>
                                </div>
                            </div>
                            <div class="profile-width-5"></div>
                        </div>
                    </div>                      
                </form>
              
            </div>   

            <!-- Store Tab -->
            <div id="Store-div" style="display: none;">
                <br>
                <div id="Store-title-header" align="center">
                    <h1>Store</h1>
                </div>
                <br>
                <!-- Div for entire content under header, consist of two content: Upper & Lower Div -->
                <div id="StoreContentDiv">


                    <div id="UpStore_Content-div" align="center">
                        <h1>Contact Info</h1>
                        <div><a><i  style="font-size:24px;cursor: pointer;color:DarkOrange;"  id="editicon" onclick="enableContactedit()" class="fa fa-edit"></i><i  style="display: none;font-size:24px;cursor: pointer;color:DarkOrange;" id="exiticon" onclick="exitContactedit()" class="fa fa-close"></i></a></div>
                        <div id="storecontactinfo-form-div">
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div id="Loc-OpHrs-div" style="display: inline-block;">
                                    <div id="Location-inputfield" style="float:left; margin-right: 30px;">
                                        <h2>Location: </h2>
                                        <textarea disabled title="Location" name="locationtext" class="input-detail" type="text" id="location" rows="4" cols="30"><?php echo $loc?></textarea>                                   
                                    </div>
                                    <div id="OperatingHrs-inputfield" style="float:left;">
                                        <h2>Operating Hours: </h2>
                                        <textarea disabled title="Operating Hours" name="OpHrstext" class="input-detail" type="text" id="OpHrs" rows="4" cols="30"><?php echo $opnHrs?></textarea>       
                                    </div>
                                </div>

                                <div id="SocMed-div" align="center">
                                    <div id="Whatsapp-inputfield"style="float:left; margin-right: 30px;">
                                        <h2>Whatsapp: </h2>
                                        <input name="storeidtext" class="input-detail" type="hidden" id="storeid" value="<?php echo $store_ID?>">  
                                        <input disabled title="Whatsapp" name="WAtext" class="input-detail" type="text" id="WA" value="<?php echo $Whatsapp?>">  
                                    </div>
                                    <div id="Insta-inputfield" style="float:left; margin-right: 30px;">
                                        <h2>Instagram: </h2>
                                        <input disabled title="Instagram" name="IGtext" class="input-detail" type="text" id="IG" value="<?php echo $Instagram?>">  
                                    </div>
                                    <div id="FB-inputfield" style="float:left; margin-right: 30px;">
                                        <h2>Facebook: </h2>
                                        <input disabled title="Facebook" name="FBtext" class="input-detail" type="text" id="FB" value="<?php echo $Facebook?>">  
                                    </div>
                                </div>

                                <br><br>
                                <div id="SaveContactInfo-btn">
                                    <input disabled type='submit' id="SaveContactBtn" class='button' name='SaveContactInfo-btn' value='Save' /> 
                                    <input disabled type='submit' id="ResetContactBtn" class='button' name='ResetContactInfo-btn' value='Reset' />                                         
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Customer Tab --> <!-- UNDER DEVELOPMENT -->
            <div id="Customer-div" style="display: none;">
                <h1 align="center">Customer Details</h1>
                <br>
                <div class="List-of-user-acc-div">
                    <div id="Search-and-Title-header" display="inline">
                        <div class="custinput-icons">
                            <i class="fa fa-search seriesicon"></i>
                            <input class="custinput-field" type="text" id="custInput" onkeyup="filterCust()" placeholder="Search username.." title="Type in a name">
                        </div>
                        <div id="Title-header" align="center">
                            <h1>LIST OF USERS ACCOUNT</h1>
                        </div>
                    </div>
                    <div id="list-of-customers" align="center">
                        <div class="tbl-header">
                            <table id="custTable" cellpadding="0" cellspacing="0" border="0" align="center">
                                <thead>
                                    <tr>
                                        <th class="info-20">CUSTOMER ID</th>
                                        <th class="info-20">USERNAME</th>
                                        <th class="info-20">FULLNAME</th>
                                        <th class="info-20">EMAIL ADDRESS</th>
                                        <th class="info-20">MOBILE NUMBER</th>
                                        <th class="info-20">HOME ADDRESS</th>
                                        <th class="info-20">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <?php $userObj->displayAllCustomer(); ?>
                                    </form>                                     
                                </tbody>
                            </table>
                        </div>                       
                    </div>
                    
                </div>
            </div>

            <!-- Hidden div for edit customer -->
            <div id="editCust-div" align="center" style="display: none;">
                <br>
                <div class="edit-cust-btn-list">
                   <button id="editUsn" type="button" onclick="editCustUsn()">Username</button> 
                   <button id="editFn" type="button" onclick="editCustFn()">Full name</button> 
                   <button id="editMob" type="button" onclick="editCustMob()">Mobile no</button> 
                   <button id="editEmail" type="button" onclick="editCustEmail()">Email address</button> 
                   <button id="editHome" type="button" onclick="editCustHome()">Home address</button> 
                </div>
                
                <!-- Username -->
                <div id="editCustUsn-div" style="display: block;">
                    <form>
                        <div class="user-detail">
                            <h2>Username</h2>
                            <div>
                                <input name="userid" id="fullname" class="input-detail" type="hidden" value="<?php echo $fullname?>">
                                <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                            </div>
                        </div>                    
                    </form>
                </div>

                <!-- Fullname -->
                <div id="editCustFn-div" style="display: none;">
                    <form>
                        <div class="user-detail">
                            <h2>Full Name</h2>
                            <div>
                                <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $password?>">
                            </div>
                        </div>                    
                    </form>
                </div>

                <!-- Mobile no -->
                <div id="editCustMob-div" style="display: none;">
                    <form>
                        <div class="user-detail">
                            <h2>Mobile Number</h2>
                            <div>
                                <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                            </div>
                        </div>                    
                    </form>
                </div>

                <!-- Email Address -->
                <div id="editCustEmail-div" style="display: none;">
                    <form>
                        <div class="user-detail">
                            <h2>Email Address</h2>
                            <div>
                                <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                            </div>
                        </div>                    
                    </form>
                </div>

                <!-- Home address -->
                <div id="editCustHome-div" style="display: none;">
                    <form>
                        <div class="user-detail">
                            <h2>Home Address</h2>
                            <div>
                                <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                            </div>
                        </div>                    
                    </form>
                </div>


            </div>            

            <!-- Product Tab -->
            <div id="Product-div" style="display: none;">
                
                <div align="center">
                    <h1 >Product Details</h1>     
                    <button onclick="addNewProduct()"><i class="fa fa-plus" style="font-size:24px"></i> Add New Product</button>
                    <button onclick="editProduct()"><i class="fa fa-plus" style="font-size:24px"></i> Edit Button (Remove later)</button>                   
                </div>
                <br>
                <div id="Productlist-div" style="display: block;" align="center">
                    <div class="productinput-icons">
                        <i class="fa fa-search seriesicon"></i>
                        <input class="filterProductinput-field" type="text" id="productcodeInput" onkeyup="filterProduct()" placeholder="Enter ID.." title="Type in a ID">
                    </div>                    
                    <h1>LIST OF PRODUCTS</h1>
                    <div class="productTable-div">
                            <table id="productTable" cellpadding="0" cellspacing="0" border="0" align="center">
                                <thead>
                                    <tr>
                                        <th class="info-20">CODE</th>
                                        <th class="info-20">NAME</th>
                                        <th class="info-20">DESCRIPTION</th>
                                        <th class="info-20">PRICE</th>
                                        <th class="info-20">SUSHI IMAGE</th>
                                        <th class="info-20">AVAILABILITY</th>
                                        <th class="info-20">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <?php $menuObj->displayAllProduct(); ?>
                                    </form>                                     
                                </tbody>
                            </table>
                        </div>                       
                </div>

                <!-- Hidden div: Edit Product -->
                <div id="EditProduct-div" style="display: none;" align="center">
                    <h1>Edit Product</h1>
                    <button onclick="backtoProductlist()"><i class="fas fa-arrow-alt-circle-left" style="font-size:24px"></i> Exit (Remove later)</button>                      
                </div>
                <!-- Hidden div: Add New Product -->
                <div id="AddnewProduct-div" style="display: none;" align="center">
                    <h1>Add Product</h1>
                    <button onclick="backtoProductlist()"><i class="fas fa-arrow-alt-circle-left" style="font-size:24px"></i> Exit (Remove later)</button>  
                </div>

            </div>

            <!-- Order Tab -->
            <div id="Order-div" style="display: none;">
                <h1 align="center">Order Details</h1>
                <br>
                <!-- List of Customer Order -->
                <div class="List-of-CustOrders-div">
                    <div id="Search-and-Title-header" display="inline">
                        <div class="orderinput-icons">
                            <i class="fa fa-search seriesicon"></i>
                            <input class="cust-orderinput-field" type="text" id="custorderInput" onkeyup="filterCustOrder()" placeholder="Search customer.." title="Type in a name">
                        </div>
                        <div id="Title-header" align="center">
                            <h1>LIST OF CUSTOMER ORDER</h1>
                            <form method='POST' action="../pdfGenerator.php">  <!-- 'action=...' set it to redirect to generatePDF.php -->
                                <input type='submit' class='button' name='Report_CustOrder' value='Download Report' />      <!-- Button: Report_CustOrder -->                                
                            </form>
                        </div>
                    </div>
                    <div id="list-of-cust-order" align="center">
                        <div class="tbl-header">
                            <table id="custOrderTable" cellpadding="0" cellspacing="0" border="0" align="center">
                                <thead>
                                    <tr>
                                        <th class="info-20">ORDER ID</th>
                                        <th class="info-20">DATE</th>
                                        <th class="info-20">CUSTOMER NAME</th>
                                        <th class="info-20">DELIVERY ADDRESS</th>
                                        <th class="info-20">DELIVERY DATE</th>
                                        <th class="info-20">DELIVERY OPTION</th>
                                        <th class="info-20">PAYMENT METHOD</th>
                                        <th class="info-20">STATUS</th>
                                        <th class="info-20">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <?php $orderObj->displayAllCustOrder(); ?>
                                    </form>                                     
                                </tbody>
                            </table>
                        </div>                       
                    </div>                    
                </div>
                <br>        
            </div>

        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>

    <script>

        //Disable the input field
        document.getElementById("username").disabled = true;
        document.getElementById("fullname").disabled = true;
        document.getElementById("email").disabled = true;
        document.getElementById("phonenumber").disabled = true;
        document.getElementById("password").disabled = true;

        //Variable declaration synced to ID
        var homediv = document.getElementById('Home-div');
        var profilediv = document.getElementById('Profile-div');
        var editprofilediv = document.getElementById('Edit-Profile-div');
        var storediv = document.getElementById('Store-div');
        var customerdiv = document.getElementById('Customer-div');
        var editcustomerdiv = document.getElementById('editCust-div');
        var productdiv = document.getElementById('Product-div');
        var productlistdiv = document.getElementById('Productlist-div');
        var editProductdiv = document.getElementById('EditProduct-div');
        var addProductdiv = document.getElementById('AddnewProduct-div');
        var orderdiv = document.getElementById('Order-div');
        var signoutdiv = document.getElementById('Signout-div');

        //Variable declaration for edit customer tab
        var usndiv = document.getElementById('editCustUsn-div');
        var fndiv = document.getElementById('editCustFn-div');
        var mobdiv = document.getElementById('editCustMob-div');
        var emaildiv = document.getElementById('editCustEmail-div');
        var addressdiv = document.getElementById('editCustHome-div');

        function Home(){

            //Set div visibility
            homediv.style.display = "block";
            profilediv.style.display = "none";
            editprofilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            editcustomerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";




        }

        function viewProfile(){

            //Disabling the input field
            document.getElementById("username").disabled = true;
            document.getElementById("fullname").disabled = true;
            document.getElementById("email").disabled = true;
            document.getElementById("phonenumber").disabled = true;
            document.getElementById("password").disabled = true;

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "block";
            editprofilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            editcustomerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";
           
        }

        function editAdmin(){

            //Enabling the input field
            document.getElementById("username").disabled = false;
            document.getElementById("fullname").disabled = false;
            document.getElementById("email").disabled = false;
            document.getElementById("phonenumber").disabled = false;
            document.getElementById("password").disabled = false;

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            editprofilediv.style.display = "block";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            editcustomerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";

        }

        function enableAboutUsedit(){

            //Enabling the input field

            document.getElementById("editAUicon").style.display = "none";
            document.getElementById("exitAUicon").style.display = "block";            

        }        

        function exitAboutUsedit(){

            //Enabling the input field
            document.getElementById("editAUicon").style.display = "block";
            document.getElementById("exitAUicon").style.display = "none";   

        }  

        function enableContactedit(){

            //Enabling the input field
            document.getElementById("location").disabled = false;
            document.getElementById("OpHrs").disabled = false;
            document.getElementById("WA").disabled = false;
            document.getElementById("IG").disabled = false;
            document.getElementById("FB").disabled = false;
            document.getElementById("SaveContactBtn").disabled = false;
            document.getElementById("ResetContactBtn").disabled = false;

            document.getElementById("editicon").style.display = "none";
            document.getElementById("exiticon").style.display = "block";            

        }        

        function exitContactedit(){

            //Enabling the input field
            document.getElementById("location").disabled = true;
            document.getElementById("OpHrs").disabled = true;
            document.getElementById("WA").disabled = true;
            document.getElementById("IG").disabled = true;
            document.getElementById("FB").disabled = true;
            document.getElementById("SaveContactBtn").disabled = true;
            document.getElementById("ResetContactBtn").disabled = true;


            document.getElementById("editicon").style.display = "block";
            document.getElementById("exiticon").style.display = "none";   

        }    




        function viewStore(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            editprofilediv.style.display = "none";
            storediv.style.display = "block";
            customerdiv.style.display = "none";
            editcustomerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";


            
        }

        function viewCustomer(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            editprofilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "block";
            editcustomerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";


            
        }

        function editCustomer(selected_id){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            editprofilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            editcustomerdiv.style.display = "block";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";

            alert("success");
            alert(selected_id);

        }        

        function editCustUsn(){
            //alert("Usn");
            usndiv.style.display = "block";
            fndiv.style.display = "none";
            mobdiv.style.display = "none";
            emaildiv.style.display = "none";
            addressdiv.style.display = "none";

        }

        function editCustFn(){

            //alert("Fn");            

            usndiv.style.display = "none";
            fndiv.style.display = "block";
            mobdiv.style.display = "none";
            emaildiv.style.display = "none";
            addressdiv.style.display = "none";
            
        }

        function editCustMob(){

            //alert("Mob");     

            usndiv.style.display = "none";
            fndiv.style.display = "none";
            mobdiv.style.display = "block";
            emaildiv.style.display = "none";
            addressdiv.style.display = "none";
            

        }

        function editCustEmail(){

            //alert("Email");       

            usndiv.style.display = "none";
            fndiv.style.display = "none";
            mobdiv.style.display = "none";
            emaildiv.style.display = "block";
            addressdiv.style.display = "none";
            

        }

        function editCustHome(){

            //alert("Home"); 

            usndiv.style.display = "none";
            fndiv.style.display = "none";
            mobdiv.style.display = "none";
            emaildiv.style.display = "none";
            addressdiv.style.display = "block";
            
            

            event.preventDefault();
        }

        function viewProduct(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            editprofilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            editcustomerdiv.style.display = "none";
            productdiv.style.display = "block";
            orderdiv.style.display = "none";


            
        }

        function addNewProduct(){
            //alert("New Product accessed!");
            productlistdiv.style.display = "none";
            addProductdiv.style.display = "block";
            editProductdiv.style.display = "none";

        }

        function editProduct(){
            //alert("Edit Product accessed!");
            productlistdiv.style.display = "none";
            addProductdiv.style.display = "none";
            editProductdiv.style.display = "block";
        }

        function backtoProductlist(){
            //alert("Edit Product accessed!");
            productlistdiv.style.display = "block";
            addProductdiv.style.display = "none";
            editProductdiv.style.display = "none";            
        }

        function viewOrder(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            editprofilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            editcustomerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "block";


            
        }

        function SignOut(){

            location.replace("../Customer/logout.php");
            
        }

        function filterCust() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("custInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("custTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
        }

        function filterProduct() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("productcodeInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("productTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
        }        

        //From Order Tab
        function filterCustOrder() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("custorderInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("custOrderTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
        }

        //From Order Tab
        function filterTransaction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("transInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("transTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
        }

    </script>
    <style>
        .aboutus_img_container {
            float:left;
            position: relative;
            width: 30%;            
        }
    </style>
</body>
</html>