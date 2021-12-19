<?php 
include '../database/dbConnection.php'; 

class Order{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function getDeliveryOptionList(){

    }

    public function getPaymentOptionList(){
        
    }

    public function addAlacarteOrder(){
        
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