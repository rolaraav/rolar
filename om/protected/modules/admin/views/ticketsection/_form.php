<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'default_staff_id'); ?>
		<?= $form->dropDownList($model,'default_staff_id',Staff::items(),array('class'=>'text')); ?>
		<?= $form->error($model,'default_staff_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'position'); ?>
		<?= $form->textField($model,'position',array('class'=>'text')); ?>
		<?= $form->error($model,'position'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->