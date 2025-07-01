<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\bill\_search.php */ ?>
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
		<?php echo $form->label($model,'sum'); ?>
		<?php echo $form->textField($model,'sum',array('class'=>'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'valuta'); ?>
		<?php echo $form->dropDownList($model,'valuta',H::emp(Lookup::items('Valuta')),array('class' => 'select')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'cupon'); ?>
		<?php echo $form->textField($model,'cupon',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'status_id'); ?>
		<?php echo $form->dropDownList($model,'status_id',H::emp(Lookup::items('Status')),array('class' => 'select')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'amail'); ?>
		<?php echo $form->textField($model,'amail',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'uname'); ?>
		<?php echo $form->textField($model,'uname',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'otchestvo'); ?>
		<?php echo $form->textField($model,'otchestvo',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'strana'); ?>
		<?php echo $form->textField($model,'strana',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'gorod'); ?>
		<?php echo $form->textField($model,'gorod',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'postindex'); ?>
		<?php echo $form->textField($model,'postindex',array('size'=>30,'maxlength'=>30, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'ip'); ?>
		<?php echo $form->textField($model,'ip',array('size'=>60,'maxlength'=>100, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'way'); ?>
		<?php echo $form->textField($model,'way',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'postNumber'); ?>
		<?php echo $form->textField($model,'postNumber',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'orderCount'); ?>
		<?php echo $form->textField($model,'orderCount',array('class'=>'text')); ?>
	</li>

	<li>
		<?php echo $form->label($model,'notifySent'); ?>
		<?php echo $form->textField($model,'notifySent',array('class'=>'text')); ?>
	</li>


</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
<?php $this->endWidget(); ?>

</div><!-- search-form -->