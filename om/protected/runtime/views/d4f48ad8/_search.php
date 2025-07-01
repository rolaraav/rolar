<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\client\_search.php */ ?>
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
		<?php echo $form->textField($model,'good_id',array('size'=>50,'maxlength'=>50, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'uname'); ?>
		<?php echo $form->textField($model,'uname',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'amail'); ?>
		<?php echo $form->textField($model,'amail',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'subscribe'); ?>
		<?php echo $form->dropDownList($model,'subscribe',H::emp(Lookup::items('Visible')), array('class'=>'select')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'bill_id'); ?>
		<?php echo $form->textField($model,'bill_id',array('size'=>20,'maxlength'=>20, 'class' => 'text')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->