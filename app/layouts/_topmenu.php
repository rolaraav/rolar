<?php defined('A') or die('Access denied'); ?>
<!-- Верхнее меню (начало) -->
<nav class="topmenu">
  <ul>
  <li class="nav-item"><a class="nav-link" href="<?=D;?>" id="home">Главная</a></li>
<!-- Вывод элементов верхнего меню (начало) -->
<?php
if(isset($topmenu)) {
  echo $topmenu;
}
?>
<!-- Вывод элементов верхнего меню (конец) -->
  </ul>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="clear"></div>
</nav>
<!-- Верхнее меню (конец) -->