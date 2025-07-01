<?php defined('A') or die('Access denied');?>
<div class="block">
    <div class="blockhead"></div>
    <div class="blockbody">
      <?php if(isset($breadcrumbs)){
        echo $breadcrumbs;
      }
      ?>
        <div class="blocktext">
          <?php
          echo '<h1>'.$title.'</h1>';
          echo $image.$text;

          /* Если существует родительская категория, то выводим название текущей категории и текст с её описанием */
          if ($category['parent'] != 0) {
            echo '<p>Информационные материалы из раздела &quot;'.$category['title'].'&quot; представлены ниже:</p>';
          }
          /* Если не существует родительских категорий, то выводим заголовок и текст главного раздела и список разделов */
          else {

            if (isset($categories_li) and ($category['type'] != 2)) {
              echo $categories_li;
            }
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
// Вывод заметок из таблицы posts (начало)
if(isset($posts)) {
  echo $posts;
}
// Вывод заметок из таблицы posts (конец)

if(isset($pagination)) {
  echo $pagination;
}




if (isset($social_buttons)) {
    echo $social_buttons;
}

if (isset($comments_block)) {
    echo $comments_block;
} ?>