<?php
    date_default_timezone_set("Asia/Kuala_Lumpur");
    include '../Login/sessionAdmin.php';

    //----------- Sum up total sales
    $getTotalSales = "SELECT orderTotal FROM orders WHERE orderStatusID=2 AND YEAR(deliverydateTime)=year(curdate())";
    $resultTotalSales = $conn->query($getTotalSales);
    $TotalSales = 0;
    
    if($resultTotalSales){
        if($resultTotalSales->num_rows > 0){
            while($row = mysqli_fetch_array($resultTotalSales)){
                $TotalSales = $TotalSales + $row['orderTotal'];
            }
        }
    }
    //----------- Sum up total users
    $getTotalUser = "SELECT COUNT(customerID) AS TotalCustomer FROM customer";    
    $resultTotalUser = $conn->query($getTotalUser);

    if($resultTotalUser){
        if($resultTotalUser->num_rows > 0){
            while($row = mysqli_fetch_array($resultTotalUser)){
                $TotalUser = $row['TotalCustomer'];
            }
        }
    }

    //-----------To get data to be displayed in Pie Chart
    $getSushi_PieChart = "SELECT s.sushiName, SUM(a.qty) AS Total FROM sushi s, alacarteorder a, orders o WHERE o.orderID=a.orderID AND a.sushiID=s.sushiID AND o.orderStatusID=2 AND YEAR(o.deliverydateTime)=year(curdate()) GROUP BY s.sushiName";
    $getResultSushi_PieChart = mysqli_query($conn, $getSushi_PieChart);

    //-----------To get the data to be displayed in curve chart
    $getRevenueChart = "SELECT MONTH(deliverydateTime) AS month, SUM(orderTotal) AS TotalSales FROM orders WHERE orderStatusID=2 AND YEAR(deliverydateTime)=year(curdate()) GROUP BY month";
    $resultRevenueChart = mysqli_query($conn, $getRevenueChart);      

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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <title>Home</title>
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
                <script>Home();</script>
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
            <!-- Home Tab -->
            <div class="home-tab-content" id="Home-div" style="display: block;">
                <div class="dashboard-title-div">
                    <h1 class="dashboard-title" style="margin: 0 auto;">Sales Report</h1>
                    <br>
                    <h5 class="sub-title-main" style="margin: 0;">statistic of current year data</h5>
                </div>
                <div class="flex-container">
                    <div class="overview-div">
                        <h2 class="inside-div-title">Overview</h2>
                        <div class="flex-row space-between">
                            <div class="total-sales flex-row" id="overview-TSales">
                                <div class="width-20">
                                    <img class= "dollar-icon" src="../img/admin-img/TotalSales.png" alt="dollar-sign">
                                </div>
                                <div class="padding-left-10 width-70">
                                    <h2 class="title">Total Sales</h2>
                                    <h2 class="content">RM <?php  echo $TotalSales ?></h2>
                                </div>
                            </div>
                            <div class="total-user flex-row space-between" id="overview-TUser">
                                <div class="">
                                    <img class= "user-icon" src="../img/admin-img/TotalUser.png" alt="user-sign">
                                </div>
                                <div class="padding-left-10 width-70">
                                    <h2 class="title">Total User</h2>
                                    <h2 class="content"><?php  echo $TotalUser ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="topbuyer-div">
                        <h2 class="inside-div-title">Top Buyer</h2>
                        <ul class="ul1">
                            <?php $adminObj->displayTopBuyer(); ?>
                        </ul>
                    </div>           
                </div>
                <div class="flex-container">
                    <div class="revenue-div">
                        <h2 class="inside-div-title ">Sales Revenue</h2>
                        <div id="curve_chart" style="width:100%; height: 300px;"></div>
                    </div>
                    <div class="topproduct-div">
                        <h2 class="inside-div-title ">Top product</h2>
                        <div id="piechart" style="width:100%; height: 300px;"></div>
                    </div> 
                </div>
            </div>       
        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawPieChart);

      function drawPieChart() {

        var TopProductdata = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
            <?php 

                while($piechart = mysqli_fetch_assoc($getResultSushi_PieChart)){

                    echo "['".$piechart['sushiName']."',".$piechart['Total']."],";

                }
           
            ?>
        ]);

        var optionsSushi = {
          title: 'Sushi'
        };

        var Piechart = new google.visualization.PieChart(document.getElementById('piechart'));

        Piechart.draw(TopProductdata, optionsSushi);
      }
    </script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawLineChart);

      function drawLineChart() {
        var Revenuedata = google.visualization.arrayToDataTable([
          ['Month', 'RM'],

            <?php 

                while($Curvechart = mysqli_fetch_assoc($resultRevenueChart)){
                    $monthNum = $Curvechart['month'];
                    $dateObj = DateTime::createFromFormat('!m', $monthNum);
                    $monthName = $dateObj->format('M');

                    echo "['".$monthName."',".$Curvechart['TotalSales']."],";

                }

            ?>          
        ]);

        var Revenueoptions = {
          title: 'Sales each month',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var Linechart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        Linechart.draw(Revenuedata, Revenueoptions);
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