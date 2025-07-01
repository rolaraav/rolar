<?php defined('A') or die('Access denied');?>
<!-- Левый блок (начало) -->
<div class="leftblock order-lg-1">
<?php
if(isset($leftmenu)) {
  echo $leftmenu; // Левое меню навигации
}

if(isset($authorization)) {
  echo $authorization; // форма авторизации
}

if(isset($change_template)) {
  echo $change_template; // смена шаблона сайта
}

if(isset($telegram)) {
  echo $telegram; // подписка на Telegram-канал
}
?>
<!--noindex-->
<?php if(isset($subscription_block)) {
  echo $subscription_block; // рассылка новостей
}
?>
<!--/noindex-->
<?php
if(isset($statistics)) {
  echo $statistics; // статистика
}

if(isset($leftbanner)) {
  echo $leftbanner; // блок рекламы с вертикальным баннером
}

if(isset($vkontakte)) {
  echo $vkontakte; // Группа Вконтакте
}

if(isset($facebook)) {
  echo $facebook; // Группа Фейсбук
}

?>
</div><!-- Левый блок (конец) -->