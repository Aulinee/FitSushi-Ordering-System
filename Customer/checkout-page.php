<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
include '../Login/sessionCustomer.php';

$sushiId = $_SESSION['sushiid'];
$sushiQty = $_SESSION['sushiqty'];
$totalorder = $_SESSION['totalorder'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $deliveryopt = $_POST["delivery-option"];
    $paymentmethod = $_POST["payment-method"];

    $orderStatus = $orderObj->makeOrder($sushiId, $sushiQty, $userid, $deliveryopt, $paymentmethod, $totalorder);

    if($orderStatus != false){
        unset($_SESSION['sushiid']);
        unset($_SESSION['sushiqty']);
        unset($_SESSION['totalorder']);

        $_SESSION['currentOrderID'] = $orderStatus;
        echo "<script>
            alert('Your order is successful created!');
        </script>";

        header("Location: email.php");
    }else{
        echo "<script>
            alert('Your order is unsuccessful! Please try again');
        </script>";
    }
}

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
    <link href="../style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>Checkout Page</title>
</head>
<body>
    <div>
        <header id="navbar" class="">
            <div class="container">
                <img class="word-logo left" src="../img/logo-title.png" alt="logo">
                <ul class="right">
                    <li><a class="home-tab" href="main-page.php">Home</a></li>
                    <li><a class="home-tab" href="menu-page.php">Menu</a></li>
                    <li><a class="home-tab" href="sushibox-page.php">SushiBox</a></li>
                    <li><a class="home-tab" href="profile-page.php"><i style="font-size:30px" class="fa fa-user" aria-hidden="true"></i>  <?php echo $username?></a></li>
                    <li><a class="home-tab" href="logout.php">Sign Out</a></li>
                </ul>
            </div>
        </header>
        <div class="checkout-detail">
            <div class="checkout-detail-title">
                <h2 class="navigation-txt"><a href="sushibox-page.php"><i class="fa fa-angle-left"></i>  Back to Sushi Box</a></h2>
            </div>
            <div class="checkout-detail-title">
                <h1 class="title-page text-center">CHECKOUT PAYMENT</h1>
            </div>
            <br>
            <div class="payment-details">
                <form name="payment" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <h4>Order for</h4>
                    <div class="row-payment">
                        <div class="payment-30">
                            <label for="PaymentID"><b>Full Name</b></label>
                        </div>
                        <div class="payment-70">
                            <input name="fullname" value="<?php echo $fullname; ?>" type="text" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row-payment">
                        <div class="payment-30">
                            <label for="PaymentID"><b>Address</b></label>
                        </div>
                        <div class="payment-70">
                            <input name="fulladdress" value="<?php echo $fulladdress; ?>" type="text" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row-payment">
                        <div class="payment-30">
                            <label for="PaymentID"><b>Mobile Number</b></label>
                        </div>
                        <div class="payment-70">
                            <input name="phonenum" value="<?php echo $phonenum; ?>" type="text" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row-payment">
                        <div class="payment-30">
                            <label for="PaymentID"><b>Total Amount (RM)</b></label>
                        </div>
                        <div class="payment-70">
                            <input name="totalamount" value="<?php echo $totalorder; ?>" type="text" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row-payment">
                        <div class="payment-30">
                            <label for="PaymentID"><b>Delivery Option</b></label>
                        </div>
                        <div class="payment-70">
                            <?php  
                                $deliveryOptArray = $orderObj->getDeliveryOptionList();

                                foreach($deliveryOptArray as $array) {
                                    echo '<input name="delivery-option" value="'.$array['id'].'" type="radio" required>'.$array['name'].'</input>';
                                }
                            ?>
                            <!-- <input name="deliveryopt" value="delivery" type="radio" readonly>Delivery</input>-->
                        </div>
                    </div>
                    <br>
                    <div class="row-payment">
                        <div class="payment-30">
                            <label for="PaymentID"><b>Payment Method</b></label>
                        </div>
                        <div class="payment-70">
                            <?php 
                                $paymentmethod = $orderObj->getPaymentOptionList();

                                foreach($paymentmethod as $array) {
                                    

                                    echo '<input name="payment-method" value="'.$array['id'].'" type="radio" required>'.$array['name'].'</input>';
                                }
                            ?>
                            <!-- <input name="payment-method" value="delivery" type="radio" readonly>Delivery</input>-->
                        </div>
                    </div>
                    <br>
                    <div class="row-payment margin-top-2">
                        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px" required>
                        <label>
                            I agree to the Terms and Condition
                            and understand that my information will be used as described on this page and FitSushi Privacy Policy. If I choose to 
                            pay with credit or debit card, my card information will be automatically stored and secured for future payments.
                        </label>
                    </div>
                    <br>
                    <br>
                    <button id="payment" type="submit" class="gotopaymentbtn margin-top-2">Confirm Payment</button>
                </form>
            </div>
        </div>
        <br>
        <br>
        <div class="sushibox-detail red-bg white-txt margin-empty-sushi">
            <h1>YOUR ORDER IS DONE!</h1>
            <h3>Sit back and relax while you wait for your order. Meeanwhile, discover our delicious sushi and its set in our MENU. </h3>
        </div>
        <br><br>
    </div>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
</body>
</html>