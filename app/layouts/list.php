<?php defined('A') or die('Access denied');?>
<div class="block">
<?php if (isset($list_block_title) and ($list_block_title !== false)): ?>
  <div class="blockhead"><?=$list_block_title;?></div>
<?php endif;?>
  <div class="blockbody">

  <div class="links">
  <?php if(!empty($list)): ?>
  <ul>
  <?php foreach($list as $item): ?>
    <li><a href="<?php if (!empty($link_pattern)) {echo D.S.$link_pattern.$item['id'];} else {echo D.S.$item['alias'];} if (isset($item['hash'])) {echo '?hash='.$item['hash'];} ?>" target="<?php if (!empty($target)) {echo $target;} else {echo '_self';} ?>"><?=$item['title'];?></a></li>
  <?php endforeach; ?>
  </ul>
  <?php else: echo $if_empty;?>
  <?php endif; ?>
  </div>

  </div>
</div>