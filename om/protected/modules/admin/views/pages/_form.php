<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'page-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>    
		<?php echo $form->labelEx($model,'psevdo'); ?>
		<?php echo $form->textField($model,'psevdo',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'psevdo'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</li>
        
	<li>
		<?php echo $form->labelEx($model,'visible',array('label' => 'Показывать?')); ?>
		<?php echo $form->dropDownList($model,'visible',Lookup::items('Visible'), array ('class' => 'select')); ?>
		<?php echo $form->error($model,'visible'); ?>
        </li>
</ol>
</fieldset>

<fieldset>
    <legend>Содержимое странички</legend>

    <?php $this->widget('application.extensions.my.ckeditor.CKEditor', array(
'model'=>$model,
'attribute'=>'content',
'language'=>'ru',
'editorTemplate'=>'full',
)); ?>


</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->