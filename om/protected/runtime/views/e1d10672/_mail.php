<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/general\_mail.php */ ?>
<fieldset>

<legend>Настройки почты</legend>

<ol>

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'mailType'); ?>
        <?php echo $form->dropDownList($model,'mailType',array (
                                'phpmailer' => 'PHP Mailer (рекомендуется)',
				'mail' => 'PHP mail через SwiftMailer',
				'smtp' => 'Через SMTP-сервер',
                                
			),
			array('class' => 'select')); ?>
        <?php echo $form->error($model,'mailType'); ?>
        <span class="hint">Этот вариант определяет способ отправки почты. Рекомендуется использовать <b>PHP Mailer</b> - этот класс использует стандартную функцию mail() для отправки почты.<br><br> Если будут проблемы с попаданием в папку "Спам" писем - попробуйте <b>Swift Mailer</b>.<br><br> Вариант с <b>SMTP</b> наиболее ресурсозатратный и может неподдерживаться хостингом (т.к. требует подключения средствами PHP через 25 порт), но обычно хорошо справляется с спам-фильтрами.</span>
    </div>    
    </li>       

</ol>

</fieldset>

<br />

<fieldset>

<legend>Параметры SMTP (если выбран этот способ):</legend>

<ol>

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'mailHost'); ?>
        <?php echo $form->textField($model,'mailHost',array('size'=>60,'maxlength'=>50, 'class' => 'text')); ?>
        <?php echo $form->error($model,'mailHost'); ?>
        <span class="hint">Заполняйте это поле ТОЛЬКО если выбран вариант SMTP-отправки. Нужны данные Вашего ящика, который указан в разделе <b>Мои данные</b> - <b>E-mail администратора</b>. Здесь нужно указать SMTP-сервер. Например, smtp.mail.ru и др.</span>
        
    </div>    
    </li>    
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'mailPort'); ?>
        <?php echo $form->textField($model,'mailPort',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'mailPort'); ?>
        <span class="hint">Укажите SMTP-порт (нужно только для способа SMTP-отправки почты). Обычно это 25 или 2525</span>
    </div>    
    </li>    
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'mailUsername'); ?>
        <?php echo $form->textField($model,'mailUsername',array('size'=>60,'maxlength'=>50, 'class' => 'text')); ?>
        <?php echo $form->error($model,'mailUsername'); ?>
        <span class="hint">SMTP-логин (чаще всего совпадает с e-mail адресом). Необходимо для SMTP-серверов, требующих авторизации.</span>
        
    </div>    
    </li>    
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'mailPassword'); ?>
        <?php echo $form->textField($model,'mailPassword',array('size'=>60,'maxlength'=>50, 'class' => 'text')); ?>
        <?php echo $form->error($model,'mailPassword'); ?>
        <span class="hint">SMTP-пароль, чаще всего совпадает с паролем к почтовому ящику.</span>        
    </div>    
    </li>                
    
</ol>

</fieldset>

<br />
