<?php defined('A') or die('Access denied');
if (isset($post['internet_link'])): ?>
  <p class="internet_link"><!--noindex--><a href="<?=D.S.'il'.$post['id'];//.'?hash='.$post['hash'];?>" rel="nofollow" target="_blank">Скачать с сервиса Облако Mail.Ru</a><!--/noindex--><br><span class="remark">(Закачек: <?=$post['internet_downloaded'];?>)</span></p>
<?php endif; ?>