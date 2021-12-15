<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
include '../Login/sessionCustomer.php';

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
                    <li><a class="home-tab" href="profile-page.php"><i style="font-size:30px" class="fa fa-user" aria-hidden="true"></i>  <?php echo $username?></a></li>
                    <li><a class="home-tab" href="signout-page.php">Sign Out</a></li>
                </ul>
            </div>
        </header>
        <div class="profile-detail">
            <h1>MY PROFILE</h1>
            <div class="profile-tbl">
                <div class="sidebar-profile profile-width-20 flex-col">
                    <i class="fa fa-user"></i>
                    <h1>redscarf</h1> 
                    <button id="viewbtn" class="sidebar-profile-btn sidebar-btn-active " onclick="viewProfile()">View Profile</button> 
                    <button id="editbtn" class="sidebar-profile-btn" onclick="editProfile()">Edit Profile</button>   
                    <button id="myorder" class="sidebar-profile-btn" onclick="myOrder()">Order History</button>       
                </div>
                <div class="main-profile profile-width-80">
                    <div id="view-profile-div" class="">
                        <div class="main-profile-detail">
                            <div class="profile-width-5"></div>
                            <div class="main-profile-detail-left ">
                                <div class="user-detail">
                                    <h3>Username</h3>
                                    <input class="input-detail" type="text" id="username" value="<?php echo $username?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Full Name</h3>
                                    <div>
                                        <input id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                                    </div>
                                </div>
                                <div class="user-detail">
                                    <h3>Email</h3>
                                    <input id="email" class="input-detail" type="text" value="<?php echo $email?>">
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
                                    <input id="phonenumber" class="input-detail" type="text" value="<?php echo $phonenum?>">
                                </div>
                            </div>
                            <div class="profile-width-20"></div>
                            <div class="main-profile-detail-right">
                                <div class="user-detail">
                                    <h3>Address Line</h3>
                                    <input id="addressline" class="input-detail" type="textarea" value="<?php echo $addressline?>">
                                </div>
                                <div class="user-detail flex-row">
                                    <div class="user-detail-col profile-margin-3">
                                        <h3>City</h3>
                                        <input id="city" class="input-detail" type="text" value="<?php echo $area?>">
                                    </div>
                                    <div class="user-detail-col">
                                        <h3>Postcode</h3>
                                        <input id="postcode" class="input-detail" type="number" value="<?php echo $postalcode?>">
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
                                    <input id="password" class="input-detail" type="password" value="<?php echo $password?>">
                                </div>
                                <br>
                                <div class="user-detail-btn">
                                    <button disabled id="save-edit" onclick="disableInfoInput()" type="submit" class="save-edit-btn red-bg">Save Changes</button>
                                </div>
                            </div>
                            <div class="profile-width-5"></div>
                        </div>

                    </div>

                    <div id="edit-profile-div" class="none">
                        <div class="main-profile-detail" >
                            <div class="profile-width-5"></div>
                            <div class="main-profile-detail-left ">
                                <form action="">
                                    <div class="user-detail">
                                        <h3>Username</h3>
                                        <input class="input-detail" type="text" id="username" value="<?php echo $username?>">
                                    </div>
                                    <div class="user-detail">
                                        <h3>Full Name</h3>
                                        <div>
                                            <input id="fullname" class="input-detail" type="text" value="<?php echo $fullname?>">
                                        </div>
                                    </div>
                                    <div class="user-detail">
                                        <h3>Email</h3>
                                        <input id="email" class="input-detail" type="text" value="<?php echo $email?>">
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
                                        <input id="phonenumber" class="input-detail" type="text" value="<?php echo $phonenum?>">
                                    </div>
                                </div>
                                <div class="profile-width-20"></div>
                                <div class="main-profile-detail-right">
                                    <div class="user-detail">
                                        <h3>Address Line</h3>
                                        <input id="addressline" class="input-detail" type="textarea" value="<?php echo $addressline?>">
                                    </div>
                                    <div class="user-detail flex-row">
                                        <div class="user-detail-col profile-margin-3">
                                            <h3>City</h3>
                                            <input id="city" class="input-detail" type="text" value="<?php echo $area?>">
                                        </div>
                                        <div class="user-detail-col">
                                            <h3>Postcode</h3>
                                            <input id="postcode" class="input-detail" type="number" value="<?php echo $postalcode?>">
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
                                        <input id="password" class="input-detail" type="password" value="<?php echo $password?>">
                                    </div>
                                    <br>
                                    <div class="user-detail-btn">
                                        <button id="save-edit" onclick="disableInfoInput()" type="submit" class="save-edit-btn red-bg">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                            <div class="profile-width-5"></div>
                        </div>
                    </div>
                    


                    <div id="user-purchase-div" class="none">
                        <br>
                        <div class="order-status-filter">
                            <h3 class="status-active"><a href="">All</a></h3>
                            <h3><a href="">Pending</a></h3>
                            <h3><a href="">On Delivery/Self-Pickup</a></h3>
                            <h3><a href="">Completed</a></h3>
                            <h3><a href="">Cancel</a></h3>
                        </div>
                        <br>
                        <div class="order-content-all flex-col">
                            <div class="set-layout">
                                <div class="set-layout-header-1 red-bg">
                                    <div class="status-div">
                                        <h3 class="white-txt">Completed</h3>
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
                        </div>`
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

    </script>
</body>
</html>