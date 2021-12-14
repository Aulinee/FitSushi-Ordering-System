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
    <link rel="stylesheet" href="../style/admin.css">
    <title>Home</title>
</head>
<body>
    <section class="admin-page">
        <div class="admin-page-sidebar">
            <div class="padding">
                <img src="..\img\logo-title.png" alt="FitSushi logo" class="logo">
            </div>
            <div>
                <table>
                    <tr>
                        <td class="padding">
                            <img src="..\img\admin-img\admin-picture.png" alt="Admin picture" class="admin-pic">
                        </td>
                        <td>
                            <h1>Susan</h1><h2>Admin</h2>
                        </td>
                    </tr>
                </table>
            </div>
            <div>
                <ul>
                    <li class="li-padding"><img src="../img/admin-img/home.png" alt="home" class="size"> HOME</li>
                    <li class="li-padding"><img src="../img/admin-img/profile.jpg" alt="profile" class="size"> PROFILE</li>
                    <li class="li-padding"><img src="../img/admin-img/store.png" alt="store" class="size"> STORE</li>
                    <li class="li-padding"><img src="../img/admin-img/customer.jpg" alt="customer" class="size"> CUSTOMER</li>
                    <li class="li-padding"><img src="../img/admin-img/product.png" alt="product" class="size"> PRODUCT</li>
                    <li class="li-padding"><img src="../img/admin-img/order.png" alt="order" class="size"> ORDER</li>
                    <li class="li-padding"><img src="../img/admin-img/sign-out.png" alt="sign-out" class="size"> SIGN OUT</li>
                </ul>
            </div>
        </div>
        <div class="admin-page-dashboard">
            <u><h1 class="h1-dashboard">Sales Report</h1></u>
            <div>
                <form action="/action_page.php"></form>
                <label for="month"><img src="img/admin-img/calendar.jpg" alt="calendar" width="39" height="52">:</label>
                <select id="month" name="month">
                    <option value=" "><i>-- select a month --</i></option>
                    <option value="January">January</option>
                    <option value="February">February</option>
                    <option value="March">March</option>
                    <option value="April">April</option>
                    <option value="May">May</option>
                    <option value="June">June</option>
                    <option value="July">July</option>
                    <option value="August">August</option>
                    <option value="September">September</option>
                    <option value="October">October</option>
                    <option value="November">November</option>
                    <option value="December">December</option>
                </select>
            </div>
        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
</body>