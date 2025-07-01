<?php $answerNum = 1; $ac = count($answers); ?>

<?php foreach ($answers as $answer): ?>

<fieldset>

<?php if ($answerNum==((Settings::item('staffReverse')==1)?1:$ac)): ?>
<legend>Последний ответ</legend>
<?php else: ?>
<legend>Ответ №<?= ((Settings::item('staffReverse')==0)?$answerNum:($ac-$answerNum+1)) ?></legend>
<?php endif; ?>



<ol>

    <li>
        <p align="center"><img style="margin:3px;" src="<?= Y::bu() ?>images/front/support/<?=($answer->kind == 'staff')?'answer':'info'; ?>.png" /></p>
    </li>

<li>
<label>Автор:</label>
<div class="vidvalue"><?= ($answer->kind == 'staff')?$answer->staff->firstName.' (оператор)':'Вы'; ?></div>
</li>

<li>
<label>Дата:</label>
<div class="oneitem"><span class="date"><?= date ('d.m.Y H:i', $answer->updateTime); ?></span></div>
</li>

<?php if (Settings::item('staffUploadOn')): ?>

<?php for ($i=1; $i<=4; $i++): ?>

<?php $ffield = 'file'.$i; ?>
<?php if (!empty($answer->$ffield)): ?>

<li>
<label>Вложенный файл #<?=$i?>:</label>
<div class="oneitem"><img style="vertical-align:middle; margin: 0 5px;" src="<?= Y::bu() ?>images/front/support/attached.png">
    <?= CHtml::link ('просмотреть ['.Ticket::findexts($answer->$ffield).']',array ('/userfiles/'.$answer->$ffield),array('target' => '_blank')); ?></div>
</li>

<?php endif; ?>

<?php endfor; ?>

<?php endif; ?>



<li>
<div class="wrap">
<h3>Текст сообщения</h3>
<?php

 $aaa = H::convertUrl (nl2br(TicketAnswer::cytate(CHtml::encode ($answer->message))));
 //Исправление для кодов
 if (preg_match ('/[a-zA-Z_0-9]{100,}/',$aaa)) {
     $aaa = preg_replace ('/([a-zA-Z_0-9]{100,})/',"<textarea class='textarea' cols=65 rows=5>\\1</textarea><br>",$aaa);
 }

?>


<?= $aaa ?>

</li>

</ol>

</fieldset>

<?php $answerNum++ ?>

<?php endforeach; ?>