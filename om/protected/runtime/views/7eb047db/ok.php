<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\views\f\ok.php */ ?>
<?php $this->pageTitle='Готово' ?>

<div class="wrap">

<h3>Готово</h3>

<h1>Благодарим! Оплата произведена успешно!</h1>

<div class="centerimg">
<img src="<?=Y::bu()?>images/m/ok.gif">
</div>

<div class="pgtext">
<p><b>Сразу после зачисления платежа Вы получите уведомление на E-mail.</b></p>
<p>Если возникнут трудности - свяжитесь с <a href="<?=Y::bu();?>support/">администратором</a>.</p>
<p>Вернуться на сайт <a href="<?=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?>"><?=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?></a>.</p>
</div>

</div>