<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?php echo $form->errorSummary($model); ?></div>

<fieldset>

<legend>Сведения о Категории</legend>

<ol>

	<li>
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'longtext')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>
    </li>

	<li>
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
    </li>

	<li>
	<div class="row">
		<?php echo $form->labelEx($model,'visible',array('label' => 'Отображать в каталоге?')); ?>
		<?php echo $form->dropDownList($model,'visible',Lookup::items('Visible'), array ('class' => 'select')); ?>
		<?php echo $form->error($model,'visible'); ?>
	</div>
    </li>

	<li>
	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position', array ('class' => 'numeric')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>
    </li>
        
</ol>
    
</fieldset>


<fieldset class="submit">
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', array ('class' => 'submit')); ?>
	</div>
    
</fieldset>    

<?php $this->endWidget(); ?>

</div><!-- form -->