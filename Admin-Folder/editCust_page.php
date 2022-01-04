<?php
    include '../Login/sessionAdmin.php';

    $custDetailArr = array();
    $fnameErr = $usernameErr = $emailErr = $mobileNumErr = $genderErr = $addressErr = $postcodeErr = $cityErr = $stateErr = $passwordErr = $confirmPassErr = "";
    $fname_edit = $username_edit = $email_edit = $mobileNum_edit = $gender_edit = $address_edit = $postcode_edit = $city_edit = $state_edit = $password_edit = "";
    $boolFname = $boolUsername = $boolEmail = $boolMobileNum = $boolGender = $boolAddress = $boolPostcode = $boolCity = $boolState = $boolPassword = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["edit-customer"])) {
            $customer_id = $_POST['edit-customer'];
            $custDetailArr = $adminObj->setSessionCustomer($customer_id);
            $_SESSION['current_userid_edit'] = $customer_id;
        }
        else if(isset($_POST["Save-customer"])){
            $customer_id = $_POST["Save-customer"];
            //full name validation
            $fname_edit = $_POST["fname"];
            if (empty($fname_edit)) {
                $fnameErr = "(Full name is required)";
            } else {
                $boolFname = true;
            }
            
            //username validation
            $username_edit = $_POST["usern"];
            if (empty($username_edit)) {
                $usernameErr = "(Username is required)";
            } elseif ($userObj->checkExistUsername($username_edit)) {
                $usernameErr = "(This username already exist!)";
            } else {
                $boolUsername = true;
            }

            //email validation
            if (empty($_POST["email"])) {
                $emailErr = "(Email is required)";
            } else {
                $email_edit = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email_edit, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "(Invalid email format)";
                } else {
                    $boolEmail = true;
                }
            }

            //mobile number validation
            if (empty($_POST["phone"])) {
                $mobileNumErr = "(Mobile number is required)";
            } else {
                $mobileNum_edit = test_input($_POST["phone"]);
                // check if phone number is valid
                if (!preg_match("/^(0)(1)[0-9]\d{7,8}$/", $mobileNum_edit)) {
                    $mobileNumErr = "(Invalid mobile number format)";
                } else {
                    $boolMobileNum = true;
                }
            }

            //empty button validation
            //gender
            if (!isset($_POST["gender"])) {
                $genderErr = "(Gender is required)";
            } else {
                $gender_edit = $_POST["gender"];
                $boolGender = true;
            }

            //address
            $address_edit = $_POST["add-1"];
            if (empty($address_edit)) {
                $addressErr = "(Address Line is required!)";
            } else {
                $boolAddress= true;
            }

            //postcode
            $postcode_edit = $_POST["post"];
            if (empty($postcode_edit)) {
                $postcodeErr = "(Postcode is required)";
            } else {
                $boolPostcode = true;
            }

            //city
            $city_edit = $_POST["city"];
            if (empty($city_edit)) {
                $cityErr = "(City name is required)";
            } else {
                $boolCity = true;
            }

            //state
            $state_edit = $_POST['state'];
            if ($state_edit === "select") {
                $stateErr = "(Please select your state)";
            } else {
                $boolState = true;
            }

            //password validation
            if (empty($_POST["passw"])) {
                $passwordErr = "(Password is required)";
            } else {
                $password_edit = test_input($_POST["passw"]);
                $boolPassword = true;
            }

            //confirmation feedback
            if ($boolFname == true && $boolUsername == true && $boolEmail == true && $boolMobileNum == true && $boolGender == true && $boolAddress == true && $boolPostcode == true && $boolCity == true && $boolState == true && $boolPassword == true) {
                $updateStatus = $userObj->updateProfile($customer_id, $username_edit, $fname_edit, $email_edit, $password_edit, $mobileNum_edit, $gender_edit, $address_edit, $postcode_edit, $city_edit, $state_edit);
                if ($updateStatus) {
                    echo'<script>alert("Update successfully!")</script>';
                    $custDetailArr = $adminObj->setSessionCustomer($_SESSION['current_userid_edit'] );
                } else {
                    $custDetailArr = $adminObj->setSessionCustomer($_SESSION['current_userid_edit'] );
                }
            }

        }
        else if(isset($_POST["delete-customer"])){
            $customer_id = $_POST['delete-customer'];            

            //Update user detail in user table
            $resultStatus = $userObj->deleteProfile($customer_id);

            if ($resultDel){
                echo '<script>alert("User (ID: '.$customer_id.') has been deleted.")</script>';                                
            }
            else {
                echo '<script>alert("User (ID: '.$customer_id.') failed to delete.")</script>';  
            }
            echo "<script>window.location.href='customer-list-page.php';</script>";
        }
        else if(isset($_POST["order_delivered"])){
            $id_delivered = $_POST['order_delivered'];

            //Update status to Completed
            $resultStatus = $orderObj->changeOrderStatus($id_delivered, 1);
    
            if ($resultStatus) {
                echo '<script>alert("Order ID ('.$id_delivered.') is on delivery.")</script>';
            }else{
                echo '<script>alert("Something went wrong. :(")</script>';
            }
            echo "<script>window.location.href='order-list-page.php';</script>";            

        }
        else if(isset($_POST["order_Received"])){
            $id_delivered = $_POST['order_Received'];

            //Update status to Completed
            $resultStatus = $orderObj->changeOrderStatus($id_delivered, 2);
    
            if ($resultStatus) {
                echo '<script>alert("Order ID ('.$id_delivered.') delivered.")</script>';
            }else{
                echo '<script>alert("Something went wrong. :(")</script>';
            }
            echo "<script>window.location.href='order-list-page.php';</script>";            

        }        
        else if(isset($_POST["order_cancelled"])){
            $id_delivered = $_POST['order_cancelled'];

            //Update status to cancel
            $resultStatus = $orderObj->changeOrderStatus($id_delivered, 3);
    
            if ($resultStatus) {
                echo '<script>alert("Order ID ('.$id_delivered.') cancelled.")</script>';
            }else{
                echo '<script>alert("Something went wrong. :(")</script>';
            }
            echo "<script>window.location.href='order-list-page.php';</script>";            

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
                        <li class="li-padding"><img src="../img/admin-img/sign-out.png" alt="sign-out" class="size"><a class="left-nav black-txt " style="cursor: pointer;" onclick="logout()"> SIGN OUT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="admin-page-dashboard">
            <div id="User-edit-container">
            <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Edit Customer Details</h1>
                </div>
                <!-- All Customer Detail goes here -->
                <!-- hidden div inside button add menu tag -->
                <div class="main-profile profile-width-80" >
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="main-profile-detail">
                            <div class="profile-width-5"></div>
                            <div class="main-profile-detail-left ">
                                <div class="user-detail">
                                    <h3>Username  <span class="error"><?php echo $usernameErr; ?></span></h3>
                                    <input name="usern" class="input-detail" type="text" id="username" value="<?php echo $custDetailArr[1]?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Full Name  <span class="error"><?php echo $fnameErr; ?></span></h3>
                                    <div>
                                        <input name="fname" id="fullname" class="input-detail" type="text" value="<?php echo $custDetailArr[2]?>">
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h3>Email  <span class="error"><?php echo $emailErr; ?></span></h3>
                                    <input name="email" id="email" class="input-detail" type="text" value="<?php echo $custDetailArr[3]?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Gender  <span class="error"><?php echo $genderErr; ?></span> </h3>
                                    <div>
                                        <div class="gender-detail">
                                            <input id="gender" name="gender" type="radio" value="male" <?php if($custDetailArr[4] == 'male') echo 'checked=checked';?>/>
                                            <label for="gender">Male</label>
                                        </div>
                                        <div class="gender-detail">
                                            <input id="gender" name="gender" type="radio" value="female" <?php if($custDetailArr[4] == 'female') echo 'checked=checked';?>/>
                                            <label for="gender">Female</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h3>Phone Number  <span class="error"><?php echo $mobileNumErr; ?></span></h3>
                                    <input name="phone" id="phonenumber" class="input-detail" type="text" value="<?php echo $custDetailArr[5]?>">
                                </div>
                            </div>
                            <div class="profile-width-20"></div>
                            <div class="main-profile-detail-right">
                                <div class="user-detail">
                                    <h3>Address Line  <span class="error"><?php echo $addressErr; ?></span></h3>
                                    <input name="add-1" id="addressline" class="input-detail" type="textarea" value="<?php echo $custDetailArr[6]?>">
                                </div>
                                <div class="user-detail flex-row">
                                    <div class="user-detail-col profile-margin-3">
                                        <h3>City <span class="error"><?php echo $cityErr; ?></span></h3>
                                        <input name="city" id="city" class="input-detail" type="text" value="<?php echo $custDetailArr[9]?>">
                                    </div>
                                    <div class="user-detail-col">
                                        <h3>Postcode <span class="error"><?php echo $postcodeErr; ?></span></h3>
                                        <input name="post" id="postcode" class="input-detail" type="number" value="<?php echo $custDetailArr[8]?>">
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h3>State <span class="error"><?php echo $stateErr; ?></span></h3>
                                    <select class="input-detail-2" name="state" id="state">
                                        <option <?php if($custDetailArr[10]=="") echo 'selected="selected"'; ?> value="">SELECT A STATE</option>
                                        <option <?php if($custDetailArr[10]=="Melaka") echo 'selected="selected"'; ?> value="Melaka">Melaka</option>
                                        <option <?php if($custDetailArr[10]=="Terengganu") echo 'selected="selected"'; ?> value="Terengganu">Terengganu</option>
                                        <option <?php if($custDetailArr[10]=="Selangor") echo 'selected="selected"'; ?> value="Selangor">Selangor</option>
                                        <option <?php if($custDetailArr[10]=="Sarawak") echo 'selected="selected"'; ?> value="Sarawak">Sarawak</option>
                                        <option <?php if($custDetailArr[10]=="Sabah") echo 'selected="selected"'; ?> value="Sabah">Sabah</option>
                                        <option <?php if($custDetailArr[10]=="Perlis") echo 'selected="selected"'; ?> value="Perlis">Perlis</option>
                                        <option <?php if($custDetailArr[10]=="Perak") echo 'selected="selected"'; ?> value="Perak">Perak</option>
                                        <option <?php if($custDetailArr[10]=="Pahang") echo 'selected="selected"'; ?> value="Pahang">Pahang</option>
                                        <option <?php if($custDetailArr[10]=="Negeri Sembilan") echo 'selected="selected"'; ?> value="Negeri Sembilan">Negeri Sembilan</option>
                                        <option <?php if($custDetailArr[10]=="Kelantan") echo 'selected="selected"'; ?> value="Kelantan">Kelantan</option>
                                        <option <?php if($custDetailArr[10]=="Kuala Lumpur") echo 'selected="selected"'; ?> value="Kuala Lumpur">Kuala Lumpur</option>
                                        <option <?php if($custDetailArr[10]=="Pulau Pinang") echo 'selected="selected"'; ?> value="Pulau Pinang">Pulau Pinang</option>
                                        <option <?php if($custDetailArr[10]=="Kedah") echo 'selected="selected"'; ?> value="Kedah">Kedah</option>
                                        <option <?php if($custDetailArr[10]=="Johor") echo 'selected="selected"'; ?> value="Johor">Johor</option>
                                        <option <?php if($custDetailArr[10]=="Labuan") echo 'selected="selected"'; ?> value="Labuan">Labuan</option>
                                        <option <?php if($custDetailArr[10]=="Putrajaya") echo 'selected="selected"'; ?> value="Putrajaya">Putrajaya</option>
                                    </select>
                                </div>
                                <div class="user-detail">
                                    <h3>Password  <span class="error"><?php echo $passwordErr; ?></span></h3>
                                    <input name="passw" id="password" class="input-detail" type="password" value="<?php echo $custDetailArr[7]?>">
                                </div>
                                <br>
                                <div class="user-detail-btn">
                                    <button id="SaveCustBtn" value=<?php echo $customer_id;?> type="submit" name="Save-customer" class="save-edit-btn red-bg">Save Changes</button>
                                </div>
                            </div>
                            <div class="profile-width-5"></div>
                        </div>
                    </form>
                </div>
                <br>
            </div>
        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
        function logout(){
            Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Log Out'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href='logout.php';
            }
            })
        }
    </script>
</body>
</html>