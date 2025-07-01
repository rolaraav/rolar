<?php
/* @var $this RsubController */
/* @var $model RassSub */
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
		<?php echo $form->label($model,'rass_id'); ?>
		<?php echo $form->textField($model,'rass_id'); ?>
	</li>

        <li>		<?php echo $form->label($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
	</li>

        <li>		<?php echo $form->label($model,'letter_id'); ?>
		<?php echo $form->textField($model,'letter_id'); ?>
        </li>
</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- search-form -->