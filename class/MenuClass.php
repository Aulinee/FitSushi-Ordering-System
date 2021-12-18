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
                                <form class="input-menu menu-row" name="menu" action="main-page.php" method="post">
                                    <div class="input-btn menu-row">
                                        <h5 class="minus-btn" onclick="decrement(\''.$name.'\')">-</h5>
                                        <input id="'.$name.'" name="'.$name.'" type=number min=0 max=110>
                                        <h5 class="plus-btn" onclick="increment(\''.$name.'\')">+</h5>
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
}

?>