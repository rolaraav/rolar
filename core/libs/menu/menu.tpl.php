<?php defined('A') or die('Access denied'); ?>
<li class="nav-item">
  <a class="nav-link" href="<?=D.S.$category['alias']?>"><?=$category['title'];?></a>
<?php
  if($category['alias'] == 'partner_products'):
    if(isset($this->partners)):
      echo '<ul>';
      foreach($this->partners as $partner): ?>
        <li><a href="<?=D.S.$category['alias'];?>?partner=<?=$partner['id'];?>"><?=$partner['title'];?></a></li>
      <?php endforeach;
      echo '</ul>';
    endif;
  endif;
  if(isset($category['childs'])): ?>
    <ul><?=$this->getMenuHtml($category['childs']);?></ul>
  <?php endif; ?>
</li>