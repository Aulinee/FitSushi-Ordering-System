<?php 
include '../database/dbConnection.php';
include '../class/MenuClass.php';

$menuObj = new Menu($conn);
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
                    <li><a class="home-tab" href="../index.php">Home</a></li>
                    <li><a class="home-tab current" href="#">Menu</a></li>
                    <li><a class="home-tab" href="../Login/sign-in.php">Sign In</a></li>
                </ul>
            </div>
        </header>
        <div class="menu-header">
            <h1 class="black-txt">MENU</h1>
        </div>
        <!-- <div class="flex" id="flexbox">
            <a href="#ala-carte">Ala Carte</a>
            <a href="#set-menu">Set</a>
        </div> -->
        <div class="menu-detail" id="ala-carte">
            <div class="menu-table red-bg white-txt">
                <h1>Ala Carte</h1>
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
    <script>
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
    </script>
</body>
</html>