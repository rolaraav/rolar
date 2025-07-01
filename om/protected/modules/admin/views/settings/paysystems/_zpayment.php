<fieldset>

<legend>Параметры приёма платежей через Z-Payment</legend>

<img src="<?=Y::bu()?>images/admin/pay/zpayment.gif" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'payZpaymentOn'); ?>
        <?php echo $form->checkBox($model,'payZpaymentOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'payZpaymentId'); ?>
        <?php echo $form->textField($model,'payZpaymentId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payZpaymentId'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payZpaymentKey'); ?>
        <?php echo $form->textField($model,'payZpaymentKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payZpaymentKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','zp') ?>
<br>

<fieldset>
<legend>Настройка уведомления на сайте Z-Payment</legend>
<ol>

<li>
<label>Result URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/zpayment</div>
</li>

<li>
<label>Метод Result URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Предварительный:</label>
<div class="systemparam">нет</div>
</li>

<li>
<label>Success URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/zpayment/ok</div>
</li>

<li>
<label>Метод Success URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Fail URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/zpayment/fail</div>
</li>

<li>
<label>Метод Fail URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Высылать Merch. Key:</label>
<div class="systemparam">нет</div>
</li>

</ol>
</fieldset>
</div>

<br />
