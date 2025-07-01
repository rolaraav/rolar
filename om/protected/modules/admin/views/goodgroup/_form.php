<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'good-group-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'group_id'); ?>
		<?= $form->textField($model,'group_id',array('class'=>'text')); ?>
		<?= $form->error($model,'group_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'good_id'); ?>
		<?= $form->dropDownList($model,'good_id',Good::items(),array('class' => 'select')); ?>
		<?= $form->error($model,'good_id'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->