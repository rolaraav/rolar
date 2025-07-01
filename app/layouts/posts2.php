<?php defined('A') or die('Access denied');
//debug($posts);
if(!empty($posts)):
  foreach($posts as $item): ?>
    <div class="block">
      <div class="blockbody post">
      <h2 class="post_h2"><?=$item['title'];?></h2>
        <article class="posttext">
        <?php if (!empty($item['image'])): ?>
          <div class="articleblockimage"><a class="fancybox" href="<?=$item['image'];?>" target="_blank" title="<?=$item['title'];?>"><img alt="<?=$item['title'];?>" class="articleimage" src="<?=$item['thumbspostimage'];?>" title="<?=$item['title'];?>"></a></div>
        <?php endif;
        echo $item['text'];?>
        <div class="clear"></div>
        </article>
        <div class="postinfo"><i class="fa fa-calendar red1" aria-hidden="true" title="Опубликовано"></i> <?=$item['date'];?> |
          <i class="fa fa-user-circle-o  blue1" aria-hidden="true" title="Автор"></i> <?=$item['author'];?> |
          <i class="fa fa-list-alt green1" aria-hidden="true" title="Категория"></i>

            <a href="<?php if (!empty($item['alias_category'])) {echo $item['alias_category'];} else {echo D.'cat'.$item['category'];} ?>" target="_self" title="<?=$item['title_category'];?>"><?=$item['title_category'];?></a> |
          <i class="fa fa-comments-o orange" aria-hidden="true" title="Комментарии"></i> <?=$item['comments'];?>
        </div>
        <hr><!--noindex--><?php include('_social.php'); ?><!--/noindex-->
      <?php
      if ($item['comments'] == 1): ?>
        <div class="show_comments">[Показать комментарии]</div>
      <?php
        if (!empty($item['comments_block'])) {
          echo '<div class="comments_wrapper">'.$item['comments_block'].'</div>'; // вывод блока с комментариями
        } ?>
        <hr>
      <?php else: ?>
      <?php $comments_block = '<div class="comments">Комментарии:</div><div>Комментарии для этой заметки выключены.</div>'; ?>
        <hr>
        <?php endif; ?>
      </div>
    </div>
  <?php endforeach;
else: ?>
<div class="block"><div class="blockbody post"><?=$if_empty;?></div></div>
<?php endif;?>