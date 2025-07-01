<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<fieldset>

<legend>Поиск</legend>

<ol>

	<li>
		<?php echo $form->label($model,'firstName'); ?>
		<?php echo $form->textField($model,'firstName',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('class'=>'text')); ?>
	</li>

</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->