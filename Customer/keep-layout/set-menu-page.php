<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <!-- <div class="menu-detail" id="set-menu">
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
        </div> -->
</body>
</html>