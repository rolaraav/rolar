<fieldset>

<legend>Общие настройки</legend>

<ol>
    
   
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'catalogOn'); ?>
        <?php echo $form->checkBox($model,'catalogOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Данная опция указывает на то, что будет ли включён каталог (доступный по адресу <?=Y::bu()?>) или же будет отображаться просто страничка с информацией о том, что на данном сайте работает Order Master 2.</span>
    </div>
    </li>   

    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'usualCartOn'); ?>
        <?php echo $form->checkBox($model,'usualCartOn',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">С помощью этой опции Вы можете разрешить или запретить использование "Традиционной корзины", т.е. корзины, в которую можно положить несколько товаров из каталога.<br><br> Эта опция не имеет отношения к апсельной корзине, привязываемой к конкретным товарам.</span>
    </div>
    </li>
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'securebookUrl'); ?>
        <?php echo $form->textField($model,'securebookUrl',array('size'=>60,'maxlength'=>255, 'class' => 'longtext')); ?>
        <?php echo $form->error($model,'securebookUrl'); ?>
        <span class="hint">Заполняйте данное поле ТОЛЬКО если Вы используйте онлайн-кейген от программы SecureBook. Оставьте поле пустым, если Вы не используете данный генератор ключей.</span>
    </div>    
    </li>    
    
    
</ol>    

</fieldset>
<br />

<fieldset>

<legend>Оформление заказа и оплата</legend>

<ol>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'checkBlack'); ?>
        <?php echo $form->checkBox($model,'checkBlack',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Если включить опцию "Чёрный список" - то после заполнения пользователем формы заказа - будет происходить проверка на наличие телефона, e-mail, IP или домашнего адреса - в "Чёрном списке". Если найдено совпадение по одному из элементов - пользователь не сможет продолжить заказ и получит сообщение об ошибке.</span>        
    </div>
    </li>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'firstWay'); ?>
        <?php echo $form->checkBox($model,'firstWay',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Данная опция определяет - будет ли на страничке "Оплата счёта" - показываться только один посредник/способ (для конкретного вариант оплаты) или же выпадающий список с несколькими вариантами.<br><br>Например, у Вас в разделе "Варианты оплаты" для способа WebMoney могут быть указаны через запятую: wmz, robokassa, zpayment. Если опция "Только один способ" включена - будет показываться форма только с первым способом. Если отключена - то будет предложен выпадающий список для выбора способа.</span>        
    </div>
    </li>   
    
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'phoneDisk'); ?>
        <?php echo $form->checkBox($model,'phoneDisk',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает или отключает запрос телефона при заказе физических товаров.</span>
    </div>
    </li>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'phoneEbook'); ?>
        <?php echo $form->checkBox($model,'phoneEbook',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Включает или отключает поле "Телефон" в форме заказа цифровых товаров или закрытых зон</span>
    </div>
    </li>    

</ol>    

</fieldset>

<br />

<fieldset>

<legend>Наложенный платёж</legend>
<ol>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'nalozhEmail'); ?>
        <?php echo $form->checkBox($model,'nalozhEmail',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Если Вы включите эту опцию - то человеку, заказавшему товар Наложенным платежом, - придёт вначале письмо на почту, где он должен нажать по специальной ссылке, прежде чем заказ получит статус "Заказ наложенным платежом подтверждён". <br><br>При отключенной опции - заказ наложенным платежом приобретает такой статус без доп. подтверждения.<br><br>Вы можете также оставить эту опцию, если подтверждаете заказы по телефону. Но тогда отключите письмо-подтверждение в разделе "Системные письма", и после уточнения по телефону - подтверждайте заказ вручную через раздел "Счета".</span>
    </div>
    </li>
    
    <li>
    <div class="row">
        <?php echo $form->labelEx($model,'nalozhManual'); ?>
        <?php echo $form->checkBox($model,'nalozhManual',array('class' => 'checkbox','uncheckValue' => 0)); ?>
        <span class="hint">Эта опция обозначает, что статус "Заказ наложенным платежом подтверждён" устанавливается только оператором (например, после обзвона клиентов), независимо подтвердил по e-mail покупатель или нет. Особенно актуально для товаров, где партнёры получают за подтверждённый заказ выплату.</span>
    </div>
    </li>
    
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'crossLimit'); ?>
        <?php echo $form->textField($model,'crossLimit',array('size'=>60,'maxlength'=>50, 'class' => 'numeric')); ?>
        <?php echo $form->error($model,'crossLimit'); ?>
        <span class="hint">Данный лимит устанавливает время кроссел-предложения, если Вы используете кроссел. Кроссел позволяет добавить спец-товар в заказ - если человек уже подтвердил заказ наложенным платежом, но данная опция определяет именно максимальное время в МИНУТАХ - в течение которого можно добавить что-либо из кроссел-предложений.</span>
    </div>    
    </li>
    
    <li>    
    <div class="row">
        <?php echo $form->labelEx($model,'nalozhCountries'); ?>
        <?php echo $form->textField($model,'nalozhCountries',array('size'=>60,'maxlength'=>255, 'class' => 'longtext')); ?>
        <?php echo $form->error($model,'nalozhCountries'); ?>
        <span class="hint">Здесь можете записать (через запятую, с большой буквы, без пробелов) страны, для которых разрешён вариант "Наложенный платёж". Если страна заказчика не является одной из этого списка - ему не будет показываться вариант заказа наложенным платежом.</span>
    </div>    
    </li>    

</ol>    

</fieldset>