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
    <link href="../style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>Menu</title>
</head>
<body>
    <div>
        <header id="navbar" class="">
            <div class="container">
                <img class="word-logo left" src="../img/title.png" alt="logo">
                <ul class="right">
                    <li><a class="home-tab" href="main-page.php">Home</a></li>
                    <li><a class="home-tab current" href="menu-page.php">Menu</a></li>
                    <li><a class="home-tab" href="sushibox-page.php">Sushibox</a></li>
                    <li><a class="home-tab" href="profile-page.php"><i style="font-size:30px" class="fa fa-user" aria-hidden="true"></i>  <?php echo $username?></a></li>
                    <li><a class="home-tab" href="logout.php">Sign Out</a></li>
                </ul>
            </div>
        </header>
        <div class="menu-header">
            <h1 class="black-txt">MENU</h1>
        </div>
        <div class="flex" id="flexbox">
            <a href="#ala-carte">Ala Carte</a>
            <div class="width-4"></div>
            <a href="#set-menu">Custom Set</a>
        </div>
        <div class="menu-detail" id="ala-carte">
            <div class="menu-table red-bg white-txt">
                <br>
                <h1>ALA CARTE</h1>
                <h3>Lorem ipsum basically instruction on how to order for ala carte</h3>
                <div class="menu-table-detail">
                    <div class="menu-col menu-card">
                        <div class="menu-row">
                            <div class="menu-display-table">
                                <img class="menu-img" src="../img/sushi.png" alt="logo">
                                <div class="details">
                                    <h2 class="detail-title margin-0">Fried Sushi</h2>
                                    <h5 class="details-title-desc margin-0">Sushi roll with cucumber, hotdog, carrot and egg</h5>
                                    <h1 class="details-title-price margin-0">RM 5.00</h1>
                                </div>
                                <form class="input-menu menu-row" name="menu" action="orderMenu.php" method="post">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement1()">-</h5>
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h5 class="plus-btn" onclick="increment1()">+</h5>
                                    </div>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="menu-col menu-card">
                        <div class="menu-row">
                            <div class="menu-display-table">
                                <img class="menu-img" src="../img/sushi.png" alt="logo">
                                <div class="details">
                                    <h2 class="detail-title margin-0">Fried Sushi</h2>
                                    <h5 class="details-title-desc margin-0">Sushi roll with cucumber, hotdog, carrot and egg</h5>
                                    <h1 class="details-title-price margin-0">RM 5.00</h1>
                                </div>
                                <form class="input-menu menu-row" name="menu" action="orderMenu.php" method="post">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement1()">-</h5>
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h5 class="plus-btn" onclick="increment1()">+</h5>
                                    </div>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="menu-col menu-card">
                        <div class="menu-row">
                            <div class="menu-display-table">
                                <img class="menu-img" src="../img/sushi.png" alt="logo">
                                <div class="details">
                                    <h2 class="detail-title margin-0">Fried Sushi</h2>
                                    <h5 class="details-title-desc margin-0">Sushi roll with cucumber, hotdog, carrot and egg</h5>
                                    <h1 class="details-title-price margin-0">RM 5.00</h1>
                                </div>
                                <form class="input-menu menu-row" name="menu" action="orderMenu.php" method="post">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement1()">-</h5>
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h5 class="plus-btn" onclick="increment1()">+</h5>
                                    </div>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="menu-col menu-card">
                        <div class="menu-row">
                            <div class="menu-display-table">
                                <img class="menu-img" src="../img/sushi.png" alt="logo">
                                <div class="details">
                                    <h2 class="detail-title margin-0">Fried Sushi</h2>
                                    <h5 class="details-title-desc margin-0">Sushi roll with cucumber, hotdog, carrot and egg</h5>
                                    <h1 class="details-title-price margin-0">RM 5.00</h1>
                                </div>
                                <form class="input-menu menu-row" name="menu" action="orderMenu.php" method="post">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement1()">-</h5>
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h5 class="plus-btn" onclick="increment1()">+</h5>
                                    </div>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="menu-col menu-card">
                        <div class="menu-row">
                            <div class="menu-display-table">
                                <img class="menu-img" src="../img/sushi.png" alt="logo">
                                <div class="details">
                                    <h2 class="detail-title margin-0">Fried Sushi</h2>
                                    <h5 class="details-title-desc margin-0">Sushi roll with cucumber, hotdog, carrot and egg</h5>
                                    <h1 class="details-title-price margin-0">RM 5.00</h1>
                                </div>
                                <form class="input-menu menu-row" name="menu" action="orderMenu.php" method="post">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement1()">-</h5>
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h5 class="plus-btn" onclick="increment1()">+</h5>
                                    </div>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="menu-col menu-card">
                        <div class="menu-row">
                            <div class="menu-display-table">
                                <img class="menu-img" src="../img/sushi.png" alt="logo">
                                <div class="details">
                                    <h2 class="detail-title margin-0">Fried Sushi</h2>
                                    <h5 class="details-title-desc margin-0">Sushi roll with cucumber, hotdog, carrot and egg</h5>
                                    <h1 class="details-title-price margin-0">RM 5.00</h1>
                                </div>
                                <form class="input-menu menu-row" name="menu" action="orderMenu.php" method="post">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement1()">-</h5>
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h5 class="plus-btn" onclick="increment1()">+</h5>
                                    </div>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h1>Our Way, Our Home</h1>
                <h3>Small menu, endless flavours</h3>
                <br>
            </div>
        </div>
        <br>
        <br>
        <div class="menu-detail" id="set-menu">
            <div class="menu-table red-bg white-txt">
                <h1>SET</h1>
                <h3>Lorem ipsum basically instruction on how to order for set</h3>
                <div class="custom-set">
                    <div class="choose-set-div menu-row">
                        <h2 class="choose-set-title">Choose your set: </h2>
                        <div class="custom-select">
                            <select>
                                <option value="0">Select set:</option>
                                <option value="1">Audi</option>
                                <option value="2">BMW</option>
                                <option value="3">Citroen</option>
                                <option value="4">Ford</option>
                                <option value="5">Honda</option>
                            </select>
                        </div>
                    </div>
                    <div class="set-detail-div menu-col">
                        <div class="add-sushi">
                            <div class="space-between menu-row">
                                <h2 class="choose-sushi-title">Choose your sushi: </h2>
                                <div class="search-div menu-row">
                                    <input type="text" placeholder="Search sushi name.." name="search">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                            <div class="sushi-list-div">
                                <div class="sushi-list-detail">
                                    <div class="sushi-list-img">
                                        <img class="" src="../img/sushi.png" alt="logo">
                                    </div>
                                    <div class="sushi-detail">
                                        <div class="margin 0">
                                            <h3 class="sushi-list-name margin-0 black-txt">Basic Sushi</h3>
                                        </div>
                                        <div class="">
                                            <h3 class="sushi-list-dsc black-txt"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                        </div>
                                    </div>
                                    <form class="sushi-list-input menu-row" name="menu" action="orderMenu.php" method="post">
                                        <div class="input-btn menu-row">
                                            <h5 class="minus-btn" onclick="decrement1()">-</h5>
                                            <input id="expresso" name="expresso" type=number min=0 max=110>
                                            <h5 class="plus-btn" onclick="increment1()">+</h5>
                                        </div>
                                        <button id="addCart" class="add-sushibox-btn" type="submit">ADD</button>
                                    </form>
                                </div>
                                <div class="sushi-list-detail">
                                    <div class="sushi-list-img">
                                        <img class="" src="../img/sushi.png" alt="logo">
                                    </div>
                                    <div class="sushi-detail">
                                        <div class="margin 0">
                                            <h3 class="sushi-list-name margin-0 black-txt">Basic Cheese</h3>
                                        </div>
                                        <div class="">
                                            <h3 class="sushi-list-dsc black-txt"> Sushi roll with cucumber, hotdog, carrot and egg</h3>
                                        </div>
                                    </div>
                                    <form class="sushi-list-input menu-row" name="menu" action="orderMenu.php" method="post">
                                        <div class="input-btn menu-row">
                                            <h5 class="minus-btn" onclick="decrement1()">-</h5>
                                            <input id="expresso" name="expresso" type=number min=0 max=110>
                                            <h5 class="plus-btn" onclick="increment1()">+</h5>
                                        </div>
                                        <button id="addCart" class="add-sushibox-btn" type="submit">ADD</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="add-sushibox">
                            <h2 class="choose-sushi-title">Your sushi box set:</h2>
                            <div class="sushibox-table">
                                <h3 class="sushibox-set-name">Majoh Set</h3>
                                <div class="sushibox-set-fixed-piece sushibox-set-bg padding-2">
                                    <h2 class="sushibox-set-title">Fixed Pieces</h2>
                                    <hr class="sushibox-line">
                                    <div class="sushibox-set-detail menu-col">
                                        <h2 class="fixed-piece-name">&#10003;  Basic Sushi</h2>
                                        <h2 class="fixed-piece-qty">x 10</h2>
                                    </div>
                                    <div class="sushibox-set-detail menu-col">
                                        <h2 class="fixed-piece-name">&#10003;  Basic Sushi</h2>
                                        <h2 class="fixed-piece-qty">x 10</h2>
                                    </div>
                                    <div class="sushibox-set-detail menu-col">
                                        <h2 class="fixed-piece-name">&#10003;  Basic Sushi</h2>
                                        <h2 class="fixed-piece-qty">x 10</h2>
                                    </div>
                                    <div class="sushibox-set-detail menu-col">
                                        <h2 class="fixed-piece-name">&#10003;  Basic Sushi</h2>
                                        <h2 class="fixed-piece-qty">x 10</h2>
                                    </div>
                                    <div class="sushibox-set-detail menu-col">
                                        <h2 class="fixed-piece-name">&#10003;  Basic Sushi</h2>
                                        <h2 class="fixed-piece-qty">x 10</h2>
                                    </div>
                                    <div class="sushibox-set-detail menu-col">
                                        <h2 class="fixed-piece-name">&#10003;  Basic Sushi</h2>
                                        <h2 class="fixed-piece-qty">x 10</h2>
                                    </div>
                                </div>
                                <div class="sushibox-set-choose-option sushibox-set-bg padding-2">
                                    <h2 class="sushibox-set-title">Choose Option</h2>
                                    <hr class="sushibox-line">
                                    <div class="sushibox-set-detail menu-row">
                                        <h2 class="sushi-option-name">Basic Cheese</h2>
                                        <h2 class="sushi-option-status">not added</h2>
                                    </div>
                                    <div class="sushibox-set-detail menu-row">
                                        <h2 class="sushi-option-name">Basic Sushi</h2>
                                        <h2 class="sushi-option-status">not added</h2>
                                    </div>
                                </div>
                                <div class="sushibox-set-notes sushibox-set-bg padding-2">
                                    <h2 class="sushibox-set-title">Extra Notes</h2>
                                    <hr class="sushibox-line">
                                    <textarea class="sushibox-notes" placeholder="Write your notes here........" name="extra-notes" rows="6" cols="50"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
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