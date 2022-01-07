<?php 
include '../database/dbConnection.php'; 
include '../class/UserClass.php';

$userObj = new User($conn);

$fnameErr = $usernameErr = $emailErr = $mobileNumErr = $genderErr = $addressErr = $postcodeErr = $cityErr = $stateErr = $passwordErr = $confirmPassErr = $conditionErr = "";
$fname = $username = $email = $mobileNum = $gender = $address = $postcode = $city = $state = $password = $confirmPass = $condition = "";
$boolFname = $boolUsername = $boolEmail = $boolMobileNum = $boolGender = $boolAddress = $boolPostcode = $boolCity = $boolState = $boolPassword = $boolConfirmPass = $boolCondition = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //header('location:sign-in-user.php');
    //full name validation
    $fname = $_POST["fname"];
    if (empty($fname)) {
        $fnameErr = "Full name is required";
    } else {
        $boolFname = true;
    }
    
    //username validation
    $username = $_POST["usern"];
    if (empty($username)) {
        $usernameErr = "Username is required";
    }else if($userObj->checkExistUsername($username)){
        $usernameErr = "This username already exist!";
    }else {
        $boolUsername = true;
    }

    //email validation
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        } else {
            $boolEmail = true;
        }
    }

    //mobile number validation
    if (empty($_POST["phone"])) {
        $mobileNumErr = "Mobile number is required";
    } else {
        $mobileNum = test_input($_POST["phone"]);
        // check if phone number is valid
        if (!preg_match("/^(0)(1)[0-9]\d{7,8}$/", $mobileNum)) {
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
        $gender = $_POST["gender"];
        $boolGender = true;
    }

    //address
    $address = $_POST["add-1"];
    if (empty($address)) {
      $addressErr = "Address Line is required!";
    } else {
      $boolAddress= true;
    }

    //postcode
    $postcode = $_POST["post"];
    if (empty($postcode)) {
      $postcodeErr = "Postcode is required";
    } else {
      $boolPostcode = true;
    }

    //city
    $city = $_POST["city"];
    if (empty($city)) {
        $cityErr = "City name is required";
    } else {
        $boolCity = true;
    }

    //state
    $state = $_POST['state'];
    if ($state === "select") {
        $stateErr = "Please select your state.";
    } else {
        $boolState = true;
    }

    //password validation
    if (empty($_POST["passw"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["passw"]);
        $boolPassword = true;
    }

    //confirm password validation
    if (empty($_POST["cpassw"])) {
        $confirmPassErr = "Confirm password is required";
    } else {
        // check if confirm password match with password
        $confirmPass = test_input($_POST["cpassw"]);
        if ($confirmPass != $password) {
            $confirmPassErr = "Your password does not match!";
        } else {
            $boolConfirmPass = true;
        }
    }

    //terms and condition
    if (empty($_POST['terms'])) {
        $conditionErr = "Please tick Terms and Condition to proceed.";
    } else {
        $boolCondition = true;
    }

    //confirmation feedback
    if (isset($_POST["register"]) && $boolFname == true && $boolUsername == true && $boolEmail == true && $boolMobileNum == true && $boolGender == true && $boolAddress == true && $boolPostcode == true && $boolCity == true && $boolState == true && $boolPassword == true && $boolConfirmPass == true && $boolCondition == true) {
        $signUpStatus = $userObj->signUp($username, $fname, $email, $password, $mobileNum, $gender, $address, $postcode, $city, $state);

        if ($signUpStatus){
            echo "<script>
            alert('Successfully sign up! Redirecting to sign in page');
            window.location.href='sign-in-user.php';
            </script>";
        } else {
            echo "<script>
            alert('Unsucessuful sign up! Please try again!');
            window.location.href='sign-up-user.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poller+One&display=swap" rel="stylesheet">
    <link href="http://fonts.cdnfonts.com/css/nats" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Neucha" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neucha&family=Poppins:wght@100&display=swap" rel="stylesheet">
    <title>Registration Form For User</title>
    <style>
        html{
            min-height: 100%;
            background-image: url(../img/bg\ grey.png);
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            scroll-behavior: smooth;
            background-attachment: fixed;
        }

        body{
            height: 100%;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Varela Round', sans-serif;
        }

        .main-container{
            margin: 5% auto;
            width: 60%;
        }
        
        .container {
            background: #ffffff;
            box-shadow: 0 15px 25px rgba(0,0,0,.6);
            border-radius: 10px;
            display: flex;
            justify-content: center;
        }

        .container .left {
            padding: 50px 0;
            display: flex;
            flex-direction: column;
            width: 30%;
            background-image: linear-gradient(#FF8A00, #ffa200);
            border-radius: 10px 0px 0px 10px;
        }

        .word{
            justify-content: center;
            width: 100%;
            display: flex;
            flex-direction: row;
            margin: 0;
        }

        .word img{
            width: 45%;
        }

        .container .left p{
            font-weight: bolder;
            font-size: 60px;
            font-family: 'ubuntu', 'sans-serif';
            color: #ffffff;
            box-shadow:  0px 15px 100px 0px #00000000;
        }

        .word-2{
            display: flex;
            flex-direction: column;
            margin:0;
            text-align: center;
            justify-content: center;
            width: 100%;
        }

        .word-2 #welcome{
            margin: 0;
            font-family: "Baloo Tamma";
            font-style: normal;
            font-weight: 700;
            font-size: 64px;
            color: #FDFDFD;
        }

        .word-2 #sign{
            margin: 0;
            font-family: "Merriweather";
            font-style: normal;
            font-weight: bolder;
            font-size: 28px;
            line-height: 35px;
            color: #fff;
        }

        .word-2 #newhere{
            margin-bottom: 0;
            font-family: 'NATS';
            font-style: normal;
            font-weight: normal;
            font-size: 20px;
            text-align: center;
            color: #FDFDFD;
        }

        .word-2 #create{
            margin: 0;
            text-decoration: none;
            color: #ffffff;
            font-style: bold;
        }

        .word-2 #create a{
            cursor: pointer;
            color: black;
            text-decoration: none;
            font-size: 20px;
            transition: ease-in-out 0.5s;
        }

        .word-2 #create a:hover{
            color: #794f08;
            border-bottom: 2px solid #794f08;
        }

        .word-2 #signpage{
            margin: 0;
            text-decoration: none;
            color: #ffffff;
            font-style: bold;
        }

        .word-2 #signpage a{
            cursor: pointer;
            color: #5e451c;
            text-decoration: none;
            font-size: 20px;
        }

        .word-2 #signpage a:hover{
            border-bottom: 2px solid #794f08;
        }

        .container .right {
            float: right;
            width: 70%;
            height: 100%;
            padding-bottom: 50px;
        }

        .form-box {
            width: auto;
            height: auto;
        }

        .form-box .input-box{
            padding-bottom: 20px
        }

        .form-box form{
            padding: 0 20px;
        }

        .form-box h1{
            text-align: center;
            border: none;
        }

        .form-box p{
            color: #ffa200;
            font-weight: bolder;
            font-size: 17px;
        }

        .form-box hr {
            width: 20px;
            height: 5px;
            background: #ffa200;
            border: none;
            border-radius: 1px;
            margin-bottom: 50px;
        }

        .form-box .selecting label{
            margin: 30px 0px 10px 8px;
            color: #ffa200;
            font-weight: bolder;
            font-size: 20px;
        }

        .form-box .selecting select{
            text-align: center;
            background-color: #fcc15c;
            outline: none;
            width: 220px;
            height: 40px;
            cursor: pointer;
            font-family: 'varela round', sans-serif;
            margin: 0 0 0 50px;
            border: none;
            color: #63440f;
            border-radius: 50px;
            padding: 10px 10px 10px 25px;
        }

        .input-element {
            border: none;
            border-bottom: 2px solid #ffa200;
            width: 90%;
            height: 30px;
        }

        input:focus{
            outline: none;
            transition: ease-in 0.1s;
            border-bottom: 2px solid #c27c04;
        }

        input:focus::placeholder{
            color: transparent;
            transition: all ease 0.3s;
        }

        .form-box .selecting select option{
            text-align: center;
        }

        input:focus{
            outline: none;
            transition: ease-in 0.1s;
            border-bottom: 2px solid #c27c04;
        }

        input:focus::placeholder{
            color: transparent;
            transition: all ease 0.3s;
        }

        .keep{
            color: #794f08;
        }

        #butang{
            justify-content: center;
            margin: 0;
            display: flex;
        }

        #butang input{
            padding: 0;
            margin: 10px;
            width: 100px;
            height: 50px;
            background-color: #d67e19;
            border-radius: 5px;
            border: none;
            font-family: 'varela round', sans-serif;
            font-weight: bolder;
            color: #352407;
            transition: all 0.2s;
        }

        #butang input:hover{
            cursor: pointer;
            background-color: #FF8A00;
            color: #ffffff;
        }

        #butang button{
            padding: 0;
            margin: 10px;
            width: 100px;
            height: 50px;
            background-color: rgb(255, 234, 206);
            border-radius: 5px;
            border: none;
            font-family: 'varela round', sans-serif;
            font-weight: bolder;
            color: #352407;
            transition: all 0.2s;
        }

        #butang button:hover{
            cursor: pointer;
            background-color: #FF8A00;
            color: #ffffff;
        }

        #butang button:focus{
            outline: none;
        }
        ::-webkit-scrollbar{
            width: 12px;
            background-color: #000000;
        }

        ::-webkit-scrollbar-thumb{
            background: linear-gradient(transparent, #352407);
            border-radius: 6px;
        }

        ::-webkit-scrollbar-thumb:hover{
            background: linear-gradient(transparent, #ffa408);
        }

        .margin-auto{
            margin: auto;
        }

        .backbtn{
            margin: 0 0 0 1%;
        }

        .backbtn #backtxt{
            cursor: pointer;
            text-decoration: none;
            font-size: 20px;
            transition: ease-in-out 0.5s;
        }

        .backbtn #backtxt a{
            text-decoration: none;
            color: black;
        }

        .backbtn #backtxt a:hover{
            color: #794f08;
            border-bottom: 2px solid #794f08;
        }

        .error {
            color: red;
        }

        @media (max-width: 1300px) {
            .container{
            flex-direction: column;
            height: auto;
            }

            .container .left{
                display: flex;
                flex-direction: column;
                float:none;
                width: 100%;
                margin: auto;
                height: auto;
                border-radius: 10px 10px 0px 0px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="backbtn">
            <h3 id="backtxt"><a href="../index.php" ><i class="fa fa-arrow-left" style="font-size:24px"></i>  Back To Main</a></h3>
        </div>
        <div class="container">
            <div class="left">
                <div class="margin-auto">
                    <div class="word">
                        <img src="../img/logo.png" alt="small-logo">
                    </div>
                    <div class="word-2">
                        <h1 id="welcome">Welcome!</h1>
                        <h1 id="sign">Sign in here</h1>
                        <br>
                        <br>
                        <h1 id="newhere">Have an account?</h1>
                        <h3 id="signpage"><a href="sign-in.php" >Sign in as Admin or Customer</a></h3>
                    </div>
                </div>
            </div>
            <div class="right">
                <div class="form-box">
                    <h1>Create Account</h1>
                    <hr>
                    <form name="register" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="input-box">
                            <p>USERNAME</p>
                            <i class='fas fa-user-alt' style="color: #ffa200;"></i>  <input class="input-element" type="text" name="usern" id="usern" placeholder="Enter username" value="<?php echo $username; ?>" >
                            <br>
                            <span class="error"><?php echo $usernameErr; ?></span>
                        </div>
                        <div class="input-box">
                            <p>FULL NAME</p>
                            <i class='fas fa-user-alt' style="color: #ffa200;"></i>  <input class="input-element" type="text" name="fname" id="fnm" placeholder="Enter full name" value="<?php echo $fname; ?>">
                            <br>
                            <span class="error"><?php echo $fnameErr; ?></span>
                        </div>
                        <div class="input-box">
                            <p>EMAIL ADDRESS</p>
                            <i class='fas fa-envelope-open' style='color:#ffa200'></i>  <input class="input-element" type="email" name="email" id="emailadd" placeholder="Enter email address" value="<?php echo $email; ?>">
                            <br>
                            <span class="error"><?php echo $emailErr; ?></span>
                        </div>
                        <div class="input-box">
                            <p>PHONE NO.</p>
                            <i class='fas fa-address-book' style='color:#ffa200'></i>  <input class="input-element" name="phone" id="hpno" placeholder="Enter phone no. exp: +60101234567" value="<?php echo $mobileNum; ?>">
                            <br>
                            <span class="error"><?php echo $mobileNumErr; ?></span>
                        </div>
                        <div class="input-box">
                            <p>ADDRESS LINE</p>
                            <i class='fas fa-home' style='color:#ffa200'></i>  <input class="input-element" type="text" name="add-1" id="ad1" placeholder="Enter address line" value="<?php echo $address; ?>">
                            <br>
                            <span class="error"><?php echo $addressErr; ?></span>
                        </div>
                        <div class="input-box">
                            <p>POSTCODE</p>
                            <i class='fas fa-map' style='color:#ffa200'></i>  <input class="input-element" type="number" name="post" id="pst" placeholder="Enter postcode" value="<?php echo $postcode; ?>">
                            <br>
                            <span class="error"><?php echo $postcodeErr; ?></span>
                        </div>
                        <div class="input-box">
                            <p>CITY</p>
                            <i class='fas fa-building' style='color:#ffa200'></i>  <input class="input-element" type="text" name="city" id="cty" placeholder="Enter city" value="<?php echo $city; ?>">
                            <br>
                            <span class="error"><?php echo $cityErr; ?></span>
                        </div>
                        <div class="selecting input-box">
                            <i class='fas fa-map-marker-alt' style='color:#ffa200'></i><label for="state">STATE</label>
                            <select name="state" id="state">
                                <option <?php if($state=="") echo 'selected="selected"'; ?> value="select">SELECT A STATE</option>
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
                            <br>
                            <span class="error"><?php echo $stateErr; ?></span>
                        </div>
                        <div class="input-box">
                            <p>GENDER</p>
                            <input type="radio" id="male" name="gender" value="male" <?php if($gender == 'male') echo 'checked=checked';?>/>
                            <label style="color: rgb(252, 162, 0); font-size: 20px;" for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female" <?php if($gender == 'female') echo 'checked=checked';?>/>
                            <label style="color: rgb(252, 162, 0); font-size: 20px;" for="female">Female</label><br>
                            <span class="error"><?php echo $genderErr; ?></span>  
                        </div>
                        <div class="input-box">
                            <p>PASSWORD</p>
                            <i class='fas fa-unlock-alt' style="color: #ffa200;"></i>  <input class="input-element" type="password" name="passw" id="psw" placeholder="Enter password" value="<?php echo $password; ?>">
                            <br>
                            <span class="error"><?php echo $passwordErr; ?></span>
                        </div>
                        <div class="input-box">
                            <p>RETYPE PASSWORD</p>
                            <i class='fas fa-unlock-alt' style="color: #ffa200;"></i>  <input class="input-element" type="password" name="cpassw" id="cpsw" placeholder="Re-enter password" value="<?php echo $confirmPass; ?>">
                            <br>
                            <span class="error"><?php echo $confirmPassErr; ?></span>
                        </div>
                        <div class="keep input-box">
                            <input type="checkbox" name="terms" id="terms" value="terms">
                            <label for="terms">I agree to the Terms of Use and understand that my information will be used as described on this page and the ExpressEat Café Privacy Policy</label>
                            <br>
                            <span class="error"><?php echo $conditionErr; ?></span>
                        </div>
                        <br>
                        <br>
                        <div class="input-box" id="butang">
                            <button type="submit" name="register">Register</button>
                            &nbsp;
                            <input  id="butang" type="reset" value="Clear Form" onclick="clearFunc()"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function clearFunc()
        {
            document.getElementById("usern").value="";
            document.getElementById("fnm").value="";
            document.getElementById("emailadd").value="";
            document.getElementById("hpno").value="";
            document.getElementById("ad1").value="";
            document.getElementById("ad2").value=""; 
            document.getElementById("pst").value="";
            document.getElementById("cty").value="";
            document.getElementById("state").value="";
            document.getElementById("psw").value="";			
            document.getElementById("cpsw").value="";
            document.getElementById("terms").checked="";
        }
    </script>
</body>
</html>