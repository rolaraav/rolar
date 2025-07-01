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
		<?php echo $form->textField($model,'id'); ?>
	</li>

	<li>
		<?php echo $form->label($model,'pincat_id'); ?>
		<?php echo $form->textField($model,'pincat_id'); ?>
	</li>

	<li>
		<?php echo $form->label($model,'added'); ?>
		<?php echo $form->textField($model,'added'); ?>
	</li>

	<li>
		<?php echo $form->label($model,'used'); ?>
		<?php echo $form->dropDownList($model,'used',Lookup::items ('Visible'), array('class'=>'text', 'empty' => '')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'client_id'); ?>
		<?php echo $form->textField($model,'client_id'); ?>
	</li>

	<li>
		<?php echo $form->label($model,'code'); ?>
		<?php echo $form->textField($model,'code',array('size'=>60,'maxlength'=>255)); ?>
	</li>

</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- search-form -->