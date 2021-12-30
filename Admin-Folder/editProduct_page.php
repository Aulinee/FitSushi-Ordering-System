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
            $hold_sushi_Img = $_FILES['selectedImage']['tmp_name'];
            $sushi_Price = $_POST["sushi_price"];
            $sushi_Available = $_POST["sushi_available"];

            //To check if the image is changed (Uncomment to test)
            /*if(empty($hold_sushi_Img)){
                echo "No image selected<br>";
            }else{
                $sushi_Img = addslashes(file_get_contents($hold_sushi_Img));
                echo "Image name: Already selected! <br>";
            }

            



            echo "Sushi ID: ".$sushi_id."<br>";
            echo "Sushi Name: ".$sushi_Name."<br>";
            echo "Sushi Desc: ".addslashes($sushi_Desc)."<br>";            
            echo "Sushi Price: ".$sushi_Price."<br>";
            echo "Sushi Available:".$sushi_Available."<br>";*/

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
    <title>Product Edit Page</title>
</head>
<body>
    <div id="User-edit-container">
        <div id="User-edit-title" align="center">
            <h1>Edit Sushi Details</h1>
        </div>

        <!-- All Customer Detail goes here -->
        <div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div>
                    <label> Sushi Name: 
                        <input name="sushi_name" class="input-detail" type="text" id="sushi_name" value="<?php echo $sushi_Name?>">                        
                    </label>
                </div>
                <div>
                    <label> Description: 
                        <textarea name="sushi_desc" class="input-detail" type="text" id="sushi_desc" rows="4" cols="30"><?php echo $sushi_Desc?></textarea>                      
                    </label>
                </div>                
                <div>
                    <label> Image Preview: 
                        <img src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($sushi_Img) ?>" width="100" height="100">                         
                    </label>
                </div>
                <div>
                    <label> Upload a new image: 
                        <input name="selectedImage" class="input-detail" type="file" id="new_image" accept=".png,.jpeg,.jpg">                        
                    </label>
                </div>
                <div>
                    <label> Price: 
                        <input name="sushi_price" class="input-detail" type="text" id="sushi_price" value="<?php echo $sushi_Price?>">                        
                    </label>
                </div>   
                <div>
                    <?php echo $printAvailability; ?>
                </div>
                <div>
                    <button id="SaveProductBtn" value=<?php echo $sushi_id;?> type="submit" name="Save-product">Save</button>                         
                    <button id="ResetProductBtn" value=<?php echo $sushi_id;?> type="submit" name="edit-product">Reset</button>                                         
                </div>                                                
            </form>
        </div>
        <br>
        <div>
            <a href="Dashboard.php">Go back</a>
        </div>
    </div>

</body>
</html>