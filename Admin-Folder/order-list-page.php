<?php
    include '../Login/sessionAdmin.php';
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
    <link href="../style/admin.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>Customer Edit Page</title>
</head>
<body class="flex-col">
    <section class="admin-page flex-row">
        <div class="admin-page-sidebar flex-col">
            <div style="height:600px">
                <div class="logo-sidebar-div">
                    <img src="..\img\logo-title.png" alt="FitSushi logo" class="logo">
                </div>
                <div class="adminlogo-sidebar-div flex-row">
                    <div class="adminlogo-sidebar-div-1">
                        <img src="..\img\admin-img\admin-picture.png" alt="Admin picture" class="admin-pic left">
                    </div>
                    <div class="adminlogo-sidebar-div-2">
                        <h1><?php echo $username; ?></h1>
                        <h2>Admin</h2>
                    </div>
                </div>
                <br>
                <div class="admin-sidebar-tab-div">
                    <ul>
                        <li class="li-padding"><img src="../img/admin-img/home.png" alt="home" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="Dashboard.php"> HOME</a></li>
                        <li class="li-padding"><img src="../img/admin-img/profile.jpg" alt="profile" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="admin-profile-page.php"> PROFILE</a></li>
                        <li class="li-padding"><img src="../img/admin-img/store.png" alt="store" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="store-detail-page.php"> STORE</a></li>
                        <li class="li-padding"><img src="../img/admin-img/customer.jpg" alt="customer" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="customer-list-page.php"> CUSTOMER</a></li>
                        <li class="li-padding"><img src="../img/admin-img/product.png" alt="product" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="menu-list-page.php"> MENU</a></li>
                        <li class="li-padding"><img src="../img/admin-img/order.png" alt="order" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="order-list-page.php"> ORDER</a></li>
                        <li class="li-padding"><img src="../img/admin-img/sign-out.png" alt="sign-out" class="size"><a class="left-nav black-txt " style="cursor: pointer;" onclick="logout()"> SIGN OUT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="admin-page-dashboard">
            <!-- Order Tab -->
            <div id="Order-div">
                <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Order Detail</h1> 
                </div>
                <section class="table-1">
                    <div class="header-table">
                        <div class="seriesinput-icons">
                            <i class="fa fa-search seriesicon"></i>
                            <input class="seriesinput-field" type="text" id="custorderInput" onkeyup="filterCustOrderPending()" placeholder="Search customer.." title="Type in a name">
                        </div>
                        <h1 class="width-60">LIST OF PENDING CUSTOMER ORDER</h1>
                        <div class="">
                            <form method='POST' action="../generatepdf/pdfGenerator.php">
                                <input type='submit' class='cancelbtn white-txt' name='Report_PendingOrder' value='Download Pending Order' style="cursor: pointer;"/>                             
                            </form>
                        </div>
                    </div>
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                            <tr>
                                <th class="info-20">ORDER ID</th>
                                <th class="info-20">DATE</th>
                                <th class="info-20">CUSTOMER NAME</th>
                                <th class="info-20">DELIVERY ADDRESS</th>
                                <th class="info-20">DELIVERY OPTION</th>
                                <th class="info-20">PAYMENT METHOD</th>
                                <th class="info-20">STATUS</th>
                                <th class="info-20">AMOUNT</th>
                                <th class="info-20">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table id="custOrderTable" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php 
                                    $orderarray = $orderObj->displayAllCustOrder(4);
                                    foreach($orderarray as $array){
                                        echo '<tr>
                                                <td>'.$array['id'].'</td>
                                                <td>'.$array['datecreate'].'</td>
                                                <td>'.$array['custname'].'</td>
                                                <td>'.$array['address'].'</td>
                                                <td>'.$array['deliveryopt'].'</td>
                                                <td>'.$array['paymentmethod'].'</td>
                                                <td>'.$array['status'].'</td>
                                                <td>'.$array['ordertotal'].'</td>';
                                                echo '<td>
                                                    <form  method="POST" action="../Admin-Folder/editCust_page.php">
                                                        <button class="button" id='.$array['id'].' value='.$array['id'].' type="submit" name="order_delivered" title="Deliver Order ID: '.$array['id'].'"><i class="fa fa-check"></i></button>
                                                        <button class="button" id='.$array['id'].' value='.$array['id'].' type="submit" name="order_cancelled" title="Cancel Order ID: '.$array['id'].'" onClick="return confirm(\'Confirm cancellation?\')"><i class="fa fa-trash"></i></button>
                                                    </form>                                    
                                                </td>';
                                        echo '</tr>';  
                                    }
                                ?>                                       
                            </tbody>
                        </table>
                    </div>
                </section>
                <br>
                <br>
                <br>
                <section class="table-1">
                    <div class="header-table">
                        <div class="seriesinput-icons">
                            <i class="fa fa-search seriesicon"></i>
                            <input class="seriesinput-field" type="text" id="custorderPendingInput" onkeyup="filterCustOrderOnDeliver()" placeholder="Search customer.." title="Type in a name">
                        </div>
                        <h1 class="width-60">LIST OF RECEIVED CUSTOMER ORDER</h1>
                        <div class="">
                            <form method='POST' action="../generatepdf/pdfGenerator.php">
                                <input type='submit' class='cancelbtn white-txt' name='Report_OnDeliverOrder' value='Download Confirm Order' style="cursor: pointer;"/>                              
                            </form>
                        </div>
                    </div>
                    <div class="tbl-header">
                        <table cellpadding="0" cellspacing="0" border="0">
                            <thead>
                            <tr>
                                <th class="info-20">ORDER ID</th>
                                <th class="info-20">DATE</th>
                                <th class="info-20">CUSTOMER NAME</th>
                                <th class="info-20">DELIVERY ADDRESS</th>
                                <th class="info-20">DELIVERY OPTION</th>
                                <th class="info-20">PAYMENT METHOD</th>
                                <th class="info-20">STATUS</th>
                                <th class="info-20">AMOUNT</th>
                                <th class="info-20">Action</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content">
                        <table id="custOrderPendingTable" cellpadding="0" cellspacing="0" border="0">
                            <tbody>
                                <?php 
                                    $orderarray = $orderObj->displayAllCustOrder(1);
                                    foreach($orderarray as $array){
                                        echo '<tr>
                                                <td>'.$array['id'].'</td>
                                                <td>'.$array['datecreate'].'</td>
                                                <td>'.$array['custname'].'</td>
                                                <td>'.$array['address'].'</td>
                                                <td>'.$array['deliveryopt'].'</td>
                                                <td>'.$array['paymentmethod'].'</td>
                                                <td>'.$array['status'].'</td>
                                                <td>'.$array['ordertotal'].'</td>';
                                                echo '<td>
                                                    <form  method="POST" action="../Admin-Folder/editCust_page.php">
                                                        <button class="button" id='.$array['id'].' value='.$array['id'].' type="submit" name="order_delivered" title="Deliver Order ID: '.$array['id'].'"><i class="fa fa-check"></i></button>
                                                        <button class="button" id='.$array['id'].' value='.$array['id'].' type="submit" name="order_cancelled" title="Cancel Order ID: '.$array['id'].'" onClick="return confirm(\'Confirm cancellation?\')"><i class="fa fa-trash"></i></button>
                                                    </form>                                    
                                                </td>';
                                        echo '</tr>';  
                                    }
                                ?>                                     
                            </tbody>
                        </table>
                    </div>
                </section>         
            </div>  
        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>

         //From Order Tab
         function filterCustOrderPending() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("custorderInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("custOrderTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
            }
        }
        //From Order Tab
        function filterCustOrderOnDeliver() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("custorderPendingInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("custOrderPendingTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }       
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