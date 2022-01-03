<?php 
include '../database/dbConnection.php'; 
include '../class/AdminClass.php';

$error ="";
$adminObj = new Admin($conn);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // username and password sent from form 
    $myusername = $_POST['usern'];
    $mypassword = $_POST['passw']; 

    $authentication = $adminObj->loginAuthentication($myusername,$mypassword);

    if(!$authentication){
        $error = "Your Login Name or Password is invalid";
        
    }else{
        // Set sessions
        if(!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['login_user'] = $myusername;
        $_SESSION['login_pass'] = $mypassword;

        // Login time is stored in a session variable 
        $_SESSION["login_time_stamp"] = time(); 
        
        header('location:../Admin-Folder/dashboard.php');
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&display=swap" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <title>Login</title>
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
            height: 100vh;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Varela Round', sans-serif;
        }

        .background{
            margin: 5% auto;
            width: 50%;
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
            height: auto;
            width: 40%;
            background-image: linear-gradient(#FF8A00, #ffa200);
            border-radius: 10px 0px 0px 10px;
        }

        .word{
            justify-content: center;
            width: 100%;
            display: flex;
            flex-direction: row;
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
            width: 60%;
            height: 100%;
            padding-bottom: 50px;
        }

        .form-box {
            margin: auto;
            height: auto;
        }

        .form-box form{
            padding: 0 20px;
        }

        .form-box p{
            margin: 30px 0px 20px 20px;
            color: #ffa200;
            font-weight: bolder;
            font-size: 20px;
        }

        .form-box h1{
            text-align: center;
            border: none;
            margin-bottom: 0%;
        }

        .form-box hr {
            width: 100px;
            height: 5px;
            background: #ffa200;
            border: none;
            border-radius: 1px;
            margin-bottom: 50px;
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
            transform: scale(1.5);
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
            transform: scale(1.5);
            cursor: pointer;
            background-color: #FF8A00;
            color: #ffffff;
        }

        #butang button:focus{
            outline: none;
        }

        .error {
            color: rgb(250, 164, 164);
            font-size: 80%;
            font-style: italic;
        }

        ::placeholder { 
            color: rgb(241, 200, 137);
            opacity: 1; 
            font-style: italic;
            letter-spacing: 1px;
            font-size: larger;
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

        @media (max-width: 1350px) {
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
                padding: 0%;
            }

            .container .right{
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="backbtn">
            <h3 id="backtxt"><a href="../index.php" ><i class="fa fa-arrow-left" style="font-size:24px"></i>  Back To Main</a></h3>
        </div>
        <div class="container">
            <div class="left">
                <div class="word">
                    <img src="../img/logo.png" alt="small-logo">
                </div>
                <div class="word-2">
                    <h1 id="welcome">Welcome!</h1>
                    <h1 id="sign">Sign in here</h1>
                    <br>
                    <br>
                    <br>
                    <h1 id="newhere">new user here?<b> Sign up now!</b></h1>
                    <h3 id="create"><a href="register-user.php" >Create An Account</a></h3>
                    <h1 id="newhere">or</h1>
                    <h3 id="signpage"><a href="sign-in-user.php" >Sign in as Customer</a></h3>
                </div>
            </div>
            <div class="right">
                <div class="form-box">
                    <h1>Sign In As Admin</h1>
                    <hr>
                    <form name="login" method="POST" action="">
                        <div style = "font-size:20px; color:#cc0000; margin-top:10px; text-align: center;"><?php echo $error; ?></div>
                        <div>
                            <p>USERNAME</p>
                            <i class='fas fa-user-alt' style="color: #ffa200;"></i>  <input class="input-element" type="text" name="usern" id="usern" placeholder="Enter username">
                        </div>
                        <div class="error" id="usernameErr"></div>
                        <div>
                            <p>PASSWORD</p>
                            <i class='fas fa-unlock-alt' style="color: #ffa200;"></i>  <input class="input-element" type="password" name="passw" id="psw" placeholder="Enter password">
                        </div>
                        <div class="error" id="passwordErr"></div>
                        <br>
                        <br>
                        <div id="butang">
                            <button type="submit" onclick="return register()">Sign In</button>
                            &nbsp;
                            <input  id="butang" type="reset" value="Clear Form" onclick="clearFunc()" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    function register()
	{
        var uname= document.getElementById("usern").value;
        var pwd= document.getElementById("psw").value;

		if(uname=='')
        {
            alert('Please enter your username');
            return false;
        }
        else if(pwd=='')
        {
             alert('Please enter Password');
            return false;
        }
    }

    function clearFunc()
    {
        document.getElementById("usern").value="";
        document.getElementById("psw").value="";			
    }

    </script>
</body>
</html>