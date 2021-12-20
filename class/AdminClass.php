<?php 
include '../database/dbConnection.php'; 

class Admin{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function loginAuthentication(string $username, string $password){
        $query = "SELECT * FROM admin WHERE Username = '$username' AND Password = '$password'";
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



    public function createCustomer(){
        echo "Customer cretaed";
    }


}

?>