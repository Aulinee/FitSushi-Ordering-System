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
        $menuQuery = "SELECT sushiName, sushiImg FROM sushi LIMIT 5";
        $result = $this->conn->query($menuQuery);

        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_array($result)){
                    $name = $row["sushiName"];
                    $image = $row["sushiImg"];

                    echo'
                        <div style="width: 1%;"></div>
                        <div style="display: flex; flex-direction: column; text-align: center; border: 1px solid var(--blue); width: 20%;">
                            <img style="margin: auto; width: 80%;" src="data:image/jpeg;base64,'.base64_encode( $image ).' alt="tv-series""/>
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
}

?>