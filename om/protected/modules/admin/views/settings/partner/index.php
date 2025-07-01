<?php $this->pageTitle='Параметры партнёрской программы' ?>

<div class="wrap">

<h3>Настройки</h3>

<h1>Параметры партнёрской программы</h1>


<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'ticket-form',
    'enableAjaxValidation'=>false,
)); ?>

<fieldset>

<legend>Общие параметры</legend>

<br>
<ol>

    <li>
        <?php echo $form->labelEx($model,'affIp'); ?>
        <?php echo $form->checkBox($model,'affIp',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Если Вы установите данную опцию, то тогда в случае если IP адрес партнёра и клиента совпадают - система не будет начислять комиссионных. Это можно использовать как защиту от покупки по собственной реф-ссылке.</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affShared'); ?>
        <?php echo $form->checkBox($model,'affShared',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Опция "Общая реф-ссылка" обозначает, что если человек перейдёт по реф-ссылке от одного товара, а купит другой - то комиссионные партнёру все равно начислятся. Если снять опцию - то реф-ссылка для одного товара - будет действовать только для этого товара. <br><br>Для определения более гибкой политики действия реф-ссылки разных товаров - используйте меню "Прочее" - "Для партнёров" - "Группы товаров".</span>        
    </li>

    <li>
        <?php echo $form->labelEx($model,'affLast'); ?>
        <?php echo $form->dropDownList($model,'affLast',Lookup::items ('AffType'),array('class' => 'text')); ?>
        <span class="hint">Здесь Вы выбираете - какому партнёру начислять комиссионные: либо первому (по чьей реф-ссылке раньше всего был переход), либо последнему (по чьей реф-ссылке был переход в самый последний раз). Наиболее популярен второй вариант (по последнему) и он наиболее рекомендуемый, т.к. особенно актуален при проведении различных акций партнёрами, где партнёры выплачиваю бонус за покупку по их реф-ссылке и хотят быть уверенными, что за это именно они получат комиссионные.</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affMin'); ?>
        <?php echo $form->textField($model,'affMin',array('size'=>60,'maxlength'=>250, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'affMin'); ?>
        <span class="hint">Здесь Вы можете указать минимальную сумму в рублях для выплат комиссионных. В разделе "Выплаты" все записи, где сумма для выплат меньше минимальной - отображаться не будут.</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affLink'); ?>
        <?php echo $form->textField($model,'affLink',array('size'=>60,'maxlength'=>250, 'class' => 'text')); ?>
        <?php echo $form->error($model,'affLink'); ?>
        <span class="hint">В это поле Вам нужно вставить <b>URL-адрес</b> Вашей странички, где находится описание Вашей партнёрской программы. На этот URL будет переадресовывать и реф-ссылка для привлечения партнёров (т.е. когда партнёры привлекают новых партнёров).</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affNewsOn'); ?>
        <?php echo $form->checkBox($model,'affNewsOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Вы можете включить данную опцию, если хотите чтобы Партнёры видели новости на главной страничке своего аккаунта.</span>
    </li>
    
    <li>
        <?php echo $form->labelEx($model,'affAllTrusted'); ?>
        <?php echo $form->checkBox($model,'affAllTrusted',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Данная опция автоматически делает возможным видеть e-mail приведённых ими клиентов. Если отключить опцию - то будут видеть только те партнёры, которые имеют статус "Доверенный".</span>
    </li>
    

    
</ol>

</fieldset>

<fieldset>

<legend>Кошельки для выплат</legend>

<br>
<ol>

    <li>
        <?php echo $form->labelEx($model,'affWmz'); ?>
        <?php echo $form->checkBox($model,'affWmz',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает WebMoney Z как способ выплат - при регистрации, в профиле партнёра и в разделе "Выплаты"</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affWmr'); ?>
        <?php echo $form->checkBox($model,'affWmr',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает WebMoney R как способ выплат - при регистрации, в профиле партнёра и в разделе "Выплаты"</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affRbk'); ?>
        <?php echo $form->checkBox($model,'affRbk',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает RBKMoney как способ выплат - при регистрации, в профиле партнёра и в разделе "Выплаты"</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affYandex'); ?>
        <?php echo $form->checkBox($model,'affYandex',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает Яндекс.Деньги как способ выплат - при регистрации, в профиле партнёра и в разделе "Выплаты"</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affZpayment'); ?>
        <?php echo $form->checkBox($model,'affZpayment',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает Z-Payment как способ выплат - при регистрации, в профиле партнёра и в разделе "Выплаты"</span>
    </li>


</ol>

</fieldset>

<fieldset>

<legend>Поля при регистрации в партнёрской программе</legend>

<br>
<ol>

    <li>
        <?php echo $form->labelEx($model,'affCountry'); ?>
        <?php echo $form->checkBox($model,'affCountry',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает поле "Страна" при регистрации в партнёрской программе</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affCity'); ?>
        <?php echo $form->checkBox($model,'affCity',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает поле "Город" при регистрации в партнёрской программе</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affUrl'); ?>
        <?php echo $form->checkBox($model,'affUrl',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает поле "URL сайта" при регистрации в партнёрской программе</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affMaillist'); ?>
        <?php echo $form->checkBox($model,'affMaillist',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает поле "Число подписчиков" при регистрации в партнёрской программе</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affAbout'); ?>
        <?php echo $form->checkBox($model,'affAbout',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает поле "О проекте" при регистрации в партнёрской программе</span>
    </li>

    <li>
        <?php echo $form->labelEx($model,'affFrom'); ?>
        <?php echo $form->checkBox($model,'affFrom',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает поле "Откуда Вы узнали о нас" при регистрации в партнёрской программе</span>
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
