<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
    include "classes.php";
    $user = new user();
    $secret = "abc";
    if(isset($_POST['UserName']) && isset($_POST['UserMail']) && isset($_POST['UserPassword'])){
    
        $user->setUserName($_POST['UserName']);
        $user->setUserMail($_POST['UserMail']);
        $user->setUserPassword(sha1($_POST['UserPassword']));
        $user->setUserActivation(md5($secret.$_POST['UserMail']));
        $user->InsertUser();
        
    }
  
?>