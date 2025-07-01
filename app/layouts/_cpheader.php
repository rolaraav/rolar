<?php defined('A') or die('Access denied');?>
<!-- Шапка (начало) -->
<header class="header" id="cpheader">
  <div id="cplogotip"><a href="<?=ADMIN;?>" target="_self"></a></div>
  <!-- Верхнее меню (начало) -->
  <div class="topmenu" id="cpmenu">
    <ul id="menu">
      <li><a href="<?=ADMIN;?>" target="_self" id="home">Главная</a></li>
      <li><a href="<?=ADMIN.S.'index'.S;?>create" target="_self">Создать</a></li>
      <li><a href="<?=ADMIN.S;?>editor" target="_self">Редактор</a></li>
      <li><a href="<?=ADMIN.S;?>sendmail" target="_self">Рассылка почты</a></li>
      <li><a href="<?=D;?>" target="_blank">Перейти на сайт</a></li>
      <li><a href="<?=D.S;?>exit" target="_self">Выйти</a></li>
      <!-- Вывод элементов верхнего меню (начало) -->
      <?php if(isset($topmenu)) {echo $topmenu;}?>
      <!-- Вывод элементов верхнего меню (конец) -->
    </ul>
  </div>
    <!-- Верхнее меню (конец) -->
    <div id="cpprivet_user">Здравствуйте, <strong><a href="<?=D.S;?>user<?php if (isset($this->user['id'])) {echo $this->user['id'];} ?>" target="_top"><?php if (isset($this->user['login'])) {echo $this->user['login'];}?></a></strong>&nbsp;&nbsp;&nbsp;<a href="<?=D.S;?>exit" target="_top"><i class="fa fa-sign-out" aria-hidden="true" title="Выход"></i></a></div>
</header><!-- Шапка (конец) -->