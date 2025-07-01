<?php defined('A') or die('Access denied');?>
<?php if (isset($archive_block_title) and ($archive_block_title !== false)): ?>
  <h3 class="listhead"><?=$archive_block_title;?></h3>
<?php endif;?>

  <div class="list">
  <?php if(!empty($archive)): ?>
  <ul>
  <?php foreach($archive as $key => $item): ?>
    <li class="year"><a class="head" href="<?=D.S.$link_pattern.$key;?>"><?=$key;?></a>
    <?php if (!empty($item)): ?>
    <ul class="content">
      <?php foreach($item as $val): ?>
      <li class="month"><a href="<?=D.S.$link_pattern.$val['month'];?>"><?=$val['month_string'];?></a></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    </li>
  <?php endforeach; ?>
  </ul>
  <?php else: echo $if_empty;?>
  <?php endif; ?>
  </div>