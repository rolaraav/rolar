<?php defined('A') or die('Access denied'); ?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
  <base href="/">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="index, follow">
  <?=$meta;?>
  <!-- Подключение необходимых каскадных таблиц стилей css (начало) -->
  <?=$styles;?>
  <!-- Подключение необходимых каскадных таблиц стилей css (конец) -->
  <link href="<?=D.S;?>favicon-cisco.ico" rel="shortcut icon" type="image/x-icon">
  <!-- Подключение необходимых скриптов1 (начало) -->
  <?=$scripts1;?>
  <!-- Подключение необходимых скриптов1 (конец) -->
  <title><?=$title;?></title>
</head>
<body>
<?php if(isset($analytics)){echo $analytics;} ?>
<div class="cisco_content">
  <?=$content;?>
  <div class="clear"></div>
<!-- Футер (начало) -->
<div class="cisco_footer">
  <hr class="cisco_copyright_hr" noshade="" width="100%">
  <p class="cisco_author">© 2013<?php if (time() > 1388512799) {echo ' - '.date('Y');} ?> <a href="<?=D;?>" target="_blank" title="">rolar</a>. Все права защищены.</p>
  <p class="cisco_support"><a href="<?=D.S;?>om/support/" target="_blank" title="Появились вопросы? Пиши сюда">Служба поддержки</a> | <a href="<?=D.S;?>om/aff/" target="_blank" title="Здесь ты можешь заработать, рекламируя данный курс">Парнёрская программа</a></p>
</div>
<!-- Футер (конец) -->
</div>
<?=$totop;?>
<!-- Подключение необходимых скриптов2 (начало) -->
<?=$scripts2;?>
<!-- Подключение необходимых скриптов2 (конец) -->
</body>
</html>