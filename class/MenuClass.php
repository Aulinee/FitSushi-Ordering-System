<?php 

class Menu{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function checkExistMenu($customerid, $sushiid) {
        $menuQuery = "SELECT * FROM alacartesushibox WHERE customerID = ? AND sushiID = ?";
        $stmt = $this->conn->prepare($menuQuery);
        $stmt->bind_param("ii", $customerid, $sushiid);
        $stmt->execute();
        $result = $stmt->get_result();
        $count = $result->num_rows;
    
        return $count == 1;
    }
    
    public function getTopMenu() {
        $menuQuery = "SELECT sushiName AS name, sushiImg AS image FROM sushi WHERE sushiImg IS NOT NULL AND availability != 0 LIMIT 5";
        $result = $this->conn->query($menuQuery);
    
        $menuData = array();
    
        while ($row = $result->fetch_assoc()) {
            $name = $row["name"];
            $image = $row["image"];
    
            $menuData[] = array(
                "name" => $name,
                "img" => $image,
            );
        }
    
        return $menuData;
    }
    
    public function getAlacarteMenuList() {
        $menuQuery = "SELECT sushiID AS id, sushiName AS name, sushiDesc AS `desc`, sushiImg AS img, price FROM sushi WHERE availability != 0";
        $result = $this->conn->query($menuQuery);
    
        $orderData = array();
    
        while ($row = $result->fetch_assoc()) {
            $id = $row["id"];
            $name = $row["name"];
            $desc = $row["desc"];
            $image = $row["img"];
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
    
    public function displayAlacarteSushibox($customerid) {
        $customerid = $this->conn->real_escape_string($customerid);
        $menuQuery = "SELECT s.sushiID, s.sushiName, s.price, a.qty FROM alacartesushibox a INNER JOIN sushi s ON a.sushiID = s.sushiID WHERE a.customerID = '$customerid'";
        $displayQuery = $this->conn->query($menuQuery);
    
        $sushiboxData = array();
    
        while ($row = $displayQuery->fetch_assoc()) {
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
                "total" => $totalprice
            );
        }
    
        return $sushiboxData;
    }

    public function addAlacarte($customerid, $sushiid, $qty) {
        $stmt = $this->conn->prepare("INSERT INTO alacartesushibox (customerID, sushiID, qty) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $customerid, $sushiid, $qty);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }    

    public function updateAlacarteQty($customerid, $sushiid, $qty) {
        $stmt = $this->conn->prepare("UPDATE alacartesushibox SET qty = ? WHERE customerID = ? AND sushiID = ?");
        $stmt->bind_param("iii", $qty, $customerid, $sushiid);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }    

    public function deleteAlacarte($customerid, $sushiid) {
        $stmt = $this->conn->prepare("DELETE FROM alacartesushibox WHERE sushiID = ? AND customerID = ?");
        $stmt->bind_param("ii", $sushiid, $customerid);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }    

    public function displayAllMenu() {
        $displayProductQuery = "SELECT * FROM sushi";
        $result = $this->conn->query($displayProductQuery);
    
        $menuData = array();
    
        while ($row = $result->fetch_assoc()) {
            $id = $row["sushiID"];
            $sushiname = $row["sushiName"];
            $sushiDesc = $row["sushiDesc"];
            $sushiPrice = $row["price"];
            $sushiimg = $row["sushiImg"];
            $availability = $row["availability"];
    
            $td_availability = $availability == 1 ? "Available" : "Not Available";
    
            $menuData[] = array(
                "id" => $id,
                "name" => $sushiname,
                "desc" => $sushiDesc,
                "price" => $sushiPrice,
                "img" => $sushiimg,
                "status" => $td_availability
            );
        }
    
        return $menuData;
    }    

    public function getMenu($menuid) {
        $stmt = $this->conn->prepare("SELECT * FROM sushi WHERE sushiID = ?");
        $stmt->bind_param("i", $menuid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    
        return $row;
    }
    
    public function addMenu($name, $desc, $img, $price) {
        $dateToday = date("Y-m-d");
        $stmt = $this->conn->prepare("INSERT INTO sushi (sushiName, sushiDesc, sushiImg, price, dateAdded, availability) VALUES (?, ?, ?, ?, ?, 0)");
        $stmt->bind_param("sssss", $name, $desc, $img, $price, $dateToday);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }

    public function deleteMenu($menuid) {
        $stmt = $this->conn->prepare("DELETE FROM sushi WHERE sushiID = ?");
        $stmt->bind_param("i", $menuid);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }
    
    public function updateMenuImage($sushiid, $sushiimg) {
        $stmt = $this->conn->prepare("UPDATE sushi SET sushiImg = ? WHERE sushiID = ?");
        $stmt->bind_param("si", $sushiimg, $sushiid);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }
    
    public function updateMenuDetail($sushiid, $sushiname, $sushidesc, $sushiprice, $status) {
        $stmt = $this->conn->prepare("UPDATE sushi SET sushiName = ?, sushiDesc = ?, price = ?, availability = ? WHERE sushiID = ?");
        $stmt->bind_param("sssii", $sushiname, $sushidesc, $sushiprice, $status, $sushiid);
        $result = $stmt->execute();
        $stmt->close();
    
        return $result;
    }
    
}

?>