<?php defined('A') or die('Access denied'); ?>
<div class="cisco_zagolovok"><br><span class="cisco_payment_success">Оплата заказа прошла успешно!<br></span><br><span class="cisco_download_course">Скачать обучающий курс</span><br><span class="cisco_siski">&quot;Сиськи по-русски&quot;</span><br><span class="cisco_or">или</span><br><span class="cisco_steps">11 простых шагов</span><br><span class="cisco_technology">по сетевым технологиям</span><br><span class="cisco_logo">CISCO</span><br><span class="cisco_russian">на русском языке</span></div>
<div class="cisco_image-center"><img alt="Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке" height="387px" width="300px" src="<?=I.S;?>cisco/ccna-book300.png" title="Сиськи по-русски или 11 простых шагов по сетевым технологиям Cisco на русском языке"></div>
<?php
//if ($_COOKIE['download_access'] == true) {
if ($download_access == true) {
  //echo '<p class="probel">&nbsp;</p>';
  echo '<p class="cisco_center big">Ссылка для скачивания курса:</p>
    <p class="cisco_download_link"><a href="'.$secret_link.'" target="_blank" title="Нажми на кнопку &quot;Скачать&quot;, чтобы скачать видеокурс">&laquo;&quot;Сиськи по-русски&quot; или<br>11 простых шагов по сетевым технологиям Cisco на русском языке&raquo;</a><br>
    <a href="'.$secret_link.'" target="_blank" title="Нажми на кнопку &quot;Скачать&quot;, чтобы скачать видеокурс"><span class="cisco_download_button"></span></a></p>
    <p class="cisco_warning">Внимание! Ссылка на скачивание одноразовая!<br>Не закрывай эту страницу, пока скачивание не завершится!<p>
    <p class="probel">&nbsp;</p>
    <div class="cisco_size">Размер файла-архива составляет более 9 Гбайт!</div>';
}
else {
  echo '<p class="cisco_warning">Возможно эта страница была закрыта и ссылка на скачивание была удалена.<p>';
}?>
<p class="probel">&nbsp;</p>
<p class="cisco_support_link">Если скачать не удалось, обратись в <a href="<?=D;?>om/support/" target="_blank" title="Написать тикет в службу поддержки"><strong>службу поддержки</strong></a>.</p>
<p class="probel">&nbsp;</p>
