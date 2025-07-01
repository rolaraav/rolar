<?php defined('A') or die('Access denied');
// если пользователь выбрал тёмный шаблон, то подгружаем файл со стилями для тёсного шаблона style-dark.css
?>
<link href="<?=D.S;?>js/jquery-ui.min.css" rel="stylesheet" type="text/css">
<link href="<?=D.S;?>js/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
<link href="<?=D.S;?>js/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">

<link href="<?=D.S;?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?=D.S;?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
<?php if ($template == 'dark'):?>
<link href="<?=D.S;?>css/style-dark.css" rel="stylesheet" type="text/css">
<?php else: ?>
<link href="<?=D.S;?>css/style.css" rel="stylesheet" type="text/css">
<?php endif; ?>
<?php if ($prefix == 'admin'):?>
<link href="<?=D.S;?>css/cp.css" rel="stylesheet" type="text/css">
<?php endif; ?>
<link href="<?=D.S;?>css/popuper.css" rel="stylesheet" type="text/css">
<link href="<?=D.S;?>css/content.css" rel="stylesheet" type="text/css">
<link href="<?=D.S;?>css/media.css" rel="stylesheet" type="text/css">