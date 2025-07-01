<?php $this->pageTitle='Просмотр тикета ' . $model->id; ?>

<div class="wrap">

<h3>Служба поддержки</h3>

<h1>Просмотр тикета <?= $model->id; ?></h1>


<fieldset>
<legend>Сведения о запросе</legend>

<ol>

    <li>
        <p align="center"><img style="margin:3px;" src="<?= Y::bu() ?>images/front/support/question.png" /></p>
    </li>


<li>
<label>Отправитель:</label>
<div class="vidvalue"><?= CHtml::encode ($model->firstName); ?></div>
</li>

<li>
<label>E-mail отправителя:</label>
<div class="oneitem"><?= CHtml::encode ($model->email); ?></div>
</li>

<li>
<label>Дата создания:</label>
<div class="oneitem"><span class="date"><?= date ('d.m.Y H:i', $model->createTime); ?></span></div>
</li>

<li>
<label>Последнее изменение:</label>
<div class="oneitem"><span class="date2"><?= date ('d.m.Y H:i', $model->updateTime); ?></span></div>
</li>

<li>
<label>Категория:</label>
<div class="oneitem"><?= CHtml::encode (TicketSection::item($model->section_id)); ?></div>
</li>

<li>
<label>Оператор поддержки:</label>
<div class="vidvalue"><?= CHtml::encode ($model->staff->firstName); ?></div>
</li>

<li>&nbsp;</li>

<li>
<label>Важность:</label>
<div class="oneitem" style="color:<?= CHtml::encode (Lookup::item('TicketPColor',$model->priority_id)); ?>">
	<?= CHtml::encode (Lookup::item('TicketPriority',$model->priority_id)); ?></div>
</li>
<li>
<label>Статус:</label>
<div class="oneitem"><strong><span style="color:<?= CHtml::encode (Lookup::item('TicketSColor',$model->status_id)); ?>">
	<?= CHtml::encode (Lookup::item('TicketStatus',$model->status_id)); ?></span></strong></div>
</li>

<li>&nbsp;</li>

<?php if (Settings::item('staffUploadOn')): ?>


<?php for ($i=1; $i<=4; $i++): ?>

<?php $ffield = 'file'.$i; ?>
<?php if (!empty($model->$ffield)): ?>

<li>
<label>Вложенный файл #<?=$i?>:</label>
<div class="oneitem">
    <img style="vertical-align:middle; margin: 0 5px;" src="<?= Y::bu() ?>images/front/support/attached.png">
    <?= CHtml::link ('просмотреть ['.Ticket::findexts($model->$ffield).']',array ('/userfiles/'.$model->$ffield),array('target' => '_blank')); ?></div>
</li>

<?php endif; ?>

<?php endfor; ?>

<?php endif; ?>

<li>
<label>Тема:</label>
<div class="oneitem"><?= CHtml::encode ($model->subject); ?></div>
</li>

<li>
<label>Всего ответов:</label>
<div class="oneitem"><?= $model->answersCount ?></div>
</li>



</ol>

</fieldset>

<?php if ($model->status_id!=Ticket::CLOSED_STATUS): ?>

<fieldset class="submit">
	<a href="<?= Y::bu() ?>support/closeticket?ticket_id=<?= $model->id ?>&hash=<?= $ticketHash ?>">
		<?= CHtml::button('Пометить тикет как закрытый', array ('class' => 'submit')); ?>
    </a>
</fieldset>

<?php endif; ?>

<?php if (Settings::item ('staffReverse')==0): ?>

<fieldset>

<legend>Текст запроса</legend>

<ol>
<li>
	    <?php

 $taa = H::convertUrl (nl2br(CHtml::encode ($model->message)));
 //Исправление для кодов
 if (preg_match ('/[a-zA-Z_0-9]{100,}/',$taa)) {
     $taa = preg_replace ('/([a-zA-Z_0-9]{100,})/',"<textarea class='textarea' cols=65 rows=5>\\1</textarea><br>",$taa);
 }

?>


<?= $taa ?>
</li>


</ol>

</fieldset>



		<?php $this->renderPartial('/support/_answers',array(
			'ticket'=>$model,
			'answers'=>$model->answers,
		)); ?>
        
<?php endif; ?>

<fieldset>
<legend>Добавить новый ответ</legend>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'answer-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<ol>

	<li>
	<div class="validerror">
	    <?php echo $form->errorSummary($answer); ?>
    </div>
    </li>


	<li>
    <div class="row">
        <?php echo $form->labelEx($answer,'message'); ?>
        <?php echo $form->textArea($answer,'message',array('rows'=>12, 'cols'=>50, 'class' => 'textarea')); ?>
        <?php echo $form->error($answer,'message'); ?>
    </div>
    </li>


<?php if (Settings::item('staffUploadOn')): ?>

    <li>
    <div class="row">
        <?php echo $form->labelEx($answer,'file1'); ?>
        <?php echo $form->fileField($answer,'file1',array('class' => 'longtext')); ?>
        <?php echo $form->error($answer,'file1'); ?>
    </div>
    </li>

    <li>
    <div class="row">
        <?php echo $form->labelEx($answer,'file2'); ?>
        <?php echo $form->fileField($answer,'file2',array('class' => 'longtext')); ?>
        <?php echo $form->error($answer,'file2'); ?>
        <br><span class="fcomment">Разрешённые типы: <?=Settings::item('staffUploadExt')?></span>
        
    </div>
    </li>

<?php endif; ?>

    <li>
<?php if (extension_loaded('gd')) {?>
	<div class="row">
		<?php echo $form->labelEx($answer, 'verifyCode', array ('style' => 'padding-top:15px'));?>
			<?php echo $form->textField($answer, 'verifyCode', array ('class' => 'text'));?>        
			<?php $this->widget('CCaptcha', array(			
					'clickableImage' => TRUE,					
					'buttonLabel' => '',
					'imageOptions' => array ('style' => 'vertical-align:middle'),
					));?>    

		<?php echo $form->error($answer, 'verifyCode');?>
		</div>
<?php }?>    
    
    
    </li>

</ol>

</fieldset>

	<fieldset class="submit">
        <?php echo CHtml::submitButton('Добавить ответ', array ('class' => 'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

<?php if (Settings::item ('staffReverse')==1): ?>


		<?php $this->renderPartial('/support/_answers',array(
			'ticket'=>$model,
			'answers'=>$model->answers,
		)); ?>


<fieldset>

<legend>Текст запроса</legend>

<ol>
<li>
	    <?php

 $taa = H::convertUrl (nl2br(CHtml::encode ($model->message)));
 //Исправление для кодов
 if (preg_match ('/[a-zA-Z_0-9]{100,}/',$taa)) {
     $taa = preg_replace ('/([a-zA-Z_0-9]{100,})/',"<textarea class='textarea' cols=65 rows=5>\\1</textarea><br>",$taa);
 }

?>


<?=$taa; ?>
</li>


</ol>

</fieldset>

        
<?php endif; ?>

</div>



<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>support/">Служба Поддержки</a></p>
</div>