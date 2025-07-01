<?php defined('A') or die('Access denied');?>
      <article class="text_block">
      <?php if($title): ?>
      <h1><?=$title;?></h1>
      <?php endif;?>

      <?php if($image): ?>
      <div class="image"><img src="<?=D.I;?>pages/<?=$image;?>"></div>
      <?php endif;?>

      <?php if($text): ?>
      <section class="text">
        <?=$text;?>
      </section>
      <?php endif;?>
      </article>