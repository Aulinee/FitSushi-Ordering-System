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
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
                    <form name="register" method="POST" action="registration.php">
                        <div class="input-box">
                            <p>USERNAME</p>
                            <i class='fas fa-user-alt' style="color: #ffa200;"></i>  <input class="input-element" type="text" name="usern" id="usern" placeholder="Enter username">
                        </div>
                        <div class="input-box">
                            <p>FIRST NAME</p>
                            <i class='fas fa-user-alt' style="color: #ffa200;"></i>  <input class="input-element" type="text" name="fname" id="fnm" placeholder="Enter first name">
                        </div>
                        <div class="input-box">
                            <p>LAST NAME</p>
                            <i class='fas fa-user-alt' style="color: #ffa200;"></i>  <input class="input-element" type="text" name="lname" id="lnm" placeholder="Enter last name">
                        </div>
                        <div class="input-box">
                            <p>EMAIL ADDRESS</p>
                            <i class='fas fa-envelope-open' style='color:#ffa200'></i>  <input class="input-element" type="email" name="email" id="emailadd" placeholder="Enter email address">
                        </div>
                        <div class="input-box">
                            <p>PHONE NO.</p>
                            <i class='fas fa-address-book' style='color:#ffa200'></i>  <input class="input-element" name="phone" id="hpno" placeholder="Enter phone no. exp: +60101234567">
                        </div>
                        <div class="input-box">
                            <p>ADDRESS LINE 1</p>
                            <i class='fas fa-home' style='color:#ffa200'></i>  <input class="input-element" type="text" name="add-1" id="ad1" placeholder="Enter address line 1">
                        </div>
                        <div class="input-box">
                            <p>POSTCODE</p>
                            <i class='fas fa-map' style='color:#ffa200'></i>  <input class="input-element" type="number" name="post" id="pst" placeholder="Enter postcode">
                        </div>
                        <div class="input-box">
                            <p>CITY</p>
                            <i class='fas fa-building' style='color:#ffa200'></i>  <input class="input-element" type="text" name="city" id="cty" placeholder="Enter city">
                        </div>
                        <div class="selecting input-box">
                            <i class='fas fa-map-marker-alt' style='color:#ffa200'></i><label for="state">STATE</label>
                            <select name="state" id="state">
                                <option value="">--SELECT A STATE--</option>
                                <option value="Melaka">Melaka</option>
                                <option value="Terengganu">Terengganu</option>
                                <option value="Selangor">Selangor</option>
                                <option value="Sarawak">Sarawak</option>
                                <option value="Sabah">Sabah</option>
                                <option value="Perlis">Perlis</option>
                                <option value="Perak">Perak</option>
                                <option value="Pahang">Pahang</option>
                                <option value="Negeri Sembilan">Negeri Sembilan</option>
                                <option value="Kelantan">Kelantan</option>
                                <option value="Kuala Lumpur">Kuala Lumpur</option>
                                <option value="Pulau Pinang">Pulau Pinang</option>
                                <option value="Kedah">Kedah</option>
                                <option value="Johor">Johor</option>
                                <option value="Labuan">Labuan</option>
                                <option value="Putrajaya">Putrajaya</option>
                            </select>
                            <div class="error" id="stateErr"></div>
                        </div>
                        <div class="input-box">
                            <p>GENDER</p>
                            <input type="radio" id="male" name="gender" value="male">
                            <label style="color: rgb(252, 162, 0); font-size: 20px;" for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label style="color: rgb(252, 162, 0); font-size: 20px;" for="female">Female</label><br>  
                        </div>
                        <div class="input-box">
                            <p>PASSWORD</p>
                            <i class='fas fa-unlock-alt' style="color: #ffa200;"></i>  <input class="input-element" type="password" name="passw" id="psw" placeholder="Enter password">
                        </div>
                        <div class="input-box">
                            <p>RETYPE PASSWORD</p>
                            <i class='fas fa-unlock-alt' style="color: #ffa200;"></i>  <input class="input-element" type="password" name="cpassw" id="cpsw" placeholder="Re-enter password">
                        </div>
                        <div class="keep input-box">
                            <input type="checkbox" name="terms" id="terms" value="terms">
                            <label for="terms">I agree to the Terms of Use and understand that my information will be used as described on this page and the ExpressEat Café Privacy Policy</label>
                        </div>
                        <br>
                        <br>
                        <div class="input-box" id="butang">
                            <button type="submit" onclick="return registration()">Register</button>
                            &nbsp;
                            <input  id="butang" type="reset" value="Clear Form" onclick="clearFunc()"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function registration()
        {  
            var uname= document.getElementById("usern").value;
            var fname= document.getElementById("fnm").value;
            var lname= document.getElementById("lnm").value;
            var email= document.getElementById("emailadd").value;
            var phone= document.getElementById("hpno").value;
            var address1= document.getElementById("ad1").value;
            var postc= document.getElementById("pst").value;
            var city= document.getElementById("cty").value;
            var state1= document.getElementById("state").value; 
            var gender= document.forms["register"]["gender"].value;
            var pwd= document.getElementById("psw").value;			
            var cpwd= document.getElementById("cpsw").value;
            var termcon= document.getElementById("terms").checked;

            //regex expression code
            var pwd_expression = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~])[A-Za-z\d!"#$%&'()*+,-.:;<=>?@[\]^_`{|}~]{6,6}$/;
            var usrname = /^[A-Za-z]+$/;
            var names = /^([A-Z]){1}([a-z]){1,}$/;
            var mobile = /^[\+][6][0][1]\d{8,9}$/;
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if(uname=='')
            {
                alert('Please enter your username');
                return false;
            }
            else if(!usrname.test(uname))
            {
                alert('Name field required only alphabet characters');
                return false;
            }
            else if(fname=='')
            {
                alert('Please enter your first name');
                return false;
            }
            else if(!names.test(fname))
            {
                alert('Name field required only alphabet characters and uppercase first letter');
                return false;
            }
            else if(lname=='')
            {
                alert('Please enter your last name');
                return false;
            }
            else if(!names.test(lname))
            {
                alert('Name field required only alphabet characters');
                return false;
            }
            else if(email=='')
            {
                alert('Please enter your user email');
                return false;
            }
            else if (!filter.test(email))
            {
                alert('Invalid email');
                return false;
            }
            else if(phone=='')
            {
                alert('Please enter phone number.');
                return false;
            }
            else if(!mobile.test(phone))
            {
                alert('Phone no. field requires +60 and only numbers');
                return false;
            }
            else if(address1=='')
            {
                alert('Please enter your address line 1');
                return false;
            }
            else if(postc=='')
            {
                alert('Please enter your postcode');
                return false;
            }
            else if(document.getElementById("pst").value.length < 5)
            {
                alert ('Postcode digit length is 5');
                return false;
            }
            else if(city=='')
            {
                alert('Please enter your city');
                return false;
            }
            else if(state1=='')
            {
                alert("Please select your state");
                return false;
            }
            else if(document.forms["register"]["male"].checked==false && document.forms["register"]["female"].checked==false)
            {
                alert("You must select male or female");
                return false;
            }
            else if(pwd=='')
            {
                alert('Please enter Password');
                return false;
            }
            else if(cpwd=='')
            {
                alert('Enter Confirm Password');
                return false;
            }
            else if(!pwd_expression.test(pwd))
            {
                alert ('At least ONE Uppercase, ONE Lowercase, ONE Special character, ONE Numeric letter and 6 DIGITS LENGTH are required in Password filed');
                return false;
            }
            else if(pwd != cpwd)
            {
                alert ('Password not Matched');
                return false;
            }
            else if(document.getElementById("terms").checked==false)
            {
                alert('Please agree on the terms and conditions!');
                return false;
            }
            else if(gender.checked==false)
            {
                alert('Please agree on the terms and conditions!');
                return false;
            }
            else
            {
                alert('Thank You for Registering & Please Login'); 
                // registerPage.style.display = 'none';
                // successPage.style.visibility = 'visible';
                // return false;
                // location.pathname= "login.html";
                // return false;
            }

        }

        function clearFunc()
        {
            document.getElementById("usern").value="";
            document.getElementById("fnm").value="";
            document.getElementById("lnm").value="";
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