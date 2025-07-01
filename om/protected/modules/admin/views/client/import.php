<?php

$this->pageTitle = 'Импорт клиентов';

$this->menu=array(
	array('label'=>'Список клиентов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);

?>

<div class="wrap">

<h3>Клиенты</h3>

<h1>Импорт клиентов</h1>

<p>С помощью этой странички Вы можете внести в базу клиентов для заданного ID товара.</p>

<p<br>Ваша база должна содержать построчно имена и e-mail адреса, разделённые заданным разделителем</p>

<p><Br>Укажите Ваш формат вида <b>{email};{uname}</b> - где {email} и {uname} обозначают сооветственно e-mail и имя человека, а знак <b>;</b> будет определён как разделитель.</p>

<div class="wide form">
<form action="" method="post">

    <fieldset>
        
        <legend>Данные</legend>

    <ol>

	<li>
<label>Выберите товар :</label> </b><?=CHtml::dropDownList ('good',FALSE,Good::items (),array ('class' => 'select')); ?></li>
    
        <li><label>Формат:</label><?=CHtml::textField ('format','{email};{uname}',array ('class' => 'longtext')); ?></li>
        
        <li><label>Список клиентов:</label>
            
<textarea class="textarea" rows="12" cols="52" name="list"></textarea></li>            

    </ol>
    </fieldset>
    
    <p><br><label>&nbsp;</label><input type="submit" value="Добавить клиентов в базу" class="submit"></p>
    
</form>
</div>



</div>