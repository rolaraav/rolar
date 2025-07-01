<?php $this->pageTitle='HTML-шаблоны' ?>

<div class="wrap">
    
    <h3>Шаблоны</h3>
    <h1>Список HTML-шаблонов</h1>
    
<?=H::moredivAll('шаблоны основные','m') ?>
<br>   

<div style="margin-left:35px;">
    
    <?=Way::templ ('Главный шаблон','layouts/main','main') ?>
    <?=Way::templ ('Ошибка','main/error','main') ?>
    <?=Way::templ ('По умолчанию, когда отключён каталог','main/index','main') ?>
    <?=Way::templ ('Список статусов','main/_statuses','main') ?>    
    
    <?=Way::templ ('Успешная оплата','f/ok','main') ?>
    <?=Way::templ ('Неуспешная оплата','f/fail','main') ?>
    <?=Way::templ ('Передано на ручную обработку','f/wait','main') ?>
    <?=Way::templ ('Рассылка - Вы отписаны от сообщений','notify/unsub','main') ?>        
    
    
</div>

</div>

<br>   
<?=H::moredivAll('шаблоны оформления заказа (по умолчанию)','order') ?>
<br>   

<div style="margin-left:35px;">
    
    <?=Way::templ ('Заказ - Форма заказа','order/index','main') ?>        
    <?=Way::templ ('Заказ - Апселл 1 уровня','order/special1','main') ?>        
    <?=Way::templ ('Заказ - Апселл 2 уровня','order/special2','main') ?>        
    <?=Way::templ ('Заказ - Корзина','order/cart','main') ?>        
    <?=Way::templ ('Заказ - Содержимое Корзины','order/total','main') ?>        
    <?=Way::templ ('Счёт - Страничка оплаты','bill/index','main') ?>        
    <?=Way::templ ('Счёт - Статус платежа','status/index','main') ?>        
    <?=Way::templ ('Наложенный платёж - Отправлено сообщение','nl/index','main') ?>        
    <?=Way::templ ('Наложенный платёж - Заказ подтверждён','nl/confirmed','main') ?>        
    <?=Way::templ ('Наложенный платёж - Специальное предложение (кроссел)','nl/special','main') ?>        
    <?=Way::templ ('Наложенный платёж - Специальный товар добавлен к заказу','nl/ok','main') ?>            
    <?=Way::templ ('Ручная оплата - Форма отправки','notify/index','main') ?>        
    <?=Way::templ ('Ручная оплата - Уведомление отправлено','notify/ok','main') ?>        
    

</div>
</div>

<br>   
<?=H::moredivAll('шаблоны каталога','catalog') ?>
<br>   

<div style="margin-left:35px;">
    
    <?=Way::templ ('Каталог - Главная','catalog/index','main') ?>
    <?=Way::templ ('Каталог - Товары','catalog/category','main') ?>
    <?=Way::templ ('Каталог - Корзина','catalog/_ajaxcart','main') ?>
    <?=Way::templ ('Каталог - один товар','catalog/_view','main') ?>    
    <?=Way::templ ('Традиционная корзина - Форма заказа','cartorder/index','main') ?>        
    <?=Way::templ ('Традиционная корзина - Подтверждение заказа','cartorder/confirm','main') ?>        

</div>
</div>

<br>   
<?=H::moredivAll('шаблоны модуля поддержки','support') ?>
<br>   

<div style="margin-left:35px;">
    
    <?=Way::templ ('Поддержка - Главная','support/index','main') ?>    
    <?=Way::templ ('Поддержка - База знаний','support/base','main') ?>    
    <?=Way::templ ('Поддержка - Статья','support/article','main') ?>    
    <?=Way::templ ('Поддержка - Категория статей','support/category','main') ?>    
    <?=Way::templ ('Поддержка - Новый тикет','support/newticket','main') ?>    
    <?=Way::templ ('Поддержка - Тикет создан','support/okticket','main') ?>    
    <?=Way::templ ('Поддержка - Открыть тикет','support/openticket','main') ?>    
    <?=Way::templ ('Поддержка - Просмотр тикета','support/viewticket','main') ?>    
    <?=Way::templ ('Поддержка - Ответы в тикете','support/_answers','main') ?>    
    

</div>
</div>

<br>   
<?=H::moredivAll('шаблоны закрытых зон','area') ?>
<br>   

<div style="margin-left:35px;">
    
    <?=Way::templ ('Закрытая зона - Основной шаблон','layouts/area','area') ?>
    <?=Way::templ ('Закрытая зона - Вход в аккаунт','default/login','area') ?>
    <?=Way::templ ('Закрытая зона - Главная страница','default/index','area') ?>
    <?=Way::templ ('Закрытая зона - Доступ закончился','default/noaccess','area') ?>
    <?=Way::templ ('Закрытая зона - Список файлов','areaitem/index','area') ?>
    <?=Way::templ ('Закрытая зона - один файл','areaitem/_view','area') ?>

</div>
</div>



    <br>   
    
<?=H::moredivAll('шаблоны партнёрской программы','aff') ?>
<br>   

<div style="margin-left:35px;">

<?=Way::templ ('Основной шаблон','layouts/aff','aff') ?>

<?=Way::templ ('Главная','default/index','aff') ?>
<?=Way::templ ('Вход в аккаунт','default/login','aff') ?>

<?=Way::templ ('Новости (одна новость)','default/_view','aff') ?>

<?=Way::templ ('Восстановление забытого пароля','forgot/index','aff') ?>
<?=Way::templ ('Восстановление забытого пароля - Отправлено','forgot/sent','aff') ?>

<?=Way::templ ('Реф-ссылки - Список','links/index','aff') ?>
<?=Way::templ ('Реф-ссылки - Просмотр рекламных материалов','links/ad','aff') ?>

<?=Way::templ ('Профиль - Просмотр','profile/index','aff') ?>
<?=Way::templ ('Профиль - Редактировать','profile/edit','aff') ?>

<?=Way::templ ('Регистрация','reg/index','aff') ?>
<?=Way::templ ('Регистрация завершена','reg/ok','aff') ?>

<?=Way::templ ('Продажи','sells/index','aff') ?>

<?=Way::templ ('Короткие ссылки','short/index','aff') ?>

<?=Way::templ ('Статистика','stat/index','aff') ?>


</div>

</div>
    
</div>