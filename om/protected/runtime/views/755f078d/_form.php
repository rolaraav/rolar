<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\waylist\_form.php */ ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'way-list-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'category'); ?>
		<?= $form->textField($model,'category',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'category'); ?>
	</li>        

	<li>
		<?= $form->labelEx($model,'pic'); ?>
		<?= $form->textField($model,'pic',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'pic'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'url'); ?>
		<?= $form->textField($model,'url',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'url'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'ways'); ?>
		<?= $form->textField($model,'ways',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'ways'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'position'); ?>
		<?= $form->textField($model,'position',array('class'=>'numeric')); ?>
		<?= $form->error($model,'position'); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->