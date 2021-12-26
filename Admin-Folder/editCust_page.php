<?php

    include '../database/dbConnection.php'; 

    echo "hello, welcome to editCust_page.php<br>";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["edit-customer"]) ) {

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
        /*else if(){
            submmit thingy goes here (to update the data)
        }*/
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
                    <input type='submit' id="SaveEdit-btn" class='button' name='SaveEdit-btn' value='Save' /> 
                    <button id="ResetContactBtn" value=<?php echo $customer_id;?> type="submit" name="edit-customer">Reset</button>                                         
                </div>                                                
            </form>
        </div>
        <div>
            <a href="Dashboard.php">Go back</a>
        </div>
    </div>
</body>
</html>