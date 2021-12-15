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
    <link rel="stylesheet" href="../style/style.css">
    <title>Menu</title>
</head>
<body>
    <div>
        <header id="navbar" class="">
            <div class="container">
                <img class="word-logo left" src="../img/logo-title.png" alt="logo">
                <ul class="right">
                    <li><a class="home-tab" href="../index.php">Home</a></li>
                    <li><a class="home-tab current" href="Customer/menu-page-public.php">Menu</a></li>
                    <li><a class="home-tab" href="../Login/sign-in.php">Sign In</a></li>
                </ul>
            </div>
        </header>
        <div class="flex" id="flexbox">
            <a href="#ala-carte">Ala Carte</a>
            <a href="#set-menu">Set</a>
        </div>
        <div class="menu-detail" id="ala-carte">
            <h1 class="black-txt">MENU</h1>
            <div class="menu-table red-bg white-txt">
                <h1>ALA CARTE</h1>
                <h3>Lorem ipsum basically instruction on how to order for ala carte</h3>
                <div class="menu-table-detail">
                    <div class="menu-col">
                        <div class="menu-row">
                            <div class="menu-display-table black-border">
                                <img class="menu-icon" src="img/sushi.png" alt="logo">
                                <div class="details black-border-top">
                                    <h3 class="">Fried Sushi</h3>
                                    <h3 class="">RM 5</h3>
                                </div>
                                <form class="menu-col" name="menu" action="orderMenu.php" method="post">
                                    <input id="expresso" name="expresso" type=number min=0 max=110>
                                    <h1 class="toggle" onclick="increment1()"><b>+</b></h1>
                                    <h1 class="toggle" onclick="decrement1()"><b>-</b></h1>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                                <br>
                            </div>
                            <div class="menu-display-table black-border">
                                <img class="menu-icon" src="img/sushi.png" alt="logo">
                                <div class="details black-border-top">
                                    <h3 class="">Fried Sushi</h3>
                                    <h3 class="">RM 5</h3>
                                </div>
                                <form class="menu-col" name="menu" action="orderMenu.php" method="post">
                                    <input id="expresso" name="expresso" type=number min=0 max=110>
                                    <h1 class="toggle" onclick="increment1()"><b>+</b></h1>
                                    <h1 class="toggle" onclick="decrement1()"><b>-</b></h1>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                                <br>
                            </div>
                            <div class="menu-display-table black-border">
                                <img class="menu-icon" src="img/sushi.png" alt="logo">
                                <div class="details black-border-top">
                                    <h3 class="">Fried Sushi</h3>
                                    <h3 class="">RM 5</h3>
                                </div>
                                <form class="menu-col" name="menu" action="orderMenu.php" method="post">
                                    <input id="expresso" name="expresso" type=number min=0 max=110>
                                    <h1 class="toggle" onclick="increment1()"><b>+</b></h1>
                                    <h1 class="toggle" onclick="decrement1()"><b>-</b></h1>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                                <br>
                            </div>
                            <div class="menu-display-table black-border">
                                <img class="menu-icon" src="img/sushi.png" alt="logo">
                                <div class="details black-border-top">
                                    <h3 class="">Fried Sushi</h3>
                                    <h3 class="">RM 5</h3>
                                </div>
                                <form class="menu-col" name="menu" action="orderMenu.php" method="post">
                                    <input id="expresso" name="expresso" type=number min=0 max=110>
                                    <h1 class="toggle" onclick="increment1()"><b>+</b></h1>
                                    <h1 class="toggle" onclick="decrement1()"><b>-</b></h1>
                                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <h1>Our Way, Our Home</h1>
                <h3>Small menu, endless flavours</h3>
            </div>
        </div>
        <br>
        <br>
        <div class="menu-detail" id="set-menu">
            <div class="menu-table red-bg white-txt">
                <h1>SET MENU</h1>
                <h3>Lorem ipsum basically instruction on how to order for set</h3>
                <hr>
                <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Eu ultrices 
                    vitae auctor eu augue ut lectus arcu bibendum.  (Description utk each set)
                </h4>
                <!--surround the select box with a "custom-select" DIV element. Remember to set the width:-->
                <form name="menu" action="orderMenu.php" method="post">
                    <div class="custom-select">
                        <select>
                            <option value="0">Select Set</option>
                            <option value="1">Audi</option>
                            <option value="2">BMW</option>
                        </select>
                    </div>
                    <div class="menu-table-detail">
                        <div class="menu-col">
                            <div class="menu-row">
                                <div class="menu-display-table black-border">
                                    <img class="menu-icon" src="img/sushi.png" alt="logo">
                                    <div class="details black-border-top">
                                        <h3 class="">Fried Sushi</h3>
                                        <h3 class="">RM 5</h3>
                                    </div>
                                    <div class="menu-col">
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h1 class="toggle" onclick="increment1()"><b>+</b></h1>
                                        <h1 class="toggle" onclick="decrement1()"><b>-</b></h1>
                                    </div>
                                    <br>
                                </div>
                                <div class="menu-display-table black-border">
                                    <img class="menu-icon" src="img/sushi.png" alt="logo">
                                    <div class="details black-border-top">
                                        <h3 class="">Fried Sushi</h3>
                                        <h3 class="">RM 5</h3>
                                    </div>
                                    <div class="menu-col">
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h1 class="toggle" onclick="increment1()"><b>+</b></h1>
                                        <h1 class="toggle" onclick="decrement1()"><b>-</b></h1>
                                    </div>
                                    <br>
                                </div>
                                <div class="menu-display-table black-border">
                                    <img class="menu-icon" src="img/sushi.png" alt="logo">
                                    <div class="details black-border-top">
                                        <h3 class="">Fried Sushi</h3>
                                        <h3 class="">RM 5</h3>
                                    </div>
                                    <div class="menu-col">
                                        <input id="expresso" name="expresso" type=number min=0 max=110>
                                        <h1 class="toggle" onclick="increment1()"><b>+</b></h1>
                                        <h1 class="toggle" onclick="decrement1()"><b>-</b></h1>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="menu-col">
                    <button id="addCart" class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                </div>
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