<?php
/* @var $this LogController */
/* @var $model Log */
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
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'action'); ?>
		<?php echo $form->dropDownList($model,'action',Lookup::items ('log',true)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'user'); ?>
		<?php echo $form->dropDownList($model,'user',Staff::items()); ?>
	</li>

	<li>
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
	</li>
</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>
    
</fieldset>    

<?php $this->endWidget(); ?>

</div><!-- search-form -->