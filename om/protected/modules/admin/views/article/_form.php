<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'article-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="validerror"><?= $form->errorSummary($model); ?>
</div>

<fieldset>

<legend>Данные</legend>

<ol>

	<li>
		<?= $form->labelEx($model,'category_id'); ?>
		<?= $form->dropDownList($model,'category_id',ArticleCategory::items(), array('class'=>'text')); ?>
		<?= $form->error($model,'category_id'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'title'); ?>
		<?= $form->textField($model,'title',array('size'=>60,'maxlength'=>255, 'class' => 'longtext')); ?>
		<?= $form->error($model,'title'); ?>
	</li>

	<li>
		<?= $form->labelEx($model,'position'); ?>
		<?= $form->textField($model,'position',array('class'=>'numeric')); ?>
		<?= $form->error($model,'position'); ?>
	</li>
        
	<li>
		<?php echo $form->labelEx($model,'visible',array('label' => 'Показывать?')); ?>
		<?php echo $form->dropDownList($model,'visible',Lookup::items('Visible'), array ('class' => 'select')); ?>
		<?php echo $form->error($model,'visible'); ?>
        </li>
        



</ol>
</fieldset>

<fieldset>
    <legend>Текст статьи</legend>

    <?php $this->widget('application.extensions.my.ckeditor.CKEditor', array(
'model'=>$model,
'attribute'=>'content',
'language'=>'ru',
'editorTemplate'=>'full',
)); ?>


</fieldset>


<fieldset class="submit">
		<?= CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить изменения', array ('class' => 'submit')); ?>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->