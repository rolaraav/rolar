<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>
<div class="blocktext">
<h1><?php echo $title; ?></h1><br>
<div class="search_form_content">
<?php if(isset($search_form)) {
  echo $search_form; // поисковая форма
}
?>
</div>
<div class="text-center">Введите ваш поисковый запрос и нажмите на кнопку &quot;Найти&quot;.</div>
<hr width="100%">
<?php if ((isset($_POST['search'])) or (!empty($_GET['search']))): // если поисковый запрос отправлен
  //echo $text;
  echo '<h2>Результаты поиска по запросу &quot;'.$search_query.'&quot;:</h2>';
?>
</div>
<div class="clear"></div>
</div>
</div>
  <?php if(isset($posts)) {
    echo $posts;
  }
?>
<div class="block">
<div class="blockhead">Результаты &quot;умного&quot; поиска по запросу &quot;<?php echo $search_query;?>&quot;:</div>
<div class="blockbody">
<div class="blocktext">
<?php if ($search_result2) {
    echo $search_result2;
  }
  else {
    echo '<p>Информация по Вашему запросу &quot;'.$search_query.'&quot; не найдена.</p>';
  }

endif; // если поисковый запрос отправлен
?>
</div>

<div class="clear"></div>
</div>
</div>
<?php
if(isset($half_blocks)) {
  echo $half_blocks;
}
?>