<fieldset>

<legend>Параметры платёжной системы WebMoney</legend>

<img src="<?=Y::bu()?>images/admin/pay/webmoney.gif" style="padding:20px 25px;">

<ol>

    <li>    
        <?php echo $form->labelEx($model,'payWebmoneyOn'); ?>
        <?php echo $form->checkBox($model,'payWebmoneyOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>    
    </li>
 
    <li>    
        <?php echo $form->labelEx($model,'payWmz'); ?>
        <?php echo $form->textField($model,'payWmz',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payWmz'); ?>
    </li>

    <li>
      <?php echo $form->labelEx($model,'payWmr'); ?>
      <?php echo $form->textField($model,'payWmr',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
      <?php echo $form->error($model,'payWmr'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payWmp'); ?>
        <?php echo $form->textField($model,'payWmp',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payWmp'); ?>
    </li>

    <li>
        <?php echo $form->labelEx($model,'payWme'); ?>
        <?php echo $form->textField($model,'payWme',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payWme'); ?>
    </li>    
    
    <li>
        <?php echo $form->labelEx($model,'payWmu'); ?>
        <?php echo $form->textField($model,'payWmu',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payWmu'); ?>
    </li>    

    <li>
        <?php echo $form->labelEx($model,'payWebmoneyKey'); ?>
        <?php echo $form->textField($model,'payWebmoneyKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'payWebmoneyKey'); ?>
    </li>


    
</ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки') ?>
<br>

<fieldset>
<legend>Данные для ввода на Merchant.WebMoney.Ru</legend>
<ol>

<li><label>Высылать Secret Key:</label><div class="systemparam">нет</div></li>

<li>
<label>Result URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/webmoney</div>
</li>

<li>
<label>Предварительный:</label>
<div class="systemparam">нет</div>
</li>

<li>
<label>Success URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/webmoney/ok</div>
</li>

<li>
<label>Метод Success URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Fail URL:</label>
<div class="systemlink"><?=Y::bu()?>ps/webmoney/fail</div>
</li>

<li>
<label>Метод Fail URL:</label>
<div class="systemparam">POST</div>
</li>

<li>
<label>Разреш. URL в форме:</label>
<div class="systemparam">нет</div>
</li>

<li>
<label>Метод подписи:</label>
<div class="systemparam">SHA256</div>
</li>

<li>
<label>Режим:</label>
<div class="systemparam">Рабочий</div>
</li>

<li>
<label>Активность:</label>
<div class="systemparam">вкл.</div>
</li>

</ol>
</fieldset>

</div>

<br />
