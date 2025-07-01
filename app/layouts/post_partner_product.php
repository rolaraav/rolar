<?php defined('A') or die('Access denied'); ?>
<h1><?=$post['title'];?><?=$post['secret2'];?></h1>
<div class="articleinfo">
    <i class="fa fa-calendar red1" aria-hidden="true" title="Опубликовано"></i> <?=$post['date'];?> |
    <i class="fa fa-user-circle-o  blue1" aria-hidden="true" title="Автор"></i> <?=$post['author'];?> |
    <i class="fa fa-list-alt green1" aria-hidden="true" title="Категория"></i> <a href="<?=D.S.$post['alias_category'];?>" target="_self" title="<?=$post['title_category'];?>"><?=$post['title_category'];?></a>
<?php if ((!empty($post['partner'])) and ($post['type'] == 2)): ?>
    | <i class="fa fa-handshake-o pink2" aria-hidden="true" title="Партнёр"></i> <a href="<?php echo D.S.'partner_products?partner='.$post['partner']; ?>" target="_self" title="<?=$post['partner_title'];?>"><?=$post['partner_title'];?></a>
  <?php endif; ?>
</div>
<div class="blocktext">
<?php if (isset($image)) {
  echo $image;
}
echo $post['text']; ?>
<div class="clear"></div>
</div>
<?php
if (isset($price)) {
  echo $price;
}

if (isset($screenshots)) {
  echo $screenshots;
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
    <img src="<?=I.S;?>rating/red_stars<?=$post['rating'];?>.png" width="65px" height="13px">
</div>