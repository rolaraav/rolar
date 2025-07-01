<fieldset>

<legend>Параметры приёма платежей через Payeer</legend>

<img src="<%=Y::bu()%>images/admin/pay/payeer.png" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'payPayeerOn'); ?>
        <?php echo $form->checkBox($model,'payPayeerOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'payPayeerId'); ?>
        <?php echo $form->textField($model,'payPayeerId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payPayeerId'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payPayeerKey'); ?>
        <?php echo $form->textField($model,'payPayeerKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payPayeerKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','payeer'); ?>
<br>

<fieldset>
<legend>Настройка уведомления на сайте Payeer</legend>
<ol>

<li>
<label>Success URL:</label>
<div class="systemlink"><%=Y::bu()%>ps/payeer/success</div>
</li>

<li>
<label>Fail URL:</label>
<div class="systemlink"><%=Y::bu()%>ps/payeer/fail</div>
</li>

<li>
<label>URL обработчика:</label>
<div class="systemlink"><%=Y::bu()%>ps/payeer/status</div>
</li>

<li>
<label>Сервер уведомлений:</label>
<div class="systemparam">Автоматический выбор</div>
</li>

</ol>
</fieldset>
</div>

<br />
