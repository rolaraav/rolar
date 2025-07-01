<?php defined('A') or die('Access denied');?>
<?php if(!empty($image)): ?>
<div class="partnerblockimage">
  <a class="fancybox" href="<?=D.S.$image;?>" target="_blank" title="<?=$title;?>">
    <img alt="<?=$title;?>" class="partnerimage" src="<?=D.S.thumbsfilename($image);?>" title="<?=$title;?>">
  </a>
</div>
<?php endif; ?>