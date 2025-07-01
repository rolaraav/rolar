<?php defined('A') or die('Access denied'); ?>
<!-- Левое меню (начало) -->
<nav class="menu">
<ul>
<li><a href="<?=D;?>" target="_self">Главная</a></li>
<!-- Вывод элементов бокового меню (начало) -->
<?php if(isset($menu)) {
  echo $menu;
}
?>
<!-- Вывод элементов бокового меню (конец) -->
<li><a href="<?=D.S;?>search">Поиск по сайту</a></li>
<li><a href="<?=D.S;?>links">Все ссылки</a></li>
<li><a href="<?=D.S;?>sitemap">Карта сайта</a></li>
<li><a href="<?='http://'.DOWNLOAD_DOMEN;?>" target="_blank" title="Файловый HTTP-сервер"><em class="gray1">Файловый HTTP-сервер</em></a></li>
<li><a href="<?='ftp://'.DOWNLOAD_DOMEN;?>" target="_blank" title="Файловый FTP-сервер (через Mozilla Firefox)"><em class="gray">Файловый FTP-сервер</em></a></li>
</ul>
</nav>
<!-- Левое меню (конец) -->