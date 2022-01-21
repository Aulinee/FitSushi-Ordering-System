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
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link rel="fitsushi icon" href="../img/logo.png" type="image/x-icon">
    <link href="../style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>Menu</title>
</head>
<body>
    <div>
        <header id="navbar" class="">
            <div class="container">
                <img class="word-logo left" src="../img/logo-title.png" alt="logo">
                <ul class="right">
                    <li><a class="home-tab" href="main-page.php">Home</a></li>
                    <li><a class="home-tab current" href="menu-page.php">Menu</a></li>
                    <li><a class="home-tab" href="sushibox-page.php">Sushibox</a></li>
                    <li><a class="home-tab" href="profile-page.php"><i style="font-size:30px" class="fa fa-user" aria-hidden="true"></i>  <?php echo $username?></a></li>
                    <li><a class="home-tab" onclick="logout()">Sign Out</a></li>
                </ul>
            </div>
        </header>
        <div class="menu-header">
            <h1 class="black-txt">MENU</h1>
        </div>
        <!-- <div class="flex" id="flexbox">
            <a href="#ala-carte">Ala Carte</a>
            <div class="width-4"></div>
            <a href="#set-menu">Custom Set</a>
        </div> -->
        <div class="menu-detail" id="ala-carte">
            <div class="menu-table red-bg white-txt">
                <br>
                <h1>ALA CARTE</h1>
                <h3>The list of our sushi menu</h3>
                <div class="menu-table-detail">
                    <?php 
                        $menulist = $menuObj->getAlacarteMenuList();
                        foreach($menulist as $array) {
                            echo'
                                <div class="col-container ">
                                    <div class="col">
                                        <div class="">
                                            <img class="menu-img" src="data:image/jpeg;base64,'.base64_encode( $array['img'] ).'" alt="'.$array['name'].'"/>
                                        </div>
                                        <div class="details">
                                            <h2 class="detail-title margin-0">'.$array['name'].'</h2>
                                            <h5 class="details-title-desc margin-0">'.$array['desc'].'</h5>
                                            <h1 class="details-title-price margin-0">RM '.$array['price'].'</h1>
                                            <div>
                                                <form onclick="" class="input-menu menu-row" name="menu" action="addAlacarte-page.php?id='.$array['id'].'" method="post">
                                                    <div class="input-btn menu-row">
                                                        <h5 class="minus-btn" onclick="decrement(\''.$array['id'].'\')">-</h5>
                                                        <input id="'.$array['id'].'" name="'.$array['id'].'" type=number min=0 max=110 value=0>
                                                        <h5 class="plus-btn" onclick="increment(\''.$array['id'].'\')">+</h5>
                                                    </div>
                                                    <button class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';       
                        }  
                    ?>
                </div>
                <br>
                <h1>Our Way, Our Home</h1>
                <h3>Small menu, endless flavours</h3>
                <br>
            </div>
        </div>
        <br>
        <br>
    </div>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script type="text/javascript">
        window.onscroll = function() {myFunction()};

        var navbar = document.getElementById("flexbox");
        var sticky = navbar.offsetTop;

        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky")
            } else {
                navbar.classList.remove("sticky");
            }
        }

        function increment(name) {
            document.getElementById(name).stepUp();
        }

        function decrement(name) {
            document.getElementById(name).stepDown();
        }

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

        function successAdded(form) {
            var qty = document.getElementsByTagName("input")[0];

            if(qty == 0){
                Swal.fire({
                    icon: 'error',
                    title: 'You added zero sushi quantity!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                    }
                });
            }else{
                Swal.fire({
                    icon: 'success',
                    title: 'Successfully added menu to sushibox!',
                    }).then((result) => {
                    if (result.isConfirmed) {
                    }
                });
            }
            
        }
    </script>
</body>
</html>