<?php defined('A') or die('Access denied');
if (isset($post['download_link'])): ?>
  <p class="download_link"><!--noindex--><a href="<?=D.S.'dl'.$post['id']; //.'?hash='.$post['hash']; ?>" rel="nofollow" target="_blank">Скачать с FTP-сервера</a><!--/noindex--><br><span class="remark">(Закачек: <?=$post['downloaded'];?>)</span></p><p class="help-block center">Для скачивания с FTP-сервера используйте браузер <a href="<?=D.S;?>l614" target="_blank">Mozilla Firefox</a>.</p>
<?php endif; ?>