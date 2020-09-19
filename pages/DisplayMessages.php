<?php

    include "classes.php";
    $chat = new chat();
    $chat->setChatRoom($_GET['room']);
    $chat->DisplayMessage();
    
?>