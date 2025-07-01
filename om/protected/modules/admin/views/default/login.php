<?php $this->pageTitle='Панель администратора - Вход' ?>

<div class="wrap">

<h1>Вход - Панель администратора</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
)); ?>

<fieldset>

<legend>Вход в Панель Управления</legend>

<ol>

<li>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array ('class' => 'text')); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

</li>

<li>    

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array ('class' => 'text')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
    
</li>

</ol>

</fieldset>

<fieldset class="submit">
	<div class="row buttons">
		<?php echo CHtml::submitButton('Выполнить вход', array ('class' => 'submit')); ?>
	</div>
</fieldset>


<?php $this->endWidget(); ?>
</div><!-- form -->

</div>

<div class="wrap">
<p align="center">&nbsp; &nbsp; &nbsp; <a href="<?= Y::bu() ?>admin/forgot">Забыли пароль?</a></p>
</div>