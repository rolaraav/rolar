<?php defined('A') or die('Access denied'); ?>
<h1><?=$post['title'];?><?=$post['secret2'];?></h1>
<div class="articleinfo">Опубликовано: <?=$post['date'];?> | Автор: <?=$post['author'];?></div>
<div class="blocktext">
<?php if (isset($image)) {
  echo $image;
}
echo $post['text']; ?>
<div class="clear"></div>
</div>
<?php
// Вывод галереи, если она прикреплена
if (isset($post['gallery_id'])) {
  echo \core\Core::$core->Gallery->render_gallery($post['gallery_id']).'<hr>';
  //echo render_gallery($post['gallery_id']).'<hr>';
}
if (isset($post['gallery_images'])) {
  echo '<div class="galleryblock">'.$post['gallery_images'].'</div>';
}
else {
  echo '<p>Картинок пока нет.</p>';
}

if (isset($partner_link)) {
  echo $partner_link;
}

if (isset($download_block)) {
  echo $download_block;
}
?>
<div class="articleinfo">
    <i class="fa fa-eye blue1" aria-hidden="true" title="Просмотры"></i> <?=$post['view'];?> |
    <i class="fa fa-comments-o orange" aria-hidden="true" title="Комментарии"></i> <?=$post['count_comments'];?> |
    <a class="like_btn like" onclick="Like.toggle(this, event);" data-count="0" href="#" title="Нравится"><i class="fa fa-thumbs-o-up green1" aria-hidden="true" title="Нравится"></i> <?=$post['rating'];?></a>
    <a class="dislike_btn dislike" onclick="Dislike.toggle(this, event);" data-count="0" href="#" title="Не нравится"><i class="fa fa-thumbs-o-down red1" aria-hidden="true" title="Не нравится"></i> <?=$post['rating'];?></a>
    <!--<img src="<?=I.S;?>rating/blue_stars<?=$post['rating'];?>.png" width="65px" height="13px"> -->
</div>