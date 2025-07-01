<?php defined('A') or die('Access denied');?>
<h1><?php echo $title;?></h1>
<?php
if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
}
?>
<p>Здесь вы можете выбрать раздел для изменения сайта:</p><ol>
  <li><a href="<?=ADMIN.S;?>post" target="_self"><strong>Материалы</strong></a>: <a href="<?=ADMIN.S;?>post/create" target="_self">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>category" target="_self"><strong>Категории</strong></a>: <a href="<?=ADMIN.S;?>category/create" target="_self">Создать</a></li>
  <br>
  <li><a href="<?=ADMIN.S;?>post?type=news" target="_self"><strong>Новости</strong></a>: <a href="<?=ADMIN.S;?>post/create?type=news" target="_self">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>category?type=rub" target="_self"><strong>Рубрики новостей</strong></a>: <a href="<?=ADMIN.S;?>category/create?type=rub" target="_self">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>post?type=partner_product" target="_self"><strong>Партнёрские продукты</strong></a>: <a href="<?=ADMIN.S;?>post/create?type=partner_product" target="_self">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>partner" target="_self"><strong>Партнёры</strong></a>: <a href="<?=ADMIN.S;?>partner/create" target="_self">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>post?type=download"><strong>Закачки</strong></a>: <a href="<?=ADMIN.S;?>post/create?type=download">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>category?type=section"><strong>Разделы</strong></a>: <a href="<?=ADMIN.S;?>category/create?type=section">Создать</a></li>

  <li><a href="<?=ADMIN.S;?>course"><strong>Курсы</strong></a>: <a href="<?=ADMIN.S;?>course/create">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>post?type=goods"><strong>Товары</strong></a>: <a href="<?=ADMIN.S;?>post/create?type=goods">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>post?type=gallery"><strong>Галереи</strong></a>: <a href="<?=ADMIN.S;?>post/create?type=gallery">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>post?type=album"><strong>Альбомы</strong></a>: <a href="<?=ADMIN.S;?>?post/create?type=album">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>post?type=post"><strong>Заметки</strong></a>: <a href="<?=ADMIN.S;?>post/create?type=post">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>comment"><strong>Комментарии</strong></a>: <a href="<?=ADMIN.S;?>comment/create">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>commenttwo"><strong>Комментарии 2</strong></a>: <a href="<?=ADMIN.S;?>commenttwo/create">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>user"><strong>Пользователи</strong></a>: <a href="<?=ADMIN.S;?>user/create">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>message"><strong>Сообщения</strong></a>: <a href="<?=ADMIN.S;?>message/create">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>link"><strong>Ссылки</strong></a>: <a href="<?=ADMIN.S;?>link/create">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>banner"><strong>Баннеры</strong></a>: <a href="<?=ADMIN.S;?>banner/create">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>post?type=page"><strong>Страницы</strong></a>: <a href="<?=ADMIN.S;?>post/create?type=page">Создать</a></li>
  <br>
  <li><a href="<?=ADMIN.S;?>editor"><strong>Текстовый редактор</strong></a></li>
  <li><a href="<?=ADMIN.S;?>sendmail"><strong>Рассылка почты</strong></a></li>
  <li><a href="<?=ADMIN.S;?>subscribers"><strong>Подписчики</strong></a>: <a href="<?=ADMIN.S;?>user/create">Создать</a></li>
  <li><a href="<?=ADMIN.S;?>soccomments"><strong>Комментарии в социальных сетях</strong></a></li>
</ol>
