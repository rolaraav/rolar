<fieldset>

<legend>Параметры платёжной системы PayOnline</legend>

<img src="<?=Y::bu()?>images/admin/pay/payonline.gif" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'payPayonlineOn'); ?>
        <?php echo $form->checkBox($model,'payPayonlineOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'payPayonlineId'); ?>
        <?php echo $form->textField($model,'payPayonlineId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payPayonlineId'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payPayonlineKey'); ?>
        <?php echo $form->textField($model,'payPayonlineKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payPayonlineKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','payonline'); ?>
<br>

<fieldset>
<legend>Настройка уведомления на сайте Payonline</legend>
<ol>

<li>
  <label>Success URL:</label>
  <div class="systemlink"><%=Y::bu()%>ps/payonline/ok</div>
</li>

<li>
  <label>Fail URL:</label>
  <div class="systemlink"><%=Y::bu()%>ps/payonline/fail</div>
</li>

<li>
  <label>URL обработчика:</label>
  <div class="systemlink"><%=Y::bu()%>ps/payonline</div>
</li>

<li>
  <label>Сервер уведомлений:</label>
  <div class="systemparam">Автоматический выбор</div>
</li>

</ol>
</fieldset>
</div>

<br />
