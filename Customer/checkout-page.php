<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
include '../Login/sessionCustomer.php';

$sushiId = $_SESSION['sushiid'];
$sushiQty = $_SESSION['sushiqty'];
$totalorder = $_SESSION['totalorder'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $deliveryopt = $_POST["delivery-option"];
    $paymentmethod = $_POST["payment-method"];

    if ($paymentmethod == "3"){
        $cardNum = $_POST["card-number"];
        $cardHolder = $_POST["card-holder"];
        $cardExpDate = $_POST["expiration-date"];
        $cardCVV = $_POST["cvv"];

        $orderStatus = $orderObj->makeOrder($sushiId, $sushiQty, $userid, $deliveryopt, $paymentmethod, $totalorder);

        unset($_SESSION['sushiid']);
        unset($_SESSION['sushiqty']);
        unset($_SESSION['totalorder']);
    
        $_SESSION['currentOrderID'] = $orderStatus;
        $cardOrderDetail = $orderObj->insertCardDetail($orderStatus, $cardNum, $cardHolder, $cardExpDate, $cardCVV);

        if($cardOrderDetail){
            echo "<script> alert('Your order is successful!'); </script>";
            header('location: email.php');
        }

    }else{
        $orderStatus = $orderObj->makeOrder($sushiId, $sushiQty, $userid, $deliveryopt, $paymentmethod, $totalorder);

        echo "<script> alert('Your order is successful!'); </script>";
        unset($_SESSION['sushiid']);
        unset($_SESSION['sushiqty']);
        unset($_SESSION['totalorder']);
    
        $_SESSION['currentOrderID'] = $orderStatus;
        header('location: email.php');
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
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="../style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <link rel="fitsushi icon" href="../img/logo.png" type="image/x-icon">
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
                    <li><a class="home-tab" onclick="logout()">Sign Out</a></li>
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
                <form onsubmit="return checkout(this)" name="payment" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
                        </div>
                    </div>
                    <div id="hidden-div" style="display: none;">
                        <br>
                        <div class="row-payment">
                            <div class="payment-30">
                                <label for="PaymentID"><b>Card Number</b></label>
                            </div>
                            <div class="payment-70">
                                <input type="text" id="card-number" name="card-number" placeholder="Enter card number! E.g. 4111111111111111">
                                <span id="card-number-error" class="error" style="display: none;">Invalid card number.</span>
                            </div>
                        </div>
                        <br>
                        <div class="row-payment">
                            <div class="payment-30">
                                <label for="PaymentID"><b>Card Holder Name</b></label>
                            </div>
                            <div class="payment-70">
                                <input type="text" id="card-holder" name="card-holder" placeholder="Enter card holder name! E.g. Audrey Duyan anak Gima">
                                <span id="card-holder-error" class="error" style="display: none;">Invalid card holder name.</span>
                            </div>
                        </div>
                        <br>
                        <div class="row-payment">
                            <div class="payment-30">
                                <label for="PaymentID"><b>Expiration Date</b></label>
                            </div>
                            <div class="payment-70">
                                <input type="text" id="expiration-date" name="expiration-date" placeholder="Enter expiration date! E.g. 12/24">
                                <span id="expiration-date-error" class="error" style="display: none;">Invalid expiration date.</span>
                            </div>
                        </div>
                        <br>
                        <div class="row-payment">
                            <div class="payment-30">
                                <label for="PaymentID"><b>CVV:</b></label>
                            </div>
                            <div class="payment-70">
                                <input type="text" id="cvv" name="cvv" placeholder="Enter CVV! E.g. 123">
                                <span id="cvv-error" class="error" style="display: none;">Invalid CVV.</span>
                            </div>
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
        <!-- <div class="sushibox-detail red-bg white-txt margin-empty-sushi">
            <h1>YOUR ORDER IS DONE!</h1>
            <h3>Sit back and relax while you wait for your order. Meeanwhile, discover our delicious sushi and its set in our MENU. </h3>
        </div>
        <br><br> -->
    </div>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
        function checkout(name)
        {
            Swal.fire({
                icon: 'success',
                title: 'Your Order is Done!',
                text: "Check your email for receipt!",
                }).then((result) => {
                if (result.isConfirmed) {
                }
            });
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
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('input[name="payment-method"]').change(function () {
                var selectedValue = $('input[name="payment-method"]:checked').val();
                if (selectedValue === '3') {
                    $('#hidden-div').show();
                } else {
                    $('#hidden-div').hide();
                }
            });

            $('#payment').on('click', function (e) {
                var isFormValid = validateCardDetails();
                if (!isFormValid) {
                    e.preventDefault(); // Prevent form submission if form is not valid
                    alert('Invalid card, please insert a new one.');
                }
            });
        });

        function validateCardDetails() {
            var selectedValue = $('input[name="payment-method"]:checked').val();
            var cardNumber = $('#card-number').val();
            var cardHolder = $('#card-holder').val();
            var expirationDate = $('#expiration-date').val();
            var cvv = $('#cvv').val();

            var isCardNumberValid = validateCardNumber(cardNumber);
            var isCardHolderValid = validateCardHolder(cardHolder);
            var isExpirationDateValid = validateExpirationDate(expirationDate);
            var isCvvValid = validateCvv(cvv);

            displayError('card-number', !isCardNumberValid);
            displayError('card-holder', !isCardHolderValid);
            displayError('expiration-date', !isExpirationDateValid);
            displayError('cvv', !isCvvValid);

            var isFormValid = isCardNumberValid && isCardHolderValid && isExpirationDateValid && isCvvValid;

            if (selectedValue !== '3') {
                // Hide the error message for non-credit/debit card payments
                $('#card-validation-error').hide();
                return true; // Form is valid
            } else {
                if (isFormValid) {
                    // Hide the error message for valid credit/debit card payments
                    $('#card-validation-error').hide();
                    return true; // Form is valid
                } else {
                    // Show the error message for invalid credit/debit card payments
                    $('#card-validation-error').show();
                    return false; // Form is not valid
                }
            }
        }

        function displayError(inputId, showError) {
            if (showError) {
                $('#' + inputId + '-error').show();
            } else {
                $('#' + inputId + '-error').hide();
            }
        }

        function validateCardNumber(cardNumber) {
            var cardNumberRegex = /^4[0-9]{12}(?:[0-9]{3})?$/;
            return cardNumberRegex.test(cardNumber);
        }

        function validateCardHolder(cardHolder) {
            var symbolRegex = /[!@#$%^&*(),.?":{}|<>]/;
            return !symbolRegex.test(cardHolder.trim());
        }

        function validateExpirationDate(expirationDate) {
            var expirationDateRegex = /^(0[1-9]|1[0-2])\/[0-9]{2}$/;
            if (!expirationDateRegex.test(expirationDate)) {
                return false;
            }

            // Validate the expiration month and year
            var currentDate = new Date();
            var currentYear = currentDate.getFullYear() % 100; // Get the last two digits of the current year
            var currentMonth = currentDate.getMonth() + 1; // Get the current month (1-12)

            var parts = expirationDate.split('/');
            var expMonth = parseInt(parts[0]);
            var expYear = parseInt(parts[1]);

            if (expYear < currentYear || (expYear === currentYear && expMonth < currentMonth)) {
                return false;
            }

            return true;
        }

        function validateCvv(cvv) {
            var cvvRegex = /^[0-9]{3}$/;
            return cvvRegex.test(cvv);
        }
    </script>
</body>
</html>