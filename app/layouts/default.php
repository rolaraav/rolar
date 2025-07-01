<?php defined('A') or die('Access denied');?>
<!DOCTYPE HTML>
<html lang="ru">
<head>
<base href="/">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="index, follow">
<meta name="zen-verification" content="HtVvef1Xxlmp6LDkzSOgEuHLbntX9GZD2cklS2d4pNSBDMDslh7pFjMW8uppBSHO" />
<?=$meta;?>
<!-- Подключение необходимых каскадных таблиц стилей css (начало) -->
<?=$styles;?>
<!-- Подключение необходимых каскадных таблиц стилей css (конец) -->
<link href="<?=D.S;?>favicon.ico" rel="shortcut icon" type="image/x-icon">
<!-- Подключение необходимых скриптов1 (начало) -->
<?=$scripts1;?>
<!-- Подключение необходимых скриптов1 (конец) -->
<title><?=$title;?></title>
</head>
<body>
<?php if(isset($analytics)){echo $analytics;} ?>
<?=$body;?>
<!-- Подключение необходимых скриптов2 (начало) -->
<?=$scripts2;?>
<!-- Подключение необходимых скриптов2 (конец) -->
</body>
</html>