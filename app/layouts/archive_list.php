<?php defined('A') or die('Access denied');?>
<div class="block">
<?php if (isset($archive_block_title) and ($archive_block_title !== false)): ?>
  <div class="blockhead"><?=$archive_block_title;?></div>
<?php endif;?>
  <div class="blockbody">

  <div class="links">
  <?php if(!empty($archive)): ?>
  <ul class="archive">
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

  </div>
</div>