<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
include '../Login/sessionCustomer.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['sushibox-form'])){
        $totalOrder = $_POST["totalorder"];
        $sushiId = $_POST["sushilist"];
        $sushiQty = $_POST["sushiqty"];

        if($totalOrder == 0){
            echo "<script>
                alert('Your total order is zero');
                window.location.href='sushibox-page.php';
                </script>";

        }else{
            $_SESSION['sushiid'] = $sushiId;
            $_SESSION['sushiqty'] = $sushiQty;
            $_SESSION['totalorder'] = $totalOrder;
            header("Location: checkout-page.php");
        }
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
                            <th class="info-20">SetQuantity</th>
                            <th class="info-20">Unit Price (RM)</th>
                            <th class="info-20">Total Price (RM)</th>
                            <th class="info-20">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <?php $menuObj->displayAlacarteSushibox(); ?>
            </form>
        </div>  
    </div>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
        function toggle(source) {
            checkboxes = document.getElementsByName('sushibox[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }

            totalIt();
        }

        function updateTotal(name) {
            var sushiQty = document.getElementById(name).value;
            var unitField = document.getElementById('unit-price').value;

            var total = sushiQty * unitField;
            
            if (!isNaN(total)){
                document.getElementById("total-price").innerHTML = "RM" + total.toFixed(2);
            }
            
        } 

        function increment(name) {
            document.getElementById(name).stepUp();

            var unitIdString = 'unit-price-' + name;
            var totalIdString = "total-price-"+ name;

            var sushiQty = document.getElementById(name).value;
            var unitField = document.getElementById(unitIdString).value;

            var total = sushiQty * unitField;
            
            if (!isNaN(total)){
                document.getElementById(totalIdString ).value = total.toFixed(2);
            }

            totalIt();
                
        }

        function decrement(name) {
            document.getElementById(name).stepDown();

            var unitIdString = 'unit-price-' + name;
            var totalIdString = "total-price-"+ name;

            var sushiQty = document.getElementById(name).value;
            var unitField = document.getElementById(unitIdString).value;

            var total = sushiQty * unitField;
            
            if (!isNaN(total)){
                document.getElementById(totalIdString).value = total.toFixed(2);
            }

            totalIt();
        }

        function totalIt(name)
        {
            var input = document.getElementsByName("sushibox[]");
            var totalField = document.getElementsByName("sushitotal");

            var total = 0;
            for (var i = 0; i < input.length; i++)
            {
                if (input[i].checked)
                {
                    total += parseFloat(totalField[i].value);
                }
            }

            document.getElementById("total").value = total.toFixed(2);
        }

    </script>
</body>
</html>