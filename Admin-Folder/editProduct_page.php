<?php
    include '../Login/sessionAdmin.php';

    $AllErr = $sushiNameErr = $sushiDescErr = $statusErr = $sushiImgErr = $sushiPriceErr = "";
    $boolAllTrue = $boolsushiName = $boolsushiDesc = $boolsushiImg = $boolsushiPrice = $boolStatus = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["edit-product"])){
            $menu_id = $_POST['edit-product'];
            $menu_detail = $menuObj->getMenu($_POST['edit-product']);
            $_SESSION['current_menuid_edit'] = $menu_id;
        }
        elseif(isset($_POST["Save-product"])){
            //Initial data
            $sushi_id = $_POST["Save-product"];
            $sushi_Name = $_POST["sushi_name"];
            $sushi_Desc = $_POST["sushi_desc"];
            $hold_sushi_Img = $_FILES["selectedImg"]["tmp_name"];
            $sushi_Price = $_POST["sushi_price"];
            $sushi_Available = $_POST["status"];

            //Validate Name
            if (empty($sushi_Name)){
                $sushiNameErr = "(Sushi name cannot be empty)";
            }
            else{
                $boolsushiName = true;
            }

            //Validate Desc
            if (empty($sushi_Desc)){
                $sushiDescErr = "(Sushi description cannot be empty)";
            }
            else{
                $boolsushiDesc = true;
            } 

            //Validate Price
            if (empty($sushi_Price)){
                $sushiPriceErr = "(Insert a price)";
            }
            else{
                $PriceAdd = test_input($_POST["sushi_price"]);
                // check if price is valid
                if (!preg_match("/^\d{0,8}(\.\d{1,4})?$/", $PriceAdd)) {
                    $sushiPriceErr = "(Invalid price format)";
                } else {
                    $boolsushiPrice = true;
                }
            } 

            //Validate status
            $status = $_POST['status'];
            if ($status === "select") {
                $statusErr = "(Please select your availability status)";
            } else {
                $boolStatus = true;
            }

            if(($boolsushiName == true) && ($boolStatus == true)){
                if($boolsushiDesc == true){
                    if($boolsushiPrice == true){
                        $boolAllTrue = true;
                    }
                }
            }

            $AllErr = $sushiNameErr.'\r\n'.$sushiDescErr.'\r\n'.$sushiPriceErr;

            if ($boolAllTrue == true){
                //To check if the image is changed
                if(empty($hold_sushi_Img)){

                    //Update sushi detail only
                    $resultUpdateSushiDetail = $menuObj->updateMenuDetail($sushi_id, $sushi_Name, $sushi_Desc, $sushi_Price, $sushi_Available);   

                    if($resultUpdateSushiDetail){
                        echo '<script>alert("Product (ID: '.$sushi_id.')(no image) has been updated.")</script>'; 
                        $menu_detail = $menuObj->getMenu($_SESSION['current_menuid_edit']); 
                    }else{
                        echo '<script>alert("Product (ID: '.$sushi_id.')(no image) has not been updated.")</script>';
                    }

                }else{
                    $sushi_Img = addslashes (file_get_contents($hold_sushi_Img));
                    
                    //Update both sushi detail and img
                    $resultUpdateSushiDetail = $menuObj->updateMenuDetail($sushi_id, $sushi_Name, $sushi_Desc, $sushi_Price, $sushi_Available);
                    $resultUpdateSushiImg = $menuObj->updateMenuImage($sushi_id, $sushi_Img);      

                    if($resultUpdateSushiDetail && $resultUpdateSushiImg){
                        echo '<script>alert("Product (ID: '.$sushi_id.')(with image) has been updated.")</script>'; 
                        $menu_detail = $menuObj->getMenu($_SESSION['current_menuid_edit']);  
                    }else{
                        echo '<script>alert("Product (ID: '.$sushi_id.')(with image) has not been updated.")</script>';
                        $menu_detail = $menuObj->getMenu($_SESSION['current_menuid_edit']); 
                    }

                }               
            
            }else{
                $menu_detail = $menuObj->getMenu($_SESSION['current_menuid_edit']); 
            }
         
        }
        else if(isset($_POST["delete-product"])){
            $sushi_id = $_POST['delete-product'];            

            $delete_status = $menuObj->deleteMenu($sushi_id);

            if ($delete_status){
                echo '<script>
                        alert("Product (ID: '.$sushi_id.') has been deleted.");
                        window.location.href="menu-list-page.php";
                    </script>';                                
            }
            else {
                echo '<script>
                        alert("Product (ID: '.$sushi_id.') failed to delete.")
                        window.location.href="menu-list-page.php";
                    </script>'; 
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
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <link href="../style/admin.css?v=<?php echo time(); ?>" rel="stylesheet" type="text/css"/>
    <title>Menu Edit Page</title>
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
            <div id="User-edit-container">
            <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Edit Menu Details</h1>
                </div>
                <div class="main-profile profile-width-80" >
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <div class="main-profile-detail">
                            <div class="profile-width-5"></div>
                            <div class="main-profile-detail-left">
                                <div class="user-detail">
                                    <h3>Image Preview</h3>
                                    <img name="previewImg" class="img-preview edit-img-side " src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($menu_detail[4]) ?>">
                                </div>
                                <div class="user-detail">
                                    <h3> Upload a new image</h3>
                                    <div>
                                        <input name="selectedImg" class="input-detail" type="file" id="new_image" accept=".png,.jpeg,.jpg"> 
                                    </div>
                                </div>
                            </div>
                            <div class="profile-width-20"></div>
                            <div class="main-profile-detail-right">
                                <div class="user-detail">
                                    <h3>Sushi Name  <span class="error"><?php echo $sushiNameErr; ?></span></h3>
                                    <input name="sushi_name" class="input-detail" type="text" id="sushi_name" value="<?php echo $menu_detail[1]?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Sushi Description <span class="error"><?php echo $sushiDescErr; ?></span></h3>
                                    <textarea name="sushi_desc" class="input-detail" type="text" id="sushi_desc" rows="4" cols="30"><?php echo $menu_detail[2]?></textarea>
                                </div>
                                <div class="user-detail">
                                    <h3>Price: <span class="error"><?php echo $sushiPriceErr; ?></span></h3>
                                    <input name="sushi_price" class="input-detail" type="text" id="sushi_price" value="<?php echo $menu_detail[3]?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Availability </h3>
                                    <select class="input-detail-2" name="status" id="status">
                                        <option <?php if($menu_detail[5]== 1) echo 'selected="selected"'; ?> value="1">Available</option>
                                        <option <?php if($menu_detail[5]== 0) echo 'selected="selected"'; ?> value="0">Not Available</option>
                                    </select>
                                </div>
                                <br>
                                <div class="user-detail-btn">
                                    <button id="SaveProductBtn" value=<?php echo $menu_detail[0];?> type="submit" name="Save-product" class="save-edit-btn red-bg">Save Changes</button>
                                </div>
                            </div>
                            <div class="profile-width-5"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <h1>&copy; Copyright 2021 FitSushi</h1>
    </footer>
    <script>
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