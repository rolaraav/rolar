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
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'bill_id'); ?>
		<?php echo $form->textField($model,'bill_id',array('size'=>20,'maxlength'=>20, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'good_id'); ?>
		<?php echo $form->textField($model,'good_id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>
        
	<li>
		<?php echo $form->label($model,'kanal'); ?>
		<?php echo $form->textField($model,'kanal',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>        

	<li>
		<?php echo $form->label($model,'cena'); ?>
		<?php echo $form->textField($model,'cena',array('class'=>'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'partner_id'); ?>
		<?php echo $form->textField($model,'partner_id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->