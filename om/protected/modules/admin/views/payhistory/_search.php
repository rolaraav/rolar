<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<fieldset>

<legend>Поиск</legend>

<ol>

	<li>
		<?php echo $form->label($model,'theid'); ?>
		<?php echo $form->textField($model,'theid',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        </li>

	<li>
		<?php echo $form->label($model,'way'); ?>
		<?php echo $form->textField($model,'way',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        </li>
        
	<li>
		<?php echo $form->label($model,'rekv'); ?>
		<?php echo $form->textField($model,'rekv',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
        </li>

	<li>
		<?php echo $form->label($model,'sum'); ?>
		<?php echo $form->textField($model,'sum', array('class' => 'numeric')); ?>
        </li>

</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
    
<?php $this->endWidget(); ?>

</div><!-- search-form -->