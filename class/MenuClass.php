<?php 

class Menu{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function checkExistMenu($customerid, $sushiid){
        $menuQuery = "SELECT * FROM alacartesushibox WHERE customerID = $customerid AND sushiID = $sushiid";

        $result = mysqli_query($this->conn, $menuQuery) or die("Error: ".mysqli_error($this->conn));
        $count = mysqli_num_rows($result);
    
        // If result matched $username, table row must be 1 row
        if($count == 1){
            return true;
        }else{
            return false;
        }
    }

    public function getTopMenu()
    {
        // $menuQuery = "SELECT sushiName, sushiImg FROM sushi LIMIT 5";
        $menuQuery = "SELECT s.sushiName AS name, s.sushiImg AS image from sushi s WHERE s.sushiImg != 'NULL' AND s.availability != 0 LIMIT 5";
        $result = $this->conn->query($menuQuery);

        $menuData = array();

        while($row = mysqli_fetch_array($result)){
            $name = $row["name"];
            $image = $row["image"];

            $menuData[] = array(
                "name" => $name,
                "img" => $image,
            );
        }

        return $menuData;
    }

    public function getAlacarteMenuList(){
        $menuQuery = "SELECT * from sushi s WHERE s.availability != 0";
        $displayQuery = mysqli_query($this->conn, $menuQuery);

        $orderData = array();

        while($row = mysqli_fetch_array($displayQuery)){
            $id = $row["sushiID"];
            $name = $row["sushiName"];
            $desc = $row["sushiDesc"];
            $image = $row["sushiImg"];
            $price = $row["price"];

            $orderData[] = array(
                "id" => $id,
                "name" => $name,
                "desc" => $desc,
                "img" => $image,
                "price" => $price
            );
        }

        return $orderData;
    }

    public function displayAlacarteSushibox($customerid){
        $customerid = $this->conn->real_escape_string($customerid);
        $menuQuery = "SELECT s.sushiID AS sushiID ,s.sushiName AS sushiName , s.price AS price, a.qty AS qty FROM alacartesushibox a, sushi s WHERE a.sushiID = s.sushiID AND customerID = '$customerid'";
        $displayQuery = mysqli_query($this->conn, $menuQuery);

        $sushiboxData = array();

        while($row = mysqli_fetch_array($displayQuery)){
            $id = $row["sushiID"];
            $name = $row["sushiName"];
            $unitprice = $row["price"];
            $qty = $row["qty"];
            $totalprice = $qty * $unitprice;

            $sushiboxData[] = array(
                "id" => $id,
                "name" => $name,
                "price" => $unitprice,
                "qty" => $qty,
                "total" =>$totalprice
            );
        }

        return $sushiboxData;

    }

    public function addAlacarte($customerid, $sushiid, $qty){
        /* Insert query template */
        $stringQuery = "INSERT INTO alacartesushibox (customerID, sushiID, qty) VALUES ('$customerid','$sushiid', '$qty')";
        $sqlQuery = $this->conn->query($stringQuery);
        if ($sqlQuery == true) {
            return true;
        }else{
            echo "Error in ".$sqlQuery." ".$this->conn->error;
            //echo "Unsuccessful add query. try again!";
            return false;
        }
    }

    public function updateAlacarteQty($customerid, $sushiid, $qty){
        $updateMenuQuery = "UPDATE alacartesushibox SET qty = $qty WHERE customerID = $customerid AND sushiID = $sushiid";

        $resultUser = mysqli_query($this->conn,  $updateMenuQuery) or die("Error: ".mysqli_error($this->conn));

        if ($resultUser == true) {
            return true;
        }else{
            // echo "Error in ".$resultUser." ".$this->conn->error;
            return false;
        }
    }

    public function deleteAlacarte($customerid, $sushiid){
        $deleteAlacarteQuery = "DELETE FROM alacartesushibox WHERE sushiID = $sushiid AND customerID = $customerid";

        $sql_alacartemenu = $this->conn->query($deleteAlacarteQuery);

		if ($sql_alacartemenu == true) {
            return true;
        }

        return false;
    }

    public function displayAllMenu(){
        $displayProductQuery = "SELECT * FROM sushi s";
        $result = $this->conn->query($displayProductQuery);

        $menuData = array();

        while($row = mysqli_fetch_array( $result)){
            $id = $row["sushiID"];
            $sushiname = $row["sushiName"];
            $sushiDesc = $row["sushiDesc"];
            $sushiPrice = $row["price"];
            $sushiimg = $row["sushiImg"];
            $availability = $row["availability"];

            if($availability == 1){
                $td_availability = "Available";
            }
            else{
                $td_availability = "Not Available";
            }

            $menuData[] = array(
                "id" => $id,
                "name" => $sushiname,
                "desc" =>  $sushiDesc,
                "price" => $sushiPrice,
                "img" => $sushiimg,
                "status" => $td_availability
            );
        }

        return $menuData;    
    }

    public function getMenu($menuid){
        $menuQuery = "SELECT * from sushi s WHERE s.sushiID = $menuid";

        $displayQuery = mysqli_query($this->conn, $menuQuery);

        $menuData = array();

        while($row = mysqli_fetch_array($displayQuery)){
            $id = $row["sushiID"];
            $sushiname = $row["sushiName"];
            $sushiDesc = $row["sushiDesc"];
            $sushiPrice = $row["price"];
            $sushiimg = $row["sushiImg"];
            $availability = $row["availability"];

            $menuData = array($id, $sushiname, $sushiDesc, $sushiPrice, $sushiimg, $availability);
            
        }

        return $menuData;
        
    }

    public function addMenu($name, $desc, $img, $price){

        $dateToday = date("Y-m-d");

        //Insert product detail in user table
        $insertProductQuery = "INSERT INTO sushi(sushiName, sushiDesc, sushiImg, price, dateAdded, availability)
        VALUES ('$name', '".mysqli_real_escape_string($this->conn, $desc)."', '$img', '$price', '$dateToday', '0')";
        $resultAdd = mysqli_query($this->conn,  $insertProductQuery) or die("Error: ".mysqli_error($this->conn));
       
        if ($resultAdd == true) {
            // echo "Success";
            return true;
        }else{
            echo "Error in ".$resultAdd." ".$this->conn->error;
            return false;
        }
        
    }

    public function deleteMenu($menuid){
        $delsushiQuery = "DELETE FROM sushi WHERE sushiID=$menuid";
        $deletemenu = $this->conn->query($delsushiQuery);

        if($deletemenu == true){
            return true;
        }else{
            return false;
        }
    }

    public function updateMenuImage($sushiid, $sushiimg){
        $updateSushiQuery = "UPDATE sushi SET sushiImg='$sushiimg' WHERE sushiID='$sushiid'";
        $resultUser = mysqli_query($this->conn,  $updateSushiQuery) or die("Error: ".mysqli_error($this->conn));

        if ($resultUser == true) {
            return true;
        }else{
            //echo "Error in ".$resultUser." ".$this->conn->error;
            return false;
        }
        
    }

    public function updateMenuDetail($sushiid, $sushiname, $sushidesc, $sushiprice, $status){
        $updateSushiQuery = "UPDATE sushi SET sushiName='$sushiname', sushiDesc='$sushidesc', price= $sushiprice, availability= $status WHERE sushiID='$sushiid'";
        $resultUser = mysqli_query($this->conn,  $updateSushiQuery) or die("Error: ".mysqli_error($this->conn));

        if ($resultUser == true) {
            return true;
        }else{
            echo "Error in ".$resultUser." ".$this->conn->error;
            return false;
        }
        
        
    }
}

?>