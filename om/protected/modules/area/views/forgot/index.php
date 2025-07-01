<?php $this->pageTitle='Восстановление забытого пароля - Закрытая зона' ?>

<div class="wrap">

<h3>Закрытая зона</h3>

<h1>Восстановление забытого пароля</h1>

<p align="center"><img style="margin:15px;" src="<?= Y::bu() ?>images/front/aff/question.png" /></p>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
)); ?>

<fieldset>
<legend>Ваши данные</legend>

<ol>
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>120, 'class' => 'text')); ?>
        <?php echo $form->error($model,'email'); ?>
    </div>    
    </li>    

<li>
<?php if (extension_loaded('gd')) {?>
	<div class="row">
		<?php echo $form->labelEx($model, 'verifyCode', array ('style' => 'padding-top:15px'));?>
			<?php echo $form->textField($model, 'verifyCode', array ('class' => 'text'));?>        
			<?php $this->widget('CCaptcha', array(			
					'clickableImage' => TRUE,					
					'buttonLabel' => '',
					'imageOptions' => array ('style' => 'vertical-align:middle'),
					));?>    

		<?php echo $form->error($model, 'verifyCode');?>
		</div>
<?php }?>    
</li>

</ol>

</fieldset>

	<fieldset class="submit">
        <?php echo CHtml::submitButton('Выслать пароль на E-mail', array ('class' => 'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div>

<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>area/">Закрытая зона</a></p>
</div>