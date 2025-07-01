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
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>
        
	<li>
		<?php echo $form->label($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',CuponCategory::items (), array('class' => 'select','empty' => '')); ?>
	</li>        
        
	<li>
		<?php echo $form->label($model,'good_id'); ?>
		<?php echo $form->textField($model,'good_id',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>        

	<li>
		<?php echo $form->label($model,'sum'); ?>
		<?php echo $form->textField($model,'sum',array('class'=>'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'selfDelete'); ?>
		<?php echo $form->dropDownList($model,'selfDelete',Lookup::items ('Visible'), array('class'=>'text', 'empty' => '')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->