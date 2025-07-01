<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'anew-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Содержимое новости</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'content'); ?>
		<?= $form->textArea($model,'content',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'content'); ?>
	</li>

</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->