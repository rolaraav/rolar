<?php defined('A') or die('Access denied');?>
<?php if ($view == 'index'):?>
<meta name="author" content="rolar">
<meta name="reply-to" content="admin@uchebacenter.ru">
<?php endif;?>
<?php if (!empty($description)):?>
<meta name="description" content="<?=$description;?>">
<?php endif;?>
<?php if (!empty($keywords)):?>
<meta name="keywords" content="<?=$keywords;?>">
<?php endif;?>
<?php if ($view == 'index'):?>
<meta name="data" content="05 june 2016 20:00:00">
<?php endif;?>
<?php if ($view == 'error'):?>
<meta http-equiv="refresh" content="10; url='<?=D;?>'">
<?php endif;?>
<meta name="google-site-verification" content="4SudJPCmNkXEomrdDTi84BwdbyU4THAhTcL74PnsCpc" />
