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

// if($_SERVER["REQUEST_METHOD"] == "POST"){

//     $sushiqty = $_POST[$sushiid_token];

//     $existMenu = $menuObj->checkExistMenu($userid, $sushiid_token);

//     if($sushiqty != 0 && $existMenu == false){
//         $menuObj->addAlacarte($userid, $sushiid_token, $sushiqty);
//     }else if($sushiqty == 0){
//         echo "<script>
//             alert('Your sushi quanitity is zero');
//             window.location.href='menu-page.php';
//             </script>";
//     }else{
//         echo "<script>
//             alert('You already add this menu to sushibox!');
//             window.location.href='menu-page.php';
//             </script>";
//     }


// }

?>