<fieldset>

    <legend>Параметры приёма платежей через ЮMoney</legend>

    <img src="<?=Y::bu()?>images/admin/pay/yoomoney.png" style="padding:20px 25px;">

    <ol>

        <li>
            <?php echo $form->labelEx($model,'payYandexOn'); ?>
            <?php echo $form->checkBox($model,'payYandexOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payYandexAccount'); ?>
            <?php echo $form->textField($model,'payYandexAccount',array('size'=>60,'maxlength'=>15, 'class' => 'text')); ?>
            <?php echo $form->error($model,'payYandexAccount'); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payYandexKey'); ?>
            <?php echo $form->textField($model,'payYandexKey',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
            <?php echo $form->error($model,'payYandexKey'); ?>
        </li>



    </ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','ya') ?>
<br>

<fieldset>
    <legend>Настройка уведомления на сайте ЮMoney</legend>
    <ol>

        <li>
            <label>Где настраивать:</label>
            <div class="systemlink"><a target="_blank" href="https://yoomoney.ru/transfer/myservices/http-notification?_openstat=settings%3Bother%3Bmoney%3Bhttp%3Bset">https://yoomoney.ru/transfer/myservices/http-notification?_openstat=settings%3Bother%3Bmoney%3Bhttp%3Bset</a></div>
        </li>

        <li>
            <label>URL для уведомлений:</label>
            <div class="systemlink"><?=Y::bu()?>ps/yandex</div>
        </li>

        <li>
            <label>Отпр. уведомления:</label>
            <div class="systemparam">да (отметить "птичкой")</div>
        </li>

    </ol>
</fieldset>
</div>

<br />
