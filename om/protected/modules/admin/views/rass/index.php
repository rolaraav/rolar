<?php $this->pageTitle='Рассылка' ?>

<div class="wrap">
    
    <h3>Рассылка</h3>
    
    <h1>Рассылка - Выбор получателей</h1>
    
<?=CHtml::form (array ('rass/msg'),'post'); ?>    
    
<fieldset>
<legend>Получатели</legend>

<ol>

<li>
<label for="format">Пользователи:</label>
<select name="users" class="select" id="users">
<option value="refs">Партнёры</option>
<option value="*">Все клиенты</option>

<?php foreach ($goods as $one): ?>

<option value="gd_<?=$one->id;?>">Клиенты <?=$one->title;?></option>

<?php endforeach; ?>

</select>
</li>

</ol>

</fieldset>

<fieldset class="submit">
<input class="submit" type="submit"
value="Продолжить" />
</fieldset>        

<?=CHtml::endForm()?>
    
    
</div>