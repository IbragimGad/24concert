<?php
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
setlocale(LC_ALL, 'ru_RU.UTF-8');
?>

<!DOCTYPE html>
<html>
<head>
    <link href="../style/watch.css" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <title>24concert</title>
    <meta charset="utf-8">
	<link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <script type="text/javascript">
        $(document).ready(function(){
        
            $(".ChatText").keyup(function(e){
             //При нажатии Enter выполняется
                if(e.keyCode ==13){
				
                    var ChatText = $(".ChatText").val();
                    $.ajax({                    
                        type:'POST',
                        url:'pages/InsertMessage.php',
                        data:{ChatText:ChatText, room:"<? echo $_GET['chatroom'];?>"},
                        success:function(){
                        $(".ChatMessages").load("pages/DisplayMessages.php","room=<? echo $_GET['chatroom'];?>");
                        $(".ChatText").val("");
						setTimeout(function(){$('.ChatMessages').scrollTop(100000)},500);
                                        }
                    });
                }
            });
        
        
            setInterval(function(){
                $(".ChatMessages").load("pages/DisplayMessages.php","room=<? echo $_GET['chatroom'];?>");
            },500);
			
            $(".ChatMessages").load("pages/DisplayMessages.php","room=<? echo $_GET['chatroom'];?>");
			//АВТОСКРОЛЛ ЧАТА ВНИЗ
			setTimeout(function(){$('.ChatMessages').scrollTop(100000)},500);
			//КТО ОНЛАЙН
			$(".watchers").load("pages/onlinecounter.php","chatroom=<? echo $_GET['chatroom'];?>");
			
			setInterval(function(){
                $(".watchers").load("pages/onlinecounter.php","chatroom=<? echo $_GET['chatroom'];?>");
            },10000);
    });
    </script>
	</head>
    
    <body>

<!-- БОКОВОЕ МЕНЮ -->
        <nav>
		<div class="logo"><img src="/img/logo.png" /></div>
		<hr noshade size=1px width=90%>
		<div class="info">
		<?        
		$id=$_GET['id'];
        include "pages/conn.php";
        $req=$bdd->prepare("SELECT UserName, UserInfo FROM users WHERE UserId=$id");
        $req->execute();
		$res=$req->fetch();
        ?>
		<p><? echo $res['UserName']; ?> предпочитает играть:<br><br>
		<? echo $res['UserInfo']; ?>
		</p>
		<hr noshade size=1px width=90%>
		<ul>
			<li><a href="/main.php"><div class="navlink">Главная</div></a></li>
			<li><a href="/about.php"><div class="navlink">О сайте</div></a></li>
			<li><a href="/panel.php"><div class="navlink">Настройки</div></a></li>
			<li><a href="/pages/logout.php"><div class="navlink">Выход</div></a></li>
		</ul>
		</div>
		</nav>
<!-- ОКНО С ВИДЕО -->		
		<content>
		<? if ($_GET['streamurl']=="") {
			?><h3><? echo "Извините, ".$res['UserName']." сейчас не в сети";?></h3><br>
			<? } else { ?>
		<div id="stream">
            <iframe width="560" height="315" src="http://youtube.com/embed/<?=$_GET['streamurl']?>?autoplay=0&rel=0" frameborder="0" allowfullscreen></iframe>
        </div>
        <? } ?>
		
<!-- ПРИЕМ ПЛАТЕЖА -->		
		<div class="thanks">
		<h3>Поблагодарить исполнителя (в руб.)</h3>	
		<?
			$mrh_login = "24concert";
			$mrh_pass1 = "Programming1992";

			$inv_id = 0;

			$inv_desc = "Добровольное пожертвование. Кому: ".$res['UserName'];

			$def_sum = "10";

			$shp_item = $_GET['id'];

			$culture = "ru";

			$encoding = "utf-8";
			
			if (isset($_SESSION['UserId'])) {
			$shp_from = $_SESSION['UserId'];
			} else {
			$shp_from = 0;}

			$crc  = md5("$mrh_login::$inv_id:$mrh_pass1:shp_from=$shp_from:shp_item=$shp_item");

			print "<html><script language=JavaScript ".
				  "src='https://auth.robokassa.ru/Merchant/PaymentForm/FormFL.js?".
				  "MerchantLogin=$mrh_login&DefaultSum=$def_sum&InvoiceID=$inv_id".
				  "&Description=$inv_desc&SignatureValue=$crc&shp_from=$shp_from&shp_item=$shp_item".
				  "&Culture=$culture&Encoding=$encoding'></script></html>";
		?>
		
		</div>
		<div class="watchers">
			
		</div>
		</content>
<!-- ОКНО С ЧАТОМ -->		
		<aside>
		
			<div id="ChatBig">
    
            <div class="ChatMessages"></div>
			<hr noshade size=1px width=90%>
            
			<textarea class="ChatText" name="ChatText"
			<? if (empty($_SESSION['UserMail'])) {?> 
			disabled placeholder="Чат доступен только для зарегистрированных"<? } else {?>
			placeholder="Введите сообщение в это окно..."<? }?>></textarea>
			
			</div>
		</aside>
		
		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
			(function (d, w, c) {
				(w[c] = w[c] || []).push(function() {
					try {
						w.yaCounter27001017 = new Ya.Metrika({
							id:27001017
						});
					} catch(e) { }
				});

				var n = d.getElementsByTagName("script")[0],
					s = d.createElement("script"),
					f = function () { n.parentNode.insertBefore(s, n); };
				s.type = "text/javascript";
				s.async = true;
				s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

				if (w.opera == "[object Opera]") {
					d.addEventListener("DOMContentLoaded", f, false);
				} else { f(); }
			})(document, window, "yandex_metrika_callbacks");
		</script>
		<noscript><div><img src="//mc.yandex.ru/watch/27001017" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
		
    </body>
</html>
<script ENGINE="text/javascript">
document.body.innerHTML = document.body.innerHTML.replace('style="text-align:center;font-size:11px', 'style="display:none; text-align:center;font-size:11px');
document.body.innerHTML = document.body.innerHTML.replace('style="text-align:center;font-size:11px', 'style="display:none; text-align:center;font-size:11px');
</script>