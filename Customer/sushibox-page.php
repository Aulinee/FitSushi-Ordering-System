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
    <title>Sushi Box</title>
</head>
<body>
    <div>
        <header id="navbar" class="">
            <div class="container">
                <img class="word-logo left" src="../img/logo-title.png" alt="logo">
                <ul class="right">
                    <li><a class="home-tab" href="main-page.php">Home</a></li>
                    <li><a class="home-tab" href="menu-page.php">Menu</a></li>
                    <li><a class="home-tab current" href="sushibox-page.php">SushiBox</a></li>
                    <li><a class="home-tab" href="profile-page.php"><i style="font-size:30px" class="fa fa-user" aria-hidden="true"></i>  <?php echo $username?></a></li>
                    <li><a class="home-tab" href="logout.php">Sign Out</a></li>
                </ul>
            </div>
        </header>
        <div class="sushibox-detail">
            <h1 class="black-txt">Sushi Box</h1>
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th class="info-20">Item Name</th>
                            <th class="info-20">Quantity</th>
                            <th class="info-20">Unit Price</th>
                            <th class="info-20">Total Price</th>
                            <th class="info-20">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
                <?php $menuObj->displayAlacarteSushibox(); ?>
                <!-- <table cellpadding="0" cellspacing="0" border="0">
                    <tbody>
                        <tr>
                            <th class="info-5"></th>
                            <th class="info-10">
                                <label class="sushi-container">
                                    <input type="checkbox" name="sushibox" checked="checked">
                                    <span class="checkmark"></span>
                                    <label class="">One</label>
                                </label>
                            </th>
                            <th class="info-5"></th>
                            <th class="info-20">
                                <div class="sushi-list-input menu-row fit-width">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="document.getElementById('expresso').stepDown();">-</h5>
                                        <input id="expresso" name="expresso" type=number min="0">
                                        <h5 class="plus-btn" onclick="document.getElementById('expresso').stepUp();">+</h5>
                                    </div>
                                </div>
                            </th>
                            <th class="info-20">Unit Price</th>
                            <th class="info-20">Total Price</th>
                            <th class="info-20">Action</th>
                        </tr>
                    </tbody>
                </table>-->
            </div>
            <br>
            <br>
            <form action="">
                <div class="tbl-content-checkout">
                    <table cellpadding="0" cellspacing="0" border="0">
                        <tbody>
                            <tr>
                                <th class="info-20">
                                    <label class="sushi-container">
                                        <input name="chk"  type="checkbox" onclick="toggle(this)" >
                                        <span class="checkmark"></span>
                                        <label class="">SELECT ALL</label>
                                    </label>
                                </th>
                                <th class="info-30"></th>
                                <th class="info-10">Total: </th>
                                <th class="info-10"><span class="info-amount" id="total">RM0.00</span></th>
                                <th class="info-10"><a class="info-checkout red-bg white-txt" href="checkout-page.php">CHECKOUT</a></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </form>

            <!-- If theres no order in sushi box -->
            <br><br>
            <div class="sushibox-detail red-bg white-txt margin-empty-sushi">
                <h1>YOUR SUSHI BOX IS EMPTY!</h1>
                <h3>Discover our delicious sushi ala carte platter available or browse our hottest sushi box set in the MENU. </h3>
            </div>
            <br><br>
            <br><br>
        </div>  
    </div>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('sushibox');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }

            totalIt();
        }

        function updateTotal(name) {
            // var totalField = document.getElementById('total-price').value;
            // var unitField = document.getElementById('unit-price').value;

            var sushiQty = document.getElementById(name);
            console.log(sushiQty.value);

            if(sushiQty){
                console.log(sushiQty.value);
            }
            
        } 

        function increment(name) {
            document.getElementById(name).stepUp();
        }

        function decrement(name) {
            document.getElementById(name).stepDown();
        }

        function totalIt()
        {
            var input = document.getElementsByName("sushibox");
            var total = 0;
            for (var i = 0; i < input.length; i++)
            {
                if (input[i].checked)
                {
                    total += parseFloat(input[i].value);
                }
            }
            document.getElementById("total").innerHTML = "RM" + total.toFixed(2);
        }

        updateTotal(this);
    </script>
</body>
</html>