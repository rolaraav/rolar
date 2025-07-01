<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
                <?= $form->hiddenField($model,'area_id'); ?>
		<?= $form->labelEx($model,'username'); ?>
		<?= $form->textField($model,'username',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'username'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'password'); ?>
		<?= $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'password'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'email'); ?>
		<?= $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'email'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->