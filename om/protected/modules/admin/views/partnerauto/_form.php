<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'partner-auto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'good_id'); ?>
		<?= $form->dropDownList($model,'good_id',Good::sitems (),array('class' => 'select')); ?>
		<?= $form->error($model,'good_id'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'count'); ?>
		<?= $form->textField($model,'count',array('class'=>'numeric')); ?>
		<?= $form->error($model,'count'); ?>
	</li>
       
	<li>
		<?= $form->labelEx($model,'komis'); ?>
		<?= $form->textField($model,'komis',array('class'=>'numeric')); ?>
		<?= $form->error($model,'komis'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'komis_type'); ?>
		<?= $form->dropDownList($model,'komis_type',Lookup::items ('KomisType'),array('class'=>'select')); ?>
		<?= $form->error($model,'komis_type'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->