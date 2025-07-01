<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/general\_other.php */ ?>
<fieldset>

<legend>Настройки Крона</legend>
<ol>
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'cronWord'); ?>
        <?php echo $form->textField($model,'cronWord',array('size'=>60,'maxlength'=>50, 'class' => 'text')); ?>
        <?php echo $form->error($model,'cronWord'); ?>
        <span class="hint">Необязательное поле (можно оставить пустым). Но если Вы его заполните - то в URL для Крона - Вам нужно будет приписать в самый конец адреса <b>/s/секретное_слово</b> - иначе он запускаться не будет (сделано для защиты от возможных нежелательных запусков).</span>
    </div>    
    </li>        
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'cronKursRate'); ?>
        <?php echo $form->textField($model,'cronKursRate',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'cronKursRate'); ?>
        <span class="hint">Укажите время, через которое будет периодически происходить обновление курсов валют. По умолчанию 1440 минут (12 часов).</span>
    </div>    
    </li>        
    
    

</ol>
</fieldset>

<br />

<fieldset>

<legend>Рассылка</legend>
<ol>

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'mailLimit'); ?>
        <?php echo $form->textField($model,'mailLimit',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'mailLimit'); ?>
        <span class="hint">Здесь Вы указываете сколько писем будет отправляться за один запуск рассыльщика. Рассыльщик отправляет письма из "очереди писем" (они туда помещаются через меню "Рассылка").<br><br> Из-за ограничений на хостингах по количеству отправляемых писем + по времени выплнения скрипта - обычно приходится отправлять небольшими порциями. Вы указываете сколько писем будет отправлено за один такой раз.</span>        
    </div>    
    </li>        
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'mailInterval'); ?>
        <?php echo $form->textField($model,'mailInterval',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'mailInterval'); ?>
        <span class="hint">Это значение дополняет предыдущее поле. По умолчанию 60 минут. Оно указывает через какое время будет выполняться очередная отправка писем из очереди. Не может быть меньше 10 минут, так как все равно крон запускается не чаще раз в 10 минут.<br><br> Например, если в предыдущем поле установлено значение 50, а в этом 20 - то это будет обозначать отправку по 50 писем 3 раза в час, итого 150 писем/час.</span>        
    </div>    
    </li>            
    
</ol>

</fieldset>

<br />

<fieldset>

<legend>Напоминания о неоплаченных счетах</legend>

<ol>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'notifyOn'); ?>
        <?php echo $form->checkBox($model,'notifyOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Если включить данную опцию, то для каждого счёта (выписанного после включения данной опции), который имеет статус "Неоплаченный счёт" (т.е. когда только была заполнена форма оплаты и всё) - будут приходить напоминания (максимум 2 напоминания) на почту с ссылкой на оплату счёта. Используйте осторожно, чтобы избежать жалоб на спам.</span>        
    </div>
    </li>    
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'notifyLimit'); ?>
        <?php echo $form->textField($model,'notifyLimit',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'notifyLimit'); ?>
        <span class="hint">Если включена опция напоминаний - то указывает сколько будет отправляться писем за один запуск "рассыльщика напоминаний". Его интервал запуска настраивается в следующем поле.</span>        
    </div>    
    </li>        
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'notifyInterval'); ?>
        <?php echo $form->textField($model,'notifyInterval',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'notifyInterval'); ?>        
    <span class="hint">Интервал запуска "рассыльщика" напоминаний о неоплаченных счетах.</span>        
    </div>    
    </li>            

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'notifyFirst'); ?>
        <?php echo $form->textField($model,'notifyFirst',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'notifyFirst'); ?>
        <span class="hint">Через сколько дней после выписки счёта (заполнения формы заказа) человек получит первое напоминание, если его счёт имеет статус "Неоплаченный счёт".</span>        
    </div>    
    </li>        

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'notifySecond'); ?>
        <?php echo $form->textField($model,'notifySecond',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'notifySecond'); ?>
        <span class="hint">Через сколько дней после выписки счёта (заполнения формы заказа) человек получит ВТОРОЕ напоминание, если его счёт имеет до сих пор статус "Неоплаченный счёт".</span>                
    </div>    
    </li>        
    
    
    
</ol>

</fieldset>

<br />

<fieldset>
<legend>Как настроить крон</legend>

<div style="padding:15px;">
<p>Нужно указать запуск строки <b><?=Y::bu()?>cron/i</b> - один раз в 5-10 минут</p><br />
<p>Если Вы используете параметр &quot;Секретное слово Крона&quot;, то вид строки будет другой:<br>
    <b><?=Y::bu()?>cron/i/<i>секретное_слово</i></b></p><br />

<p>Варианты строки для крона (уточняйте у службы поддержки своего хостинга):</p>
</div>

<ol>

<li>
<label>Настройки времени:</label>
<span class="oneitem">*/10 * * * *</span>
</li>

<li>
<label>Вариант 1:</label>
<span class="oneitem">wget -O /dev/null <?=Y::bu()?>cron/i</span>
</li>

<li>
<label>Вариант 2:</label>
<span class="oneitem">lynx -dump <?=Y::bu()?>cron/i >/dev/null</span>
</li>

<li>
<label>Вариант 3:</label>
<span class="oneitem">GET <?=Y::bu()?>cron/i >/dev/null</span>
</li>

</ol>
</fieldset>

<br>

<fieldset>
<legend>Статистика работы крона</legend>
<ol>

<?
	$last = Settings::item('cronLast');
	$klast = Settings::item('cronKurs');
	$rlast = Settings::item('cronRass');
        $nlast = Settings::item('cronNotify');;		        

?>

<li>
<label>Последний запуск:</label>
<span class="oneitem"><?=($last>1)?date('d.m.Y H:i:s',$last):'никогда'?></span>
</li>

<li>
<label>Обновление курсов:</label>
<span class="oneitem"><?=($klast>1)?date('d.m.Y H:i:s',$klast):'никогда'?></span>
</li>

<li>
<label>Рассылка из очереди:</label>
<span class="oneitem"><?=($rlast>1)?date('d.m.Y H:i:s',$rlast):'никогда'?></span>
</li>

<li>
<label>Отправка напоминаний:</label>
<span class="oneitem"><?=($nlast>1)?date('d.m.Y H:i:s',$nlast):'никогда'?></span>
</li>

</ol>
</fieldset>

<br>