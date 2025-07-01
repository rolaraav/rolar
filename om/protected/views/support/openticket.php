<?php $this->pageTitle='Просмотр существующего тикета' ?>

<div class="wrap">

<h3>Служба поддержки</h3>

<h1>Просмотр существующего тикета</h1>

<p align="center"><img style="margin:15px;" src="<?= Y::bu() ?>images/front/support/exists.jpg" /></p>

<p align="center">Введите ID отправленного Вами запроса:</p>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
)); ?>

<fieldset>
<legend>Данные запроса</legend>

<ol>

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('size'=>60,'maxlength'=>12, 'class' => 'text')); ?>
        <?php echo $form->error($model,'id'); ?>
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
        <?php echo CHtml::submitButton('Просмотреть тикет', array ('class' => 'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div>

<div class="wrap">
<p align="center"><a href="<?= Y::bu() ?>support/">Служба Поддержки</a></p>
</div>