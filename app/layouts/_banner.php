<?php defined('A') or die('Access denied');?>
<!-- Блок для баннеров (начало) -->
<div class="banner">
<?php
if ($banner['file_extension'] == 'swf' or $banner['file_extension'] == 'SWF'): ?>
<div class="banner468x60">
<a href="<?=D.S.'ba'.$banner['id'];?>" target="_blank" title="<?=$banner['title'];?>"></a>
<object id="banner468x60swf" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="468px" height="60px">
<param name="allowScriptAccess" value="sameDomain">
<param name="movie" value="<?=D.S.$banner['image'];?>">
<param name="quality" value="high">
<param name="bgcolor" value=""#ffffff">
<embed src="<?=D.S.$banner['image'];?>" name="<?=$banner['title'];?>" title="<?=$banner['title'];?>" id="banner468x60swf" flashvars="Referal=597960&" wmode="transparent" quality="high" width="468px" height="60px" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
</object>
</div>
<?php else: ?>
<div class="banner468x60">
  <a href="<?=D.S.'ba'.$banner['id'];?>" target="_blank">
    <img alt="<?=$banner['title'];?>" height="60px" src="<?=D.S.$banner['image'];?>" title="<?=$banner['title'];?>" width="468px">
  </a>
</div>
<?php endif;
?>
</div>
<!-- Блок для баннеров (конец) -->
