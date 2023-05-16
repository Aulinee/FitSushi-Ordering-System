<?php 
// include '../database/dbConnection.php'; 

class User{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function displayAllCustomer() {
        $displayCustomerQuery = "SELECT * FROM customer c, address a WHERE c.PostalCode = a.PostalCodeID";
        $stmt = $this->conn->prepare($displayCustomerQuery);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $customerData = array();
    
        while ($row = $result->fetch_assoc()) {
            $id = $row["customerID"];
            $username = $row["username"];
            $custname = $row["custName"];
            $phoneNum = $row["phoneNo"];
            $email = $row["email"];
            $address = $row["deliveryAddress"] . ', ' . $row["PostalCode"] . ' ' . $row["Area"] . ', ' . $row["State"] . ', ' . $row["Country"];
    
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
    

    public function checkExistUsername($username) {
        $checkUsernameQuery = "SELECT * FROM `customer` WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $checkUsernameQuery);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($result);
    
        // If result matched $username, table row must be 1 row
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }
    

    public function addNewAddress($postalcode, $city, $state, $country) {
        $postalcode = $this->conn->real_escape_string($postalcode);
        $city = $this->conn->real_escape_string($city);
        $state = $this->conn->real_escape_string($state);
        $country = $this->conn->real_escape_string($country);
    
        $insertQuery = "INSERT INTO address(PostalCode, State, Area, Country) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $postalcode, $state, $city, $country);
        
        if ($stmt->execute()) {
            // echo "Successful update query";
            return true;
        } else {
            return false;
            // echo "Error: " . $stmt->error;
            // echo "Unsuccessful update query. Try again!";
        }
    }
    

    public function signUp($username, $fullname, $email, $password, $mobileNum, $gender, $addressline, $postcode, $city, $state) {
        $checkPostalQuery = "SELECT * FROM address WHERE PostalCode = ? AND State = ? AND Area = ?";
        $stmtPostal = mysqli_prepare($this->conn, $checkPostalQuery);
        mysqli_stmt_bind_param($stmtPostal, "sss", $postcode, $state, $city);
        mysqli_stmt_execute($stmtPostal);
        $resultPostal = mysqli_stmt_get_result($stmtPostal);
        $countPostal = mysqli_num_rows($resultPostal);
    
        if ($countPostal == 0) {
            // Insert new postal address in address table
            $this->addNewAddress($postcode, $city, $state, "Malaysia");
            $postalid = $this->conn->insert_id;
        } else {
            $row = $resultPostal->fetch_assoc();
            $postalid = $row['PostalCodeID'];
        }
    
        // Insert user detail in user table
        $insertUserQuery = "INSERT INTO customer(username, password, custName, email, gender, phoneNo, deliveryAddress, PostalCode)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmtUser = mysqli_prepare($this->conn, $insertUserQuery);
        mysqli_stmt_bind_param($stmtUser, "sssssssi", $username, $password, $fullname, $email, $gender, $mobileNum, $addressline, $postalid);
        $resultUser = mysqli_stmt_execute($stmtUser);
    
        if ($resultUser) {
            return true;
        } else {
            return false;
        }
    }
    
    public function loginAuthentication(string $username, string $password) {
        $query = "SELECT * FROM customer WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($result);
    
        if ($count == 1) {
            return true;
        } else {
            return false;
        }
    }
    

    public function setSessionData(string $username, string $password) {
        $query = "SELECT * FROM customer WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $arrayData = array();
    
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userid = $row['customerID'];
                $username = $row['username'];
                $fullname = $row['custName'];
                $email = $row['email'];
                $gender = $row['gender'];
                $phonenum = "0" . $row['phoneNo'];
    
                // Query for postal code
                $addressline = $row['deliveryAddress'];
                $postalcode = $row['PostalCode'];
                $queryPC = "SELECT * FROM address WHERE PostalCodeID = ?";
                $stmtPC = mysqli_prepare($this->conn, $queryPC);
                mysqli_stmt_bind_param($stmtPC, "i", $postalcode);
                mysqli_stmt_execute($stmtPC);
                $resultPC = mysqli_stmt_get_result($stmtPC);
    
                if ($resultPC) {
                    if ($resultPC->num_rows > 0) {
                        $rowPC = $resultPC->fetch_assoc();
                        $postalcodeno = $rowPC['PostalCode'];
                        $area = $rowPC['Area'];
                        $state = $rowPC['State'];
                        $country = $rowPC['Country'];
                        $arrayData = array($userid, $username, $fullname, $email, $gender, $phonenum, $addressline, $password, $postalcodeno, $area, $state, $country, $postalcode);
                    }
                }
                return $arrayData;
            } else {
                echo "Record not found";
            }
        } else {
            echo "Error in " . $query . " " . mysqli_error($this->conn);
        }
    }
    

    public function updateProfile($id, $username, $fullname, $email, $password, $mobileNum, $gender, $addressline, $postcode, $city, $state, $postalid) {
        $checkPostalQuery = "SELECT * FROM address WHERE PostalCodeID = ? AND PostalCode = ? AND State = ? AND Area = ?";
        $stmtPostal = mysqli_prepare($this->conn, $checkPostalQuery);
        mysqli_stmt_bind_param($stmtPostal, "isss", $postalid, $postcode, $state, $city);
        mysqli_stmt_execute($stmtPostal);
        $resultPostal = mysqli_stmt_get_result($stmtPostal);
        $countPostal = mysqli_num_rows($resultPostal);
    
        $mobileNum = $this->conn->real_escape_string($mobileNum);
        $email = $this->conn->real_escape_string($email);
    
        if ($countPostal == 0) {
            // Insert new postal address in the address table
            $this->addNewAddress($postcode, $city, $state, "Malaysia");
            $last_id = $this->conn->insert_id;
            $postalid = $last_id;
        }
    
        // Update user details in the user table
        $updateUserQuery = "UPDATE customer SET username=?, password=?, phoneNo=?, custName=?, email=?, gender=?, deliveryAddress=?, PostalCode=?, password=? WHERE customerID=?";
        $stmtUser = mysqli_prepare($this->conn, $updateUserQuery);
        mysqli_stmt_bind_param($stmtUser, "sssssssssi", $username, $password, $mobileNum, $fullname, $email, $gender, $addressline, $postalid, $password, $id);
        $resultUser = mysqli_stmt_execute($stmtUser);
    
        if ($resultUser) {
            return true;
        } else {
            // echo "Error in " . $resultUser . " " . $this->conn->error;
            return false;
        }
    }
    

    function deleteProfile($cust_id) {
        $delprofileQuery = "DELETE FROM customer WHERE customerID=?";
        $stmt = mysqli_prepare($this->conn, $delprofileQuery);
        mysqli_stmt_bind_param($stmt, "i", $cust_id);
        $deleteProfile = mysqli_stmt_execute($stmt);
    
        if ($deleteProfile) {
            return true;
        } else {
            return false;
        }
    }
    

}

//end of line
?> 
