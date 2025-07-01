<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<fieldset>

<legend>Поиск</legend>

<ol>

	<li>
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'subject'); ?>
		<?php echo $form->textField($model,'subject',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type',Letter::types(), array ('class' => 'select',  'empty' => '')); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'lon'); ?>
		<?php echo $form->dropDownList($model,'lon',Lookup::items('Visible'), array ('class' => 'select', 'empty' => '')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->