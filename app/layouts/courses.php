<?php defined('A') or die('Access denied');
if (isset($courses_block_title) and ($courses_block_title !== false)): ?>
  <div class="block"><div class="blockbody"><h1><?=$courses_block_title;?></h1></div></div>
<?php endif;
if(!empty($courses)):
  foreach($courses as $item): ?>
    <div class="block">
    <div class="blockhead"><a href="<?=D.S.$link_pattern.$item['id'];?>" title="<?=$item['title'];?>"><?=$item['title'];?></a></div>
    <div class="blockbody">

    <div class="articleinfo">
    <i class="fa fa-calendar red1" aria-hidden="true" title="Год выпуска"></i> <?=$item['year'];?> |
    <i class="fa fa-user-circle-o  blue1" aria-hidden="true" title="Автор(ы)"></i> <?=$item['author'];?>
    </div>

    <article class="blocktext">
    <?php if (!empty($item['image'])): ?>
      <div class="image"><a class="fancybox" href="<?=$item['image'];?>" target="_blank" title="<?=$item['title'];?>"><img alt="<?=$item['title'];?>" class="imagecenter" src="<?=$item['image'];?>" title="<?=$item['title'];?>"></a></div>
    <?php endif;
    echo $item['text'];

    if (!empty($item['price'])):?>
      <div class="product_price">Цена: <?php if(isset($item['author_price'])) {echo '<span class="red1"><s>'.(int)$item['author_price'].' руб.</s></span>';}?><span class="green1"><?php echo $item['price'].' руб.';?></span></div>
    <?php endif; ?>

    <?php if (!empty($item['buy_link'])):?>
      <div id="oformit_zakaz2"><!--noindex--><a class="buy_link" href="<?=D.S.'blink'.$item['id'];?>" rel="nofollow" target="_blank" title="Нажмите на кнопку &quot;ОФОРМИТЬ ЗАКАЗ!&quot;, чтобы заказать данный курс"></a><!--/noindex--></div>
      <div class="remark center bold">Уже заказали: <?php echo (int)$item['orders'];?> раз(а).</div>
      <div class="clear"></div>
      <?php endif; ?>
    <?php if (isset($item['partner_link'])):?>
      <p class="partner_link"><a href="<?=D.S.'plink'.$item['id'];?>" target="_blank" title="<?=$item['title'];?>">Перейти на сайт с описанием продукта</a><br><span class="remark">(Переходов: <?=$item['transitions'];?>)</span></p>
      <div class="clear"></div>
    <?endif; ?>
    <?php if ($this->user['login'] == 'rolar') { // Проверяем наличие логина пользователя, если есть (пользователь зашел на сайт), то мы выводим ссылку
      if (isset($item["download_link"])) {echo '<p class="download_link"><!--noindex--><a href="'.D.S.'dlink?alias='.$item['alias'].'&hash='.$item['hash'].'" rel="nofollow" target="_blank">Скачать курс</a><!--/noindex--><br><span class="remark">(Закачек: '.$item['downloaded'].')</span></p>';}
      } ?>
      <div class="clear"></div>

    <div class="readmore"><a href="<?=D.S.$link_pattern.$item['id'];?>" target="_self">Подробнее</a></div>
    <div class="clear"></div>
    </article>

    <div class="articleinfo">
    <i class="fa fa-eye blue1" aria-hidden="true" title="Просмотры"></i> <?=$item['view'];?> |
    <i class="fa fa-floppy-o orange" aria-hidden="true" title="Размер"></i> <?=$item['size'];?> |
    <i class="fa fa-list-alt green1" aria-hidden="true" title="Категория"></i>
    <a href="<?php if (!empty($item['alias_category'])) {echo $item['alias_category'];} else {echo 'cat'.$item['category'];} ?>" title="<?=$item['title_category'];?>"><?=$item['title_category'];?></a>
    </div>

    </div>
    </div>
  <?php endforeach;
else: ?>
<div class="block"><div class="blockhead"></div><div class="blockbody"><?=$if_empty;?></div></div>
<?php endif;?>
