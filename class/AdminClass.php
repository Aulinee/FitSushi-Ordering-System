<?php 
include '../database/dbConnection.php'; 

class Admin{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function loginAuthentication(string $username, string $password){
        $query = "SELECT * FROM administrator WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($this->conn, $query) or die("Error: ".mysqli_error($this->conn));
        $count = mysqli_num_rows($result);
    
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 1){
            return true;
        }else{
            echo "Record not found";
        }
        
        return false;
    }

    public function setSessionData(string $username, string $password){
        $query = "SELECT * FROM administrator WHERE username = '$username' AND password = '$password'";
        $result = $this->conn->query($query);
        $arrayData = array();
		if($result){
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $adminid = $row['adminID'];
                $username = $row['username'];
                $fullname = $row['adminName'];
                $email = $row['email'];
                $phonenum = "0".$row['phoneNo'];

                $arrayData = array($adminid, $username, $password, $fullname, $phonenum, $email);

                return $arrayData;

            }else{
                echo "Record not found";
            }
        }else{
            echo "Error in ".$query." ".$this->conn->error;
        } 
    }    

    public function displayStoreDetail()
    {
        $query = "SELECT * FROM storedetails";
        $result = $this->conn->query($query);
        $arrayData = array();

        if($result){
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

            }else{
                echo "Record not found";
            }
        }else{
            echo "Error in ".$query." ".$this->conn->error;
        } 

    }

    public function editProfile($edit_id, $newUsn, $newFname, $newEmail, $newPass, $newPhoneNum){

        //Update user detail in user table
        $updateAdminQuery = "UPDATE administrator SET username='$newUsn', password='$newPass', phoneNo='$newPhoneNum', adminName='$newFname', email='$newEmail' WHERE adminID=$edit_id ";
        $resultAdmin = mysqli_query($this->conn,  $updateAdminQuery) or die("Error: ".mysqli_error($this->conn));
       
        if ($resultAdmin == true) {
            return true;
        }else{
            // echo "Error in ".$resultUser." ".$this->conn->error;
            return false;
        }        
    }

    public function setSessionCustomer(string $cust_id){
        $query = "SELECT * FROM customer WHERE customerID = $cust_id";
        $result = $this->conn->query($query);
        $arrayData = array();
		if($result){
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $userid = $row['customerID'];
                $username = $row['username'];
                $password = $row['password'];
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


    public function createCustomer(){
        echo "Customer cretaed";
    }


}

?>