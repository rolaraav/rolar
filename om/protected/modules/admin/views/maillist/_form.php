<?php
/* @var $this MaillistController */
/* @var $model Rass */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rass-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Основные данные</legend>

<ol>

	<li>
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class' => 'text')); ?>
		<?php echo $form->error($model,'title'); ?>
	</li>

	<li>		<?php echo $form->labelEx($model,'good_id'); ?>
		<?php echo $form->dropDownList($model,'good_id',Good::items(),array ('class' => 'select')); ?>
		<?php echo $form->error($model,'good_id'); ?>
	</li>

	<li>		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active',Lookup::items("Visible"),array ('class' => 'select')); ?>
		<?php echo $form->error($model,'active'); ?>
        </li>
</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->