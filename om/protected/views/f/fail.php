<?php $this->pageTitle='Оплата не была произведена' ?>

<div class="wrap">

<h3>Оплата завершилась неуспешно</h3>

<h1>Оплата не была произведена!</h1>


<div class="centerimg">
<img src="<?=Y::bu()?>images/m/fail.gif">
</div>

<div class="pgtext">
<p><b>Оплата не была произведена и товар Вам не будет выслан.</b></p>
<p>Если возникнут трудности - свяжитесь с <a href="<?=Y::bu();?>support/">администратором</a>.</p>
<p>Вернуться на сайт <a href="<?=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?>"><?=$_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];?></a>.</p>
</div>

</div>