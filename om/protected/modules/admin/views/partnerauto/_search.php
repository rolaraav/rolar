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
		<?php echo $form->textField($model,'id',array('class'=>'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'good_id'); ?>
		<?php echo $form->textField($model,'good_id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'count'); ?>
		<?php echo $form->textField($model,'count',array('class'=>'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'komis'); ?>
		<?php echo $form->textField($model,'komis',array('class'=>'numeric')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'komis_type'); ?>
		<?php echo $form->dropDownList($model,'komis_type',H::emp(Lookup::items('KomisType')),array('class'=>'select')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->