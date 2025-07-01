<fieldset>

    <legend>Параметры приёма платежей через PayPal</legend>

    <img src="<?=Y::bu()?>images/admin/pay/paypal.jpg" style="padding:20px 25px;">

    <ol>

        <li>
            <?php echo $form->labelEx($model,'payPaypalOn'); ?>
            <?php echo $form->checkBox($model,'payPaypalOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payPaypalEmail'); ?>
            <?php echo $form->textField($model,'payPaypalEmail',array('size'=>60,'maxlength'=>50, 'class' => 'text')); ?>
            <?php echo $form->error($model,'payPaypalEmail'); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payPaypalKey'); ?>
            <?php echo $form->dropDownlist($model,'payPaypalKey',array(
                'fsockopen' => 'fsockopen (рекомендуется)',
                'file_get_contents' => 'file_get_contents (альтернативный)',
                'ipcheck'   => 'Только IP host проверка (ненадёжно)',
                'none'  => 'Не проверять (не рекомендуется)',
        ), array('class' => 'text')); ?>
            <?php echo $form->error($model,'payPaypalKey'); ?>
        </li>



    </ol>

</fieldset>

<br />

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','paypal'); ?>
<br>

<fieldset>
<legend>Настройки на сайте системы PayPal - Мои счета - профиль - Мои инструменты продаж - </legend>
<ol>

<li>
  <label>URL-адрес для уведомления:</label>
  <div class="systemlink"><?=Y::bu()?>ps/paypal/ok</div>
</li>
<br>
<li>
  <label>IPN-сообщения:</label>
  <div class="systemparam">Включено</div>
</li>

</ol>
</fieldset>

</div>

<br />