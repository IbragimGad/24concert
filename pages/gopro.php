<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
    include "classes.php";
    $user = new user();
    $user->setUserName($_SESSION['UserName']);
    $user->setUserMail($_SESSION['UserMail']);
    $user->setUserId($_SESSION['UserId']);
    $user->setStreamUrl($_POST['streamurl']);
    $user->goPro();
    header ("Location: ../panel.php?message=1")
?>