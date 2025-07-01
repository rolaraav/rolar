<?php defined("A") or die("Access denied"); ?>
<?php
/* Вывод вертикального баннера (начало) */
if ($left_banner['file_extension'] == 'swf' or $left_banner['file_extension'] == 'SWF'): ?>
  <div id="leftbanner">
  <div class="banner_left"><a href="<?=D.S.'ba'.$left_banner['id'];?>" target="_blank" title="<?=$left_banner['title'];?>"></a>
  <object id="banner_leftswf" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="200px" height="300px">
  <param name="allowScriptAccess" value="sameDomain">
  <param name="movie" value="<?=D.S.$left_banner['image'];?>">
  <param name="quality" value="high">
  <param name="bgcolor" value="#ffffff">
  <embed src="<?=D.S.$left_banner['image'];?>" name="<?=$left_banner['title'];?>" title="<?=$left_banner['title'];?>" id="banner_leftswf" flashvars="Referal=597960&" wmode="transparent" quality="high" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer">
  </object>
  </div>
  </div>
<?php else: ?>
  <div id="leftbanner">
    <div class="banner_left"><a href="<?=D.S.'ba'.$left_banner['id'];?>" target="_blank"><img alt="<?=$left_banner['title'];?>" src="<?=D.S.$left_banner['image'];?>" title="<?=$left_banner['title'];?>"></a></div>
  </div>
<?php endif;
/* Вывод вертикального баннера (конец) */
?>