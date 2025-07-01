<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<fieldset>

<legend>Поиск</legend>


<ol>

	<li>
	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id', array ('class' => 'text')); ?>
	</div>
    </li>

	<li>
	<div class="row">
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class' => 'longtext')); ?>
	</div>
    </li>

	<li>
	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50,'class' => 'textarea')); ?>
	</div>
    </li>
    
	<li>
	<div class="row">
		<?php echo $form->label($model,'visible'); ?>
		<?php echo $form->dropDownList($model,'visible',Lookup::items('Visible'), array ('class' => 'select', 'empty' => '')); ?>
	</div>
    </li>    

	<li>
	<div class="row">
		<?php echo $form->label($model,'position'); ?>
		<?php echo $form->textField($model,'position', array ('class' => 'text')); ?>
	</div>
    </li>

</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<?php echo CHtml::submitButton(' Поиск ', array ('class' => 'submit')); ?>
	</div>
    
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- search-form -->