<?php
ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
?>
<!DOCTYPE html>
<html>

    <head>
    <title>Главная</title>
    <meta charset="utf-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/style/main.css">
	<link href="/img/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    </head>
    
    <body>
	
	<nav>
		<div class="logo"><img src="/img/logo.png" /></div>
		<ul>
		<? if (empty($_SESSION['UserId'])) { ?>
			<li><a class="navlink" href="/index.php">Войти</a></li> <? } ?>
			<li><a class="navlink" href="../about.php">О сайте</a></li>
			<li><a class="navlink" href="../panel.php">Настройки</a></li>
			<li><a class="navlink" href="../pages/logout.php">Выход</a></li>
		</ul>
	</nav>
	
	<div id="background">
		<div class="bg-text">Живой звук<br>Живые эмоции</div>
	</div>    
	
<!-------------------------------------------------------------------------------->
    
    <div id="container">
	
    <?        
        include "pages/conn.php";
        //$req=$bdd->prepare("SELECT UserId, UserName, StreamUrl FROM users WHERE Level='2' ORDER BY UserId");
		$req=$bdd->prepare("SELECT UserId, UserName,StreamUrl FROM users WHERE StreamUrl!='' ORDER BY UserId");
        $req->execute();
		if($req->rowCount()!==0){?>
		<div class="header">Выберите исполнителя</div>
		<? 
        while($res=$req->fetch()){
            ?>
        
		
        <div class="thumb">
           <a href="/watch.php?streamurl=<? echo $res['StreamUrl']?>&chatroom=chat<? echo $res['UserId'];?>&id=<? echo $res['UserId'];?>">
            
            <div class="wrapper">
                <img src="/avatars/<? echo $res['UserId']?>.jpg" onerror="this.src = '/img/nophoto.jpg';"/>
            </div>
			
			<div class="info">
			<div class="name"><? echo $res['UserName'];?></div>
			</a>
			</div>
        </div>        
    
        
    
    <?
        }
	} else { ?>
		<div class="header">Извините, сейчас никого нет<br>Но можно посмотреть записи последних трансляций<br>
		<a href="https://docs.google.com/spreadsheets/d/1Ga3mXQCGNPWMcubJubEc_coNKVw-_oiac_n4viL8U4E/edit?usp=sharing">Ближайшие концерты</a>
		</div>
		<? 
		$req=$bdd->prepare("SELECT UserId, StreamUrl, Date FROM lastair ORDER BY Date DESC");
        $req->execute();
		while($res=$req->fetch()){
		?> <div class="airrecord">
		<iframe width="560" height="315" src="http://youtube.com/embed/<?=$res['StreamUrl']?>?autoplay=0&rel=0" frameborder="0" allowfullscreen></iframe>
		</div><?
		}
		}
    ?>
    </div>
<!-------------------------------------------------------------------------------->

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