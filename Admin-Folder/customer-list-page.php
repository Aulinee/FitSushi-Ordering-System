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
                        <li class="li-padding"><img src="../img/admin-img/sign-out.png" alt="sign-out" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="logout.php"> SIGN OUT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="admin-page-dashboard">
            <!-- Customer Tab -->
            <div  class="home-tab" id="Customer-div">
                <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Customer Detail</h1>
                </div>
                <div class="List-of-user-acc-div">
                    <section class="table-1">
                        <div class="header-table">
                            <div class="seriesinput-icons">
                                <i class="fa fa-search seriesicon"></i>
                                <input class="seriesinput-field" type="text" id="custInput" onkeyup="filterCust()" placeholder="Search username.." title="Type in a name">
                            </div>
                            <h1>List of Users Account </h1>
                            <div style="visibility: hidden; width: 30%;"></div>
                        </div>
                        <div class="tbl-header">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email Address</th>
                                    <th>Home Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content">
                            <table id="custTable" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <?php 
                                        $cust_array = $userObj->displayAllCustomer(); 
                                        foreach($cust_array as $array){
                                            echo '
                                            <div>
                                                <tr>
                                                    <td>'.$array['id'].' <input type="hidden" name="cust-id" value="'.$array['id'].'"> </td>
                                                    <td>'.$array['username'].'</td>
                                                    <td>'.$array['custname'].'</td>
                                                    <td> 0'.$array['phone'].'</td>
                                                    <td>'.$array['email'].'</td>
                                                    <td>'.$array['address'].'</td>
                                                    <td>
                                                        <form method="POST" action="../Admin-Folder/editCust_page.php">
                                                            <button class="button" id='.$array['id'].' value='.$array['id'].' type="submit" name="edit-customer" title="Edit ID: '.$array['id'].'"><i class="fa fa-edit"></i></button>
                                                            <button class="button" id='.$array['id'].' value='.$array['id'].' type="submit" name="delete-customer" title="Delete ID: '.$array['id'].'"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </div>
                                            ';
                                        }
                                    ?>                                     
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>  
        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
        function filterCust() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("custInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("custTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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
    </script>
</body>
</html>