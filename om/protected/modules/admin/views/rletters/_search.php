<?php
/* @var $this RlettersController */
/* @var $model RassLetter */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
    
<fieldset>

<legend>Поиск</legend>

<ol>

    <li>
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</li>

        <li>
		<?php echo $form->label($model,'rass_id'); ?>
		<?php echo $form->textField($model,'rass_id'); ?>
	</li>

        <li>
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</li>

        <li>
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>30)); ?>
	</li>

        <li>
		<?php echo $form->label($model,'hours'); ?>
		<?php echo $form->textField($model,'hours'); ?>
	</li>

        <li>
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
        </li>            
</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- search-form -->