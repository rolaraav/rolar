<?php $this->pageTitle='Вход' ?>

<div class="wrap">

    <h3>Закрытая зона</h3>

<h1>Вход в Закрытую Зону</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
)); ?>

<fieldset>

<legend>Вход</legend>

<ol>

<li>

		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username', array ('class' => 'text')); ?>
		<?php echo $form->error($model,'username'); ?>
</li>

<li>    
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password', array ('class' => 'text')); ?>
		<?php echo $form->error($model,'password'); ?>
    
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
<p align="center">&nbsp; &nbsp; &nbsp; <a href="<?= Y::bu() ?>area/forgot">Восстановить пароль</a></p>
</div>