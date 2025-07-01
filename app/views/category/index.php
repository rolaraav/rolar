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
echo '<h1>'.$page['title'].'</h1>';
echo $image.$page['text'];

/* Если существует родительская категория, то выводим название текущей категории и текст с её описанием */
if ($category['parent'] != 0) {
  echo '<p>Информационные материалы из раздела &quot;'.$page['title'].'&quot; представлены ниже:</p>';
}
/* Если не существует родительских категорий, то выводим заголовок и текст главного раздела и список разделов */
else {

  if (isset($categories_li) and ($category['type'] != 2)) {
    echo $categories_li;
  }
  if (isset($partners_li) and ($category['type'] == 2) and (!isset($_GET['partner']))) {
    echo $partners_li;
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
  <div class="paginal_navigation">Пост <?php echo count($posts);?> из <?php echo $this->total_posts_pagination;?></div>
<?php
if(isset($posts)) {
  echo $posts;
}

if(isset($pagination)) {
  echo $pagination;
}

if(isset($half_blocks)) {
  echo $half_blocks;
}
else {
  echo $categories_list;
}
?>