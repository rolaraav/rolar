<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ad-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'good_id'); ?>
		<?= $form->dropDownList($model,'good_id',Good::items (), array('class' => 'select')); ?>
		<?= $form->error($model,'good_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'text')); ?>
		<?= $form->error($model,'title'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'code'); ?>
		<?= $form->textArea($model,'code',array('rows'=>6, 'cols'=>50, 'class' => 'textarea')); ?>
		<?= $form->error($model,'code'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'adcategory_id'); ?>
		<?= $form->dropDownList($model,'adcategory_id',AdCategory::items (), array('class'=>'select')); ?>
		<?= $form->error($model,'adcategory_id'); ?>
	</li>
        
	<li>
		<?= $form->labelEx($model,'position'); ?>
		<?= $form->textField($model,'position',array('class'=>'numeric')); ?>
		<?= $form->error($model,'position'); ?>
	</li>
        
	<li>
		<?php echo $form->labelEx($model,'showcode',array('label' => 'Показывать код?')); ?>
		<?php echo $form->dropDownList($model,'showcode',Lookup::items('Visible'), array ('class' => 'select')); ?>
		<?php echo $form->error($model,'showcode'); ?>
                <span class="hint">Если установить эту опцию - будет показываться код для копирования.<br><br> Если опция установлена в значение "нет", то не будет отображаться поле с кодом для копирования, а только собственно сам предпросмотр кода (т.е. собственно HTML-код передастся браузеру).</span>
        </li>
        


</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->