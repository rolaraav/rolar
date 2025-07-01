<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-paylist-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
                <?= $form->hiddenField($model,'area_id'); ?>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'srok'); ?>
		<?= $form->textField($model,'srok',array('class'=>'numeric')); ?>
		<?= $form->error($model,'srok'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'price'); ?>
		<?= $form->textField($model,'price',array('class'=>'numeric')); ?>
		<?= $form->error($model,'price'); ?>
	</li>



</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->