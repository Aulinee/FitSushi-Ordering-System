<?php
    include '../Login/sessionAdmin.php';

    $AllErr = $sushiNameErr = $sushiDescErr = $statusErr = $sushiImgErr = $sushiPriceErr = "";
    $boolAllTrue = $boolsushiName = $boolsushiDesc = $boolsushiImg = $boolsushiPrice = $boolStatus = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["Add-product"])){
            
            $sushiName = $_POST["sushi_name"];
            $sushiDesc = $_POST["sushi_desc"];
            $sushiImg = $_FILES["selectedImage"]["tmp_name"];
            $sushiPrice = $_POST["sushi_price"];

            //Validate Name
            if (empty($sushiName)){
                $sushiNameErr = "(Sushi name cannot be empty)";
            }
            else{
                $boolsushiName = true;
            }

            //Validate Desc
            if (empty($sushiDesc)){
                $sushiDescErr = "(Sushi description cannot be empty)";
            }
            else{
                $boolsushiDesc = true;
            }

            //Validate status
            $status = $_POST['status'];
            if ($status === "select") {
                $statusErr = "(Please select your availability status)";
            } else {
                $boolStatus = true;
            }
            
            //Validate Img
            if (empty($sushiImg)){
                $sushiImgErr = "(Select an image)";
            }
            else{
                $boolsushiImg = true;
            }               

            //Validate Price
            if (empty($sushiPrice)){
                $sushiPriceErr = "(Insert a price)";
            }
            else{
                $PriceAdd = test_input($_POST["sushi_price"]);
                // check if price is valid
                if (!preg_match("/^\d{0,8}(\.\d{1,4})?$/", $PriceAdd)) {
                    $sushiPriceErr = "Invalid price format";
                } else {
                    $boolsushiPrice = true;
                }
            } 
            
            if(($boolsushiName == true) && ($boolStatus == true)){
                if($boolsushiDesc == true){
                    if($boolsushiImg == true){
                        if($boolsushiPrice == true){
                            $boolAllTrue = true;
                        }
                    }
                }
            }

            $AllErr = $sushiNameErr.'\r\n'.$sushiDescErr.'\r\n'.$sushiImgErr.'\r\n'.$sushiPriceErr;
            $AllInput = $sushiName.'\r\n'.$sushiDesc.'\r\n'.$sushiImg.'\r\n'.$sushiPrice;
            if($boolAllTrue == true){
                //Get the content of the uploaded image
                $imgContent = addslashes(file_get_contents($sushiImg));
                $addproductStatus = $menuObj->addMenu($sushiName, $sushiDesc, $imgContent, $sushiPrice);

                if($addproductStatus){
                    echo '<script>alert("Product added successfully!")</script>';
                }else{
                    echo '<script>alert("Something went wrong while add :( ")</script>';
                }
                
            }
            else{
                echo '<script>alert("'.$AllErr.'")</script>';
            }

        }elseif(isset($_POST["delete-product"])){
            $deleteproductid = $_POST["delete-product"];
            echo '<script>alert("Delete:'.$deleteproductid.'")</script>'; 
            
        }elseif(isset($_POST["order-delivered"])){
            $id_delivered = $_POST['order_delivered'];
            echo "<script>alert('.$id_delivered.')</script>";
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
            <!-- Product Tab -->
            <div  class="home-tab" id="Product-div">
                <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Menu Detail</h1> 
                </div>
                <div id="Productlist-div" style="display: block;">
                    <section class="table-1">
                        <div class="header-table" >
                            <div class="seriesinput-icons width-20">
                                <i class="fa fa-search seriesicon"></i>
                                <input class="seriesinput-field" type="text" id="productcodeInput" onkeyup="filterMenu()" placeholder="Search for menu name.." title="Type in menu name">
                            </div>                   
                            <h1 class="width-60">LIST OF MENUS</h1>
                            <div class="create-series-btn">
                                <button class='cancelbtn white-txt' onclick="document.getElementById('add-sushi').style.display='block'"> <i class="fa fa-plus"></i>   CREATE</button>
                                <!-- hidden div inside button add menu tag -->
                                <div id="add-sushi" class="sub-hidden-form">
                                    <form class="hidden-form animate" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                                        <div class="titlecontainer">
                                            <h2 class="main-page-title">ADD MENU</h2>
                                            <h5 class="sub-title-main">add new menu here</h5>
                                            <span class="close-btn" onclick="document.getElementById('add-sushi').style.display='none'" title="Close Modal">&times;</span>
                                        </div>
                                        <div class="contentcontainer">
                                            <div class="editinfo-div editinfo-div-2">
                                                <label for="sushi-name">New Menu Name:  <span class="error"><?php echo $sushiNameErr; ?></span></label>
                                                <br>
                                                <input placeholder="Enter your sushi name.." name="sushi_name" class="input-detail" type="text" id="sushi_name">
                                            </div>
                                            <div class="editinfo-div editinfo-div-2">
                                                <label for="add-sushi">New Menu Description:  <span class="error"><?php echo $sushiDescErr; ?></span></label>
                                                <br>
                                                <textarea placeholder="Enter your sushi description.." name="sushi_desc" class="input-detail" type="text" id="sushi_desc" cols="80" rows="10"></textarea>
                                            </div>
                                            <div class="editinfo-div editinfo-div-2">
                                                <label for="add-sushi">New Menu Price:  <span class="error"><?php echo $sushiPriceErr; ?></span></label>
                                                <br>
                                                <input placeholder="Enter your sushi price.." min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" name="sushi_price" class="input-detail" type="number" id="sushi_price">
                                            </div>
                                            <div class="editinfo-div editinfo-div-2">
                                                <label for="add-sushi">Availability Status  <span class="error"><?php echo $statusErr; ?></span></label>
                                                <select class="input-detail" name="status" id="status">
                                                    <option value="select" selected>Not Selected</option>
                                                    <option value="1">Available</option>
                                                    <option value="0">Not Available</option>
                                                </select>
                                            </div>
                                            <div class="editinfo-div editinfo-div-2">
                                                <label for="add-sushi">Upload Menu Picture  <span class="error"><?php echo $sushiImgErr; ?></span></label>
                                                <input name="selectedImage" class="input-detail" type="file" id="new_image" accept=".png,.jpeg,.jpg">
                                            </div>
                                            <br>
                                            <div class="margin-5"></div>
                                            <div class="hidden-div-btn">
                                                <button class="submitbtn inline" id="AddProductBtn" type="submit" name="Add-product">Submit</button>
                                                <button class="cancelbtn inline" type="button" onclick="document.getElementById('add-sushi').style.display='none'">Cancel</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>                            
                        </div>
                        <div class="tbl-header">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                    <tr>
                                        <th class="info-20">CODE</th>
                                        <th class="info-20">NAME</th>
                                        <th class="info-20">DESCRIPTION</th>
                                        <th class="info-20">PRICE</th>
                                        <th class="info-20">SUSHI IMAGE</th>
                                        <th class="info-20">AVAILABILITY</th>
                                        <th class="info-20">ACTION</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content">
                            <table id="productTable" cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <div>
                                        <?php 
                                            $menuArray = $menuObj->displayAllMenu(); 

                                            foreach($menuArray as $array){
                                                echo '
                                                    <tr>
                                                        <td>'.$array['id'].'</td>
                                                        <td>'.$array['name'].'</td>
                                                        <td>'.$array['desc'].'</td>
                                                        <td>'.$array['price'].'</td>
                                                        <td><img src="data:image/jpg;charset=utf8;base64, '.base64_encode($array['img']).'" width="100" height="100"></td>
                                                        <td>'.$array['status'].'</td>                               
                                                        <td >
                                                            <form  method="POST" action="../Admin-Folder/editProduct_page.php">
                                                                <button class="button" id='.$array['id'].' value='.$array['id'].' type="submit" name="edit-product" title="Edit ID: '.$array['id'].'"><i class="fa fa-edit"></i></button>
                                                                <button class="button" id='.$array['id'].' value='.$array['id'].' type="submit" name="delete-product" title="Delete ID: '.$array['id'].'" onClick="return confirm(\'Confirm deletion?\')"><i class="fa fa-trash"></i></button>
                                                            </form>                                    

                                                        </td>                            
                                                    </tr>
                                                ';
                                            }
                                        ?>
                                    </div>                                      
                                </tbody>
                            </table>
                        </div>
                    </section>                 
                </div>

                <!-- Hidden div: Add New Product -->
                <div  class="home-tab" id="AddnewProduct-div" style="display: none;" align="center">
                    <h1>Add Product</h1>
                    <!-- New Product Form -->
                    <div id="Product-Form">
                        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                            <div>
                                <label> Sushi Name: 
                                    <input name="sushi_name" class="input-detail" type="text" id="sushi_name">                        
                                </label>                                
                            </div>
                            <div>
                                <label> Description: 
                                    <textarea name="sushi_desc" class="input-detail" type="text" id="sushi_desc" rows="4" cols="30"></textarea>                      
                                </label>                                
                            </div>
                            <div>
                                <label> Upload a new image: 
                                    <input name="selectedImage" class="input-detail" type="file" id="new_image" accept=".png,.jpeg,.jpg">                        
                                </label>                                
                            </div>
                            <div>
                                <label> Price: 
                                    <input name="sushi_price" class="input-detail" type="text" id="sushi_price">                        
                                </label>                                
                            </div>
                            <div>
                                <button id="AddProductBtn" type="submit" name="Add-product">Save</button>                         
                                <button id="ClearProductBtn" type="submit" name="clear-product">Clear</button>                                         
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
        function filterMenu() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("productcodeInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("productTable");
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