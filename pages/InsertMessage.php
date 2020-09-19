<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
    session_start();
    include "classes.php";
    $chat = new chat();

    if(isset($_POST['ChatText'])){
            $chat->setChatUserId($_SESSION['UserId']);
            $chat->setChatText($_POST['ChatText']);
            $chat->setChatRoom($_POST['room']);
            $chat->InsertChatMessage();
    }
?>