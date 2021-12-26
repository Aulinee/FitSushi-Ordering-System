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

            echo "Customer ID: ".$customer_id."<br>";
            echo "Username: ".$cust_Usn."<br>";
            echo "Password: ".$cust_pass."<br>";
            echo "Fullname: ".$cust_Fn."<br>";
            echo "Mobile Number: 0".$cust_Mob."<br>";
            echo "Email Address: ".$cust_EmailAdd."<br>";
            echo "Home Address: ".$cust_HomeAdd."<br>";
            echo "Postal Code: ".$cust_POS."<br>";
            echo "Gender: ".$cust_Gender."<br>";

        }
    }
?>