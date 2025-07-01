<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\way\_form.php */ ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'way-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>
    
	<li>
		<?= $form->labelEx($model,'way_id'); ?>
		<?= $form->textField($model,'way_id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'way_id'); ?>
	</li>    

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'code'); ?>
		<?= $form->textArea($model,'code',array('rows'=>15, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'code'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->