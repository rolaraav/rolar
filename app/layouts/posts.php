<?php defined('A') or die('Access denied');
if (isset($posts_block_title) and ($posts_block_title !== false)): ?>
  <div class="block"><div class="blockbody"><h1><?=$posts_block_title;?></h1></div></div>
<?php endif;
if(!empty($posts)):
  foreach($posts as $item): ?>
    <div class="block">
    <div class="blockhead"><a href="<?=D.S.$link_pattern.$item['id'];?>" title="<?=$item['title'];?>"><?=$item['title'];?></a><?=$item['secret'];?></div>
    <div class="blockbody">

    <div class="articleinfo">
    <i class="fa fa-calendar red1" aria-hidden="true" title="Опубликовано"></i> <?=$item['date'];?> |
    <i class="fa fa-user-circle-o  blue1" aria-hidden="true" title="Автор"></i> <?=$item['author'];?> |
    <i class="fa fa-list-alt green1" aria-hidden="true" title="Категория"></i>
    <a href="<?php if (!empty($item['alias_category'])) {echo $item['alias_category'];} else {echo D.'cat'.$item['category'];} ?>" target="_self" title="<?=$item['title_category'];?>"><?=$item['title_category'];?></a>
    <?php if ((!empty($item['partner'])) and ($item['type'] == 2)): ?>
     | <i class="fa fa-handshake-o pink2" aria-hidden="true" title="Партнёр"></i>
    <a href="<?php echo D.S.'partner_products?partner='.$item['partner']; ?>" target="_self" title="<?=$item['partner_title'];?>"><?=$item['partner_title'];?></a>
    <?php endif; ?>
    </div>

    <article class="blocktext">
    <?php if (!empty($item['image'])): ?>
      <div class="articleblockimage"><a class="fancybox" href="<?=$item['image'];?>" target="_blank" title="<?=$item['title'];?>"><img alt="<?=$item['title'];?>" class="articleimage" src="<?=$item['thumbspostimage'];?>" title="<?=$item['title'];?>"></a></div>
    <?php endif;
    echo $item['introduction'];

    if (!empty($item['price'])):?>
    <div class="product_price">Цена: <span class="red1"><s><?php echo $item['price']*1.5." руб.";?></s></span><span class="green1"><?php echo $item['price'].' руб.';?></span></div>
    <?php endif; ?>
    <?php if (!empty($item['buy_link'])):?>
    <div id="oformit_zakaz2"><!--noindex--><a class="buy_link" href="<?=D.S.'bl'.$item['id'];?>" rel="nofollow" target="_blank" title="Нажмите на кнопку &quot;ОФОРМИТЬ ЗАКАЗ!&quot;, чтобы заказать данный продукт"></a><!--/noindex--></div>
    <?php endif; ?>

    <div class="readmore"><a href="<?=D.S.$link_pattern.$item['id'];?>" target="_self">Подробнее</a></div>
    <div class="clear"></div>
    </article>

    <div class="articleinfo">
    <i class="fa fa-eye blue1" aria-hidden="true" title="Просмотры"></i> <?=$item['view'];?> |
    <i class="fa fa-comments-o orange" aria-hidden="true" title="Комментарии"></i> <?=$item['comments'];?> |
    <a class="like_btn like" onclick="Like.toggle(this, event);" data-count="0" href="#" title="Нравится"><i class="fa fa-thumbs-o-up green1" aria-hidden="true" title="Нравится"></i> <?=$item['rating'];?></a>
    <a class="dislike_btn dislike" onclick="Dislike.toggle(this, event);" data-count="0" href="#" title="Не нравится"><i class="fa fa-thumbs-o-down red1" aria-hidden="true" title="Не нравится"></i> <?=$item['rating'];?></a>
    <img src="<?=I.S;?>rating/yellow_stars<?=$item['rating'];?>.png" width="65px" height="13px">
    </div>

    </div>
    </div>
  <?php endforeach;
else: ?>
<div class="block"><div class="blockhead"></div><div class="blockbody"><?=$if_empty;?></div></div>
<?php endif;?>
