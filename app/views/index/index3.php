<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">

<nav class="breadcrumb" aria-label="breadcrumb">
  <a class="breadcrumb-item" href="<?=D.S;?>" title="Главная">Главная</a>
  <a class="breadcrumb-item" href="<?=D.S;?>news/" title="Заголовок категории">Заголовок категории</a>
  <a class="breadcrumb-item active" href="news.php?rub=$rub" title="Заголовок новости">Заголовок новости</a>
</nav>

<div class="blocktext">
<h1>Добро пожаловать!</h1>
<div class="articleblockimage"><a class="fancybox" href="<?=I.S;?>data/welcome/welcome.png" target="_blank" title="Добро пожаловать!"><img alt="Добро пожаловать!" class="articleimage" src="<?=I.S;?>data/welcome/welcome_th.png" title="Добро пожаловать!"></a></div>
<?php echo $page['text']; ?>
</div>

</div>
</div>

<div class="block"><div class="blockbody"><h1>Новости</h1></div></div>

<?php
if($news):
  foreach($news as $item): ?>
    <div class="block">
    <div class="blockhead"><a class="rub_title" href="view_news.php?id=<?=$item['id'];?>" target="_self" title="<?=$item['title'];?>"><?=$item['title'];?></a><?=$item['secret'];?></div>
    <div class="blockbody">

    <div class="articleinfo">
      <i class="fa fa-calendar red1" aria-hidden="true" title="Опубликовано"></i> <?=$item['date'];?> |
      <i class="fa fa-user-circle-o  blue1" aria-hidden="true" title="Автор"></i> <?=$item['author'];?> |
      <i class="fa fa-list-alt green1" aria-hidden="true" title="Категория"></i> <a class="rub_title" href="news.php?rub=<?=$item['category'];?>" target="_self" title="<?=$item['title_category'];?>"><?=$item['title_category'];?></a>
    </div>

    <article class="blocktext">
    <?php if ($item["image"]): ?>
      <div class="articleblockimage"><a class="fancybox" href="<?=$item['image'];?>" target="_blank" title="<?=$item['title'];?>"><img alt="<?=$item['title'];?>" class="articleimage" src="<?=$item['thumbspostimage'];?>" title="<?=$item['title'];?>"></a></div>
    <?php endif;
    echo $item['introduction'];?>
    <div class="readmore"><a href="view_news.php?id=<?=$item['id'];?>" target="_self">Подробнее</a></div>
    <div class="clear"></div>
    </article>

    <div class="articleinfo">
      <i class="fa fa-eye blue1" aria-hidden="true" title="Просмотры"></i> <?=$item['view'];?> |
      <i class="fa fa-comments-o orange" aria-hidden="true" title="Комментарии"></i> <?=$item['comments'];?> |
      <i class="fa fa-thumbs-o-up green1" aria-hidden="true" title="Рейтинг +"></i>
      <i class="fa fa-thumbs-o-down red1" aria-hidden="true" title="Рейтинг -"></i>
      <img src="<?=I.S;?>rating/yellow_stars<?=$item['rating'];?>.png" width="65px" height="13px">
    </div>

    </div>
    </div>
  <?php endforeach;
else: echo '<div class="block"><div class="blockhead"></div><div class="blockbody">Новостей пока нет.</div></div>';
endif;?>
<div class="block"><div class="blockbody"><h1>Партнёрские продукты</h1></div></div>
<?php
if($partner_products):
  foreach($partner_products as $item): ?>
    <div class="block">
    <div class="blockhead"><a class="partner_title" href="view_partner_product.php?id=<?=$item['id'];?>" target="_self" title="<?=$item['title'];?>"><?=$item['title'];?></a><?=$item['secret'];?></div>
    <div class="blockbody">
    <div class="articleinfo">Опубликовано: <?=$item['date'];?> | Автор: <?=$item['author'];?> | Партнёр: <a class="partner_title" href="partner_products.php?partner=<?=$item['category'];?>" target="_self" title="<?=$item['title_category'];?>"><?=$item['title_category'];?></a></div>
    <article class="blocktext">
    <?php if ($item["image"]): ?>
      <div class="articleblockimage"><a class="fancybox" href="<?=$item['image'];?>" target="_blank" title="<?=$item['title'];?>"><img alt="<?=$item['title'];?>" class="articleimage" src="<?=$item['thumbspostimage'];?>" title="<?=$item['title'];?>"></a></div>
    <?php endif;
    echo $item['introduction'];?>
    <div class="readmore"><a href="view_partner_product.php?id=<?=$item['id'];?>" target="_self">Подробнее</a></div>
    <div class="clear"></div>
    </article>
    <div class="articleinfo">Просмотров: <?=$item['view'];?> | Комментариев: <?=$item['comments'];?> | Рейтинг: <img src="<?=I.S;?>rating/red_stars<?=$item['rating'];?>.png" width="65px" height="13px"></div>
    </div>
    </div>
  <?php endforeach;
