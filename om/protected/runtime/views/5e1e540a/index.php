<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\forgot\index.php */ ?>
<?php $this->pageTitle='Восстановление забытого пароля - Панель администратора' ?>

<div class="wrap">

<h3>Панель Администратора</h3>

<h1>Сброс пароля входа в Панель Администратора</h1>

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
        <?php echo $form->labelEx($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('size'=>60,'maxlength'=>50, 'class' => 'text')); ?>
        <?php echo $form->error($model,'id'); ?>
    </div>    
    </li>
    
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
        <?php echo CHtml::submitButton('Сбросить пароль (подтверждение по e-mail)', array ('class' => 'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div>