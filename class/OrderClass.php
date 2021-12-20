<?php 
include '../database/dbConnection.php'; 

class Order{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function getDeliveryOptionList(){
         $deliveryQuery = "SELECT * from delivery";
         $result = $this->conn->query($deliveryQuery);
 
         if($result){
             if ($result->num_rows > 0) {
                 while($row = mysqli_fetch_array($result)){
                     $id = $row["deliveryID"];
                     $name = $row["deliveryOption"];
 
                     echo'
                     
                     ';
                 }
             }else{
                 echo "Record not found";
             }
         }else{
             echo "Error in ".$deliveryQuery." ".$this->conn->error;
         }

    }

    public function getPaymentOptionList(){
        $paymentQuery = "SELECT * from payment";
        $result = $this->conn->query($paymentQuery);

        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_array($result)){
                    $id = $row["paymentID"];
                    $name = $row["paymentMethod"];

                    echo'
                    
                    ';
                }
            }else{
                echo "Record not found";
            }
        }else{
            echo "Error in ".$paymentQuery." ".$this->conn->error;
        }
        
    }

    public function addAlacarteOrder(){
        // add into alacarteorder table
    }

    public function deleteAlacarteOrder(){
        
    }

    public function makeOrder(){
        
    }

    public function getPendingOrder(){
        
    }

    public function getOnDeliveryOrder(){
        
    }

    public function getCompleteOrder(){
        
    }

    public function getCancelOrder(){
        
    }

    
}

?>