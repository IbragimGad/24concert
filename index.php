<? session_start(); if (isset($_SESSION['UserMail'])) { header("Location: /main.php"); }?>
<!DOCTYPE html>
<html>
<head>
    <title>Добро пожаловать</title>
    <link rel="stylesheet" href="style/index.css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<meta charset="utf-8">
	<link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>
<body>
    <script>
        $(document).ready(function(){
            $("#btn").click(function(){
                $("#LogReg").slideToggle();
                });
    }) 
    </script>
    <script>
        $(document).ready(function(){
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})
})
    </script>
    
    <div id="button">
    <a href="/main.php" class="button">Смотреть</a>	
	<div id="btn"><a href="#" class="button">Войти</a></div>
    </div>
    
    
    <div id="LogReg">
        
    <ul class="tabs">
		<li class="tab-link current" data-tab="tab-1">Вход</li>
		<li class="tab-link" data-tab="tab-2">Регистрация</li>
	</ul>    
    <div id="tab-1" class="tab current">       
        
            <form method="post" action="/pages/UserLogin.php">   
            <input class="reginput" type="email" name="UserMailLogin" placeholder="Ваш E-mail" required />
            <input class="reginput" type="password" name="UserPasswordLogin" placeholder="Ваш пароль" required />
            <input class="regbutton" type="submit" value="OK"/>
            </form>
        
    </div>       
    

    <div id="tab-2" class="tab">   
        
            <form method="post" action="pages/InsertUser.php">
            <input class="reginput" type="text" name="UserName" placeholder="Ваше имя" required/>
            <input class="reginput" type="email" name="UserMail" placeholder="Ваш E-mail" required/>
            <input class="reginput" type="password" name="UserPassword" placeholder="Пароль" required/>
            <input class="regbutton" type="submit" value="Зарегистрироваться"/>
            </form>
        
    </div>
    </div>
    
	<?	switch ($_GET['message']) {
				case 1: $message='Неверный логин или пароль';break;
				case 2: $message='Ваш аккаунт не активирован. Пожалуйста, проверьте почту';break;
				case 3: $message='На указанный Вами адрес выслано письмо с ссылкой для активации';break;
				case 4: $message='Учетая запись активирована, Входите';break;
				case 5: $message='Пользователь с таким e-mail уже существует';break;
				default: break;
			};
		if (isset($message)){?>
	<div id="message"><?echo $message?></div><?}?>
<div class="bigtext">
<b>24</b>CONCERT<br>
<p class="small-text">Уличные музыканты теперь в тепле</p>
</div>
<footer>
<a href="../about.php" class="foottext">Узнать больше о сайте</a>
</footer>

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