<?php
    include '../Login/sessionAdmin.php';

    $locErr = $opnHrsErr = $WAErr = $IGErr = $FBErr = "";
    $loc_edit = $opnHrs_edit = $WA_edit = $IG_edit = $FB_edit = "";
    $boolloc= $boolopnHrs = $boolWA = $boolIG = $boolFB = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["SaveContactInfo-btn"])){
            $temp_storeID = $_POST["storeidtext"];

            //Location 
            $loc_edit = $_POST["locationtext"];
            if (empty($loc_edit)) {
                $locErr = "(Location is required)";
            } else {
                $boolloc = true;
            }

            //Open hours
            $opnHrs_edit = $_POST["OpHrstext"];
            if (empty($opnHrs_edit)) {
                $opnHrsErr = "(Open hours is required)";
            } else {
                $boolopnHrs = true;
            }


            //WA
            $WA_edit = $_POST["WAtext"];
            if (empty($WA_edit)) {
                $WAErr = "(Whatsapp is required)";
            } else {
                $boolWA = true;
            }            

            //IG
            $IG_edit = $_POST["IGtext"];
            if (empty($IG_edit)) {
                $IGErr = "(Instagram is required)";
            } else {
                $boolIG = true;
            }

            //FB
            $FB_edit = $_POST["FBtext"];
            if (empty($FB_edit)) {
                $FBErr = "(Facebook is required)";
            } else {
                $boolFB = true;
            }

            //confirmation feedback
            if (($boolloc == true) && ($boolopnHrs == true) && ($boolWA == true) && ($boolIG == true) && ($boolFB == true)) {
                $updateStoreStatus = $adminObj->editStore($temp_storeID, $loc_edit, $opnHrs_edit, $WA_edit, $IG_edit, $FB_edit);

                if ($updateStoreStatus) {
                    echo "<script>
                    alert('Store detail successfully edited!');
                    window.location.href='store-detail-page.php';
                    </script>";
                } else {
                    echo "<script>
                    alert('Store detail is not successfully edited! Please try again!');
                    window.location.href='store-detail-page.php';
                    </script>";
                }
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
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
            <!-- Store Tab -->
            <div  class="home-tab" id="Store-div">
                <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Store Detail</h1>
                </div>
                <!-- Div for entire content under header, consist of two content: Upper & Lower Div -->
                <div class="store-detail-main">
                    <div class="store-detail-title flex-row">
                        <h1 class="">Contact Info</h1>
                        <div class="edit-detail-icon">
                            <a>
                                <i id="editicon" onclick="enableContactedit()" class="fa fa-edit"></i>
                                <i id="exiticon" onclick="exitContactedit()" class="fa fa-close"></i>
                            </a>
                        </div>
                    </div>
                    <div class="store-detail-content">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="" id="Loc-OpHrs-div" >
                                <div id="Location-inputfield">
                                    <h2>Location: <span class="error"><?php echo $locErr; ?></span></h2>
                                    <textarea disabled title="Location" name="locationtext" class="store-input-detail" type="text" id="location" rows="4" cols="30"><?php echo $loc?></textarea>                                   
                                </div>
                                <div id="OperatingHrs-inputfield">
                                    <h2>Operating Hours: <span class="error"><?php echo $opnHrsErr; ?></span></h2>
                                    <textarea disabled title="Operating Hours" name="OpHrstext" class="store-input-detail" type="text" id="OpHrs" rows="4" cols="30"><?php echo $opnHrs?></textarea>       
                                </div>
                            </div>
                            <br><br>
                            <div class="" id="SocMed-div">
                                <div id="Whatsapp-inputfield">
                                    <h2>Whatsapp: <span class="error"><?php echo $WAErr; ?></span></h2>
                                    <input name="storeidtext" class="store-input-detail" type="hidden" id="storeid" value="<?php echo $store_ID?>">  
                                    <input disabled title="Whatsapp" name="WAtext" class="store-input-detail" type="text" id="WA" value="<?php echo $Whatsapp?>">  
                                </div>
                                <div id="Insta-inputfield">
                                    <h2>Instagram: <span class="error"><?php echo $IGErr; ?></span></h2>
                                    <input disabled title="Instagram" name="IGtext" class="store-input-detail" type="text" id="IG" value="<?php echo $Instagram?>">  
                                </div>
                                <div id="FB-inputfield">
                                    <h2>Facebook: <span class="error"><?php echo $FBErr; ?></span></h2>
                                    <input disabled title="Facebook" name="FBtext" class="store-input-detail" type="text" id="FB" value="<?php echo $Facebook?>">  
                                </div>
                            </div>
                            <div id="SaveContactInfo-btn">
                                <input disabled type='submit' id="SaveContactBtn" class='button' name='SaveContactInfo-btn' value='Save' /> 
                                <input disabled type='submit' id="ResetContactBtn" class='button' name='ResetContactInfo-btn' value='Cancel' />                                         
                            </div>
                        </form>
                    </div>
                </div>
            </div>   
        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
        exitContactedit();

        function enableContactedit(){
            //Enabling the input field
            document.getElementById("location").disabled = false;
            document.getElementById("OpHrs").disabled = false;
            document.getElementById("WA").disabled = false;
            document.getElementById("IG").disabled = false;
            document.getElementById("FB").disabled = false;
            document.getElementById("SaveContactBtn").disabled = false;
            document.getElementById("ResetContactBtn").disabled = false;

            document.getElementById("location").style.backgroundColor = "#ffffff";
            document.getElementById("OpHrs").style.backgroundColor = "#ffffff";
            document.getElementById("WA").style.backgroundColor = "#ffffff";
            document.getElementById("IG").style.backgroundColor = "#ffffff";
            document.getElementById("FB").style.backgroundColor = "#ffffff";

            document.getElementById("editicon").style.display = "none";
            document.getElementById("exiticon").style.display = "block";            

        }        

        function exitContactedit(){

            //disabling the input field
            document.getElementById("location").disabled = true;
            document.getElementById("OpHrs").disabled = true;
            document.getElementById("WA").disabled = true;
            document.getElementById("IG").disabled = true;
            document.getElementById("FB").disabled = true;
            document.getElementById("SaveContactBtn").disabled = true;
            document.getElementById("ResetContactBtn").disabled = true;

            document.getElementById("location").style.backgroundColor = "#cfcfcf";
            document.getElementById("OpHrs").style.backgroundColor = "#cfcfcf";
            document.getElementById("WA").style.backgroundColor = "#cfcfcf";
            document.getElementById("IG").style.backgroundColor = "#cfcfcf";
            document.getElementById("FB").style.backgroundColor = "#cfcfcf";


            document.getElementById("editicon").style.display = "block";
            document.getElementById("exiticon").style.display = "none";   

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