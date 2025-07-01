<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/paysystems\_sprypay.php */ ?>
<fieldset>

<legend>Параметры платёжной системы SpryPay</legend>

<img src="<?=Y::bu()?>images/admin/pay/sprypay.gif" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'paySprypayOn'); ?>
        <?php echo $form->checkBox($model,'paySprypayOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'paySprypayId'); ?>
        <?php echo $form->textField($model,'paySprypayId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'paySprypayId'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'paySprypayKey'); ?>
        <?php echo $form->textField($model,'paySprypayKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'paySprypayKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','spry'); ?>
<br>

<fieldset>
<legend>Настройка уведомления на сайте SpryPay</legend>
<ol>
    
<li>
<label>Success URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/sprypay/ok</div>
</li>

<li>
<label>Метод Success URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Fail URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/sprypay/fail</div>
</li>

<li>
<label>Метод Fail URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>IPN URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/sprypay</div>
</li>

<li>
<label>Метод IPN URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Состояние магазина:</label>
<div class="systemparam">вкл</div>
</li>

</ol>
</fieldset>
</div>

<br />
