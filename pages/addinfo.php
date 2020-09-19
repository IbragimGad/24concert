<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
    include "classes.php";
    $user = new user();
    $user->setUserId($_SESSION['UserId']);
    $user->InsertUserInfo($_POST['info']);
	header ("Location: ../panel.php?success=3");
    
?>