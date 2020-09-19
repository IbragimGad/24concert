<?
include "conn.php";
	$ip= $_SERVER['REMOTE_ADDR'];
	$date = time();
	$delete_date = $date-180;
	
	//ПРОВЕРКА НА ИМЕЮЩЕГОСЯ ОНЛАЙН
	$req = $bdd->prepare("SELECT * FROM online WHERE ip=:ip");
	$req->execute(array('ip'=>$ip));
	
	if($req->rowCount()!==0){
	$req = $bdd->prepare("UPDATE online SET date=:date, chatroom=:chatroom WHERE ip=:ip");
	$req->execute(array('ip'=>$ip, 'date'=>$date, 'chatroom'=>$_GET['chatroom']));
	} else {
	$req = $bdd->prepare("INSERT INTO online(ip, date, chatroom) VALUES(:ip, :date, :chatroom)");
	$req->execute(array('ip'=>$ip, 'date'=>$date, 'chatroom'=>$_GET['chatroom']));
	}
	//УДАЛЕНИЕ ОФФЛАЙН
	$req = $bdd->prepare("DELETE FROM online WHERE date<$delete_date");
	$req->execute(array('ip'=>$ip));
	
	//ПОДСЧЕТ ОНЛАЙН
	$req = $bdd->prepare("SELECT * FROM online WHERE chatroom=:chatroom");
	$req->execute(array('chatroom'=>$_GET['chatroom']));
	$watchers = $req->rowCount();
?>
<h3>Зрителей онлайн: <? echo $watchers;?></h3>
