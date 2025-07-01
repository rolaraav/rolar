<?php

$this->pageTitle = 'Конструктор форм';

?>

<div class="wrap">

<h3>Конструктор форм</h3>

<h1>Конструктор форм</h1>

<p>Здесь Вы можете сгенерировать код формы заказа для установки на свой сайт.</p>

<form action="<?=Y::bua();?>form/generate" method="post">
    
    <fieldset>

<legend>Сведения о товаре</legend>
<br>
<ol>
        
	<li>
            <label>Товар</label>
            <?=CHtml::dropDownList('goodid', '', Good::items(),array ('class' => 'select')); ?>
        </li>
        
	<li>
            <label>Название блока 1</label>
            <input name="block1" value="Ваши данные" type="text" class="text">
        </li>
        
	<li>
            <label>Название блока 2</label>
            <input name="block2" value="Адрес для доставки" type="text" class="text">
        </li>
        
        
        
</ol>
    </fieldset>
    <p>&nbsp;</p>
    
<fieldset>

<legend>Какие поля показывать</legend>
<br>
<ol>
                
	<li>
            <label>E-mail</label>
            <input type="checkbox" name="f[email]" checked>
            <input name="p[email]" type="text" style="margin-left: 100px; width:40px" value="10"> - позиция
	</li>    
        
	<li>
            <label>Дополнительный E-mail</label>
            <input type="checkbox" name="f[amail]" checked>
            <input name="p[amail]" type="text" style="margin-left: 100px; width:40px" value="20"> - позиция
	</li>    
        
	<li>
            <label>Купон скидки</label>
            <input type="checkbox" name="f[cupon]" checked>
            <input name="p[cupon]" type="text" style="margin-left: 100px; width:40px" value="30"> - позиция
	</li>    
        
	<li>
            <label>Разделитель блоков</label>
            <input type="checkbox" name="f[block]" checked>
            <input name="p[block]" type="text" style="margin-left: 100px; width:40px" value="40"> - позиция
	</li>            
        
        <p>&nbsp;</p>
        
	<li>
            <label>Фамилия</label>            
            <input type="checkbox" name="f[surname]" checked>
            <input name="p[surname]" type="text" style="margin-left: 100px; width:40px" value="50"> - позиция            
	</li>    
        
	<li>
            <label>Имя</label>            
            <input type="checkbox" name="f[uname]" checked>
            <input name="p[uname]" type="text" style="margin-left: 100px; width:40px" value="60"> - позиция            
	</li>            

	<li>
            <label>Отчество</label>            
            <input type="checkbox" name="f[otchestvo]" checked>
            <input name="p[otchestvo]" type="text" style="margin-left: 100px; width:40px" value="70"> - позиция            
	</li>    

	<li>
            <label>Страна</label>            
            <input type="checkbox" name="f[strana]" checked>
            <input name="p[strana]" type="text" style="margin-left: 100px; width:40px" value="80"> - позиция            
	</li>    

	<li>
            <label>Область</label>            
            <input type="checkbox" name="f[region]" checked>
            <input name="p[region]" type="text" style="margin-left: 100px; width:40px" value="90"> - позиция            
	</li>    
        
	<li>
            <label>Город</label>            
            <input type="checkbox" name="f[gorod]" checked>
            <input name="p[gorod]" type="text" style="margin-left: 100px; width:40px" value="100"> - позиция            
	</li>    

	<li>
            <label>Почтовый индекс</label>            
            <input type="checkbox" name="f[postindex]" checked>
            <input name="p[postindex]" type="text" style="margin-left: 100px; width:40px" value="110"> - позиция            
	</li>    

	<li>
            <label>Адрес</label>            
            <input type="checkbox" name="f[address]" checked>
            <input name="p[address]" type="text" style="margin-left: 100px; width:40px" value="120"> - позиция            
	</li>    
        
	<li>
            <label>Телефон</label>            
            <input type="checkbox" name="f[phone]" checked>
            <input name="p[phone]" type="text" style="margin-left: 100px; width:40px" value="130"> - позиция            
	</li>    
        

	<li>
            <label>Комментарий к заказу</label>            
            <input type="checkbox" name="f[comment]" checked>
            <input name="p[comment]" type="text" style="margin-left: 100px; width:40px" value="140"> - позиция            
	</li>            
        
</ol>
</fieldset>
    
   
<fieldset class="submit">
		<?= CHtml::submitButton('Получить код формы', array ('class' => 'submit')); ?>
</fieldset>   
    
    
</form>

<p>&nbsp;</p>

<p style="font-size:12px;">Чем меньше значение поля "Позиция" - тем выше будет отображаться поле

</div>