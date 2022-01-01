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
        $result = mysqli_query($this->conn, $deliveryQuery);

        $orderData = array();
        while($rowoption = mysqli_fetch_array($result)){
            $id = $rowoption["deliveryID"];
            $name = $rowoption["deliveryOption"];

            $orderData[] = array(
                "id" => $id,
                "name" => $name,
            );
        }

        return $orderData;

    }

    public function displayAllCustOrder($orderstatusid){
        $displayCustOrderQuery = "SELECT
                                o.orderID, o.dateCreated, c.custName, c.deliveryAddress, o.deliverydateTime, d.deliveryOption, p.paymentMethod, s.statusName, o.orderTotal
                              FROM orders o, customer c, delivery d, payment p, orderstatus s
                              WHERE
                                o.customerID = c.customerID AND o.orderStatusID = s.statusID AND o.deliveryID = d.deliveryID AND o.paymentID = p.paymentID AND o.orderStatusID=$orderstatusid";

        $result = $this->conn->query($displayCustOrderQuery);

        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_array($result)){
                    $id = $row["orderID"];
                    $dateCreated = $row["dateCreated"];
                    $custname = $row["custName"];
                    $address = $row["deliveryAddress"];
                    $deliverydate = $row["deliverydateTime"];
                    $deliveryOption = $row["deliveryOption"];
                    $paymentMethod = $row["paymentMethod"];
                    $status = $row["statusName"];
                    $total = $row["orderTotal"];

                    echo '<tr>';

                    if ($orderstatusid == 4){

                        echo '<td>'.$id.'</td>
                            <td>'.$dateCreated.'</td>
                            <td>'.$custname.'</td>
                            <td>'.$address.'</td>
                            <td>'.$deliveryOption.'</td>
                            <td>'.$paymentMethod.'</td>
                            <td>'.$status.'</td>
                            <td>'.$total.'</td>
                            <td>
                                <form  method="POST" action="../Admin-Folder/editCust_page.php">
                                    <button class="button" id='.$id.' value='.$id.' type="submit" name="order_delivered" title="Order ID: '.$id.'"><i class="fa fa-check"></i></button>
                                    <button class="button" id='.$id.' value='.$id.' type="submit" name="order_cancelled" title="Order ID: '.$id.'"><i class="fa fa-trash"></i></button>
                                </form>                                    
                            </td>';
                    }else{

                        echo '<td>'.$id.'</td>
                            <td>'.$dateCreated.'</td>
                            <td>'.$custname.'</td>
                            <td>'.$address.'</td>
                            <td>'.$deliverydate.'</td>
                            <td>'.$deliveryOption.'</td>
                            <td>'.$paymentMethod.'</td>
                            <td>'.$status.'</td>
                            <td>'.$total.'</td>
                            <td>
                                <form  method="POST" action="../Admin-Folder/editCust_page.php">
                                    <button class="button" id='.$id.' value='.$id.' type="submit" name="order_Received" title="Order ID: '.$id.'"><i class="fa fa-check"></i></button>
                                    <button class="button" id='.$id.' value='.$id.' type="submit" name="order_cancelled" title="Order ID: '.$id.'"><i class="fa fa-trash"></i></button>
                                </form>                                    
                            </td>';
                    }
                    echo '</tr>';
                    
                    
                }
            }else{
                echo "Record not found";
            }
        }
        else{
            echo "Error in ".$displayCustOrderQuery." ".$this->conn->error;
        }
    }  
    
    public function displayAllTransaction(){
        $displayTransactionQuery = "SELECT paymentID, orderID, dateCreated, orderTotal FROM orders";

        $result = $this->conn->query($displayTransactionQuery);

        if($result){
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_array($result)){
                    $paymentid = $row["paymentID"];
                    $orderid = $row["orderID"];
                    $dateCreated = $row["dateCreated"];
                    $orderTotal = $row["orderTotal"];

                    echo '
                    <div>
                        <tr>
                            <td>'.$paymentid.'</td>
                            <td>'.$orderid.'</td>
                            <td>'.$dateCreated.'</td>
                            <td>'.$orderTotal.'</td>
                        </tr>
                    </div>
                    ';
                }
            }else{
                echo "Record not found";
            }
        }
        else{
            echo "Error in ".$displayTransactionQuery." ".$this->conn->error;
        }
    }      

    public function getPaymentOptionList(){
        $paymentQuery = "SELECT * from payment";
        $result = mysqli_query($this->conn, $paymentQuery);

        $orderData = array();
        while($rowoption = mysqli_fetch_array($result)){
            $id = $rowoption["paymentID"];
            $name = $rowoption["paymentMethod"];

            $orderData[] = array(
                "id" => $id,
                "name" => $name,
            );
        }

        return $orderData;
        
    }

    public function getAllOrderData($customerid){
        $stringQuery = "SELECT  o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal FROM orders o, payment p, orderstatus s, delivery d WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID AND o.customerID = $customerid";
        $displayQuery = mysqli_query($this->conn, $stringQuery);

        $customerid = $orderid = 0;
        $orderData = array();

        while($roworder = mysqli_fetch_array($displayQuery)){
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

    public function getPendingOrderData($customerid){
        $stringQuery = "SELECT  o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal FROM orders o, payment p, orderstatus s, delivery d WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID AND o.orderStatusID = 4 AND o.customerID = $customerid";
        $displayQuery = mysqli_query($this->conn, $stringQuery);

        $customerid = $orderid = 0;
        $orderData = array();

        while($roworder = mysqli_fetch_array($displayQuery)){
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

    public function getDeliveryOrderData($customerid){
        $stringQuery = "SELECT  o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal FROM orders o, payment p, orderstatus s, delivery d WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID AND o.orderStatusID = 1 AND o.customerID = $customerid";
        $displayQuery = mysqli_query($this->conn, $stringQuery);

        $customerid = $orderid = 0;
        $orderData = array();

        while($roworder = mysqli_fetch_array($displayQuery)){
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

    public function getCompleteOrderData($customerid){
        $stringQuery = "SELECT  o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal FROM orders o, payment p, orderstatus s, delivery d WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID AND o.orderStatusID = 2 AND o.customerID = $customerid";
        $displayQuery = mysqli_query($this->conn, $stringQuery);

        $customerid = $orderid = 0;
        $orderData = array();

        while($roworder = mysqli_fetch_array($displayQuery)){
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

    public function getCancelOrderData($customerid){
        $stringQuery = "SELECT  o.orderID, o.customerID, s.statusName, o.dateCreated, d.deliveryOption, o.deliverydateTime, p.paymentMethod, o.orderTotal FROM orders o, payment p, orderstatus s, delivery d WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID AND o.orderStatusID = 3 AND o.customerID = $customerid";
        $displayQuery = mysqli_query($this->conn, $stringQuery);

        $customerid = $orderid = 0;
        $orderData = array();

        while($roworder = mysqli_fetch_array($displayQuery)){
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

    public function buyAgainOrder($prev_orderid, $customerid, $deliveryid, $paymentid, $ordertotal){
        $orderid = 0; //initialize value 
        //Insert order created date 
        date_default_timezone_set("Asia/Kuala_Lumpur"); //set time region
        $current_time = date('Y-m-d', time());

        //Set order status to 4 for pending order status
        $orderstatus = 4;

        // add into order table
        $stringQuery = "INSERT INTO orders(customerID, orderStatusID, dateCreated, deliveryID, deliverydateTime, paymentID, orderTotal) 
                        VALUES ($customerid, $orderstatus, '$current_time', $deliveryid, 'NULL', $paymentid, $ordertotal)";

        $sqlQuery = $this->conn->query($stringQuery);
        if ($sqlQuery == true) {
            //This will return auto_increment order id 
            $last_id = $this->conn->insert_id;
            $orderid = $last_id;

            $prev_order_array = $this->getAlacarteOrder($customerid, $prev_orderid);

            foreach($prev_order_array as $array){
                $this->addAlacarteOrder($orderid, $array["sushiid"], $array['qty']);
            }

            return true;
        }else{
            // echo "Error in ". $sqlQuery." ".$this->conn->error;
            return false;
        }
    }

    public function getOrderData($customerid, $orderid){
        $stringQuery = "SELECT  o.orderID,c.custName, c.phoneNo , c.deliveryAddress, a.PostalCode, a.State, a.Area, a.Country, o.dateCreated, d.deliveryOption, p.paymentMethod, o.orderTotal FROM customer c, address a, orders o, payment p, orderstatus s, delivery d WHERE o.orderStatusID = s.statusID AND o.paymentID = p.paymentID AND o.deliveryID = d.deliveryID AND o.orderID = $orderid AND o.customerID = $customerid AND c.customerID = o.customerID AND c.PostalCode = a.PostalCode";
        $displayQuery = mysqli_query($this->conn, $stringQuery);

        $customerid = $orderid = 0;
        $orderData = array();

        while($roworder = mysqli_fetch_array($displayQuery)){
            $orderid = $roworder['orderID'];
            $customername = $roworder['custName'];
            $phoneno = $roworder['phoneNo'];
            $address = $roworder["deliveryAddress"].", ".$roworder['PostalCode'].' '.$roworder['Area'].', '.$roworder['State'].', '.$roworder['Country'];
            $datecreate = $roworder['dateCreated'];
            $deliveryopt = $roworder['deliveryOption'];
            $paymentmethod = $roworder['paymentMethod'];
            $ordertotal = $roworder['orderTotal'];

            $orderData = array($orderid, $customername, $phoneno, $address, $datecreate, $deliveryopt ,$paymentmethod, $ordertotal);
        }

        return $orderData;

    }

    public function getAlacarteOrder($customerid, $orderid){
        $stringQuery = "SELECT a.sushiID, s.sushiName, s.sushiDesc, s.sushiImg, s.price, a.qty FROM orders o, alacarteorder a, sushi s WHERE $orderid = o.orderID AND o.orderID = a.orderID AND a.sushiID = s.sushiID AND o.customerID = $customerid";
        $displayQuery = mysqli_query($this->conn, $stringQuery);

        $orderData = array();
        while($roworder = mysqli_fetch_array($displayQuery)){
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

    public function addAlacarteOrder($orderid, $sushiid, $qty){
        // add into alacarteorder table
        $stringQuery = "INSERT INTO alacarteorder(orderID, sushiID, qty) VALUES ($orderid, $sushiid, $qty)";

        $sqlQuery = $this->conn->query($stringQuery);
        if ($sqlQuery == true) {
            //echo "Successful update query";
            return true;
        }else{
            return false;
            // echo "Error in ". $sqlQuery." ".$this->conn->error;
            //echo "Unsuccessful update query. try again!";
        }
    }

    public function deleteAlacarteOrder($customerid, $sushiid){
        $deleteAlacarteQuery = "DELETE FROM alacarteorder WHERE sushiID = $sushiid AND customerID = $customerid";

        $sql_alacartemenu = $this->conn->query($deleteAlacarteQuery);

		if ($sql_alacartemenu == true) {
            return true;
        }

        return false;
    }

    public function makeOrder($sushiid, $sushiqty, $customerid, $deliveryid, $paymentid, $ordertotal){
        $orderid = 0; //initialize value 
        //Insert order created date 
        date_default_timezone_set("Asia/Kuala_Lumpur"); //set time region
        $current_time = date('Y-m-d', time());

        //Set order status to 4 for pending order status
        $orderstatus = 4;

        // add into order table
        $stringQuery = "INSERT INTO orders(customerID, orderStatusID, dateCreated, deliveryID, paymentID, orderTotal) 
                        VALUES ($customerid, $orderstatus, '$current_time', $deliveryid, $paymentid, $ordertotal)";

        $sqlQuery = $this->conn->query($stringQuery);
        if ($sqlQuery == true) {
            //This will return auto_increment order id 
            $last_id = $this->conn->insert_id;
            $orderid = $last_id;

            //inserted multiple sushi piece order
            foreach (array_combine($sushiid, $sushiqty) as $sushiid => $sushiqty) {
                $this->addAlacarteOrder($orderid, $sushiid, $sushiqty);

                 //delete sushi list from sushibox
                 $this->clearSushibox($customerid, $sushiid);
            }

            return $orderid;
        }else{
            // echo "Error in ". $sqlQuery." ".$this->conn->error;
            return false;
        }
    }

    // literally delete order func yuhh
    // public function cancelOrder($customerid, $orderid){
    //     $deleteAlacarteQuery = "DELETE FROM orders WHERE orderID = $orderid AND customerID = $customerid";

    //     $sql_alacartemenu = $this->conn->query($deleteAlacarteQuery);

	// 	if ($sql_alacartemenu == true) {
    //         $this->deleteAlacarteOrder($customerid, $orderid);
    //         return true;
    //     }

    //     return false;
    // }


    public function clearSushibox($customerid, $sushiid){
        $deleteAlacarteQuery = "DELETE FROM alacartesushibox WHERE sushiID = $sushiid AND customerID = $customerid";

        $sql_alacartemenu = $this->conn->query($deleteAlacarteQuery);

		if ($sql_alacartemenu == true) {
            return true;
        }

        return false;
    }

    public function editOrderStatus($customerid, $orderid, $orderstatusid){
        $updateQuery = "UPDATE orders SET orderStatusID = $orderstatusid WHERE customerID = $customerid AND orderID = $orderid";
        $result = mysqli_query($this->conn,  $updateQuery) or die("Error: ".mysqli_error($this->conn));

        if ($result == true) {
            return true;
        }else{
            // echo "Error in ".$result." ".$this->conn->error;
            return false;
        }

    }

    public function editDeliveryTime($customerid, $orderid, $deliverytime){
        $updateQuery = "UPDATE orders SET deliveryDateTime = '$deliverytime' WHERE customerID = $customerid AND orderID = $orderid";
        $result = mysqli_query($this->conn,  $updateQuery) or die("Error: ".mysqli_error($this->conn));

        if ($result == true) {
            return true;
        }else{
            // echo "Error in ".$result." ".$this->conn->error;
            return false;
        }
        
    }

}

?>