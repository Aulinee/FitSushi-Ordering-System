<?php 
// include '../database/dbConnection.php'; 

class Order{
    /* Constructor */
	public function __construct($DB_con)
	{
        $this->conn = $DB_con;
	}

    public function getDeliveryOptionList() {
        $deliveryQuery = "SELECT * FROM delivery";
        $result = $this->conn->query($deliveryQuery);
    
        $orderData = array();
        while ($rowoption = mysqli_fetch_array($result)) {
            $id = $rowoption["deliveryID"];
            $name = $rowoption["deliveryOption"];
    
            $orderData[] = array(
                "id" => $id,
                "name" => $name,
            );
        }
    
        return $orderData;
    }
    
    public function displayAllCustOrder($orderstatusid) {
        $displayCustOrderQuery = "SELECT o.orderID, o.dateCreated, c.custName, c.deliveryAddress, a.PostalCode, a.State, a.Area, a.Country, o.deliverydateTime, d.deliveryOption, p.paymentMethod, s.statusName, o.orderTotal
                                  FROM orders o
                                  INNER JOIN customer c ON o.customerID = c.customerID
                                  INNER JOIN delivery d ON o.deliveryID = d.deliveryID
                                  INNER JOIN payment p ON o.paymentID = p.paymentID
                                  INNER JOIN orderstatus s ON o.orderStatusID = s.statusID
                                  INNER JOIN address a ON c.PostalCode = a.PostalCodeID
                                  WHERE o.orderStatusID = ?";
        $stmt = $this->conn->prepare($displayCustOrderQuery);
        $stmt->bind_param("i", $orderstatusid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        $orderData = array();
        while ($roworder = mysqli_fetch_array($result)) {
            $orderid = $roworder['orderID'];
            $datecreate = $roworder['dateCreated'];
            $customername = $roworder['custName'];
            $address = $roworder["deliveryAddress"] . ", " . $roworder['PostalCode'] . ' ' . $roworder['Area'] . ', ' . $roworder['State'] . ', ' . $roworder['Country'];
            $deliverydate = $roworder["deliverydateTime"];
            $deliveryopt = $roworder['deliveryOption'];
            $paymentmethod = $roworder['paymentMethod'];
            $status = $roworder["statusName"];
            $ordertotal = $roworder['orderTotal'];
    
            $orderData[] = array(
                "id" => $orderid,
                "datecreate" => $datecreate,
                "custname" => $customername,
                "address" => $address,
                "deliverydate" => $deliverydate,
                "deliveryopt" => $deliveryopt,
                "paymentmethod" => $paymentmethod,
                "status" => $status,
                "ordertotal" => $ordertotal
            );
        }
    
        return $orderData;
    }    

    public function getPaymentOptionList() {
        $paymentQuery = "SELECT * FROM payment";
        $result = $this->conn->query($paymentQuery);
    
        $orderData = array();
        while ($rowoption = mysqli_fetch_array($result)) {
            $id = $rowoption["paymentID"];
            $name = $rowoption["paymentMethod"];
    
            $orderData[] = array(
                "id" => $id,
                "name" => $name,
            );
        }
    
        return $orderData;
    }
    
    public function getAllOrderData($customerid) {
        $stringQuery = "SELECT o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal
                        FROM orders o
                        INNER JOIN payment p ON o.paymentID = p.paymentID
                        INNER JOIN orderstatus s ON o.orderStatusID = s.statusID
                        INNER JOIN delivery d ON o.deliveryID = d.deliveryID
                        WHERE o.customerID = ?";
        $stmt = $this->conn->prepare($stringQuery);
        $stmt->bind_param("i", $customerid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        $orderData = array();
        while ($roworder = mysqli_fetch_array($result)) {
            $orderid = $roworder['orderID'];
            $customerid = $roworder['customerID'];
            $statusname = $roworder['statusName'];
            $datecreate = $roworder['dateCreated'];
            $deliveryopt = $roworder['deliveryOption'];
            $paymentmethod = $roworder['paymentMethod'];
            $ordertotal = $roworder['orderTotal'];
    
            $orderData[] = array(
                "orderid" => $orderid,
                "cusid" => $customerid,
                "status" => $statusname,
                "datecreate" => $datecreate,
                "deliveryopt" => $deliveryopt,
                "paymentmethod" => $paymentmethod,
                "ordertotal" => $ordertotal
            );
        }
    
        return $orderData;
    }
    
    public function getPendingOrderData($customerid) {
        $stringQuery = "SELECT o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal
                        FROM orders o
                        INNER JOIN payment p ON o.paymentID = p.paymentID
                        INNER JOIN orderstatus s ON o.orderStatusID = s.statusID
                        INNER JOIN delivery d ON o.deliveryID = d.deliveryID
                        WHERE o.orderStatusID = 4 AND o.customerID = ?";
        $stmt = $this->conn->prepare($stringQuery);
        $stmt->bind_param("i", $customerid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        $orderData = array();
        while ($roworder = mysqli_fetch_array($result)) {
            $orderid = $roworder['orderID'];
            $customerid = $roworder['customerID'];
            $statusname = $roworder['statusName'];
            $datecreate = $roworder['dateCreated'];
            $deliveryopt = $roworder['deliveryOption'];
            $paymentmethod = $roworder['paymentMethod'];
            $ordertotal = $roworder['orderTotal'];
    
            $orderData[] = array(
                "orderid" => $orderid,
                "cusid" => $customerid,
                "status" => $statusname,
                "datecreate" => $datecreate,
                "deliveryopt" => $deliveryopt,
                "paymentmethod" => $paymentmethod,
                "ordertotal" => $ordertotal
            );
        }
    
        return $orderData;
    }
    
    public function getDeliveryOrderData($customerid) {
        $stringQuery = "SELECT o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal
                        FROM orders o
                        INNER JOIN payment p ON o.paymentID = p.paymentID
                        INNER JOIN orderstatus s ON o.orderStatusID = s.statusID
                        INNER JOIN delivery d ON o.deliveryID = d.deliveryID
                        WHERE o.orderStatusID = 1 AND o.customerID = ?";
        $stmt = $this->conn->prepare($stringQuery);
        $stmt->bind_param("i", $customerid);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
    
        $orderData = array();
        while ($roworder = mysqli_fetch_array($result)) {
            $orderid = $roworder['orderID'];
            $customerid = $roworder['customerID'];
            $statusname = $roworder['statusName'];
            $datecreate = $roworder['dateCreated'];
            $deliveryopt = $roworder['deliveryOption'];
            $deliverydatetime = $roworder['deliverydateTime'];
            $paymentmethod = $roworder['paymentMethod'];
            $ordertotal = $roworder['orderTotal'];
    
            $orderData[] = array(
                "orderid" => $orderid,
                "cusid" => $customerid,
                "status" => $statusname,
                "datecreate" => $datecreate,
                "deliveryopt" => $deliveryopt,
                "deliverydate" => $deliverydatetime,
                "paymentmethod" => $paymentmethod,
                "ordertotal" => $ordertotal
            );
        }
    
        return $orderData;
    }

    public function getCompleteOrderData($customerid) {
        $stringQuery = "SELECT o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal 
                        FROM orders o, payment p, orderstatus s, delivery d 
                        WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID 
                        AND o.orderStatusID = 2 AND o.customerID = ?";
    
        $statement = $this->conn->prepare($stringQuery);
        $statement->bind_param("i", $customerid);
        $statement->execute();
        $result = $statement->get_result();
    
        $orderData = array();
    
        while ($roworder = $result->fetch_assoc()) {
            $orderid = $roworder['orderID'];
            $customerid = $roworder['customerID'];
            $statusname = $roworder['statusName'];
            $datecreate = $roworder['dateCreated'];
            $deliveryopt = $roworder['deliveryOption'];
            $deliverydatetime = $roworder['deliverydateTime'];
            $paymentmethod = $roworder['paymentMethod'];
            $ordertotal = $roworder['orderTotal'];
    
            $orderData[] = array(
                "orderid" => $orderid, 
                "cusid" => $customerid, 
                "status" => $statusname, 
                "datecreate" => $datecreate, 
                "deliveryopt" => $deliveryopt,
                "deliverydate" => $deliverydatetime,
                "paymentmethod" => $paymentmethod,
                "ordertotal" => $ordertotal
            );
        }
    
        return $orderData;
    }    
    
    public function getCancelOrderData($customerid) {
        $stringQuery = "SELECT o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal 
                        FROM orders o, payment p, orderstatus s, delivery d 
                        WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID 
                        AND o.orderStatusID = 3 AND o.customerID = ?";
    
        $statement = $this->conn->prepare($stringQuery);
        $statement->bind_param("i", $customerid);
        $statement->execute();
        $result = $statement->get_result();
    
        $orderData = array();
    
        while ($roworder = $result->fetch_assoc()) {
            $orderid = $roworder['orderID'];
            $customerid = $roworder['customerID'];
            $statusname = $roworder['statusName'];
            $datecreate = $roworder['dateCreated'];
            $deliveryopt = $roworder['deliveryOption'];
            $deliverydatetime = $roworder['deliverydateTime'];
            $paymentmethod = $roworder['paymentMethod'];
            $ordertotal = $roworder['orderTotal'];
    
            $orderData[] = array(
                "orderid" => $orderid, 
                "cusid" => $customerid, 
                "status" => $statusname, 
                "datecreate" => $datecreate, 
                "deliveryopt" => $deliveryopt,
                "deliverydate" => $deliverydatetime,
                "paymentmethod" => $paymentmethod,
                "ordertotal" => $ordertotal
            );
        }
    
        return $orderData;
    }    
    
    public function buyAgainOrder($prev_orderid, $customerid, $deliveryid, $paymentid, $ordertotal) {
        $orderid = 0; // Initialize value 
        
        // Insert order created date 
        date_default_timezone_set("Asia/Kuala_Lumpur"); // Set time region
        $current_time = date('Y-m-d', time());
    
        // Set order status to 4 for pending order status
        $orderstatus = 4;
    
        // Add into order table
        $stringQuery = "INSERT INTO orders(customerID, orderStatusID, dateCreated, deliveryID, deliverydateTime, paymentID, orderTotal) 
                        VALUES (?, ?, ?, ?, NULL, ?, ?)";
    
        $statement = $this->conn->prepare($stringQuery);
        $statement->bind_param("iiisi", $customerid, $orderstatus, $current_time, $deliveryid, $paymentid, $ordertotal);
        $result = $statement->execute();
    
        if ($result == true) {
            // This will return auto_increment order id 
            $last_id = $this->conn->insert_id;
            $orderid = $last_id;
    
            $prev_order_array = $this->getAlacarteOrder($customerid, $prev_orderid);
    
            foreach ($prev_order_array as $array) {
                $this->addAlacarteOrder($orderid, $array["sushiid"], $array['qty']);
            }
    
            return true;
        } else {
            return false;
        }
    }
    
    public function getOrderData($customerid, $orderid) {
        $stringQuery = "SELECT o.orderID, c.custName, c.phoneNo, c.deliveryAddress, a.PostalCode, a.State, a.Area, a.Country, o.dateCreated, d.deliveryOption, p.paymentMethod, o.orderTotal 
                        FROM customer c, address a, orders o, payment p, orderstatus s, delivery d 
                        WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID 
                        AND o.orderID = ? AND o.customerID = ? 
                        AND c.customerID = o.customerID AND c.PostalCode = a.PostalCodeID";
    
        $statement = $this->conn->prepare($stringQuery);
        $statement->bind_param("ii", $orderid, $customerid);
        $statement->execute();
        $result = $statement->get_result();
    
        $orderData = array();
    
        while ($roworder = $result->fetch_assoc()) {
            $orderid = $roworder['orderID'];
            $customername = $roworder['custName'];
            $phoneno = $roworder['phoneNo'];
            $address = $roworder["deliveryAddress"].", ".$roworder['PostalCode'].' '.$roworder['Area'].', '.$roworder['State'].', '.$roworder['Country'];
            $datecreate = $roworder['dateCreated'];
            $deliveryopt = $roworder['deliveryOption'];
            $paymentmethod = $roworder['paymentMethod'];
            $ordertotal = $roworder['orderTotal'];
    
            $orderData = array($orderid, $customername, $phoneno, $address, $datecreate, $deliveryopt, $paymentmethod, $ordertotal);
        }
    
        return $orderData;
    }    
    
    public function getAlacarteOrder($customerid, $orderid) {
        $stringQuery = "SELECT a.sushiID, s.sushiName, s.sushiDesc, s.sushiImg, s.price, a.qty 
                        FROM orders o, alacarteorder a, sushi s 
                        WHERE o.orderID = ? AND o.orderID = a.orderID AND a.sushiID = s.sushiID AND o.customerID = ?";
        
        $statement = $this->conn->prepare($stringQuery);
        $statement->bind_param("ii", $orderid, $customerid);
        $statement->execute();
        $result = $statement->get_result();
        
        $orderData = array();
        
        while ($roworder = $result->fetch_assoc()) {
            $sushiid = $roworder['sushiID'];
            $sushiname = $roworder['sushiName'];
            $sushidesc = $roworder['sushiDesc'];
            $sushiimg = $roworder['sushiImg'];
            $sushiprice = $roworder['price'];
            $sushiqty = $roworder['qty'];
        
            $orderData[] = array(
                "sushiid" => $sushiid, 
                "name" => $sushiname, 
                "desc" => $sushidesc, 
                "img" => $sushiimg, 
                "price" => $sushiprice, 
                "qty" => $sushiqty
            );
        }
        
        return $orderData;
    }
    
    public function addAlacarteOrder($orderid, $sushiid, $qty) {
        // Add into alacarteorder table
        $insertQuery = "INSERT INTO alacarteorder(orderID, sushiID, qty) VALUES (?, ?, ?)";
        
        $statement = $this->conn->prepare($insertQuery);
        $statement->bind_param("iii", $orderid, $sushiid, $qty);
        $result = $statement->execute();
        
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteAlacarteOrder($customerid, $sushiid) {
        $deleteQuery = "DELETE FROM alacarteorder WHERE sushiID = ? AND customerID = ?";
        
        $statement = $this->conn->prepare($deleteQuery);
        $statement->bind_param("ii", $sushiid, $customerid);
        $result = $statement->execute();
        
        if ($result == true) {
            return true;
        }
        
        return false;
    }    

    public function makeOrder($sushiid, $sushiqty, $customerid, $deliveryid, $paymentid, $ordertotal) {
        $orderid = 0; // initialize value 
        // Insert order created date 
        date_default_timezone_set("Asia/Kuala_Lumpur"); // set time region
        $current_time = date('Y-m-d'); // Format the date as 'YYYY-MM-DD'
    
        // Set order status to 4 for pending order status
        $orderstatus = 4;
    
        // Add into order table
        $insertQuery = "INSERT INTO orders(customerID, orderStatusID, dateCreated, deliveryID, paymentID, orderTotal) 
                        VALUES (?, ?, ?, ?, ?, ?)";
    
        $statement = $this->conn->prepare($insertQuery);
        $statement->bind_param("iiisid", $customerid, $orderstatus, $current_time, $deliveryid, $paymentid, $ordertotal);
        $result = $statement->execute();
    
        if ($result == true) {
            // This will return auto_increment order id 
            $orderid = $statement->insert_id;
    
            // Insert multiple sushi piece orders
            foreach (array_combine($sushiid, $sushiqty) as $sushiid => $sushiqty) {
                $this->addAlacarteOrder($orderid, $sushiid, $sushiqty);
    
                // Delete sushi list from sushibox
                $this->clearSushibox($customerid, $sushiid);
            }
    
            return $orderid;
        } else {
            return false;
        }
    }

    public function insertCardDetail($orderid, $cardNum, $cardHolder, $cardExp, $cardCVV){
        // Add into order table
        $insertQuery = "INSERT INTO cardpayment(orderID, cardNumber, cardHolder, cardExpirationDate, cardCVV) 
                        VALUES (?, ?, ?, ?, ?)";
    
        $statement = $this->conn->prepare($insertQuery);
        $statement->bind_param("issss", $orderid, $cardNum, $cardHolder, $cardExp, $cardCVV);
        $result = $statement->execute();

        if ($result == true) {
            return true;
        }
    
        return false;
    }
    
    public function clearSushibox($customerid, $sushiid) {
        $deleteQuery = "DELETE FROM alacartesushibox WHERE sushiID = ? AND customerID = ?";
    
        $statement = $this->conn->prepare($deleteQuery);
        $statement->bind_param("ii", $sushiid, $customerid);
        $result = $statement->execute();
    
        if ($result == true) {
            return true;
        }
    
        return false;
    }       

    public function editOrderStatus($customerid, $orderid, $orderstatusid) {
        $updateQuery = "UPDATE orders SET orderStatusID = ? WHERE customerID = ? AND orderID = ?";
        $statement = $this->conn->prepare($updateQuery);
        $statement->bind_param("iii", $orderstatusid, $customerid, $orderid);
        $result = $statement->execute();
    
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }
    
    public function changeOrderStatus($orderid, $orderstatusid) {
        $updateQuery = "UPDATE orders SET orderStatusID = ?, deliverydateTime = CURRENT_TIMESTAMP WHERE orderID = ?";
        $statement = $this->conn->prepare($updateQuery);
        $statement->bind_param("ii", $orderstatusid, $orderid);
        $result = $statement->execute();
    
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }
    
    public function editDeliveryTime($customerid, $orderid, $deliverytime) {
        $updateQuery = "UPDATE orders SET deliveryDateTime = ? WHERE customerID = ? AND orderID = ?";
        $statement = $this->conn->prepare($updateQuery);
        $statement->bind_param("sii", $deliverytime, $customerid, $orderid);
        $result = $statement->execute();
    
        if ($result == true) {
            return true;
        } else {
            return false;
        }
    }
    

}

?>