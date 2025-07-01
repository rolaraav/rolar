<?php defined('A') or die('Access denied'); // основной шаблон галереи ?>
<div class="gallery_wrap">
<div class="gallery_view_bg"></div>
<div class="gallery_view_img"></div>
<?php if (GALLERY_NAME_SHOW == true):?>
<h3 class="gallery_title"><?php if (isset($gallery['title'])) {echo $gallery['title'];} ?></h3>
<?php endif; ?>
<?php $i = 0;
foreach($rows as $row):?>
	<div class="gallery_line">
	<?php foreach($row as $k=>$item):?>
	<img onclick="showImages(<?php echo $item['id'];?>,<?php echo $gallery_id;?>)" style="height:<?php echo $row_height[$i];?>px; width:<?php echo $width_img[$i][$k];?>px" src="<?php echo GIMAGES.$gallery['name'].S.G_IMG_LARGE.$item['name'];?>">
	<?php endforeach;?>
	</div>
	<?php $i++;
endforeach;?>
<div class="gallery_clear"></div>
<?php echo $gcomments;?>
</div>