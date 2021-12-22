<?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    include '../Login/sessionAdmin.php';

    $username = $_SESSION['login_user'];
    $password = $_SESSION['login_pass'];

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
                    alert('Successfully updated! Please relogin.');
                    window.location.href='../Login/sign-in-admin.php';
                    </script>";
                } else {
                    echo "<script>
                    window.location.href='dashboard.php';
                    </script>";
                }
            }
        }/*else if(isset($_POST['buy-again-btn'])){
            $prev_orderid = $_POST['order-id'];
            $total_order = $_POST['order-total'];

            $_SESSION['prev-orderid'] = $prev_orderid;
            $_SESSION['total-order'] = $total_order;

            header("Location: buy-again-checkout-page.php");*/
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
                    <li class="li-padding"><img src="../img/admin-img/home.png" alt="home" class="size"><a class="left-nav" onclick="Home()"> HOME</a></li>
                    <li class="li-padding"><img src="../img/admin-img/profile.jpg" alt="profile" class="size"><a class="left-nav" onclick="viewProfile()"> PROFILE</a></li>
                    <li class="li-padding"><img src="../img/admin-img/store.png" alt="store" class="size"><a class="left-nav" onclick="viewStore()"> STORE</a></li>
                    <li class="li-padding"><img src="../img/admin-img/customer.jpg" alt="customer" class="size"><a class="left-nav" onclick="viewCustomer()"> CUSTOMER</a></li>
                    <li class="li-padding"><img src="../img/admin-img/product.png" alt="product" class="size"><a class="left-nav" onclick="viewProduct()"> PRODUCT</a></li>
                    <li class="li-padding"><img src="../img/admin-img/order.png" alt="order" class="size"><a class="left-nav" onclick="viewOrder()"> ORDER</a></li>
                    <li class="li-padding"><img src="../img/admin-img/sign-out.png" alt="sign-out" class="size"><a class="left-nav" onclick="SignOut()"> SIGN OUT</a></li>
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
                <h2>Store</h2>
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
                                <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
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
                <h2>Product</h2>
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
                            <form method='POST'>  <!-- 'action=...' set it to redirect to generatePDF.php -->
                                <input type='submit' class='button' name='Report_CustOrder' value='Download Report' />      <!-- Button: Report_CustOrder -->   
                                <input type='submit' class='button' name='Report_Order' value='Download Order' />      <!-- Button: Report_Order -->                               
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
                <!-- List of Order Transaction-->
                <div class="List-of-OrderFlow-div">
                    <div id="Search-and-Title-header" display="inline">
                        <div class="ordertrans-input-icons">
                            <i class="fa fa-search seriesicon"></i>
                            <input class="ordertrans-input-field" type="text" id="transInput" onkeyup="filterTransaction()" placeholder="Search ID.." title="Type in an ID">
                        </div>
                        <div id="Title-header" align="center">
                            <h1>ORDER TRANSACTION</h1>
                            <form method='POST'>  <!-- 'action=...' set it to redirect to generatePDF.php -->
                                <input type='submit' class='button' name='Report_CustOrder' value='Download Report' />      <!-- Button: Report_CustOrder -->                              
                            </form>                            
                        </div>
                    </div>
                    <div id="list-of-customers" align="center">
                        <div class="tbl-header">
                            <table id="transTable" cellpadding="0" cellspacing="0" border="0" align="center">
                                <thead>
                                    <tr>
                                        <th class="info-20">PAYMENT ID</th>
                                        <th class="info-20">ORDER ID</th>
                                        <th class="info-20">PAYMENT DATE</th>
                                        <th class="info-20">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <?php $orderObj->displayAllTransaction(); ?>
                                    </form>                                     
                                </tbody>
                            </table>
                        </div>                       
                    </div>                    
                </div>                
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
        var orderdiv = document.getElementById('Order-div');
        var signoutdiv = document.getElementById('Signout-div');

        //Variable declaration for edit customer tab
        var usndiv = document.getElementByID('editCustUsn-div');
        var fndiv = document.getElementByID('editCustFn-div');
        var mobdiv = document.getElementByID('editCustMob-div');
        var emaildiv = document.getElementByID('editCustEmail-div');
        var addressdiv = document.getElementByID('editCustHome-div');

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
            alert("Usn");
            usndiv.style.display = "block";
            fndiv.style.display = "none";
            mobdiv.style.display = "none";
            emaildiv.style.display = "none";
            addressdiv.style.display = "none";

        }

        function editCustFn(){
            alert("Fn");
            usndiv.style.display = "none";
            fndiv.style.display = "block";
            mobdiv.style.display = "none";
            emaildiv.style.display = "none";
            addressdiv.style.display = "none";
            
            
        }

        function editCustMob(){
            usndiv.style.display = "none";
            fndiv.style.display = "none";
            mobdiv.style.display = "block";
            emaildiv.style.display = "none";
            addressdiv.style.display = "none";
            
            alert("Mob");
        }

        function editCustEmail(){
            usndiv.style.display = "none";
            fndiv.style.display = "none";
            mobdiv.style.display = "none";
            emaildiv.style.display = "block";
            addressdiv.style.display = "none";
            
            alert("Email");
        }

        function editCustHome(){
            usndiv.style.display = "none";
            fndiv.style.display = "none";
            mobdiv.style.display = "none";
            emaildiv.style.display = "none";
            addressdiv.style.display = "block";
            
            alert("Home");
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
</body>
</html>