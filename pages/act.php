<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
    require_once "classes.php";
    session_start();
    require_once "conn.php";
    $user= new user();
        $user->setUserMail($_GET['usermail']);
        $key=$_GET['key'];
    
    if($user->checkActivateLink($key)){
        
        $user->activateUser();
        $_SESSION['success_act']=1;
    }
        else {$_SESSION['error_act']=1;}
        header("Location: /index.php?message=4");
?>