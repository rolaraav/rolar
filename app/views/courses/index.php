<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">

<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}

if (($this->alias == 'course') and (!empty($course))): ?>
    <h1><?php echo $title;?></h1>
    <div class="articleinfo">
        <i class="fa fa-calendar red1" aria-hidden="true" title="Год выпуска"></i> <?=$course['year'];?> |
        <i class="fa fa-user-circle-o  blue1" aria-hidden="true" title="Автор(ы)"></i> <?=$course['author'];?>
    </div>

    <article class="blocktext">
      <?php if (!empty($course['image'])): ?>
          <div class="image"><a class="fancybox" href="<?=$course['image'];?>" target="_blank" title="<?=$course['title'];?>"><img alt="<?=$course['title'];?>" class="imagecenter" src="<?=$course['image'];?>" title="<?=$course['title'];?>"></a></div>
      <?php endif;
      echo $course['text'];

      if (!empty($course['price'])):?>
          <div class="product_price">Цена: <?php if(isset($course['author_price'])) {echo '<span class="red1"><s>'.(int)$course['author_price'].' руб.</s></span>';}?><span class="green1"><?php echo $course['price'].' руб.';?></span></div>
      <?php endif; ?>

      <?php if (!empty($course['buy_link'])):?>
          <div id="oformit_zakaz2"><!--noindex--><a class="buy_link" href="<?=D.S.'blink'.$course['id'];?>" rel="nofollow" target="_blank" title="Нажмите на кнопку &quot;ОФОРМИТЬ ЗАКАЗ!&quot;, чтобы заказать данный курс"></a><!--/noindex--></div>
          <div class="remark center bold">Уже заказали: <?php echo (int)$course['orders'];?> раз(а).</div>
          <div class="clear"></div>
      <?php endif; ?>

      <?php if (isset($bill_form)):?>
        <div class="bill_form"><?=$bill_form;?></div>
        <div class="clear"></div>
      <?php endif; ?>

      <?php if (isset($course['partner_link'])):?>
        <p class="partner_link"><a href="<?=D.S.'plink'.$course['id'];?>" target="_blank" title="<?=$course['title'];?>">Перейти на сайт с описанием продукта</a><br><span class="remark">(Переходов: <?=$course['transitions'];?>)</span></p>
        <div class="clear"></div>
      <?php endif; ?>
      <?php if ($this->user['login'] == 'rolar') { // Проверяем наличие логина пользователя, если есть (пользователь зашел на сайт), то мы выводим ссылку
        if (isset($course["download_link"])) {echo '<p class="download_link"><!--noindex--><a href="'.D.S.'dlink?alias='.$course['alias'].'&hash='.$course['hash'].'" rel="nofollow" target="_blank">Скачать курс</a><!--/noindex--><br><span class="remark">(Закачек: '.$course['downloaded'].')</span></p>';}
      } ?>
        <div class="clear"></div>
    </article>

    <div class="articleinfo">
        <i class="fa fa-eye blue1" aria-hidden="true" title="Просмотры"></i> <?=$course['view'];?> |
        <i class="fa fa-floppy-o orange" aria-hidden="true" title="Размер"></i> <?=$course['size'];?> |
        <i class="fa fa-list-alt green1" aria-hidden="true" title="Категория"></i>
        <a href="<?php if (!empty($course['alias_category'])) {echo $course['alias_category'];} else {echo 'cat'.$course['category'];} ?>" title="<?=$course['title_category'];?>"><?=$course['title_category'];?></a>
    </div>
<?php else: ?>
  <div class="blocktext">
    <h1><?php echo $title;?></h1>
    <?php echo $text;?>
  </div>
<?php endif; ?>

<div class="clear"></div>
</div>
</div>

<?php
if(isset($pagination)) {
  echo $pagination;
}

if (isset($courses)): ?>
  <!-- <div><?php echo count($courses);?> из <?php echo $this->total_posts_pagination;?></div> -->
  <?php echo $courses;
endif;

if(isset($pagination)) {
  echo $pagination;
}
?>