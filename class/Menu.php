<?php 
include '../database/dbConnection.php'; 

class Menu{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
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
}

?>