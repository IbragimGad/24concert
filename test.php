<? 
echo time();
if (mail("ibragimgadziev@gmail.com", "заголовок", "текст")) {
    echo 'Отправлено на ibragimgadziev@gmail.com';
}
else {
    echo 'Не отправлено';
}
				?>