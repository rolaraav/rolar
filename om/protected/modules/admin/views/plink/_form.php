<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'plink-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>
    
	<li>
		<?= $form->labelEx($model,'id'); ?>
		<?= $form->textField($model,'id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'id'); ?>
	</li>    

	<li>
		<?= $form->labelEx($model,'plink'); ?>
		<?= $form->textField($model,'plink',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'plink'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->