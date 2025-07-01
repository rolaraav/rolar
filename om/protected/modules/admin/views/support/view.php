<?php $this->pageTitle='Просмотр тикета';

$this->menu=array(
	array('label'=>'Список тикетов', 'url'=>array('support/tickets/id/'.$model->section_id.'/Ticket%5Bstatus_id%5D/1'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Удалить тикет', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<?php $this->pageTitle='Просмотр тикета ' . $model->id; ?>

<div class="wrap" style="max-width: 670px;">

<h3>Поддержка</h3>

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
<div class="oneitem"><span class="date2"><?= date ('d.m.Y H:i', $model->createTime); ?></span></div>
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

<fieldset>
<legend>Изменение данных тикета</legend>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'answer-form',
    'action' => array ('update','id' => $model->id),
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<ol>

	<li>
		<?php echo $form->label($model,'section_id'); ?>
		<?php echo $form->dropDownList($model,'section_id',TicketSection::items (), array ('class' => 'select')); ?>
	</li>


	<li>
		<?php echo $form->label($model,'priority_id'); ?>
		<?php echo $form->dropDownList($model,'priority_id',Lookup::items('TicketPriority'), array ('class' => 'select')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'status_id'); ?>
		<?php echo $form->dropDownList($model,'status_id',Lookup::items('TicketStatus'), array ('class' => 'select')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'staff_id'); ?>
		<?php echo $form->dropDownList($model,'staff_id',Staff::items(), array ('class' => 'select')); ?>
	</li>
</ol>

</fieldset>

	<fieldset class="submit">
        <?php echo CHtml::submitButton('Изменить данные', array ('class' => 'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>


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
     'action' => array ('answer','id' => $model->id),
    'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

<ol>

	<li>
	<div class="validerror">
	    <?php echo $form->errorSummary($answer); ?>
    </div>
    </li>

    <li>
        <input type="button" id="cytate" value=" Цитировать выделенное "> &nbsp;
        <input type="button" id="ascytate" value=" Как цитата " style="font-size:9px;"> &nbsp;
        <input type="button" id="quote1" value=" [QUOTE] " style="font-size:9px;"> &nbsp;
        <input type="button" id="quote2" value=" [/QUOTE] " style="font-size:9px;"> &nbsp;  
        <input type="button" id="noquote" value=" Убрать [QUOTE] " style="font-size:9px;"> &nbsp;        
    </li>

<script type="text/javascript">
<!--
jQuery(function() {
    // Bind the click handler of some button on your page
    jQuery('#cytate').click(function(evt) {
        // Insert the selected text into a given textarea
        var textarea = jQuery('textarea#mainanswer');
        var newtext = textarea.val() + '[QUOTE]' + getSelectedText() + '[/QUOTE]';
        textarea.val(newtext);
        evt.preventDefault();
    });
    
    
    jQuery('#ascytate').click(function(evt) {
        // Insert the selected text into a given textarea        
        var textarea = document.getElementById('mainanswer');
        tag_add (textarea,'[QUOTE]','[/QUOTE]');        
        evt.preventDefault();
    });
    
    jQuery('#quote1').click(function(evt) {
        // Insert the selected text into a given textarea        
        var textarea = document.getElementById('mainanswer');
        tag_add (textarea,'[QUOTE]','');        
        evt.preventDefault();
    });
    
    jQuery('#quote2').click(function(evt) {
        // Insert the selected text into a given textarea        
        var textarea = document.getElementById('mainanswer');
        tag_add (textarea,'','[/QUOTE]');        
        evt.preventDefault();
    });
    
    jQuery('#noquote').click(function(evt) {
        // Insert the selected text into a given textarea        
        var textarea = document.getElementById('mainanswer');
        textarea.value = str_replace ('[QUOTE]','',textarea.value);
        textarea.value = str_replace ('[/QUOTE]','',textarea.value);        
        evt.preventDefault();
    });    
    
    
});

    function str_replace(search, replace, subject) {
     return subject.split(search).join(replace);
    }

	function tag_add(obj, str1, str2){ 
	obj.focus();  
	// Для IE 
	if(document.selection)  
	 { 
	 var s = document.selection.createRange(); 
         if(s.text) 
	  { 
	  s.text = str1 + s.text + str2; 
	  } 
	 else
	  { 
	  obj.value = obj.value + str1 + str2; 
	  } 
	 return true; 
	 } 
	// Opera, FireFox 
	else if (typeof(obj.selectionStart) == "number") 
	 { 
	  var start = obj.selectionStart; 
	  var end = obj.selectionEnd; 
	  s = obj.value.substr(start,end-start); 
	  obj.value = obj.value.substr(0, start) + str1 + s + str2 + obj.value.substr(end); 
	 return true; 
	 } 
	 return false; 
	}

// Get user selection text on page
function getSelectedText() {
    if (window.getSelection) {
        return window.getSelection();
    }
    else if (document.selection) {
        return document.selection.createRange().text;
    }
    return '';
}
//-->
</script>

	<li>
    <div class="row">
        <?php echo $form->labelEx($answer,'message'); ?>
        <?php echo $form->textArea($answer,'message',array('rows'=>12, 'cols'=>50, 'class' => 'textarea', 'id' => 'mainanswer')); ?>
        <?php echo $form->error($answer,'message'); ?>
    </div>
    </li>

	<li>
		<?php echo $form->label($answer,'status_id',array ('label' => 'Статус после ответа')); ?>
		<?php echo $form->dropDownList($answer,'status_id',Lookup::items('TicketStatus'), array ('class' => 'select')); ?>
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


<?= $taa ?>
</li>


</ol>

</fieldset>

<?php endif; ?>

</div>

<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>support/">Служба Поддержки</a></p>
</div>