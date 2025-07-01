<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/paysystems\_interkassa.php */ ?>
<fieldset>

<legend>Параметры Интеркассы</legend>

<img src="<?=Y::bu()?>images/admin/pay/interkassa.gif" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'payInterkassaOn'); ?>
        <?php echo $form->checkBox($model,'payInterkassaOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
    </li> 

    <li>
        <?php echo $form->labelEx($model,'payInterkassaId'); ?>
        <?php echo $form->textField($model,'payInterkassaId',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payInterkassaId'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payInterkassaKey'); ?>
        <?php echo $form->textField($model,'payInterkassaKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payInterkassaKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','int') ?>
<br>

<fieldset>
<legend>Настройка уведомления на сайте Интеркассы 2.0 (секция "Интерфейс")</legend>
<ol>

<li>
<label>URL успешной оплаты:</label>
<div class="systemlink"><?=Y::bu()?>ps/interkassa/ok</div>
</li>

<li>
<label>Тип запроса:</label>
<div class="systemparam">GET</div>
</li>

<li>
<label>URL неуспешной оплаты:</label>
<div class="systemlink"><?=Y::bu()?>ps/interkassa/fail</div>
</li>
<br>
<li>
<label>Тип запроса:</label>
<div class="systemparam">GET</div>
</li>


<li>
<label>URL ожидания:</label>
<div class="systemparam">(ничего не вводим)</div>
</li>

<li>
  <label>URL взаимодействия:</label>
  <div class="systemlink"><?=Y::bu()?>ps/interkassa</div>
</li>

<li>
  <label>Тип запроса:</label>
  <div class="systemparam">POST</div>
</li>

<li>
  <label>Разрешить переопределять:</label>
  <div class="systemlink">(во всех случаях - переключатель в значении "отключено")</div>
</li>
<br>
<li>
<label>Валюта кассы:</label>
<div class="systemparam">USD (доллар США)</div>
</li>


</ol>
</fieldset>
</div>

<br />
