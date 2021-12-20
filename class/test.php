<?php 
include '../database/dbConnection.php'; 
include 'UserClass.php';
include 'AdminClass.php';
include 'MenuClass.php';
include 'OrderClass.php';
$userObj = new User($conn);
$adminObj = new Admin($conn);
$menuObj = new Menu($conn);
$orderObj = new Order($conn);

$myarray = $orderObj->getAlacarteOrder(2, 22);
$delivery = $orderObj->getDeliveryOptionList();
// $myarray = $orderObj->getOrderData(2,4);

// var_dump($myarray);

// $subtotal = 0;
// foreach($myarray as $array) {
//     echo $array["name"]. " ".$array["desc"]." ".$array["qty"]." ".$array["price"]."\n"; 
//     $subtotal += ($array["qty"] * $array["price"]);
// }

// echo "<br>".$subtotal;

// foreach($delivery as $array) {
//     echo $array["id"]. " ".$array["name"]; 
// }

// $id= $orderObj->makeOrder(array(1,2),array(2,2),2, 1, 1, 69.90);
// echo $id;

// $userObj->checkExistUsername("kiannyp");

// $userObj->signUp('Aulinee', 'Audrey Duyan', 'audrey@gmail.com', 'Ass123-', '01114095674', 'female', 'Lot 6647, Kampung Rembus', 93200, "Kuching", "Sarawak");

// $userObj->loginAuthentication('kiannyp', 'Pkenny12');
// $hello = $userObj->setSessionData('kiannyp', 'Pkenny12');

// echo $hello[0];
// echo $hello[1];
// echo $hello[2];
// echo $hello[3];
// echo $hello[4];
// echo $hello[5];
// echo $hello[6];
// echo $hello[7];
// echo $hello[8];
// echo $hello[9];
// echo $hello[10];

// $userObj->updateProfile(1, 'sebi37', 'Sebidium', 'sebisebi@gmail.com', 'Ass1234', 112345678, 'male', 'Lorong 4, No 10, Taman Desa Wira', 93250, 'Kuching', 'Sarawak');

// $hello = $adminObj->displayStoreDetail();
// echo $hello[0];
// echo $hello[1];
// echo $hello[2];
// echo $hello[3];
// echo $hello[4];
// echo $hello[5];

// $menuObj->addAlacarte(1,2,3);

// $menuObj->updateSushiQty(1,1,3);

// $orderObj->editDeliveryTime(2,22, '2021-12-21 17:00:00');

// $orderObj->editOrderStatus(2, 22, 4);

?>
<!-- <form action="">
    <label for="party">Enter a date and time for your party booking:</label>
    <input id="party" type="datetime-local" name="partydate" value="2017-06-01T08:30">
</form> -->