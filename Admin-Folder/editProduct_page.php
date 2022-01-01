<?php
    include '../database/dbConnection.php'; 
    include '../Login/sessionAdmin.php';

    //echo "hello, welcome to editCust_page.php<br>";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["edit-product"])) {

            $sushi_id = $_POST['edit-product'];

            $query = "SELECT * FROM sushi WHERE sushiID=$sushi_id";
            $result = $conn->query($query);

            if($result){
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $sushi_Name = $row['sushiName'];
                    $sushi_Desc= $row['sushiDesc'];
                    $sushi_Img = $row['sushiImg'];
                    $sushi_Price = $row['price'];
                    $sushi_Available = $row['availability'];    
                }else{
                    echo "Record not found";
                }
            }else{
                echo "Error in ".$query." ".$conn->error;
            } 

            //To test for correct output (_Uncomment to use_)
            /*echo "Customer ID: ".$customer_id."<br>";
            echo "Username: ".$cust_Usn."<br>";
            echo "Password: ".$cust_pass."<br>";
            echo "Fullname: ".$cust_Fn."<br>";
            echo "Mobile Number: 0".$cust_Mob."<br>";
            echo "Email Address: ".$cust_EmailAdd."<br>";
            echo "Home Address: ".$cust_HomeAdd."<br>";
            echo "Postal Code: ".$cust_POS."<br>";
            echo "Gender: ".$cust_Gender."<br>";*/

            //Create a preset code for gender
            if($sushi_Available=="1"){
                $printAvailability = "<label>
                                    <select id=\"availability\" name=\"sushi_available\">
                                        <option value=\"1\" selected>Available</option>
                                        <option value=\"0\">Not Available</option>
                                    </select>
                                </label>";
            }else{
                $printAvailability = "<label>
                                    <select id=\"availability\" name=\"sushi_available\">
                                        <option value=\"1\">Available</option>
                                        <option value=\"0\" selected>Not Available</option>
                                    </select>
                                </label>";
            }


        }
        else if(isset($_POST["Save-product"])){

            //Initial data
            $sushi_id = $_POST["Save-product"];
            $sushi_Name = $_POST["sushi_name"];
            $sushi_Desc = $_POST["sushi_desc"];
            $hold_sushi_Img = $_FILES["selectedImg"]["tmp_name"];
            $sushi_Price = $_POST["sushi_price"];
            $sushi_Available = $_POST["status"];

            $AllErr = $sushiNameErr = $sushiDescErr = $sushiImgErr = $sushiPriceErr = "";
            $boolAllTrue = $boolsushiName = $boolsushiDesc = $boolsushiPrice = false;

            //echo "Input check<br>";

            //Validate Name
            if (empty($sushi_Name)){
                $sushiNameErr = "Sushi name cannot be empty.";
            }
            else{
                $boolsushiName = true;
            }

            //Validate Desc
            if (empty($sushi_Desc)){
                $sushiDescErr = "Sushi description cannot be empty.";
            }
            else{
                $boolsushiDesc = true;
            } 

            //Validate Price
            if (empty($sushi_Price)){
                $sushiPriceErr = "Insert a price.";
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

            if($boolsushiName == true){
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

                    //Update sushi detail
                    $updateSushiQuery = "UPDATE sushi SET sushiName='$sushi_Name', sushiDesc='".mysqli_real_escape_string($conn, $sushi_Desc)."', price='$sushi_Price', availability='$sushi_Available' WHERE sushiID=$sushi_id ";
                    $resultUpdateSushi = mysqli_query($conn,  $updateSushiQuery) or die("Error: ".mysqli_error($conn));   

                    if($resultUpdateSushi){
                        echo '<script>alert("Product (ID: '.$sushi_id.')(no image) has been updated.")</script>';  
                    }else{
                        echo '<script>alert("Product (ID: '.$sushi_id.')(no image) has not been updated.")</script>';
                    }

                }else{
                    $sushi_Img = addslashes(file_get_contents($hold_sushi_Img));
                    
                    //Update sushi detail
                    $updateSushiQuery = "UPDATE sushi SET sushiName='$sushi_Name', sushiDesc='".mysqli_real_escape_string($conn, $sushi_Desc)."', sushiImg='$sushi_Img', price='$sushi_Price', availability='$sushi_Available' WHERE sushiID=$sushi_id ";
                    $resultUpdateSushi = mysqli_query($conn,  $updateSushiQuery) or die("Error: ".mysqli_error($conn));   

                    if($resultUpdateSushi){
                        echo '<script>alert("Product (ID: '.$sushi_id.')(with image) has been updated.")</script>';  
                    }else{
                        echo '<script>alert("Product (ID: '.$sushi_id.')(without image) has not been updated.")</script>';
                    }

                }  

                $query = "SELECT sushiImg FROM sushi WHERE sushiID=$sushi_id";
                $result = $conn->query($query);

                if($result){
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $sushi_Img = $row['sushiImg'];   
                    }
                }                
            
            }else{

                $query = "SELECT sushiImg FROM sushi WHERE sushiID=$sushi_id";
                $result = $conn->query($query);

                if($result){
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $sushi_Img = $row['sushiImg'];   
                    }
                }                 
                echo '<script>alert("'.$AllErr.'")</script>';                    
            } 

            //Create a preset code for gender
            if($sushi_Available=="1"){
                $printAvailability = "<label>
                                    <select id=\"availability\" name=\"sushi_available\">
                                        <option value=\"1\" selected>Available</option>
                                        <option value=\"0\">Not Available</option>
                                    </select>
                                </label>";
            }else{
                $printAvailability = "<label>
                                    <select id=\"availability\" name=\"sushi_available\">
                                        <option value=\"1\">Available</option>
                                        <option value=\"0\" selected>Not Available</option>
                                    </select>
                                </label>";
            }            
        }
        else if(isset($_POST["delete-product"])){
            $sushi_id = $_POST['delete-product'];            


            //Update user detail in user table
            $delsushiQuery = "DELETE FROM sushi WHERE sushiID='$sushi_id'";
            $resultDel = mysqli_query($conn,  $delsushiQuery) or die("Error: ".mysqli_error($conn));

            if ($resultDel){
                echo '<script>alert("Product (ID: '.$sushi_id.') has been deleted.")</script>';                                
            }
            else {
                echo '<script>alert("Product (ID: '.$sushi_id.') failed to delete.")</script>';  
            }
            echo "<script>window.location.href='dashboard.php';</script>";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Display all the output in textfield and so on (with suitable field)
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
    <title>Menu Edit Page</title>
</head>
<body class="flex-col">
<section class="admin-page flex-row">
        <div class="admin-page-sidebar flex-col">
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
            <div class="admin-sidebar-tab-div">
                <ul>
                    <li class="li-padding"><img src="../img/admin-img/home.png" alt="home" class="size"><a class="left-nav black-txt" style="cursor: pointer;" href="Dashboard.php"> HOME</a></li>
                    <li class="li-padding"><img src="../img/admin-img/profile.jpg" alt="profile" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="Dashboard.php"> PROFILE</a></li>
                    <li class="li-padding"><img src="../img/admin-img/store.png" alt="store" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="Dashboard.php"> STORE</a></li>
                    <li class="li-padding"><img src="../img/admin-img/customer.jpg" alt="customer" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="Dashboard.php"> CUSTOMER</a></li>
                    <li class="li-padding"><img src="../img/admin-img/product.png" alt="product" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="Dashboard.php"> PRODUCT</a></li>
                    <li class="li-padding"><img src="../img/admin-img/order.png" alt="order" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="Dashboard.php"> ORDER</a></li>
                    <li class="li-padding"><img src="../img/admin-img/sign-out.png" alt="sign-out" class="size"><a class="left-nav black-txt " style="cursor: pointer;" href="Dashboard.php"> SIGN OUT</a></li>
                </ul>
            </div>
        </div>
        <div class="admin-page-dashboard">
            <div id="User-edit-container">
            <div class="dashboard-title-div">
                    <h1 class="dashboard-title">Edit Menu Details</h1>
                </div>
                <!-- All Customer Detail goes here -->
                <!-- hidden div inside button add menu tag -->
                <div class="main-profile profile-width-80" >
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                        <div class="main-profile-detail">
                            <div class="profile-width-5"></div>
                            <div class="main-profile-detail-left">
                                <div class="user-detail">
                                    <h3>Image Preview</h3>
                                    <img class="img-preview edit-img-side " src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($sushi_Img) ?>">
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
                                    <h3>Sushi Name</h3>
                                    <input name="sushi_name" class="input-detail" type="text" id="sushi_name" value="<?php echo $sushi_Name?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Sushi Description</h3>
                                    <textarea name="sushi_desc" class="input-detail" type="text" id="sushi_desc" rows="4" cols="30"><?php echo $sushi_Desc?></textarea>
                                </div>
                                <div class="user-detail">
                                    <h3>Price: </h3>
                                    <input name="sushi_price" class="input-detail" type="text" id="sushi_price" value="<?php echo $sushi_Price?>">
                                </div>
                                <div class="user-detail">
                                    <h3>Availability</h3>
                                    <select class="input-detail-2" name="status" id="status">
                                        <option <?php if($sushi_Available== 1) echo 'selected="selected"'; ?> value="1">Available</option>
                                        <option <?php if($sushi_Available== 0) echo 'selected="selected"'; ?> value="0">Not Available</option>
                                    </select>
                                </div>
                                <br>
                                <div class="user-detail-btn">
                                    <button id="SaveProductBtn" value=<?php echo $sushi_id;?> type="submit" name="Save-product" class="save-edit-btn red-bg">Save Changes</button>
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

</body>
</html>