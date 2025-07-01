<?php defined('A') or die('Access denied'); ?>
    <h1><?=$post['title'];?><?=$post['secret2'];?></h1>
<div class="articleinfo">Опубликовано: <?=$post['date'];?> | Автор: <?=$post['author'];?> | Заказы: <?php if (isset($post['orders'])) {echo (int)$post['orders'];} else {echo 0;} ?></div>
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
<div class="articleinfo">Просмотров: <?=$post['view'];?> | Комментариев: <?=$post['count_comments'];?> | Рейтинг: <img src="<?=I.S;?>rating/black_stars<?=$post['rating'];?>.png" width="65px" height="13px"></div>