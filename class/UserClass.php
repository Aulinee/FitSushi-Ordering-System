<?php 
// include '../database/dbConnection.php'; 

class User{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function checkExistUsername($username){
        //Create query string
        $checkUsernameQuery = "SELECT * FROM `customer` WHERE username = '$username'";
        $result = mysqli_query($this->conn, $checkUsernameQuery) or die("Error: ".mysqli_error($this->conn));
        $count = mysqli_num_rows($result);
    
        // If result matched $username, table row must be 1 row
        if($count == 1){
            return true;
        }else{
            return false;
        }

    }

    public function addNewAddress($postalcode, $city, $state, $country){
        $postalcode = $this->conn->real_escape_string($postalcode);
        $city = $this->conn->real_escape_string($city);
        $state = $this->conn->real_escape_string($state);
        $country = $this->conn->real_escape_string($country);

        /* Insert query template */
        $stringQuery = "INSERT INTO address(PostalCode, State, Area, Country) VALUES ('$postalcode', '$state', '$city', '$country')";
        
        $sqlQuery = $this->conn->query($stringQuery);
        if ($sqlQuery == true) {
            //echo "Successful update query";
            return true;
        }else{
            return false;
            // echo "Error in ". $sqlQuery." ".$this->conn->error;
            //echo "Unsuccessful update query. try again!";
        }
    }

    public function signUp($username, $fullname, $email, $password, $mobileNum, $gender, $addressline, $postcode, $city, $state){
        $checkPostalQuery = "SELECT * FROM address WHERE PostalCode = $postcode";
        $resultPostal = mysqli_query($this->conn,  $checkPostalQuery) or die("Error: ".mysqli_error($this->conn));
        $countPostal = mysqli_num_rows($resultPostal);

        if($countPostal == 0){
            //Insert new postal address in address table
            $this->addNewAddress($postcode, $city, $state, "Malaysia");
        }

        //Insert user detail in user table
        $insertUserQuery = "INSERT INTO customer(username, password, custName, email, gender, phoneNo, deliveryAddress, PostalCode)
        VALUES ('$username', '$password', '$fullname', '$email', '$gender', $mobileNum, '$addressline', $postcode)";
        $resultUser = mysqli_query($this->conn,  $insertUserQuery) or die("Error: ".mysqli_error($this->conn));
       
        if ($resultUser == true) {
            // echo "Success";
            return true;
        }else{
            echo "Error in ".$resultUser." ".$this->conn->error;
            return false;
        }
        
    }

    public function loginAuthentication(string $username, string $password){
        $query = "SELECT * FROM customer WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($this->conn, $query) or die("Error: ".mysqli_error($this->conn));
        $count = mysqli_num_rows($result);
    
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 1){
            // echo "Success 1";
            return true;
        }else{
            // echo "Record not found";
        }
        
        return false;
    }

    public function setSessionData(string $username, string $password){
        $query = "SELECT * FROM customer WHERE username = '$username' AND password = '$password'";
        $result = $this->conn->query($query);
        $arrayData = array();
		if($result){
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userid = $row['customerID'];
                $username = $row['username'];
                $fullname = $row['custName'];
                $email = $row['email'];
                $gender = $row['gender'];
                $phonenum = "0".$row['phoneNo'];

                //Query for postal code
                $addressline = $row['deliveryAddress'];
                $postalcode = $row['PostalCode'];
                $queryPC = "SELECT * FROM address WHERE PostalCode =  $postalcode";
                $resultPC = $this->conn->query($queryPC);

                if($resultPC){
                    if($resultPC->num_rows > 0){
                        $rowPC = $resultPC->fetch_assoc();
                        $area = $rowPC['Area'];
                        $state = $rowPC['State'];
                        $country = $rowPC['Country'];
                        $arrayData = array($userid, $username, $fullname, $email, $gender, $phonenum, $addressline, $password, $postalcode, $area, $state, $country);
                    }
                }
                return $arrayData;
            }else{
                echo "Record not found";
            }
        }else{
            echo "Error in ".$query." ".$this->conn->error;
        } 
    }

    public function updateProfile($id, $username, $fullname, $email, $password, $mobileNum, $gender, $addressline, $postcode, $city, $state){
        $checkPostalQuery = "SELECT * FROM address WHERE PostalCode = $postcode";
        $resultPostal = mysqli_query($this->conn,  $checkPostalQuery) or die("Error: ".mysqli_error($this->conn));
        $countPostal = mysqli_num_rows($resultPostal);

        $mobileNum = $this->conn->real_escape_string($mobileNum);
        $email = $this->conn->real_escape_string($email);

        if($countPostal == 0){
            //Insert new postal address in address table
            $this->addNewAddress($postcode, $city, $state, "Malaysia");
        }

        //Update user detail in user table
        $updateUserQuery = "UPDATE customer SET username='$username', password='$fullname', phoneNo='$mobileNum', custName='$fullname', email='$email', gender='$gender', deliveryAddress='$addressline', 
                            PostalCode=$postcode, password='$password' WHERE customerID=$id ";
        $resultUser = mysqli_query($this->conn,  $updateUserQuery) or die("Error: ".mysqli_error($this->conn));
       
        if ($resultUser == true) {
            return true;
        }else{
            // echo "Error in ".$resultUser." ".$this->conn->error;
            return false;
        }
        
    }

    //This function is still under development 
    public function displayAllCustomer(){
        $displayCustomerQuery = "SELECT * FROM customer c, address a WHERE c.PostalCode = a.PostalCode";
        $result = $this->conn->query($displayCustomerQuery);

        $customerData = array();

        while($row = mysqli_fetch_array($result)){
            $id = $row["customerID"];
            $username = $row["username"];
            $custname = $row["custName"];
            $phoneNum = $row["phoneNo"];
            $email = $row["email"];
            $address = $row["deliveryAddress"].', '.$row["PostalCode"].' '.$row["Area"].', '.$row["State"].', '.$row["Country"];

            $customerData[] = array(
                "id" => $id,
                "username" => $username,
                "custname" => $custname,
                "phone" => $phoneNum,
                "email" => $email,
                "address" => $address
            );
        }

        return $customerData;
    }

}

//end of line
?> 
