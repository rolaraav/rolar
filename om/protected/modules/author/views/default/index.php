<?php $this->pageTitle='Главная' ?>

<div class="wrap">

<h3>Панель автора</h3>

<h1>Панель автора</h1>


<fieldset>
    
    <legend>Информация</legend>
    
    <ol>
        
        <li>
            <label>Имя:</label><?=$model->uname?>
        </li>
        
        <li>
            <label>Логин:</label><?=$model->id?>
        </li>
        

        <li>
            <label>E-mail:</label><?=$model->email?>
        </li>

        
        
    </ol>
    
</fieldset>

<fieldset>
    
    <legend>Мини-статистика</legend>
    
    <ol>
        
        <li>
            <label>Товаров:</label><?=count($model->goods)?>
        </li>
        
        <li>
            <label>Заработано всего:</label><?=H::mysum($model->total)?> р.
        </li>        
        
        <li>
            <label>Выплачено:</label><?=H::mysum($model->paid)?> р.
        </li>                
        
        <li>
            <label>Ожидает выплаты:</label><?=H::mysum($model->total-$model->paid)?> р.
        </li>        
        
        
    </ol>
    
</fieldset>


<br>

</div>