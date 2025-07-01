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

	<!-- Тут текст ошибки -->
	<div class="error_page">
	<?if(isset($error)) :?>
		<? foreach($error as $item) :?>
			<?=$item.'<br>';?>
		<? endforeach;?>
	<?endif;?>
		<p class='message_button'><input class='button' name='back' type='button' value='Вернуться назад' onclick='history.back();'></p>
		<div class="clearfix"></div>
	</div>

</article>