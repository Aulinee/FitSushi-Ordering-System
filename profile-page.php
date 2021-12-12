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
    <link rel="stylesheet" href="style/style.css">
    <title>User Profile</title>
</head>
<body>
    <div>
        <header id="navbar" class="">
            <div class="container">
                <img class="word-logo left" src="img/title.png" alt="logo">
                <ul class="right">
                    <li><a class="home-tab" href="main-page.php">Home</a></li>
                    <li><a class="home-tab" href="menu-page.php">Menu</a></li>
                    <li><a class="home-tab" href="sushibox-page.php">Sushi</a></li>
                    <li><a class="home-tab" href="profile-page.php">Redscarf</a></li>
                    <li><a class="home-tab" href="signout-page.php">Sign Out</a></li>
                </ul>
            </div>
        </header>
        <div class="profile-detail" id="view-profile-div">
            <h1>MY PROFILE</h1>
            <div class="profile-tbl">
                <div class="sidebar-profile profile-width-20 flex-col">
                    <i class="fa fa-user"></i>
                    <h1>redscarf</h1> 
                    <button class="sidebar-profile-btn sidebar-btn-active " onclick="disableInfoInput()">View Profile</button> 
                    <button class="sidebar-profile-btn" onclick="enableInfoInput()">Edit Profile</button>   
                    <button class="sidebar-profile-btn" onclick="enableInfoInput()">Order History</button>       
                </div>
                <div class="main-profile profile-width-80">
                    <div class="main-profile-detail">
                        <div class="profile-width-5"></div>
                        <div class="main-profile-detail-left ">
                            <div class="user-detail">
                                <h3>Username</h3>
                                <input class="input-detail" type="text" id="username" value="redscarf">
                            </div>
                            <div class="user-detail">
                                <h3>Full Name</h3>
                                <div>
                                    <input id="fullname" class="input-detail" type="text" value="redscarf">
                                </div>
                            </div>
                            <div class="user-detail">
                                <h3>Email</h3>
                                <input class="input-detail" type="text" value="audreyduyan@gmail.com">
                            </div>
                            <div class="user-detail">
                                <h3>Gender</h3>
                                <div>
                                    <div class="gender-detail">
                                        <input id="gender" class="" name="gender" type="radio" value="male">
                                        <label for="gender">Male</label>
                                    </div>
                                    <div class="gender-detail">
                                        <input id="gender" class="" name="gender" type="radio" value="female">
                                        <label for="gender">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="user-detail">
                                <h3>Phone Number</h3>
                                <input id="phonenumber" class="input-detail" type="text" value="01114095674">
                            </div>
                        </div>
                        <div class="profile-width-20"></div>
                        <div class="main-profile-detail-right">
                            <div class="user-detail">
                                <h3>Address Line</h3>
                                <input id="addressline" class="input-detail" type="text" value="redscarf">
                            </div>
                            <div class="user-detail flex-row">
                                <div class="user-detail-col profile-margin-3">
                                    <h3>City</h3>
                                    <input id="city" class="input-detail" type="text" value="Kuching">
                                </div>
                                <div class="user-detail-col">
                                    <h3>Postcode</h3>
                                    <input id="postcode" class="input-detail" type="number" value="93450">
                                </div>
                            </div>
                            <div class="user-detail">
                                <h3>State</h3>
                                <input id="state" class="input-detail" type="text" value="redscarf">
                            </div>
                            <div class="user-detail">
                                <h3>Password</h3>
                                <input id="password" class="input-detail" type="password" value="redscarf">
                            </div>
                            <br>
                            <div class="user-detail-btn">
                                <button id="save-edit" onclick="disableInfoInput()" type="submit" class="save-edit-btn red-bg">Save Changes</button>
                            </div>
                        </div>
                        <div class="profile-width-5"></div>
                    </div>
                </div>
            </div>
            <br>
            <!-- edit profile div -->
            <div class="profile-tbl">
                <div class="sidebar-profile profile-width-20 flex-col">
                    <i class="fa fa-user"></i>
                    <h1>redscarf</h1> 
                    <button class="sidebar-profile-btn" onclick="disableInfoInput()">View Profile</button> 
                    <button class="sidebar-profile-btn sidebar-btn-active " onclick="enableInfoInput()">Edit Profile</button>   
                    <button class="sidebar-profile-btn" onclick="enableInfoInput()">Order History</button>       
                </div>
                <div class="main-profile profile-width-80">
                    <div class="main-profile-detail">
                        <div class="profile-width-5"></div>
                        <div class="main-profile-detail-left ">
                            <div class="user-detail">
                                <h3>Username</h3>
                                <input class="input-detail" type="text" id="username" value="redscarf">
                            </div>
                            <div class="user-detail">
                                <h3>Full Name</h3>
                                <div>
                                    <input id="fullname" class="input-detail" type="text" value="redscarf">
                                </div>
                            </div>
                            <div class="user-detail">
                                <h3>Email</h3>
                                <input class="input-detail" type="text" value="audreyduyan@gmail.com">
                            </div>
                            <div class="user-detail">
                                <h3>Gender</h3>
                                <div>
                                    <div class="gender-detail">
                                        <input id="gender" class="" name="gender" type="radio" value="male">
                                        <label for="gender">Male</label>
                                    </div>
                                    <div class="gender-detail">
                                        <input id="gender" class="" name="gender" type="radio" value="female">
                                        <label for="gender">Female</label>
                                    </div>
                                </div>
                            </div>
                            <div class="user-detail">
                                <h3>Phone Number</h3>
                                <input id="phonenumber" class="input-detail" type="text" value="01114095674">
                            </div>
                        </div>
                        <div class="profile-width-20"></div>
                        <div class="main-profile-detail-right">
                            <div class="user-detail">
                                <h3>Address Line</h3>
                                <input id="addressline" class="input-detail" type="text" value="redscarf">
                            </div>
                            <div class="user-detail flex-row">
                                <div class="user-detail-col profile-margin-3">
                                    <h3>City</h3>
                                    <input id="city" class="input-detail" type="text" value="Kuching">
                                </div>
                                <div class="user-detail-col">
                                    <h3>Postcode</h3>
                                    <input id="postcode" class="input-detail" type="number" value="93450">
                                </div>
                            </div>
                            <div class="user-detail">
                                <h3>State</h3>
                                <input id="state" class="input-detail" type="text" value="redscarf">
                            </div>
                            <div class="user-detail">
                                <h3>Password</h3>
                                <input id="password" class="input-detail" type="password" value="redscarf">
                            </div>
                            <br>
                            <div class="user-detail-btn">
                                <button id="save-edit" onclick="disableInfoInput()" type="submit" class="save-edit-btn red-bg">Save Changes</button>
                            </div>
                        </div>
                        <div class="profile-width-5"></div>
                    </div>
                </div>
            </div>
            <br>
            <!-- order history div -->
            <div class="profile-tbl">
                <div class="sidebar-profile profile-width-20 flex-col">
                    <i class="fa fa-user"></i>
                    <h1>redscarf</h1> 
                    <button class="sidebar-profile-btn" onclick="disableInfoInput()">View Profile</button> 
                    <button class="sidebar-profile-btn" onclick="enableInfoInput()">Edit Profile</button>   
                    <button class="sidebar-profile-btn sidebar-btn-active" onclick="enableInfoInput()">My Order</button>       
                </div>
                <div class="main-profile profile-width-80">
                    <br>
                    <div class="order-status-filter">
                        <h3 class="status-active"><a href="">All</a></h3>
                        <h3><a href="">Pending</a></h3>
                        <h3><a href="">On Delivery/Self-Pickup</a></h3>
                        <h3><a href="">Completed</a></h3>
                        <h3><a href="">Cancel</a></h3>
                    </div>
                    <br>
                    <div class="seriesinput-icons align-center">
                        <i class="fa fa-search seriesicon"></i>
                        <input class="seriesinput-field" type="text" id="seriesInput" onkeyup="filterSeries()" placeholder="Search by cast name.." title="Type in a name">
                    </div>
                    <div class="order-content-all">
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <h1>&copy; Copyright 2021 FitSushi</h1>
        </footer>
    </div>
    <script>
        function disableInfoInput() {
            document.getElementById("username").disabled = true;
            document.getElementById("username").style.backgroundColor = "#f9f9f9";
        }

        function enableInfoInput() {
            document.getElementById("username").disabled = false;
            document.getElementById("username").style.backgroundColor = "white";
        }

        // To filter all order by orderid, menu name etc
        function filterSeries() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("seriesInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("seriesTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[5];
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