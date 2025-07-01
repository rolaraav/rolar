<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'staff-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?php echo $form->labelEx($model,'good_id'); ?>
		<?= $form->dropDownList($model,'good_id',Good::items(),array('class' => 'select')); ?>
		<?php echo $form->error($model,'good_id'); ?>
        </li>

        <li>
		<?php echo $form->labelEx($model,'newgood_id'); ?>
		<?= $form->dropDownList($model,'newgood_id',Good::items(),array('class' => 'select')); ?>
		<?php echo $form->error($model,'newgood_id'); ?>
        </li>

        <li>
		<?php echo $form->labelEx($model,'sum'); ?>
		<?php echo $form->textField($model,'sum', array ('class' => 'numeric')); ?>
		<?php echo $form->error($model,'sum'); ?>
        </li>

        <li>
		<?php echo $form->labelEx($model,'valuta'); ?>
		<?= $form->dropDownList($model,'valuta',Lookup::items ('Valuta'), array('class' => 'select')); ?>
		<?php echo $form->error($model,'valuta'); ?>
	</li>



</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->