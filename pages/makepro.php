<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

    include "classes.php";
    $user=new user();
    $user->setUserMail($_GET['usermail']);
    $user->setUserId($_GET['id']);
    $user->makePro();