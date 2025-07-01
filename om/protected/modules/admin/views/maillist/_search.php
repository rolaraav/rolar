<?php
/* @var $this MaillistController */
/* @var $model Rass */
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
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'good_id'); ?>
		<?php echo $form->textField($model,'good_id',array('size'=>60,'maxlength'=>100)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>

        </li>
</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
    

<?php $this->endWidget(); ?>

</div><!-- search-form -->