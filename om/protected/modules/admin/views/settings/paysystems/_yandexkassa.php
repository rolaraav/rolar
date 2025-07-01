<fieldset>

    <legend>Параметры приёма платежей через ЮKassa</legend>

    <img src="<?=Y::bu()?>images/admin/pay/yookassa.png" style="padding:20px 25px;">

    <ol>

        <li>
            <?php echo $form->labelEx($model,'payYandexkassaOn'); ?>
            <?php echo $form->checkBox($model,'payYandexkassaOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payYandexkassaShopId'); ?>
            <?php echo $form->textField($model,'payYandexkassaShopId',array('size'=>60,'maxlength'=>15, 'class' => 'text')); ?>
            <?php echo $form->error($model,'payYandexkassaShopId'); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payYandexkassaShopPassword'); ?>
            <?php echo $form->textField($model,'payYandexkassaShopPassword',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
            <?php echo $form->error($model,'payYandexkassaShopPassword'); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payYandexkassaScId'); ?>
            <?php echo $form->textField($model,'payYandexkassaScId',array('size'=>60,'maxlength'=>15, 'class' => 'text')); ?>
            <?php echo $form->error($model,'payYandexkassaScId'); ?>
        </li>

    </ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','yak') ?>
<br>

<fieldset>
    <legend>Настройка уведомления на сайте Яндекс.Касса</legend>
    <ol>

        <li>
            <label>Где настраивать:</label>
            <div class="systemlink"><a target="_blank" href="https://money.yandex.ru/my/tunes">https://money.yandex.ru/my/tunes</a></div>
        </li>

        <li>
            <label>checkURL:</label>
            <div class="systemlink"><?=Y::bu()?>ps/yandexkassa</div>
        </li>

        <li>
          <label>paymentAvisoURL:</label>
          <div class="systemlink"><?=Y::bu()?>ps/yandexkassa</div>
        </li>

        <li>
            <label>Отпр. уведомления:</label>
            <div class="systemparam">да (отметить "птичкой")</div>
        </li>

    </ol>
</fieldset>
</div>

<br />
