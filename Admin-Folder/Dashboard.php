<?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    include '../Login/sessionAdmin.php';

    $username = $_SESSION['login_user'];
    $password = $_SESSION['login_pass'];

    echo '<script>alert("'.$username.'")</script>';

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
            <div id="Home-div">
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
            <div id="Profile-div">
                <h2>Profile</h2>
            </div>
            <div id="Store-div">
                <h2>Store</h2>
            </div>
            <div id="Customer-div">
                <h2>Customer</h2>
            </div>
            <div id="Product-div">
                <h2>Product</h2>
            </div>
            <div id="Order-div">
                <h2>Order</h2>
            </div>
            <div id="Signout-div">
                <h2>Signout</h2>
            </div>

        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>

    <script>

        //Variable declaration synced to ID
        var homediv = document.getElementById('Home-div');
        var profilediv = document.getElementById('Profile-div');
        var storediv = document.getElementById('Store-div');
        var customerdiv = document.getElementById('Customer-div');
        var productdiv = document.getElementById('Product-div');
        var orderdiv = document.getElementById('Order-div');
        var signoutdiv = document.getElementById('Signout-div');

        function Home(){

            //Set div visibility
            homediv.style.display = "block";
            profilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";
            signoutdiv.style.display = "none";




        }
        function viewProfile(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "block";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";
            signoutdiv.style.display = "none";


            
        }
        function viewStore(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            storediv.style.display = "block";
            customerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";
            signoutdiv.style.display = "none";


            
        }
        function viewCustomer(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "block";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";
            signoutdiv.style.display = "none";


            
        }
        function viewProduct(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            productdiv.style.display = "block";
            orderdiv.style.display = "none";
            signoutdiv.style.display = "none";


            
        }
        function viewOrder(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "block";
            signoutdiv.style.display = "none";


            
        }
        function SignOut(){

            //Set div visibility
            homediv.style.display = "none";
            profilediv.style.display = "none";
            storediv.style.display = "none";
            customerdiv.style.display = "none";
            productdiv.style.display = "none";
            orderdiv.style.display = "none";
            signoutdiv.style.display = "block";


            
        }
    </script>
</body>
</html>