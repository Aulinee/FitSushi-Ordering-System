<?php 
    include '../database/dbConnection.php';
    include '../class/UserClass.php';
    include '../class/AdminClass.php';
    include '../class/MenuClass.php';
    include '../class/OrderClass.php';

    $userObj = new User($conn);
    $adminObj = new Admin($conn);
    $menuObj = new Menu($conn);
    $orderObj = new Order($conn);
    
    // Set sessions
    if(!isset($_SESSION)) {
        session_start();
    }

    if(isset($_SESSION['login_user']))  
    { 
        if(time()-$_SESSION["login_time_stamp"] > 180000)   
        { 
            session_unset(); 
            session_destroy(); 
            header("Location:../Login/sign-in-admin.php"); 
        } 
    } 

    $username = $_SESSION['login_user'];
    $password = $_SESSION['login_pass'];

    //Set session data
    $session_data = $adminObj->setSessionData($username, $password);
    $session_StoreData = $adminObj->setSessionStore();

    $adminid = $session_data[0];
    $username = $session_data[1];
    $password = $session_data[2];
    $fullname = $session_data[3];
    $phonenum = $session_data[4];
    $email = $session_data[5];

    $store_ID = $session_StoreData[0];
    $opnHrs = $session_StoreData[1];
    $loc = $session_StoreData[2];
    $Whatsapp = $session_StoreData[3];
    $Instagram = $session_StoreData[4];
    $Facebook = $session_StoreData[5];
    $PhoneNumber = $session_StoreData[6];

    if(!isset($_SESSION['login_user'])){
        header("Location:../Login/sign-in-admin.php");  
        die();
    }

?>