else: echo '<div class="block"><div class="blockhead"></div><div class="blockbody">Партнёрских продуктов пока нет.</div></div>';
endif;?>
<div class="block"><div class="blockbody"><h1>Закачки</h1></div></div>
<?php
if($downloads):
  foreach($downloads as $item): ?>
    <div class="block">
    <div class="blockhead"><a class="cat_title" href="view_download.php?id=<?=$item['id'];?>" target="_self" title="<?=$item['title'];?>"><?=$item['title'];?></a><?=$item['secret'];?></div>
    <div class="blockbody">
    <div class="articleinfo">Опубликовано: <?=$item['date'];?> | Автор: <?=$item['author'];?> | Категория: <a class="cat_title" href="downloads.php?cat=<?=$item['category'];?>" target="_self" title="<?=$item['title_category'];?>"><?=$item['title_category'];?></a></div>
    <article class="blocktext">
    <?php if ($item["image"]): ?>
      <div class="articleblockimage"><a class="fancybox" href="<?=$item['image'];?>" target="_blank" title="<?=$item['title'];?>"><img alt="<?=$item['title'];?>" class="articleimage" src="<?=$item['thumbspostimage'];?>" title="<?=$item['title'];?>"></a></div>
    <?php endif;
    echo $item['introduction'];?>
    <div class="readmore"><a href="view_download.php?id=<?=$item['id'];?>" target="_self">Подробнее</a></div>
    <div class="clear"></div>
    </article>
    <div class="articleinfo">Просмотров: <?=$item['view'];?> | Комментариев: <?=$item['comments'];?> | Рейтинг: <img src="<?=I.S;?>rating/blue_stars<?=$item['rating'];?>.png" width="65px" height="13px"></div>
    </div>
    </div>
  <?php endforeach;
else: echo '<div class="block"><div class="blockthead"></div><div class="blockbody">Закачек пока нет.</div></div>';
endif; ?>
<div class="block"><div class="blockbody"><h1>Товары</h1></div></div>
<?php
if($goods):
  foreach($goods as $item): ?>
    <div class="block">
    <div class="blockhead"><a class="goods_title" href="view_product.php?id=<?=$item['id'];?>" target="_self" title="<?=$item['title'];?>"><?=$item['title'];?></a><?=$item['secret'];?></div>
    <div class="blockbody">
    <div class="articleinfo">Опубликовано: <?=$item['date'];?> | Автор: <?=$item['author'];?> | Заказы: <?php echo (int)$item['orders'];?></div>
    <article class="blocktext">
    <?php if ($item["image"]): ?>
      <div class="articleblockimage"><a class="fancybox" href="<?=$item['image'];?>" target="_blank" title="<?=$item['title'];?>"><img alt="<?=$item['title'];?>" class="articleimage" src="<?=$item['thumbspostimage'];?>" title="<?=$item['title'];?>"></a></div>
    <?php endif;
    echo $item['introduction'];
    if ($item["price"]):?>
      <div class="product_price">Цена: <span class="red1"><s><?php echo $item["price"]*1.5." руб.";?></s></span><span class="green1"><?php echo $item["price"]." руб.";?></span></div>
    <?php endif; ?>
    <?php if ($item["buy_link"]):?>
      <div id="oformit_zakaz2"><!--noindex--><a class="buy_link" href="buy_link.php?id=<?=$item['id'];?>" rel="nofollow" target="_blank" title="Нажмите на кнопку &quot;ОФОРМИТЬ ЗАКАЗ!&quot;, чтобы заказать данный продукт"></a><!--/noindex--></div>
    <?php endif; ?>
    <div class="readmore"><a href="view_product.php?id=<?=$item['id'];?>" target="_self">Подробнее</a></div>
    <div class="clear"></div>
    </article>
    <div class="articleinfo">Просмотров: <?=$item['view'];?> | Комментариев: <?=$item['comments'];?> | Рейтинг: <img src="<?=I.S;?>rating/black_stars<?=$item['rating'];?>.png" width="65px" height="13px"></div>
    </div>
    </div>
  <?php endforeach;
