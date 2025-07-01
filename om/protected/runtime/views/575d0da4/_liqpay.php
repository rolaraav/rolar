<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/paysystems\_liqpay.php */ ?>
<fieldset>

<legend>Параметры платёжной системы LiqPay</legend>

<img src="<?=Y::bu()?>images/admin/pay/liqpay.jpg" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'payLiqpayOn'); ?>
        <?php echo $form->checkBox($model,'payLiqpayOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'payLiqpayId'); ?>
        <?php echo $form->textField($model,'payLiqpayId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payLiqpayId'); ?>
    </li>
    
    <li>
        <?php echo $form->labelEx($model,'payLiqpayPhone'); ?>
        <?php echo $form->textField($model,'payLiqpayPhone',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payLiqpayPhone'); ?>    </li>
    

    <li>
        <?php echo $form->labelEx($model,'payLiqpayKey'); ?>
        <?php echo $form->textField($model,'payLiqpayKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payLiqpayKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','liq') ?>
<br>

<fieldset>
<legend>Данные для настройки LiqPay - Подключить магазин - Мой магазин - Настройки магазина</legend>
<ol>


<li>
<label>Включить магазин:</label>
<div class="systemparam">да</div>
</li>

<li>
<label>Требовать OrderID:</label>
<div class="systemparam">да</div>
</li>

<li>
<label>Проверять подпись:</label>
<div class="systemparam">да</div>
</li>


</ol>
</fieldset>
</div>

<br />
