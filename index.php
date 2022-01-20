<?php
    include 'database/dbConnection.php'; 
    include_once 'class/MenuClass.php'; 
    include_once 'class/AdminClass.php'; 

    $menuObj = new Menu($conn);
    $adminObj = new Admin($conn);

    //retrive store detail
    $store_detail = $adminObj->displayStoreDetail();

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>FitSushi</title>
    <link rel="fitsushi icon" href="../img/logo.png" type="image/x-icon">
</head>
<body>
    <div class="mainpage-bg">
        <header id="navbar" class="">
            <div class="container">
                <img class="word-logo left" src="img/logo-title.png" alt="logo">
                <ul class="right">
                    <li><a class="home-tab current" href="#">Home</a></li>
                    <li><a class="home-tab" href="Customer/menu-page-public.php">Menu</a></li>
                    <li><a class="home-tab" href="Login/sign-in.php">Sign In</a></li>
                </ul>
            </div>
        </header>
        <div class="flexbox-container" id="mainpage-section">
            <div class="flex-1" id="flexbox">
                <a href="#mainpage-section">Main Page</a>
                <a href="#about-section">About Us</a>
                <a href="#menu-section">Menu</a>
                <a href="#contact-section">Contact Us</a>
            </div>
            <div class="welcome">
                <div class="welcome-1">
                    <h1 class="yellow-txt">Welcome!</h1>
                </div>
                <div class="welcome-2 uppercase-txt">
                    <span class="">delicious sushi  </span>
                    <span class="red-txt">ready</span>
                </div>
                <div class="welcome-3">
                    <hr>
                </div>
                <div class="welcome-4">
                    <h1>Don't worry. We deliver fresh wherever you are.</h1>
                </div>
                <div class="welcome-5">
                    <button class="order-btn red-bg"><a class="white-txt" href="Login/sign-in.php">Order Now</a></button>
                </div>
            </div>
        </div>
    </div>
    <div class="about-us" id="about-section">
        <h1 class="yellow-txt">About Us</h1>
        <div class="abt-us-detail">
            <div class="width-20"></div>
            <div class="width-20">
                <img class="abt-us-icon" src="img/fresh2.png" alt="logo">
                <br>
                <h3 class="abt-us-txt">Guaranteed with fresh ingredient</h3>
            </div>
            <div class="width-10"></div>
            <div class="width-20">
                <img class="abt-us-icon" src="img/fast-delivery2.png" alt="logo">
                <br>
                <h3 class="abt-us-txt">Fast Delivery</h3>
            </div>
            <div class="width-10"></div>
            <div class="width-20">
                <img class="abt-us-icon" src="img/payment-method2.png" alt="logo">
                <br>
                <h3 class="abt-us-txt">Online payment method available.</h3>
            </div>
            <div class="width-20"></div>
        </div>
    </div>
    <div class="abt-menu red-bg" id="menu-section">
        <h1 class="yellow-txt">Menu</h1>
        <br>
        <h2 class="white-txt margin-minus">Keep browsing and it will get your mouth watering, just a few clicks and we will deliver it to you!</h2>
        <div class="menu-display white-border">
            <div class="width-4"></div>
            <?php 
                $menulist = $menuObj->getTopMenu();
                foreach($menulist  as $array) {
                    echo'
                        <div style="width: 1%;"></div>
                        <div style="display: flex; flex-direction: column; text-align: center; border: 1px solid var(--blue); width: 20%;">
                            <img style="margin: auto; width: 80%;" src="data:image/jpeg;base64,'.base64_encode( $array['img'] ).'" alt="'.$array['name'].'"/>
                            <div style="background-color: var(--blue);">
                                <h1 style="font-size: 30px; color:white;">'.$array['name'].'</h1>
                            </div>
                        </div>
                    ';
                }
            ?>
            <div class="width-4"></div>
        </div>
        <div class="padding-tb">
            <button class="order-btn yellow-bg"><a class="white-txt" href="Customer/menu-page-public.php">SEE MORE</a></button>
        </div>
    </div>
    <div class="abt-contact blue-bg white-txt" id="contact-section">
        <h1 class="yellow-txt">Contact Us</h1>
        <div class="abt-contact-detail">
            <div class="contact-1 vertical-border">
                <h1 class="title-underline">OUR SOCIAL MEDIA:</h1>
                <div class="socmed-detail">
                    <div class="width-10"></div>
                    <div class="socmed-quote">
                        <h1>“Forget the Old Way, We are Everywhere”-fitsushi</h1>   
                    </div>
                    <div class="width-10"></div>
                    <div class="socmed-info">
                        <h1>Instagram: &nbsp<a href="<?php echo 'https://www.instagram.com/'.$store_detail[3].'/'; ?>" target="_blank"><?php echo $store_detail[3]; ?></a></h1>
                        <h1>Facebook: &nbsp<a href="<?php echo 'https://www.facebook.com/'.$store_detail[4].'/'; ?>" target="_blank"><?php echo $store_detail[4]; ?></a></h1>
                        <h1>Whatsapp: &nbsp<a href="<?php echo 'https://wa.me/c/'.$store_detail[2].'/'; ?>" target="_blank"><?php echo $store_detail[2]; ?></a></h1>
                    </div>
                </div>
            </div>
            <div class="contact-2">
                <h1 class="title-underline">COME FIND US AT:</h1>
                <h1><?php echo $store_detail[1]; ?></h1>  
            </div>
            <div class="contact-3 vertical-border">
                <h1 class="title-underline">OPERATING HOURS</h1>
                <h1><?php echo $store_detail[0]; ?></h1>
            </div>
        </div>
    </div>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
        // When the user scrolls the page, execute myFunction
        window.onscroll = function() {myFunction()};

        // Get the navbar
        var navbar = document.getElementById("flexbox");

        // Get the offset position of the navbar
        var sticky = navbar.offsetTop;

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function myFunction() {
            if (window.pageYOffset >= sticky) {
                navbar.classList.add("sticky");
            } else {
                navbar.classList.remove("sticky");
            }
        }
    </script>
</body>
</html>