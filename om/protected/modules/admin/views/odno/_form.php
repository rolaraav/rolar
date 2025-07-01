<?php
/* @var $this OdnoController */
/* @var $model Odno */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'odno-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Основные данные</legend>

<ol>

	<li>    

		<?php echo $form->labelEx($model,'good_id'); ?>
		<?php echo $form->textField($model,'good_id',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'good_id'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'dost'); ?>
		<?php echo $form->textField($model,'dost',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'dost'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'oldprice'); ?>
		<?php echo $form->textField($model,'oldprice'); ?>
		<?php echo $form->error($model,'oldprice'); ?>
	</li>
</ol>
</fieldset>
    
    <p>&nbsp;</p>
        
<fieldset>

<legend>Отзывы</legend>

<ol>
        

	<li>
		<?php echo $form->labelEx($model,'otz1'); ?>
		<?php echo $form->textArea($model,'otz1',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'otz1'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'otz2'); ?>
		<?php echo $form->textArea($model,'otz2',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'otz2'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'otz3'); ?>
		<?php echo $form->textArea($model,'otz3',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'otz3'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'otz4'); ?>
		<?php echo $form->textArea($model,'otz4',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'otz4'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'otz5'); ?>
		<?php echo $form->textArea($model,'otz5',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'otz5'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'otz6'); ?>
		<?php echo $form->textArea($model,'otz6',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'otz6'); ?>
	</li>

</ol>
</fieldset>
    
    <p>&nbsp;</p>
        
<fieldset>

<legend>Дополнительные поля</legend>

<ol>
	<li>
		<?php echo $form->labelEx($model,'vkgroup'); ?>
		<?php echo $form->textField($model,'vkgroup',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'vkgroup'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'footer'); ?>
		<?php echo $form->textArea($model,'footer',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'footer'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'video'); ?>
		<?php echo $form->textField($model,'video',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'video'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
		<?php echo $form->error($model,'height'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'width'); ?>
		<?php echo $form->textField($model,'width'); ?>
		<?php echo $form->error($model,'width'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'zag1'); ?>
		<?php echo $form->textField($model,'zag1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'zag1'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'block1'); ?>
		<?php echo $form->textField($model,'block1',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'block1'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'block1data'); ?>
		<?php echo $form->textArea($model,'block1data',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'block1data'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'block2'); ?>
		<?php echo $form->textField($model,'block2',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'block2'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'block2data'); ?>
		<?php echo $form->textArea($model,'block2data',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'block2data'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'block3'); ?>
		<?php echo $form->textField($model,'block3',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'block3'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'block3data'); ?>
		<?php echo $form->textArea($model,'block3data',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'block3data'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'preorder'); ?>
		<?php echo $form->textField($model,'preorder',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'preorder'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'currency'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'imgcount'); ?>
		<?php echo $form->textField($model,'imgcount'); ?>
		<?php echo $form->error($model,'imgcount'); ?>
	</li>

	<li>
		<?php echo $form->labelEx($model,'visible'); ?>
		<?php echo $form->dropDownList($model,'visible',Lookup::items('visible')); ?>
		<?php echo $form->error($model,'visible'); ?>
        </li>
</ol>
</fieldset>

<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->