else: echo '<div class="block"><div class="blockhead"></div><div class="blockbody">Закачек пока нет.</div></div>';
endif; ?>

<div class="half">
<div class="left_half">

<div class="block">
<div class="blockhead">Последние новости</div>
<div class="blockbody">
<?php if($last_news):
  echo '<ul>';
  foreach($last_news as $item): ?>
    <li><a href="view_news.php?id=<?=$item['id'];?>" target="_self"><?=$item['title'];?></a></li>
  <?php endforeach;
  echo '</ul>';
else: echo "<p>Новостей пока нет.</p>";
endif; ?>
</div>
</div>

</div>

<div class="right_half">

<div class="block">
<div class="blockhead">Рубрики новостей</div>
<div class="blockbody">
<?php if($rub_news):
  echo '<ul>';
  foreach($rub_news as $item): ?>
    <li><a href="news.php?rub=<?=$item['id'];?>" target="_self"><?=$item['title'];?></a></li>
  <?php endforeach;
  echo '</ul>';
else: echo "<p>Информация по запросу не найдена, т.к. в таблице нет записей.</p>";
endif; ?>
</div>
</div>

</div>
<div class="clear"></div>
</div>

<div class="half">
<div class="left_half">

<div class="block">
<div class="blockhead">Популярные партнёрские продукты</div>
<div class="blockbody">
<?php if($popular_partner_products):
  echo '<ul>';
  foreach($popular_partner_products as $item): ?>
    <li><a href="view_partner_product.php?id=<?=$item['id'];?>" target="_self"><?=$item['title'];?></a></li>
  <?php endforeach;
  echo '</ul>';
else: echo "<p>Партнёрских продуктов пока нет.</p>";
endif; ?>
</div>
</div>

</div>

<div class="right_half">

<div class="block">
<div class="blockhead">Известные партнёры</div>
<div class="blockbody">
<?php if($partners):
  echo '<ul>';
  foreach($partners as $item): ?>
    <li><a href="partner_products.php?partner=<?=$item['id'];?>" target="_self"><?=$item['title'];?></a></li>
  <?php endforeach;
  echo '</ul>';
else: echo "<p>Информация по запросу не найдена, т.к. в таблице нет записей.</p>";
endif; ?>
</div>
</div>

</div>
<div class="clear"></div>
</div>

<div class="half">
<div class="left_half">

<div class="block">
<div class="blockhead">Случайные материалы для скачивания</div>
<div class="blockbody">
<?php if($random_downloads):
  echo '<ul>';
  foreach($random_downloads as $item): ?>
    <li><a href="view_download.php?id=<?=$item['id'];?>" target="_self"><?=$item['title'];?></a></li>
  <?php endforeach;
  echo '</ul>';
else: echo "<p>Материалов для скачивания пока нет.</p>";
endif; ?>
</div>
</div>

</div>

<div class="right_half">

<div class="block">
<div class="blockhead">Категории материалов для скачивания</div>
<div class="blockbody">
<?php if($cat_downloads):
  echo '<ul>';
  foreach($cat_downloads as $item): ?>
    <li><a href="downloads.php?cat=<?=$item['id'];?>" target="_self"><?=$item['title'];?></a></li>
  <?php endforeach;
  echo '</ul>';
else: echo "<p>Информация по запросу не найдена, т.к. в таблице нет записей.</p>";
endif; ?>
</div>
</div>

</div>
<div class="clear"></div>
</div>

<!--
   <div class="block">
    <div class="blocktitle">Заголовок нового текстового блока</div>
    <div class="blocktext">
    <p>А здесь другой текстовый блок основного контента. Тут тоже написан основной текст страницы. Возможно здесь будут приводиться основные статьи</p>
    </div>
   </div>
-->
<div class="clear"></div>