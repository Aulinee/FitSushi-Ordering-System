<?php
include '../Login/sessionCustomer.php';

$sushiid_token = htmlentities($_GET["id"]);

$deleteSushi = $menuObj->deleteAlacarte($userid, $sushiid_token);

if($deleteSushi){
    echo "<script>
        alert('Successful');
        window.location.href='sushibox-page.php';
        </script>";
}else{
    echo "<script>
        alert('Failed');
        window.location.href='sushibox-page.php';
        </script>";
}

?>