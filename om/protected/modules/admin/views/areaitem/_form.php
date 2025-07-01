<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'area-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'area_section_id'); ?>
                <?= $form->hiddenField($model,'area_id'); ?>
		<?= $form->dropDownList($model,'area_section_id',AreaSection::items($area_id),array('class'=>'text')); ?>
		<?= $form->error($model,'area_section_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'description'); ?>
		<?= $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'description'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'icon'); ?>
		<?= $form->dropDownList($model,'icon',H::directoryMap ('./images/area_icons/',TRUE),array('class' => 'text')); ?>
		<?= $form->error($model,'icon'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'filename'); ?>
		<?= $form->textField($model,'filename',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'filename'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'position'); ?>
		<?= $form->textField($model,'position',array('class'=>'numeric')); ?>
		<?= $form->error($model,'position'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'size'); ?>
		<?= $form->textField($model,'size',array('size'=>40,'maxlength'=>40, 'class' => 'numeric')); ?>
		<?= $form->error($model,'size'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->