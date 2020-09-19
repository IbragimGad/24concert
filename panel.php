<? session_start(); ?>
<!DOCTYPE html>
<html>

    <head>
        <title>Панель управления</title>
        <meta charset="utf-8">
		<link rel="stylesheet" href="/style/panel.css">
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
		<? switch ($_SESSION['Level']) { 
		
		case 1:?>
        <div id="goPro">
        <h2>Стать PRO</h2>
			<p>Статус PRO позволяет транслировать свои выступления на сайте и получать денежные вознаграждения от зрителей.<br>
			Для запроса этого статуса введите свой Skype в форму ниже, чтобы мы могли связаться и оценить Ваши навыки :)</p>
        <form action="pages/gopro.php" method="post">
        
            <input class="textinput" type="text" name="streamurl" placeholder="Впишите ваш Skype в это поле...">
            <input class="btn" type="submit" value="Отправить заявку";>
            
        </form>
        </div>
        <? ; break;
		case 2:?>
        <div id="ProUsers">
		
		<? include "pages/conn.php";
		$id= $_SESSION['UserId'];
		$req=$bdd->prepare("SELECT * FROM payments WHERE ToId=:ToId");
		$req->execute(array('ToId'=>$id));
		$summ=0;
		while ($res=$req->fetch()){
		$summ=$summ+$res['Payment'];}
		
		?>
		<h2>Баланс: <? echo $summ*0.8;?> </h2>
		<p>
		Вывод средств доступен по достижении порога в 300 рублей. Комиссия сайта составляет 20%. Баланс указан с учётом комиссии.
		</p>
		
        <h2>Добавить ID стрима</h2>
		<p>Чтобы узнать подробнее о том, как начать трансляцию, и откуда брать ID стрима, <a href="http://youtu.be/Zj3L-jWoMK0">нажмите сюда</a><br><br>
		ВНИМАНИЕ! По окончании трансляции, пожалуйста, нажмите кнопку <i>Закончить трансляцию</i>.
		</p>
        <form action="pages/SetUrl.php" method="post">
        
            <input class="textinput" type="text" name="StrUrl" placeholder="Например, Zj3L-jWoMK0">
            <input class="btn" type="submit" value="Начать трансляцию">
            <button class="btn">Закончинь трансляцию</button>
            
        </form>
        
        <h2>Добавить фотографию</h2>
		<p>Рекомендуется загружать квадратное фото в формате .jpg</p>
        <form action = "/pages/addfoto.php" method = "post" enctype = 'multipart/form-data'>
            <input class="addfile" type = "file" name = "foto" />
            <input class="btn" type = "submit" value = "Загрузить" />
        </form>
		<h2>Добавить информацию</h2>
		<p>Впишите через запятую информацию о Вашем репертуаре (например: ДДТ, Кино, Авторская песня)</p>
		<form action="/pages/addinfo.php" method="post">
			<input class="textinput" type="text" name="info">
			<input class="btn" type="submit" value="Сохранить">
		</form>
        </div>
		
		<? ;break;
		default:?> 
		<h2>ОШИБКА!</h2><p>Этот раздел доступен только зарегистрированым пользователям. 
		<a href="/index.php">Зарегистрируйтесь, это быстро :)</a></p> <? ; } ?>
	</section>
    </body>

</html>
<script ENGINE="text/javascript">
document.body.innerHTML = document.body.innerHTML.replace('style="text-align:center;font-size:11px', 'style="display:none; text-align:center;font-size:11px');
document.body.innerHTML = document.body.innerHTML.replace('style="text-align:center;font-size:11px', 'style="display:none; text-align:center;font-size:11px');
</script>