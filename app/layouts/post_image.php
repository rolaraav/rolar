<?php defined('A') or die('Access denied');
if ((isset($post['image'])) and (isset($post['thumbspostimage']))): ?>
  <div class="articleblockimage"><a class="fancybox" href="<?=D.S.$post['image'];?>" target="_blank" title="<?=$post['title'];?>"><img alt="<?=$post['title'];?>" class="articleimage" src="<?=D.S.$post['thumbspostimage'];?>" title="<?=$post['title'];?>"></a></div>
<?php endif; ?>
