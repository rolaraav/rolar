<?php defined('A') or die('Access denied');?>
<div class="block">
<?php if ($block_title !== false):?>
  <div class="blockhead"><?=$block_title;?></div>
<?php endif;?>
  <div class="blockbody">
    <?=$block_body;?>
  </div>
</div>