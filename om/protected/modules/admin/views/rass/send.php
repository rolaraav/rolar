<?php $this->pageTitle='Рассылка - Сообщение отправлено' ?>

<div class="wrap">
    
    <h3>Рассылка</h3>
    
    <h1>Рассылка - Сообщение отправлено</h1>
    
    <p>&nbsp;</p>
    
<p align="center"><img src="<?=Y::bu()?>images/m/mailed.gif" style="margin:25px;"></p>

<p>&nbsp;</p>

<p align="center" style="font-size:16px;"><b>Сообщение для <?=$count?> получателей - передано в очередь</b></p>    

<p>&nbsp;</p>

<p align="center"><a href="<?=Y::bu()?>cron/i<?

$xxs = Settings::item('cronWord');
 if (!empty($xxs)) {
     
    echo '/s/'.$xxs;
    
 } ?>" target="_blank">Вызвать строку для Крона самостоятельно сейчас (если не настроен Крон) для разовой отправки</a></p>

<p>&nbsp;</p>

<p align="center"><?=CHtml::link ('Просмотреть очередь',array ('queue/index')); ?></p>

<p>&nbsp;</p>

</div>
