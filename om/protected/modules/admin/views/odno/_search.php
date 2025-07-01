<?php
/* @var $this OdnoController */
/* @var $model Odno */
/* @var $form CActiveForm */
?>

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
		<?php echo $form->label($model,'good_id'); ?>
		<?php echo $form->textField($model,'good_id',array('size'=>60,'maxlength'=>100)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'dost'); ?>
		<?php echo $form->textField($model,'dost',array('size'=>50,'maxlength'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>50,'maxlength'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
        </li>

        <li>
		<?php echo $form->label($model,'oldprice'); ?>
		<?php echo $form->textField($model,'oldprice'); ?>
        </li>

        <li>
		<?php echo $form->label($model,'otz1'); ?>
		<?php echo $form->textArea($model,'otz1',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'otz2'); ?>
		<?php echo $form->textArea($model,'otz2',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'otz3'); ?>
		<?php echo $form->textArea($model,'otz3',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'otz4'); ?>
		<?php echo $form->textArea($model,'otz4',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'otz5'); ?>
		<?php echo $form->textArea($model,'otz5',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'otz6'); ?>
		<?php echo $form->textArea($model,'otz6',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'vkgroup'); ?>
		<?php echo $form->textField($model,'vkgroup',array('size'=>60,'maxlength'=>100)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'footer'); ?>
		<?php echo $form->textArea($model,'footer',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'video'); ?>
		<?php echo $form->textField($model,'video',array('size'=>60,'maxlength'=>255)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
        </li>

        <li>
		<?php echo $form->label($model,'width'); ?>
		<?php echo $form->textField($model,'width'); ?>
        </li>

        <li>
		<?php echo $form->label($model,'zag1'); ?>
		<?php echo $form->textField($model,'zag1',array('size'=>60,'maxlength'=>255)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'block1'); ?>
		<?php echo $form->textField($model,'block1',array('size'=>60,'maxlength'=>255)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'block1data'); ?>
		<?php echo $form->textArea($model,'block1data',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'block2'); ?>
		<?php echo $form->textField($model,'block2',array('size'=>60,'maxlength'=>255)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'block2data'); ?>
		<?php echo $form->textArea($model,'block2data',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'block3'); ?>
		<?php echo $form->textField($model,'block3',array('size'=>60,'maxlength'=>255)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'block3data'); ?>
		<?php echo $form->textArea($model,'block3data',array('rows'=>6, 'cols'=>50)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'preorder'); ?>
		<?php echo $form->textField($model,'preorder',array('size'=>60,'maxlength'=>255)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'currency'); ?>
		<?php echo $form->textField($model,'currency',array('size'=>40,'maxlength'=>40)); ?>
        </li>

        <li>
		<?php echo $form->label($model,'imgcount'); ?>
		<?php echo $form->textField($model,'imgcount'); ?>
        </li>

</ol>
</fieldset>

<fieldset class="submit">

	<div class="row buttons">
		<input class="submit" type="submit" name="yt0" value=" Поиск " />	</div>
    
</fieldset>
    
<?php $this->endWidget(); ?>

</div><!-- search-form -->