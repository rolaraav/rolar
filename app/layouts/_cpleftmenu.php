<?php defined('A') or die('Access denied'); ?>
<!-- Левое меню (начало) -->
<nav class="menu">
<ul id="nav">
  <!-- Вывод элементов бокового меню (начало) -->
  <li><a href="<?=ADMIN.S;?>post">Материалы</a>
  <ul><li><a href="<?=ADMIN.S;?>post/create">Создать материал</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>category">Категории</a>
  <ul><li><a href="<?=ADMIN.S;?>category/create">Создать категорию</a></li></ul></li>
  <hr>
  <li><a href="<?=ADMIN.S;?>post?type=news">Новости</a>
  <ul><li><a href="<?=ADMIN.S;?>post/create?type=news">Создать новость</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>category?type=rub">Рубрики новостей</a>
  <ul><li><a href="<?=ADMIN.S;?>category/create?type=rub">Добавить рубрику</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>post?type=partner_product">Партнёрские продукты</a>
  <ul><li><a href="<?=ADMIN.S;?>post/create?type=partner_product">Создать партнёрский продукт</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>partner">Партнёры</a>
  <ul><li><a href="<?=ADMIN.S;?>partner/create">Добавить партнёра</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>post?type=download">Закачки</a>
  <ul><li><a href="<?=ADMIN.S;?>post/create?type=download">Создать закачку</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>category?type=section">Разделы</a>
  <ul><li><a href="<?=ADMIN.S;?>category/create?type=section">Добавить раздел</a></li></ul></li>

  <li><a href="<?=ADMIN.S;?>course"><strong>Курсы</strong></a>
  <ul><li><a href="<?=ADMIN.S;?>course/create">Создать курс</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>post?type=goods">Товары</a>
  <ul><li><a href="<?=ADMIN.S;?>post/create?type=goods">Создать товар</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>post?type=gallery">Галереи</a>
  <ul><li><a href="<?=ADMIN.S;?>?post/create?type=gallery">Создать галерею</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>post?type=album">Альбомы</a>
  <ul><li><a href="<?=ADMIN.S;?>post/create?type=album">Создать альбом</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>post?type=post">Заметки</a>
  <ul><li><a href="<?=ADMIN.S;?>post/create?type=post">Создать заметку</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>comment">Комментарии</a>
  <ul><li><a href="<?=ADMIN.S;?>comment/create">Создать комментарий</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>commenttwo">Комментарии 2</a>
  <ul><li><a href="<?=ADMIN.S;?>commenttwo/create">Создать комментарий 2</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>phrases">Мудрые фразы</a>
  <ul><li><a href="<?=ADMIN.S;?>phrases/create">Добавить фразу</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>user">Пользователи</a>
  <ul><li><a href="<?=ADMIN.S;?>user/create">Добавить пользователя</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>message">Сообщения</a>
  <ul><li><a href="<?=ADMIN.S;?>message/create">Создать сообщение</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>link">Ссылки</a>
  <ul><li><a href="<?=ADMIN.S;?>link/create">Создать ссылку</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>banner">Баннеры</a>
  <ul><li><a href="<?=ADMIN.S;?>banner/create">Создать баннер</a></li></ul></li>
  <li><a href="<?=ADMIN.S;?>post?type=page">Страницы</a>
  <ul><li><a href="<?=ADMIN.S;?>post/create?type=page">Создать страницу</a></li></ul></li>
  <hr>
  <li><a href="<?=ADMIN.S;?>editor" target="_self">Текстовый редактор</a></li>
  <li><a href="<?=ADMIN.S;?>sendmail" target="_self">Рассылка почты</a></li>
  <li><a href="<?=ADMIN.S;?>subscribers" target="_self">Подписчики</a></li>
  <li><a href="<?=ADMIN.S;?>soccomments">Комментарии в социальных сетях</a></li>
  <br>
  <li><a href="<?=D.S;?>om/admin" target="_self">OrderMaster</a></li>
  <li><a href="<?=D;?>" target="_blank">Перейти на сайт</a></li>
  <!-- Вывод элементов бокового меню (конец) -->
  <li><a href="<?=D.S;?>links">Все ссылки</a></li>
  <li><a href="<?=D.S;?>sitemap">Карта сайта</a></li>
  <li><a href="<?='http://'.DOWNLOAD_DOMEN;?>" target="_blank" title="Файловый HTTP-сервер Артура Абзалова"><em class="gray1">Файловый HTTP-сервер</em></a></li>
  <li><a href="<?='ftp://'.DOWNLOAD_DOMEN;?>" target="_blank" title="Файловый FTP-сервер Артура Абзалова"><em class="gray">Файловый FTP-сервер</em></a></li>
</ul>
</nav>
<!-- Левое меню (конец) -->