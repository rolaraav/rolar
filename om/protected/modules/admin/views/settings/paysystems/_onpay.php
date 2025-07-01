<fieldset>

<legend>Параметры платёжной системы OnPay</legend>

<img src="<?=Y::bu()?>images/admin/pay/onpay.png" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'payOnpayOn'); ?>
        <?php echo $form->checkBox($model,'payOnpayOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'payOnpayId'); ?>
        <?php echo $form->textField($model,'payOnpayId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payOnpayId'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payOnpayKey'); ?>
        <?php echo $form->textField($model,'payOnpayKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payOnpayKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','onpay'); ?>
<br>

<fieldset>
<legend>Настройка уведомления на сайте OnPay</legend>
<ol>

<li>
  <label>Success URL:</label>
  <div class="systemlink"><%=Y::bu()%>ps/onpay/ok</div>
</li>

<li>
  <label>Fail URL:</label>
  <div class="systemlink"><%=Y::bu()%>ps/onpay/fail</div>
</li>

<li>
  <label>URL обработчика:</label>
  <div class="systemlink"><%=Y::bu()%>ps/onpay</div>
</li>

<li>
  <label>Сервер уведомлений:</label>
  <div class="systemparam">Автоматический выбор</div>
</li>

</ol>
</fieldset>
</div>

<br />
