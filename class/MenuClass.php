<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "fitsushi";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    
}

class Menu{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function displayMenu()
    {
        // $menuQuery = "SELECT sushiName, sushiImg FROM sushi LIMIT 5";
        $menuQuery = "SELECT s.sushiName AS name, s.sushiImg AS image from sushi s, sushicategory sc WHERE sc.categoryID = 1 AND s.sushiID=sc.sushiID AND s.sushiImg != 'NULL' LIMIT 5";
        $result = $this->conn->query($menuQuery);

        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_array($result)){
                    $name = $row["name"];
                    $image = $row["image"];

                    echo'
                        <div style="width: 1%;"></div>
                        <div style="display: flex; flex-direction: column; text-align: center; border: 1px solid var(--blue); width: 20%;">
                            <img style="margin: auto; width: 80%;" src="data:image/jpeg;base64,'.base64_encode( $image ).'" alt="'.$name.'"/>
                            <div style="background-color: var(--blue);">
                                <h1 style="font-size: 30px; color:white;">'.$name.'</h1>
                            </div>
                        </div>
                    ';
                }
            }else{
                echo "Record not found";
            }
        }else{
            echo "Error in ".$menuQuery." ".$this->conn->error;
        }
    }

    public function displayAlacarteMenu(){

        // $menuQuery = "SELECT sushiName, sushiImg FROM sushi LIMIT 5";
        $menuQuery = "SELECT * from sushi s, sushicategory sc WHERE sc.categoryID = 1 AND s.sushiID=sc.sushiID AND s.sushiImg != 'NULL'";
        $result = $this->conn->query($menuQuery);

        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_array($result)){
                    $id = $row["sushiID"];
                    $name = $row["sushiName"];
                    $desc = $row["sushiDesc"];
                    $image = $row["sushiImg"];
                    $price = $row["price"];

                    echo'
                    <div class="menu-col menu-card">
                        <div class="menu-row">
                            <div class="menu-display-table">
                                <img class="menu-img" src="data:image/jpeg;base64,'.base64_encode( $image ).'" alt="'.$name.'"/>
                                <div class="details">
                                    <h2 class="detail-title margin-0">'.$name.'</h2>
                                    <h5 class="details-title-desc margin-0">'.$desc.'</h5>
                                    <h1 class="details-title-price margin-0">RM '.$price.'</h1>
                                </div>
                                <form class="input-menu menu-row" name="menu" action="addAlacarte-page.php?id='.$id.'" method="post">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement(\''.$id.'\')">-</h5>
                                        <input id="'.$id.'" name="'.$id.'" type=number min=0 max=110>
                                        <h5 class="plus-btn" onclick="increment(\''.$id.'\')">+</h5>
                                    </div>
                                    <button class="cart" type="submit"><i class="fa fa-shopping-cart"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    ';
                }
            }else{
                echo "Record not found";
            }
        }else{
            echo "Error in ".$menuQuery." ".$this->conn->error;
        }
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


    public function displayAlacarteSushibox(){
        $menuQuery = "SELECT s.sushiID AS sushiid ,s.sushiName AS sushiname, s.price AS sushiprice, a.qty AS sushiqty FROM alacartesushibox a, sushi s WHERE a.sushiID = s.sushiID";

        $result = $this->conn->query($menuQuery);

        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_array($result)){
                    $id = $row["sushiid"];
                    $name = $row["sushiname"];
                    $unitprice = $row["sushiprice"];
                    $qty = $row["sushiqty"];
                    $totalprice = $qty * $unitprice;
                    echo'
                        <tr>
                            <th class="info-20" style="text-align: left;">
                                <label class="sushi-container">
                                    <input type="checkbox" value="'.$id.'" name="sushibox[]" onclick="totalIt(\''.$name.'\')" disabled>
                                    <input type="hidden" name="sushilist[]" value="'.$id.'" /> 
                                    <span style="opacity: 0.7; border:none;" class="checkmark"></span>
                                    <label class="">'.$name.'</label>
                                </label>
                            </th>
                            <th class="info-20">
                                <div class="sushi-list-input menu-row fit-width">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement(\''.$name.'\')">-</h5>
                                        <input id="'.$name.'" name="sushiqty[]" type=number min=1 value="'.$qty.'" readonly="readonly">
                                        <h5 class="plus-btn" onclick="increment(\''.$name.'\')">+</h5>
                                    </div>
                                </div>
                            </th>
                            <th class="info-20"><input class="none-outline" type="text" name="'.$name.'" id="unit-price-'.$name.'" value="'.$unitprice.'" readonly="readonly"></th>
                            <th class="info-20"> <input class="none-outline" name="sushitotal" id="total-price-'.$name.'" type="number" value="'.$totalprice.'" onclick="totalIt(\''.$name.'\')" readonly="readonly"></th>
                            <th class="info-20"><a href="deleteAlacarte-page.php?id='.$id.'" style="color: #c1273a;">DELETE</a></th>
                        </tr>
                    ';
                }
            }else{
                echo "Record not found";
            }
        }else{
            echo "Error in ".$menuQuery." ".$this->conn->error;
        }

    }
        
    
}

?>