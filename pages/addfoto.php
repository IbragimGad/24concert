<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
    session_start();
    $blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");
    foreach ($blacklist as $item)
    if(preg_match("/$item\$/i", $_FILES['foto']['name'])) exit;
    $type = $_FILES['foto']['type'];
    $size = $_FILES['foto']['size'];
    if (($type != "image/jpg") && ($type != "image/jpeg")) exit;
    if ($size > 1024000) exit;
    $uploadfile = "../avatars/".$_SESSION['UserId'].".jpg";
    move_uploaded_file($_FILES['foto']['tmp_name'], $uploadfile);
    header("Location: ../panel.php?success=3");
?>