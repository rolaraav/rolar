<?php $this->pageTitle='Мои данные' ?>

<div class="wrap">

<h3>Настройки</h3>

<h1>Мои данные</h1>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
)); ?>

<fieldset>

<legend>Сведения о владельце магазина</legend>

<br>
<ol>

    <li>
        <?php echo $form->labelEx($model,'adminName'); ?>
        <?php echo $form->textField($model,'adminName',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'adminName'); ?>
        <span class="hint">Укажите Ваше имя - имя администратора. Будет использоваться в поле "От" при отправке всех писем. Пожалуйста, не используйте специальные символы или кавычки в данном поле, т.к. могут быть трудности с доставкой писем.</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'adminEmail'); ?>
        <?php echo $form->textField($model,'adminEmail',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'adminEmail'); ?>
        <span class="hint">Укажите e-mail администратора. Данный e-mail будет отображаться в поле "От" во всех письмах - т.е. его будут видеть все получатели писем. Это может быть в том числе несуществующий е-майл, например, no-reply@example.com. Рекомендуется чтобы это всё-таки был e-mail на Вашем сайте (вида user@вашсайт.ру) - чтобы избежать возможных проблем со спам-фильтрами.</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'sysEmail'); ?>
        <?php echo $form->textField($model,'sysEmail',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'sysEmail'); ?>
        <span class="hint">Укажите Ваш СУЩЕСТВУЮЩИЙ e-mail адрес. Его никто не будет видеть, но на него будут приходить все системные уведомления. Оптимально будет - если для этой цели Вы создадите e-mail на своём сайте, вида user@example.com - чтобы письма не попадали под спам-фильтры почтовых служб (как, например, иногда бывает на gmail.com, yandex.ru и др.)</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'copyEmail'); ?>
        <?php echo $form->textField($model,'copyEmail',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'copyEmail'); ?>
        <span class="hint">Если Вы хотите - чтобы копии всех писем, которые приходят на указанный в предыдущем поле e-mail, - отправлялись ещё на какой-то адрес (копии писем, например, для Вашего помощника) - укажите емайл в данное поле. Этот емайл также будет невидимым для пользователей. Или оставьте пустым, если не нужно.</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'mobile'); ?>
        <?php echo $form->textField($model,'mobile',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'mobile'); ?>
        <span class="hint">Некоторые мобильные операторы предоставляют специальный e-mail для получения почты - и входящие письма перенаправляются в виде SMS-сообщения. Это может быть ящик вида 380671234567@2sms.kyivstar.net или другой (зависит от оператора), иногда эту функцию нужно дополнительно активировать. Если Вы знаете и имеете адрес такого вида - то можете вписать его в данное поле, либо оставьте пустым поле.</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'siteName'); ?>
        <?php echo $form->textField($model,'siteName',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'siteName'); ?>
        <span class="hint">Здесь Вы можете указать название Вашего проекта. Обычно подставляется в конец различных писем.</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'siteUrl'); ?>
        <?php echo $form->textField($model,'siteUrl',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'siteUrl'); ?>
        <span class="hint">Укажите URL-адрес (начиная с http:// или https://) Вашего основного проекта. Обычно подставляется внизу различных писем.</span>
    </li>
    
</ol>

</fieldset>

<br />


<br />


<fieldset class="submit">
        <?php echo CHtml::submitButton('Сохранить настройки', array ('class' => 'submit')); ?>

<?php $this->endWidget(); ?>

</fieldset>

</div>
