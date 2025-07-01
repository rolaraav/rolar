<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">

<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>

<div class="blocktext">

<?php

/* Если существует переменая $rub (раздел выбран), то выводим название раздела и текст с его описанием */
if (isset($_GET['cat'])) {
  echo '<h1>'.$rubrika['title'].'</h1>';
  echo $rubrika['text'];

  echo '<p>Информационные материалы из раздела &quot;'.$rubrika['title'].'&quot; представлены ниже:</p>';
}
/* Если не существует переменной $rub (раздел не выбран), то выводим заголовок и текст главного раздела и список разделов */
else {
  echo $page['text'];

  if(isset($rub_news_li)) {
    echo $rub_news_li;
  }

  echo '<br><p>Информационные материалы из всех разделов представлены ниже:</p>';
}
?>

</div>

<div class="clear"></div>
</div>
</div>

<?php
if(isset($pagination)) {
  echo $pagination;
}
?>
<!--<p><?php echo count($news);?> из <?php echo $this->total_posts_pagination;?></p>-->
<?php
if(isset($news)) {
  echo $news;
}

if(isset($pagination)) {
  echo $pagination;
}

if(isset($half_blocks)) {
  echo $half_blocks;
}
else {
  echo $rub_news;
}
?>