<?php 
class Admin{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function loginAuthentication(string $username, string $password) {
        $query = "SELECT * FROM administrator WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $count = mysqli_num_rows($result);
    
        if ($count == 1) {
            return true;
        } else {
            echo "Record not found";
            return false;
        }
    }
    
    public function setSessionData(string $username, string $password) {
        $query = "SELECT * FROM administrator WHERE username = ? AND password = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $arrayData = array();
    
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $adminid = $row['adminID'];
                $username = $row['username'];
                $fullname = $row['adminName'];
                $email = $row['email'];
                $phonenum = "0" . $row['phoneNo'];
    
                $arrayData = array($adminid, $username, $password, $fullname, $phonenum, $email);
    
                return $arrayData;
            } else {
                echo "Record not found";
            }
        } else {
            echo "Error in " . $query . " " . $this->conn->error;
        }
    
        return $arrayData;
    }
    
    public function setSessionStore() {
        $query = "SELECT * FROM storedetails";
        $result = $this->conn->query($query);
        $arrayData = array();
    
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $storeid = $row['storeID'];
                $opHrs = $row['operatingHours'];
                $location = $row['location'];
                $WA = $row['whatsappDetails'];
                $IG = $row['instagramDetails'];
                $FB = $row['facebookDetails'];
                $phonenum = "0" . $row['contactNo'];
    
                $arrayData = array($storeid, $opHrs, $location, $WA, $IG, $FB, $phonenum);
    
                return $arrayData;
            } else {
                echo "Record not found";
            }
        } else {
            echo "Error in " . $query . " " . $this->conn->error;
        }
    
        return $arrayData;
    }    

    public function displayStoreDetail() {
        $query = "SELECT * FROM storedetails";
        $result = $this->conn->query($query);
        $arrayData = array();
    
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $operatingHour = $row['operatingHours'];
                $location = $row['location'];
                $whatsapp = $row['whatsappDetails'];
                $instagram = $row['instagramDetails'];
                $facebook = $row['facebookDetails'];
                $contactNo = $row['contactNo'];
    
                $arrayData = array($operatingHour, $location, $whatsapp, $instagram, $facebook, $contactNo);
                return $arrayData;
            } else {
                echo "Record not found";
            }
        } else {
            echo "Error in " . $query . " " . $this->conn->error;
        }
    }
    
    public function editProfile($edit_id, $newUsn, $newFname, $newEmail, $newPass, $newPhoneNum) {
        $newUsn = $this->conn->real_escape_string($newUsn);
        $newFname = $this->conn->real_escape_string($newFname);
        $newEmail = $this->conn->real_escape_string($newEmail);
        $newPass = $this->conn->real_escape_string($newPass);
        $newPhoneNum = $this->conn->real_escape_string($newPhoneNum);
    
        $updateAdminQuery = "UPDATE administrator SET username=?, password=?, phoneNo=?, adminName=?, email=? WHERE adminID=?";
        $stmt = mysqli_prepare($this->conn, $updateAdminQuery);
        mysqli_stmt_bind_param($stmt, "sssssi", $newUsn, $newPass, $newPhoneNum, $newFname, $newEmail, $edit_id);
        $resultAdmin = mysqli_stmt_execute($stmt);
    
        if ($resultAdmin) {
            return true;
        } else {
            // echo "Error in " . $resultUser . " " . $this->conn->error;
            return false;
        }
    }

    public function editStore($hold_storeid, $new_loc, $new_OpnHrs, $new_WA, $new_IG, $new_FB) {
        $new_loc = $this->conn->real_escape_string($new_loc);
        $new_OpnHrs = $this->conn->real_escape_string($new_OpnHrs);
        $new_WA = $this->conn->real_escape_string($new_WA);
        $new_IG = $this->conn->real_escape_string($new_IG);
        $new_FB = $this->conn->real_escape_string($new_FB);
    
        $updateStoreQuery = "UPDATE storedetails SET operatingHours=?, location=?, whatsappDetails=?, instagramDetails=?, facebookDetails=? WHERE storeID=?";
        $stmt = $this->conn->prepare($updateStoreQuery);
        $stmt->bind_param("sssssi", $new_OpnHrs, $new_loc, $new_WA, $new_IG, $new_FB, $hold_storeid);
        $resultStore = $stmt->execute();
    
        if ($resultStore) {
            return true;
        } else {
            // echo "Error in ".$resultUser." ".$this->conn->error;
            return false;
        }
    }
    
    public function setSessionCustomer($cust_id) {
        $query = "SELECT * FROM customer WHERE customerID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $cust_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $arrayData = array();
    
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userid = $row['customerID'];
                $username = $row['username'];
                $password = $row['password'];
                $fullname = $row['custName'];
                $email = $row['email'];
                $gender = $row['gender'];
                $phonenum = "0" . $row['phoneNo'];
    
                //Query for postal code
                $addressline = $row['deliveryAddress'];
                $postalcodeID = $row['PostalCode'];
                $queryPC = "SELECT * FROM address WHERE PostalCodeID = ?";
                $stmtPC = $this->conn->prepare($queryPC);
                $stmtPC->bind_param("i", $postalcodeID);
                $stmtPC->execute();
                $resultPC = $stmtPC->get_result();
    
                if ($resultPC) {
                    if ($resultPC->num_rows > 0) {
                        $rowPC = $resultPC->fetch_assoc();
                        $postalCode = $rowPC['PostalCode'];
                        $area = $rowPC['Area'];
                        $state = $rowPC['State'];
                        $country = $rowPC['Country'];
                        $arrayData = array($userid, $username, $fullname, $email, $gender, $phonenum, $addressline, $password, $postalCode, $area, $state, $country, $postalcodeID);
                    }
                }
                return $arrayData;
            } else {
                echo "Record not found";
            }
        } else {
            echo "Error in " . $query . " " . $this->conn->error;
        }
    }

    public function displayTopBuyer() {
        $sqlGetTop5 = "SELECT o.customerID AS custID, COUNT(o.customerID) AS Frequency, c.custName AS customerName FROM orders o JOIN customer c ON o.customerID = c.customerID WHERE o.orderStatusID = 2 GROUP BY o.customerID ORDER BY Frequency DESC LIMIT 5";
        $stmt = $this->conn->prepare($sqlGetTop5);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<li class="li2">' . $row['customerName'] . '</li>';
                }
            }
        }
    }
    


}

?>