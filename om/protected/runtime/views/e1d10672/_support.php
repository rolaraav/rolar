<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/general\_support.php */ ?>
<fieldset>

<legend>Настройки модуля поддержки</legend>

<ol>

    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'staffOn'); ?>
        <?php echo $form->checkBox($model,'staffOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Эта опция определяет - будет ли работать служба поддержки (модуль поддержки) или нет.</span>
    </div>
    </li>

    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'staffBaseOn'); ?>
        <?php echo $form->checkBox($model,'staffBaseOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">С помощью данной опции Вы можете включить или выключить Базу знаний</span>        
    </div>
    </li>

    <li>&nbsp;</li>

    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'staffUploadOn'); ?>
        <?php echo $form->checkBox($model,'staffUploadOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Эта опция разрешает или запрещает загрузку вложений при создании тикета/выплнении ответа. Обратите внимание что вложения хранятся в папке <b>op/userfiles</b> - и на это папку должны быть установлены права на запись.</span>
    </div>
    </li>

    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'staffUploadExt'); ?>
        <?php echo $form->textField($model,'staffUploadExt',array('size'=>60,'maxlength'=>250, 'class' => 'longtext')); ?>
        <?php echo $form->error($model,'staffUploadExt'); ?>
        <span class="hint">Если Вы используете вложения - укажите через запятую (без пробелов, маленькими буквами) - расширения файлов, которые допустимы. Например jpg,rar,png и т.п.</span>
    </div>
    </li>

    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'staffUploadMax'); ?>
        <?php echo $form->textField($model,'staffUploadMax',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'staffUploadMax'); ?>
        <span class="hint">Укажите максимальный размер (в килобайтах) одного файла во вложении</span>
    </div>    
    </li>        
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'supportLetter'); ?>
        <?php echo $form->dropDownList($model,'supportLetter',Lookup::items('Visible'),array('class' => 'select')); ?>
        <?php echo $form->error($model,'supportLetter'); ?>
        <span class="hint">Если включить эту опцию - то пользователю, создавшему тикет, - будет приходить уведомление с ID тикета. Проверьте также чтобы в разделе "Системные письма" - было включено данное письмо о новом тикете (так как оно по умолчанию отключено). <br><br>Имейте ввиду, что создавший тикет пользователь - может указать сторонний e-mail, и тем самым уведомление может прийти другому человеку с Вашего сайта, что может привести к возможным жалобам на СПАМ. Используйте данную опцию на собственный страх и риск.</span>
    </div>
    </li>    
    
    <li>&nbsp;</li>    
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'staffReverse'); ?>
        <?php echo $form->dropDownList($model,'staffReverse',array (
            
            0 => 'Старые вверху, новые внизу',
            1 => 'Новые вверху, старые внизу',
            
        ),array('class' => 'select')); ?>
        <?php echo $form->error($model,'staffReverse'); ?>
        <span class="hint">Эта опция определяет порядок отображения ответов в тикете: либо последние ответы будут вверху отображаться, - либо ранние ответы вверху, а поздние внизу. Опция действует как для пользователя (при просмотре тикета), так и для оператора/администратора (при ответе).</span>
    </div>
    </li>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'staffFullAccess'); ?>
        <?php echo $form->dropDownList($model,'staffFullAccess',array (
            
            0 => 'Оператор видит свои тикеты',
            1 => 'Оператор видит все тикеты',
            
        ),array('class' => 'select')); ?>
        <?php echo $form->error($model,'staffFullAccess'); ?>
        <span class="hint">Вы можете определить этой опцией - будет ли видеть оператор тикеты, у которых владельцем является в данный момент другой оператор или администратор. Эта опция позволяет ограничить таким образом доступ, чтобы оператор не отвечал на тикеты, на которые отвечает другой оператор. Владельцем тикета при создании - становится владелец, назначенный "По умолчанию" в разделе "Отделы поддержки". Потом владельца тикета может менять оператор.<br><br>Если опцию отключить - оператор будет видеть все тикеты (в т.ч. где не является владельцем), но только в рамках своего отдела.</span>
    </div>
    </li>
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'staffAutoClose'); ?>
        <?php echo $form->textField($model,'staffAutoClose',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'staffAutoClose'); ?>
        <span class="hint">Укажите время (в часах) - если хотите, чтобы тикеты со статусом "Ждём ответ от пользователя" - закрывались по истечении заданного времени автоматически, если на них не был сделан ответ. Значение "0" - отключает данную возможность.</span>
    </div>    
    </li>        
    
    
    
</ol>

</fieldset>

<br />


<br />
