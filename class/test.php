<?php 
include '../database/dbConnection.php'; 
include 'UserClass.php';
include 'AdminClass.php';
$userObj = new User($conn);
$adminObj = new Admin($conn);

$userObj->checkExistUsername("kiannyp");

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

$hello = $adminObj->displayStoreDetail();
echo $hello[0];
echo $hello[1];
echo $hello[2];
echo $hello[3];
echo $hello[4];
echo $hello[5];
?>