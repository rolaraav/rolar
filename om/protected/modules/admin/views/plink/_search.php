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
		<?php echo $form->textField($model,'id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'plink'); ?>
		<?php echo $form->textField($model,'plink',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->