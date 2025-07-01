<?php defined('A') or die('Access denied');
if (isset($post['partner_link'])): ?>
  <p class="partner_link"><a href="<?=D.S.'pl'.$post['id'];?>" target="_blank">Перейти на сайт с описанием новости</a><br><span class="remark">(Переходов: <?=$post['transitions'];?>)</span></p>
<?php endif; ?>