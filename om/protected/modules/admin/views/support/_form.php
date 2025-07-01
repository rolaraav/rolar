<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticket-form',
	'enableAjaxValidation'=>false,        
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'section_id'); ?>
		<?= $form->textField($model,'section_id',array('class'=>'text')); ?>
		<?= $form->error($model,'section_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'subject'); ?>
		<?= $form->textField($model,'subject',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'subject'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'message'); ?>
		<?= $form->textArea($model,'message',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'message'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'firstName'); ?>
		<?= $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'firstName'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'email'); ?>
		<?= $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'email'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'priority_id'); ?>
		<?= $form->textField($model,'priority_id',array('class'=>'text')); ?>
		<?= $form->error($model,'priority_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'status_id'); ?>
		<?= $form->textField($model,'status_id',array('class'=>'text')); ?>
		<?= $form->error($model,'status_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'createTime'); ?>
		<?= $form->textField($model,'createTime',array('class'=>'text')); ?>
		<?= $form->error($model,'createTime'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'staff_id'); ?>
		<?= $form->textField($model,'staff_id',array('class'=>'text')); ?>
		<?= $form->error($model,'staff_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'ip'); ?>
		<?= $form->textField($model,'ip',array('size'=>50,'maxlength'=>50, 'class' => 'text')); ?>
		<?= $form->error($model,'ip'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->