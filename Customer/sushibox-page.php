<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
include '../Login/sessionCustomer.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['sushibox-form'])){
        $totalOrder = $_POST["totalorder"];
        $sushiId = $_POST["sushilist"];
        $sushiQty = $_POST["sushiqty"];

        if($totalOrder != 0){
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
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="../style/style.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <link rel="fitsushi icon" href="../img/logo.png" type="image/x-icon">
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
                    <li><a class="home-tab" onclick="logout()">Sign Out</a></li>
                </ul>
            </div>
        </header>
        <div class="sushibox-detail">
            <h1 class="black-txt">Sushi Box</h1>
            <form onsubmit="return errorPopout(this);" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <?php 
                   $sushiboxArray = $menuObj->displayAlacarteSushibox($userid);
                   if(empty($sushiboxArray)){
                        echo '
                        <div class="sushibox-detail white-txt red-bg margin-empty-sushi">
                            <h1>YOUR SUSHI BOX IS EMPTY!</h1>
                            <h3>Discover our delicious sushi ala carte platter available in the MENU. </h3>
                        </div>
                        ';
                   }else{
                        echo'
                        <div class="tbl-header">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                    <tr>
                                        <th class="info-20">Item Name</th>
                                        <th class="info-20">Set Quantity</th>
                                        <th class="info-20">Unit Price (RM)</th>
                                        <th class="info-20">Total Price (RM)</th>
                                        <th class="info-20">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content">
                            <table cellpadding="0" cellspacing="0" border="0">';
                                foreach($sushiboxArray as $sushiboxList) {
                                    echo'
                                    <tr>
                                        <th class="info-20" style="text-align: left;">
                                            <label class="sushi-container">
                                                <input type="checkbox" value="'.$sushiboxList['id'].'" name="sushibox[]" onclick="totalIt(\''.$sushiboxList['name'].'\')" disabled>
                                                <input type="hidden" name="sushilist[]" value="'.$sushiboxList['id'].'" /> 
                                                <span style="opacity: 0.7; border:none;" class="checkmark"></span>
                                                <label class="">'.$sushiboxList['name'].'</label>
                                            </label>
                                        </th>
                                        <th class="info-20">
                                            <div class="sushi-list-input menu-row fit-width">
                                                <div class="input-btn menu-row">
                                                    <h5 class="minus-btn" onclick="decrement(\''.$sushiboxList['name'].'\')">-</h5>
                                                    <input id="'.$sushiboxList['name'].'" name="sushiqty[]" type=number min=1 value="'.$sushiboxList['qty'].'" readonly="readonly">
                                                    <h5 class="plus-btn" onclick="increment(\''.$sushiboxList['name'].'\')">+</h5>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="info-20"><input class="none-outline" type="text" name="'.$sushiboxList['name'].'" id="unit-price-'.$sushiboxList['name'].'" value="'.$sushiboxList['price'].'" readonly="readonly"></th>
                                        <th class="info-20"> <input class="none-outline" name="sushitotal" id="total-price-'.$sushiboxList['name'].'" type="number" value="'.$sushiboxList['total'].'" onclick="totalIt(\''.$sushiboxList['name'].'\')" readonly="readonly"></th>
                                        <th class="info-20"><a href="delete-alacarte.php?id='.$sushiboxList['id'].'" style="color: #c1273a;"><i class="fa fa-trash"></i></a></th>
                                    </tr>';
                                }
                        echo'</table>
                        </div>
                        <br>
                        <br>
                        <div class="tbl-content-checkout">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <tr>
                                        <th style="text-align:left;" class="info-20">
                                            <label class="sushi-container">
                                                <input name="chk"  type="checkbox" onclick="toggle(this)" >
                                                <span class="checkmark"></span>
                                                <label class="">SELECT ALL</label>
                                            </label>
                                        </th>
                                        <th class="info-10">Total(RM): </th>
                                        <th class="info-30"><input name="totalorder" id="total" class="info-amount none-outline" value="0.00"></th>
                                        <th class="info-30"><button name ="sushibox-form" type="submit" class="info-checkout red-bg white-txt">CHECKOUT</button></th>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>';
                    }
                ?>
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

        function errorPopout(form) {
            var totalorder = document.getElementById("total").value;
            if(totalorder == 0){
                Swal.fire({
                icon: 'error',
                title: 'Please make sure to check select all before check out!',
            });
            event.preventDefault();
            }
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
</body>
</html>