<?php

$this->pageTitle = 'Экспорт клиентов';

$this->menu=array(
	array('label'=>'Список клиентов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
        array('label'=>'Импорт клиентов', 'url'=>array('import'), 'itemOptions' => array ('class' => 'rmenu_add')),        

);

?>

<div class="wrap">

<h3>Клиенты</h3>

<h1>Экспорт клиентов</h1>

<p>На этой страничке Вы можете сформировать и получить список Ваших клиентов в заданном формате.</p>

<div class="wide form">
<form action="" method="post">

    <fieldset>
        
        <legend>Данные</legend>

    <ol>

	<li>
<label>Выберите товар:</label> </b><?=CHtml::dropDownList ('good',FALSE,Good::items (),array ('class' => 'select')); ?></li>
    
        <li><label>Формат:</label><?=CHtml::textField ('format','{email}||{uname}||{good_id}',array ('class' => 'longtext')); ?></li>

    </ol>
    </fieldset>
    
    <p><br><label>&nbsp;</label><input type="submit" value="Показать список клиентов" class="submit"></p>
    
</form>
</div>

<?php if (!empty ($data)): ?>

<br>

<div class="wide form">
    
    <p>Полученный список клиентов (<?=$dc ?> записей):<br>&nbsp;</p>

<p><textarea class="textarea" rows="12" cols="70"><?=$data?></textarea>
    
</div>

<?php endif; ?>


<br><?=H::moredivAll ('подсказку по переменным'); ?>

<p><br>Пример формата:<br><br>
    
    <b>{email}||{uname}||{good_id}</b>

    <br>&nbsp;</p>

<p>- это обозначает возврат списка в виде: <b>E-mail||Имя||ID товара</b><br>&nbsp;</p>

<p>Все возможные переменные:<br><br>
    
    <b>{good_id}</b> - ID товара<br>
    <b>{uname}</b> - Имя клиента<br>
    <b>{email}</b> - Основной e-mail клиента<br>
    <b>{amail}</b> - альтернативный e-mail (если был указан)<br>
    <b>{date}</b> - дата добавления в базу (ДД.ММ.ГГГГ)<br>
    <b>{subscribe}</b> - подписан ли на рассылку (1 - да, 0 - нет)<br>


</div>



</div>