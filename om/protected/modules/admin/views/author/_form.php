<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'author-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные автора</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'id'); ?>
		<?= $form->textField($model,'id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'password'); ?>
		<?= $form->textField($model,'password',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'password'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'email'); ?>
		<?= $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'email'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'uname'); ?>
		<?= $form->textField($model,'uname',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'uname'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'purse'); ?>
		<?= $form->textField($model,'purse',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'purse'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'kind'); ?>
		<?= $form->dropDownList($model,'kind',Lookup::items ('Purse'), array('class' => 'text')); ?>
		<?= $form->error($model,'kind'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->