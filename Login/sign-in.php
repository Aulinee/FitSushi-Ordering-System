<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="http://fonts.cdnfonts.com/css/nats" rel="stylesheet">
    <title>Login Main</title>
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

        .main-container{
            margin: auto;
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

        .container .right {
            margin: auto;
            float: right;
            width: 60%;
            height: 100%;
            padding-bottom: 50px;
        }

        .form-box {
            width: auto;
            height: auto;
        }

        .form-box h1{
            text-align: center;
            border: none;
            margin-bottom: 0%;
        }

        .form-box hr {
            width: 20px;
            height: 5px;
            background: #ffa200;
            border: none;
            border-radius: 1px;
            margin-bottom: 50px;
        }

        .row-log{
            justify-content: center;
            display: flex;
            flex-direction: row;
        }

        .col-log{
            width: auto;
        }

        .butang-log{
            padding: 18px 30px;
            background-color: rgb(255, 234, 206);
            border: none;
            border-radius: 10px;
            width: 150px;
        }

        .margin{
            margin-left: 10px;
        }

        .butang-log a{
            text-decoration: none;
        }

        .butang-log a{
            text-decoration: none;
            color: rgb(75, 38, 38);
            font: 'varela round';
            font-weight: bold;
            letter-spacing: 2px;
        }

        .butang-log a:hover{
            color: rgb(255, 255, 255);
        }

        .butang-log:hover{
            background-color: tomato;
            transform: scale(1.2);
            transition: ease-in 0.2s;
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

        @media (max-width: 1300px) {
            .container{
                flex-direction: column;
                height: auto;
                margin: 5% 0;
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
                <div class="word">
                    <img src="../img/logo.png" alt="small-logo">
                </div>
                <div class="word-2">
                    <h1 id="welcome">Welcome!</h1>
                    <h1 id="sign">Sign in here</h1>
                    <h1 id="newhere">new user here?<b> Sign up now!</b></h1>
                    <h3 id="create"><a href="register-user.php" >Create An Account</a></h3>
                </div>
            </div>
            <div class="right">
                <div class="form-box">
                    <h1>Sign In</h1>
                    <hr>
                    <div class="row-log-1">
                        <div class="row-log">
                            <br>
                            <h2>Sign in as:</h2>
                            <br>
                            <br>
                        </div>
                        <div class="row-log">
                            <div class="col-log">
                                <button class="butang-log"><a href="sign-in-admin.php">ADMIN</a>
                                </button>
                            </div>
                            <div class="col-log">
                                <button class="butang-log margin"><a href="sign-in-user.php">CUSTOMER</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>