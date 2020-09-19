<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="/style/panel.css" type="text/css" rel="stylesheet"/>
    <title>24concert</title>
    <meta charset="utf-8">
	<link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
	<nav>
		<div class="logo"><img src="/img/logo.png" /></div>
		<ul>
			<li><a class="navlink" href="/main.php">Главная</a></li>
			<li><a class="navlink" href="../about.php">О сайте</a></li>
			<li><a class="navlink" href="../panel.php">Настройки</a></li>
			<li><a class="navlink" href="../pages/logout.php">Выход</a></li>
		</ul>
	</nav>
	<section>
	<?
	switch ($_GET['message']) { 
		
		case 1:?>
        
        <h2>Спасибо!</h2>
			<p>Ваше пожертвование принято! Благодарим за поддержку!</p>
        
        <? ; break;
		case 2:?>
        
        <h2>Ошибка :(</h2>
		<p>Что-то пошло не так при оплате. Скорее всего необходимо попробовать снова</p>
       	
		<? ;break;} ?>
		
		<?
  $mrh_login = "24concert";
  $mrh_pass1 = "Programming1992";
  $inv_id = 0;
  $inv_desc = "Техническая документация по ROBOKASSA";
  $out_summ = "8.96";
  $crc = md5("$mrh_login:$out_summ:$inv_id:$mrh_pass1");
  print
   
   "<form action='http://test.robokassa.ru/Index.aspx' method=POST>".
   "<input type=hidden name=MrchLogin value=$mrh_login>".
   "<input type=hidden name=OutSum value=$out_summ>".
   "<input type=hidden name=InvId value=$inv_id>".
   "<input type=hidden name=Desc value='$inv_desc'>".
   "<input type=hidden name=SignatureValue value=$crc>".
   "<input type=submit value='Оплатить'>".
   "</form>";
?>
	</section>
</body>
</html>