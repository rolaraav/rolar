<?php $this->pageTitle='Оформление заказа - Готово' ?>

<div class="wrap">

<h3>Готово</h3>

<h1>Товар добавлен к заказу</h1>

<p>&nbsp;</p>

<p align="center"><img src="<?=Y::bu()?>images/m/ok.gif" style="margin:25px;"></p>

<p>&nbsp;</p>
<p>&nbsp;</p>

<p align="center" style="font-size:16px;"><b>Выбранный Вами товар добавлен к заказу</b></p>

<p>&nbsp;</p>
<p>&nbsp;</p>

<?php if (!empty ($slink)): ?>

<p align="center">Постоянная ссылка для отслеживания состояния Вашего заказа:

    <br><br>
    
    <a href="<?=$slink?>" target="_blank"><?=$slink?></a>

</p>

<?php endif; ?>


</div>
