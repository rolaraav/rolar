<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/paysystems\_smscoin.php */ ?>
<fieldset>

<legend>Параметры приёма SMS-платежей через SMS Coin</legend>

<img src="<?=Y::bu()?>images/admin/pay/sms.gif" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'paySmsOn'); ?>
        <?php echo $form->checkBox($model,'paySmsOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'paySmsId'); ?>
        <?php echo $form->textField($model,'paySmsId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'paySmsId'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'paySmsKey'); ?>
        <?php echo $form->textField($model,'paySmsKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'paySmsKey'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'paySmsUrl'); ?>
        <?php echo $form->textField($model,'paySmsUrl',array('size'=>60,'maxlength'=>250, 'class' => 'longtext')); ?>
        <?php echo $form->error($model,'paySmsUrl'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'paySmsCost'); ?>
        <?php echo $form->checkBox($model,'paySmsCost',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li>



    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','sms') ?>
<br>

<fieldset>
<legend>Данные для настройки услуги смс:банк</legend>
<ol>

<li>
<label>Success URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/sms/ok</div>
</li>

<li>
<label>Метод Success URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Fail URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/sms/fail</div>
</li>

<li>
<label>Метод Fail URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Result URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/sms</div>
</li>

<li>
<label>Метод Result URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Задержка:</label>
<div class="systemparam">5 (рекомендуется)</div>
</li>

<li>
<label>Активен:</label>
<div class="systemparam">да</div>
</li>

</ol>
</fieldset>
</div>

<br />
