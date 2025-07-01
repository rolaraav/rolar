<?php defined('A') or die('Access denied');?>
<?=$modal;?>
<div id="cpwrapper"><!--<a name="top" id="top"></a>-->
<?=$header;?>
<?=$topmenu;?>
<!-- Основной блок (начало) -->
<div id="cpmain" class="container-fluid">
  <!-- Левый блок (начало) -->
  <div class="leftblock order-lg-1">
    <?php
    if(isset($leftmenu)) {
      echo $leftmenu; // Левое меню навигации
    }

    if(isset($authorization)) {
      echo $authorization; // форма авторизации
    }

    if(isset($statistics)) {
      echo $statistics; // статистика
    }
    ?>
  </div><!-- Левый блок (конец) -->
  <!-- Центральный блок с контентом (начало) -->
  <div class="centerblock order-lg-2" id="cpcenterblock">
      <div id="cpbreadcrumbs_right"></div>
      <div id="cpbreadcrumbs"><?php echo $breadcrumbs; ?></div>
      <div class="cpblockbody">
          <div class="cpblocktext">
          <?=$content;?>
          </div>
    </div>
  <div class="clear"></div>
  </div>
  <!-- Центральный блок с контентом (конец) -->
</div>
<!-- Основной блок (конец) -->
<div class="clear"></div>
<?=$footer;?>
</div>
<?=$totop;?>