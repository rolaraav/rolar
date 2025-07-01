<?php
/* @var $this RlettersController */
/* @var $model RassLetter */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rass-letter-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<fieldset>

<legend>Основные данные</legend>

<ol>

	<li>
		<?php echo $form->labelEx($model,'rass_id'); ?>
		<?php echo $form->dropDownList($model,'rass_id',Rass::items ()); ?>
		<?php echo $form->error($model,'rass_id'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>12, 'cols'=>42)); ?>
		<?php echo $form->error($model,'content'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'hours'); ?>
		<?php echo $form->textField($model,'hours'); ?>
		<?php echo $form->error($model,'hours'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comment'); ?>
        </li>
        
        
        <?php if ($model->isNewRecord): ?>
        <li><br>
        <label>&nbsp;</label>
        <input type="checkbox" class="checkbox" name="add" value="1" checked> Добавить это письмо в очередь текущим подписчикам
        </li>
        
        <?php endif; ?>
</ol>
</fieldset>
    
    

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>
    
    <br>
    <p style="font-size:10px;"> Подсказка: используйте <b>%name%</b> макрос для подстановки имени человека в тексте или теме письма.</p>

</div><!-- form -->