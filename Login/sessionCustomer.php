<?php 
    include '../database/dbConnection.php';
    include '../class/UserClass.php';

    $userObj = new User($conn);
    
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
            header("Location:../Login/sign-in-user.php"); 
        } 
    } 

    $username = $_SESSION['login_user'];
    $password = $_SESSION['login_pass'];

    //Set session data
    $session_data = $userObj->setSessionData($username, $password);

    $userid = $session_data[0];
    $username = $session_data[1];
    $fullname = $session_data[2];
    $email = $session_data[3];
    $gender = $session_data[4];
    $phonenum = $session_data[5];
    $addressline= $session_data[6];
    $password= $session_data[7];
    $postalcode= $session_data[8];
    $area= $session_data[9];
    $state= $session_data[10];
    $country= $session_data[11];

    if(!isset($_SESSION['login_user'])){
        header("Location:../Login/sign-in-user.php");  
        die();
    }

?>