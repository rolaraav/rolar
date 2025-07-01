<fieldset>

    <legend>Параметры приёма платежей через Qiwi</legend>

    <img src="<?=Y::bu()?>images/admin/pay/qiwi.jpg" style="padding:20px 25px;">

    <ol>

        <li>
            <?php echo $form->labelEx($model,'payQiwiOn'); ?>
            <?php echo $form->checkBox($model,'payQiwiOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payQiwiId'); ?>
            <?php echo $form->textField($model,'payQiwiId',array('size'=>60,'maxlength'=>15, 'class' => 'text')); ?>
            <?php echo $form->error($model,'payQiwiId'); ?>
        </li>

        <li>
            <?php echo $form->labelEx($model,'payQiwiPass'); ?>
            <?php echo $form->textField($model,'payQiwiPass',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
            <?php echo $form->error($model,'payQiwiPass'); ?>
        </li>



    </ol>

</fieldset>

<br />

<?=H::moredivAll('данные для настройки','qw') ?>
<br>

<fieldset>
    <legend>Настройка уведомления Qiwi</legend>
    <ol>

        <li>
            <label>Где подключать сайт:</label>
            <div class="systemlink"><a target="_blank" href="https://ishop.qiwi.com">https://ishop.qiwi.com</a></div>
        </li>

        <li>
            <label>ID магазина:</label>
            <div class="systemlink">В разделе "Настройки" - Протоколы - REST-протокол - <b>ID проекта</b></div>
        </li>

        <li>
            <label>Что включить:</label>
            <div class="systemparam">Настройки Pull (REST) протокола - в значение "Включено"</div>
        </li>

        <li>
            <label>Как получить ключ:</label>
            <div class="systemparam">Нажмите в разделе REST - Сгенерировать новый ID</div>
        </li>

        <li>
            <label>API_ID:API_KEY:</label>
            <div class="systemparam">В поле настроек здесь впишите через двоеточие API_ID и API_ключ сгенерированные</div>
        </li>

        <li>
            <label>Пример ID:KEY:</label>
            <div class="systemparam">31463682:ZcTfCrbji6o56WltZhZo</div>
        </li>

        <li></li>



    </ol>
</fieldset>
</div>

<br />
