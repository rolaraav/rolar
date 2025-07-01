<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'letter-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Письмо</legend>

<ol>

        <?php if ($model->isNewRecord): ?>
	<li>
		<?= $form->labelEx($model,'id'); ?>
		<?= $form->textField($model,'id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'id'); ?>
	</li>    
        <?php endif; ?>

	<li>
		<?= $form->labelEx($model,'description'); ?>
		<?= $form->textField($model,'description',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'description'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'subject'); ?>
		<?= $form->textField($model,'subject',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'subject'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'message'); ?>
		<?= $form->textArea($model,'message',array('rows'=>15, 'cols'=>55, 'class' => 'textarea')); ?>
		<?= $form->error($model,'message'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',Letter::types(), array ('class' => 'select')); ?>
		<?php echo $form->error($model,'type'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'lon'); ?>
		<?php echo $form->dropDownList($model,'lon',Lookup::items('Visible'), array ('class' => 'select')); ?>
		<?php echo $form->error($model,'lon'); ?>
	</li>

</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->