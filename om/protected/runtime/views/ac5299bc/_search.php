<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\good\_search.php */ ?>
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
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'image'); ?>
		<?php echo $form->textField($model,'image',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('class'=>'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'affLink'); ?>
		<?php echo $form->textField($model,'affLink',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'dlink'); ?>
		<?php echo $form->textField($model,'dlink',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->