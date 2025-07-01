<?php $this->pageTitle='Уведомление об оплате счёта' ?>

<div class="wrap">

<h3>Уведомление об оплате счёта</h3>

<h1>Отправка уведомления о совершении оплаты вручную</h1>

<p>&nbsp;</p>

<p style="font-size:14px; line-height:170%;">Если Вы совершили оплату ручным переводом напрямую продавцу (не через мерчанты и/или посредников), - то с помощью данной формы Вы можете отправить запрос администратору, чтобы он нашёл Ваш платёж - и отметил Ваш счёт как оплаченный.</p>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p style="color:#CC0000"><b>Счёт №<?=$bill->id?> от <?=H::date($bill->createDate)?></b></p><br>
<p>Ваш e-mail: <b><?=CHtml::encode ($bill->email)?></b></p>

<br><br>

<p style="font-size:14px; line-height:170%;">Пожалуйста, укажите как можно больше сведений о Вашем переводе: дата и время суток; точная сумма; кошелёк, с которого был перевод; назначение платежа и др. Это ускорит процесс поиска платежа.</p>

<br><br>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'notify-form',
    'enableAjaxValidation'=>false,
)); ?>

<fieldset>
<legend>Данные запроса</legend>

<ol>

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'way'); ?>
        <?php echo $form->textField($model,'way',array('size'=>60,'maxlength'=>12, 'class' => 'longtext')); ?>
        <?php echo $form->error($model,'way'); ?>
    </div>    
    </li>
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'message'); ?>
        <?php echo $form->textArea($model,'message',array('cols'=>50,'rows'=>12, 'class' => 'textarea')); ?>
        <?php echo $form->error($model,'message'); ?>
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
        <?php echo CHtml::submitButton('Отправить сообщение', array ('class' => 'submit')); ?>
	</fieldset>

<?php $this->endWidget(); ?>

</div>


</div>