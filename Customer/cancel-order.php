<?php 
include '../Login/sessionCustomer.php';

$orderid_token = htmlentities($_GET["orderid"]);

//no 3 symbolize cancel status
$cancel_status = $orderObj->editOrderStatus($userid, $orderid_token, 3);

if($cancel_status == true){
    echo "<script>
            alert('Your cancellation request is successful!');
            window.location.href='profile-page.php';
        </script>";
}else{
    echo "<script>
            alert('Your cancellation request is unsuccessful! Please try again!');
            window.location.href='profile-page.php';
        </script>";
}

?>