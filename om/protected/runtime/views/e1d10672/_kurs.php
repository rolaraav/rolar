<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\settings/general\_kurs.php */ ?>
<fieldset>

<legend>Курсы валют</legend>


<ol>

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'dv'); ?>
        <?php echo $form->dropDownList($model,'dv',array(
			'rur' => 'Российский рубль',
			'usd' => 'Доллар США',
			'eur' => 'Евро',
			'uah' => 'Украинская гривня',
		), array ('class' => 'select')); ?>
		<span class="hint"><p></p>Эта валюта будет использоваться в качестве предпочтительной при отображении в статистике и некоторых других местах (частично). <p></p>Тем не менее, обратите внимание, что внутренней валютой будет оставаться Рубль, поэтому при изменениях курса рубля (в т.ч. автообновлении) могут быть неточности в общей статистике.</p></span>
        <?php echo $form->error($model,'dv'); ?>
    </div>    
    </li>

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'kursUsd'); ?>
        <?php echo $form->textField($model,'kursUsd',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
		<span class="hint">Укажите сколько рублей стоит 1 доллар</span>
        <?php echo $form->error($model,'kursUsd'); ?>
    </div>    
    </li>    
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'kursEur'); ?>
        <?php echo $form->textField($model,'kursEur',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
		<span class="hint">Укажите сколько рублей стоит 1 евро</span>
        <?php echo $form->error($model,'kursEur'); ?>
		
    </div>    
    </li>        

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'kursUah'); ?>
        <?php echo $form->textField($model,'kursUah',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
		<span class="hint">Укажите сколько рублей стоит 1 гривня</span>
        <?php echo $form->error($model,'kursUah'); ?>
    </div>    
    </li>

</ol>
</fieldset>

<br />

<fieldset>
<legend>Автообновление курса с сайта ЦБР (если есть Крон)</legend>
<ol>

    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'kursAuto'); ?>
        <?php echo $form->checkBox($model,'kursAuto',array('class' => 'checkbox','uncheckValue' => 0)); ?>
		<span class="hint">В случае, если эта опция установлена и настроен Крон - курс будет обновляться с сайта ЦБР в заданный в настройках Крона интервал</span>
    </div>    
    </li>    
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'kursAutoMul'); ?>
        <?php echo $form->textField($model,'kursAutoMul',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'kursAutoMul'); ?>
		<span class="hint">Здесь можно задать число, на которое будут умножены официальные курсы ЦБР в момент обновления - перед внесением в базу. Если Вы хотите для OM2 точные курсы ЦБР - впишите сюда 1.
    </div>    
    </li>        

</ol>
</fieldset>

<br />

<fieldset>
<legend>Сравните с реальными курсами</legend>

<div align="center" style="padding:7px;">   
<br />    
<table border=0 align="center">
<tr>
<td><img src="http://pics.rbc.ru/img/grinf/usd/usd_dm_cb_000066_88x61.gif?<?php echo rand (10000,99999); ?>" WIDTH=88 HEIGHT="61" border=0></td>
<td>&nbsp;</td>
<td>
<img src="http://finance.ua/cgi-bin/fip.cgi?currency=uah/rub&source=nbu&lang=ru&rand=<?php echo rand (10000,99999); ?>" alt="Курсы валют" width="88" height="31" border="0" title="Курсы валют">

</td>
</tr>
</table>
<br />
</div>  

</fieldset>
