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

    $adminid = $session_data[0];
    $username = $session_data[1];
    $password = $session_data[2]
    $fullname = $session_data[3];
    $phonenum = $session_data[4];
    $email = $session_data[5];

    if(!isset($_SESSION['login_user'])){
        header("Location:../Login/sign-in-admin.php");  
        die();
    }

?>