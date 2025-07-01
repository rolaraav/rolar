<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'black-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'ip'); ?>
		<?= $form->textField($model,'ip',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
		<?= $form->error($model,'ip'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'email'); ?>
		<?= $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'email'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'phone'); ?>
		<?= $form->textField($model,'phone',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'phone'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'strana'); ?>
		<?= $form->textField($model,'strana',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'strana'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'gorod'); ?>
		<?= $form->textField($model,'gorod',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'gorod'); ?>
	</li>        

	<li>
		<?= $form->labelEx($model,'address'); ?>
		<?= $form->textField($model,'address',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'address'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'comment'); ?>
		<?= $form->textField($model,'comment',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'comment'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->