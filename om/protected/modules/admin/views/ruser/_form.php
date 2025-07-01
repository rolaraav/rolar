<?php
/* @var $this RlettersController */
/* @var $model RassLetter */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ruser-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<fieldset>

<legend>Основные данные</legend>

<ol>

	<li>
		<?php echo $form->labelEx($model,'rass_id'); ?>
		<?php echo $form->dropDownList($model,'rass_id',Rass::items ()); ?>
		<?php echo $form->error($model,'rass_id'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'uname'); ?>
		<?php echo $form->textField($model,'uname',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?php echo $form->error($model,'uname'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?php echo $form->error($model,'email'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'sub'); ?>
    <?php echo $form->dropDownList($model,'sub',Lookup::items ('Visible'),array('class'=>'text')); ?>
		<?php echo $form->error($model,'sub'); ?>
	</li>

  <li>
  <?php echo $form->labelEx($model,'date'); ?>
  <?php $this->widget('zii.widgets.jui.CJuiDatePicker', Ars::datePicker ('Ruser[date]',$model->date)); ?>
  <?php echo $form->error($model,'date'); ?>
  </li>

  <li>
  <?php echo $form->labelEx($model,'unsubdate'); ?>
  <?php $this->widget('zii.widgets.jui.CJuiDatePicker', Ars::datePicker ('Ruser[unsubdate]',$model->unsubdate)); ?>
  <?php echo $form->error($model,'unsubdate'); ?>
  </li>



</ol>
</fieldset>

<fieldset class="submit">
  <?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>


<?php $this->endWidget(); ?>
    


</div><!-- form -->