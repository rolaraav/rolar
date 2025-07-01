<?php defined('A') or die('Access denied'); // шаблон вывода большого изображения ?>
<div class="gallery_back_img" onclick="showImages(<?php echo $arr['back'];?>,<?php echo $arr['gal'];?>)"><div></div></div>
<div class="gallery_img_wrap">
  <div class="gallery_img">
  <p class="gallery_image_name">Изображение <?php echo $arr['pos'];?> из <?php echo $arr['summ'];?></p>
  <img onclick="showImages(<?php echo $arr['next'];?>,<?php echo $arr['gal'];?>)" src="<?php echo $arr['image']['name'];?>">
  <div class="gallery_clear"></div>
  <p class="gallery_image_text"><?php echo $arr['image']['text'];?></p>
  <p class="gallery_image_date">Добавлено: <?php echo $arr['image']['date'];?></p>
  <div class="gallery_clear"></div>
  <p class="gallery_image_title"><?php echo $arr['gallery']['title'];?></p>
  </div>
  <div class="gallery_clear"></div>
  <?php echo $arr['gcomments'];?>
</div>
<div class="gallery_switch_img"><div></div></div>
<div class="gallery_close_img"><div></div></div>