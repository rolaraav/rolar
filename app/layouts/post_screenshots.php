<?php defined('A') or die('Access denied');
if (isset($post['screenshots'])): ?>
  <div class="screenshots">Скриншот(ы):</div>
  <div class="screenshotsblock"><?=$post['screenshots'];?></div>
<?php endif; ?>