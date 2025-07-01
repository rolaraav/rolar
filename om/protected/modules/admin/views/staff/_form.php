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
		<?= $form->labelEx($model,'username'); ?>
		<?= $form->textField($model,'username',array('class'=>'text')); ?>
		<?= $form->error($model,'username'); ?>
	</li>
    
    <li>
        <?php echo $form->labelEx($model,'password', array('label' => 'Пароль')); ?>
        <?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
        <?php echo $form->error($model,'password'); ?>
    </li>
    
    <li>
        <?php echo $form->labelEx($model,'passwordRepeat'); ?>
        <?php echo $form->passwordField($model,'passwordRepeat',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
        <?php echo $form->error($model,'passwordRepeat'); ?>
    </li>        
    
    <li>&nbsp;</li>

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



</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->