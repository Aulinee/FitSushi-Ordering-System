<?php 
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
    
    public function setSessionStore(){
        $query = "SELECT * FROM storedetails";
        $result = $this->conn->query($query);
        $arrayData = array();
		if($result){
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $storeid = $row['storeID'];
                $opHrs = $row['operatingHours'];
                $location = $row['location'];
                $WA = $row['whatsappDetails'];
                $IG = $row['instagramDetails'];
                $FB = $row['facebookDetails'];
                $phonenum = "0".$row['contactNo'];

                $arrayData = array($storeid, $opHrs, $location, $WA, $IG, $FB, $phonenum);

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

    public function editStore($hold_storeid, $new_loc, $new_OpnHrs, $new_WA, $new_IG, $new_FB){

        //Update user detail in user table
        $updateStoreQuery = "UPDATE storedetails SET operatingHours='$new_OpnHrs', location='$new_loc', whatsappDetails='$new_WA', instagramDetails='$new_IG', facebookDetails='$new_FB' WHERE storeID=$hold_storeid ";
        $resultStore = mysqli_query($this->conn,  $updateStoreQuery) or die("Error: ".mysqli_error($this->conn));
       
        if ($resultStore == true) {
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

    public function displayTopBuyer(){

        $sqlGetTop5 = "SELECT o.customerID AS custID, COUNT(o.customerID) AS Frequency, c.custName AS customerName FROM orders o, customer c WHERE o.customerID = c.customerID AND o.orderStatusID = 2 GROUP BY o.customerID ORDER BY Frequency DESC LIMIT 5";
        $ResultGetTop5 = $this->conn->query($sqlGetTop5);

        if ($ResultGetTop5){
            if($ResultGetTop5->num_rows > 0){
                while($row = mysqli_fetch_array($ResultGetTop5)){
                    echo '<li class="li2">'.$row['customerName'].'</li>';
                }
            }
        }

    }


}

?>