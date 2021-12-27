<?php

    include '../database/dbConnection.php'; 
    include '../Login/sessionAdmin.php';

    echo "hello, welcome to editCust_page.php<br>";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["edit-customer"])) {

            $customer_id = $_POST['edit-customer'];

            $query = "SELECT * FROM customer WHERE customerID=$customer_id";
            $result = $conn->query($query);

            if($result){
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $cust_Usn = $row['username'];
                    $cust_pass = $row['password'];
                    $cust_Fn = $row['custName'];
                    $cust_Mob = $row['phoneNo'];
                    $cust_EmailAdd = $row['email'];
                    $cust_HomeAdd = $row['deliveryAddress'];
                    $cust_POS = $row['PostalCode'];
                    $cust_Gender = $row['gender'];
    
                }else{
                    echo "Record not found";
                }
            }else{
                echo "Error in ".$query." ".$conn->error;
            } 

            //To test for correct output
            echo "Customer ID: ".$customer_id."<br>";
            echo "Username: ".$cust_Usn."<br>";
            echo "Password: ".$cust_pass."<br>";
            echo "Fullname: ".$cust_Fn."<br>";
            echo "Mobile Number: 0".$cust_Mob."<br>";
            echo "Email Address: ".$cust_EmailAdd."<br>";
            echo "Home Address: ".$cust_HomeAdd."<br>";
            echo "Postal Code: ".$cust_POS."<br>";
            echo "Gender: ".$cust_Gender."<br>";

            //Create a preset code for gender
            if($cust_Gender=="male"){
                $printGender = "<label> Male
                                    <input type=\"radio\" id=\"male\" name=\"genderbtn\" value=\"male\" checked>
                                </label>
                                <label> Female
                                    <input type=\"radio\" id=\"female\" name=\"genderbtn\" value=\"female\">
                                </label>";
            }else{
                $printGender = "<label> Male
                                    <input type=\"radio\" id=\"male\" name=\"genderbtn\" value=\"male\">
                                </label>
                                <label> Female
                                    <input type=\"radio\" id=\"female\" name=\"genderbtn\" value=\"female\" checked>
                                </label>";
            }


        }
        else if(isset($_POST["Save-customer"])){

            //Initial data
            $customer_id = $_POST["Save-customer"];
            $cust_Usn = $_POST["cust_usn"];
            $cust_Fn = $_POST["cust_fn"];
            $cust_Mob = $_POST["cust_mob"];
            $cust_EmailAdd = $_POST["cust_email"];
            $cust_HomeAdd = $_POST["cust_home"];
            $cust_POS = $_POST["cust_POS"];
            $cust_Gender = $_POST["genderbtn"];

            $usernameErr = $FullnameErr = $mobileNumErr = $emailErr = $HomeErr = $POSErr = "";
            $username_edit = $fname_edit = $mobileNum_edit = $email_edit = $home_edit = $POS_edit = "";
            $boolUsername = $boolFname = $boolMobileNum = $boolEmail = $boolHome = $boolPOS = false;
            $boolAllTrue = false;

            echo "Input check<br>";

            //Username validation
            $username_edit = $cust_Usn;
            if (empty($username_edit)) {
                //echo "Username is empty<br>";
                $usernameErr = "Username is required";
            } else {
                //echo "Username is true<br>";
                $boolUsername = true;
            }

            //full name validation
            $fname_edit = $cust_Fn;
            if (empty($fname_edit)) {
                //echo "Fullname is empty<br>";
                $FullnameErr = "Full name is required";
            } else {
                //echo "Fullname is true<br>";
                $boolFname = true;
            }
        
            //email validation
            if (empty($cust_EmailAdd)) {
                //echo "email is empty<br>";
                $emailErr = "Email is required";
            } else {
                $email_edit = test_input($cust_EmailAdd);
                // check if e-mail address is well-formed
                if (!filter_var($email_edit, FILTER_VALIDATE_EMAIL)) {
                    //echo "email is wrong format<br>";
                    $emailErr = "Invalid email format";
                } else {
                    //echo "email is true<br>";
                    $boolEmail = true;
                }
            }
        
            //Home validation
            $home_edit = $cust_HomeAdd;
            if (empty($home_edit)) {
                //echo "Address is wrong<br>";
                $HomeErr = "Full name is required";
            } else {
                //echo "Address is true<br>";
                $boolHome = true;
            }

            //Postal validation
            if (empty($cust_POS)) {
                //echo "POS is empty<br>";
                $POSErr = "Postal code is required";
            } else {
                $POS_edit = test_input($cust_POS);
                // check if postal code is valid
                if (!preg_match("/^([1-9])\d{4}$/", $POS_edit)) {
                    $POSErr = "Invalid postal format";
                    //echo "POS is wrong format<br>";
                } else {
                    //echo "POS is true<br>";
                    $boolPOS = true;
                }
            }            

            //mobile number validation
            if (empty($cust_Mob)) {
                echo "Mob is empty<br>";
                $mobileNumErr = "Mobile number is required";
            } else {
                $mobileNum_edit = test_input($cust_Mob);
                // check if phone number is valid
                if (!preg_match("/^(1)[0-9]\d{6,7}$/", $mobileNum_edit)) {
                    $mobileNumErr = "Invalid mobile number format";
                   // echo "Mob is wrong format<br>";
                } else {
                    //echo "Mob is true<br>";
                    $boolMobileNum = true;
                }
            }

            if ($boolUsername == true){
                if($boolFname == true){
                    if($boolMobileNum == true){
                        if($boolEmail == true){
                            if($boolHome == true){
                                if($boolPOS == true){
                                    $boolAllTrue = true;
                                }
                            }
                        }
                    }
                }
            }

            if ($boolAllTrue == true){

                //Update user detail in user table
                $updateCustQuery = "UPDATE customer SET username='$cust_Usn', custName='$cust_Fn', phoneNo='$cust_Mob', email='$cust_EmailAdd', deliveryAddress='$cust_HomeAdd', PostalCode='$cust_POS', gender='$cust_Gender' WHERE customerID=$customer_id ";
                $resultCust = mysqli_query($conn,  $updateCustQuery) or die("Error: ".mysqli_error($conn));
            
            }

            //Create a preset code for gender
            if($cust_Gender=="male"){
                $printGender = "<label> Male
                                    <input type=\"radio\" id=\"male\" name=\"genderbtn\" value=\"male\" checked>
                                </label>
                                <label> Female
                                    <input type=\"radio\" id=\"female\" name=\"genderbtn\" value=\"female\">
                                </label>";
            }else{
                $printGender = "<label> Male
                                    <input type=\"radio\" id=\"male\" name=\"genderbtn\" value=\"male\">
                                </label>
                                <label> Female
                                    <input type=\"radio\" id=\"female\" name=\"genderbtn\" value=\"female\" checked>
                                </label>";
            }

            //To test for correct output
            echo "Customer ID: ".$customer_id."<br>";
            echo "New Username: ".$cust_Usn."<br>";
            echo "New Fullname: ".$cust_Fn."<br>";
            echo "New Mobile Number: 0".$cust_Mob."<br>";
            echo "New Email Address: ".$cust_EmailAdd."<br>";
            echo "New Home Address: ".$cust_HomeAdd."<br>";
            echo "New Postal Code: ".$cust_POS."<br>";
            echo "New Gender: ".$cust_Gender."<br>";            

            $AllErr = $usernameErr.'\r\n'.$FullnameErr.'\r\n'.$mobileNumErr.'\r\n'.$emailErr.'\r\n'.$HomeErr.'\r\n'.$POSErr;

            if ($boolAllTrue == true){
                echo '<script>alert("Congratulations. Customer\'s profile has been updated.")</script>';
            }
            else{
                echo '<script>alert("'.$AllErr.'")</script>';
            }
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
    <title>Customer Edit Page</title>
</head>
<body>
    <div id="User-edit-container">
        <div id="User-edit-title" align="center">
            <h1>Edit Customer Details</h1>
        </div>

        <!-- All Customer Detail goes here -->
        <div>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div>
                    <label> Username: 
                        <input name="cust_usn" class="input-detail" type="text" id="username" value="<?php echo $cust_Usn?>">                        
                    </label>
                </div>
                <div>
                    <label> Fullname: 
                        <input name="cust_fn" class="input-detail" type="text" id="fullname" value="<?php echo $cust_Fn?>">                        
                    </label>
                </div>
                <div>
                    <label> Mobile Number: 
                        <input name="cust_mob" class="input-detail" type="text" id="mobilenumber" value="<?php echo $cust_Mob?>">                        
                    </label>
                </div>
                <div>
                    <label> Email Address: 
                        <input name="cust_email" class="input-detail" type="text" id="email_address" value="<?php echo $cust_EmailAdd?>">                        
                    </label>
                </div>
                <div>
                    <label> Home Address: 
                        <textarea name="cust_home" class="input-detail" type="text" id="home_address" rows="4" cols="30"><?php echo $cust_HomeAdd?></textarea>                      
                    </label>
                </div>
                <div>
                    <label> Postal: 
                        <input name="cust_POS" class="input-detail" type="text" id="home_address" value="<?php echo $cust_POS?>">                        
                    </label>
                </div>   
                <div>
                    <?php echo $printGender; ?>
                </div>
                <div>
                    <button id="SaveCustBtn" value=<?php echo $customer_id;?> type="submit" name="Save-customer">Save</button>                         
                    <button id="ResetCustBtn" value=<?php echo $customer_id;?> type="submit" name="edit-customer">Reset</button>                                         
                </div>                                                
            </form>
        </div>
        <div>
            <a href="Dashboard.php">Go back</a>
        </div>
    </div>
</body>
</html>