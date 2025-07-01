<?php defined('A') or die('Access denied');?>
<?php if (isset($list_block_title) and ($list_block_title !== false)): ?>
  <h3 class="listhead"><?=$list_block_title;?></h3>
<?php endif;?>

  <div class="list">
  <?php if(!empty($list)): ?>
  <ul>
  <?php foreach($list as $item): ?>
    <li><a href="<?php if (!empty($link_pattern)) {echo D.S.$link_pattern.$item['id'];} else {echo D.S.$item['alias'];} ?>" target="<?php if (!empty($target)) {echo $target;} else {echo '_self';} ?>"><?=$item['title'];?></a></li>
  <?php endforeach; ?>
  </ul>
  <?php else: echo '<p>'.$if_empty.'</p>';?>
  <?php endif; ?>
  </div>