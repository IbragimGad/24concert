<?
    session_start();
    include "classes.php";
    $user=new user();
    $user->setUserMail($_SESSION['UserMail']);
	$user->setUserId($_SESSION['UserId']);
    $StrUrl=$_POST['StrUrl'];
    $user->setUrl($StrUrl);
header ("Location: ../panel.php?success=2");
?>