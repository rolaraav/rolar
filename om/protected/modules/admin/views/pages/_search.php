<?php
/* @var $this PagesController */
/* @var $model Page */
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
		<?php echo $form->label($model,'psevdo'); ?>
		<?php echo $form->textField($model,'psevdo',array('size'=>60,'maxlength'=>100)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</li>

	<li>
		<?php echo $form->label($model,'visible'); ?>
		<?php echo $form->dropDownList($model,'visible',Lookup::items ('Visible'), array('class'=>'text', 'empty' => '')); ?>
	</li>

</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
    
<?php $this->endWidget(); ?>

</div><!-- search-form -->