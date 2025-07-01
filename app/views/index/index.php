<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">

<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>

<div class="blocktext">

<h1>Добро пожаловать!</h1>
<div class="articleblockimage"><a class="fancybox" href="<?=I.S;?>data/dlya_chego_sait/rolar.png" target="_blank" title="Для чего сайт rolar.ru?"><img alt="Для чего сайт rolar.ru?" class="articleimage" src="<?=I.S;?>data/dlya_chego_sait/rolar_th.png" title="Для чего сайт rolar.ru?"></a></div>

<?php echo $page['text']; ?>

<!-- <br><?php echo EDITOR; ?><br> -->
<!-- <textarea id="text" name="text">Тут пишем текст</textarea> -->
<!-- <textarea id="text2" name="text" cols="102" rows="25">тут тоже пишем текст</textarea> -->

</div>

<div class="clear"></div>
</div>
</div>

<?php
if(isset($news)) {
  echo $news;
}
if(isset($partner_products)) {
  echo $partner_products;
}
if(isset($downloads)) {
  echo $downloads;
}
if(isset($goods)) {
  echo $goods;
}

if(isset($half_blocks)) {
  echo $half_blocks;
}

if(isset($phrase)) {
  echo $phrase;
}
?>