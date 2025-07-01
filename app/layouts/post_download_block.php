<?php defined('A') or die('Access denied');
if ((isset($post['internet_link'])) or (isset($post['download_link']))):
  /* Вывод секретной информации доступной только авторизованым пользователям (начало) */
  if (($post['type'] == 2) or ($post['type'] == 4)): ?>
  <div class="spoiler">
  <div class="spoilerhead"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Ссылки на закачку</div>
  <div class="spoilerbody">
  <?php endif;
  if (isset($user['login'])): // Проверяем наличие логина пользователя, если есть (пользователь зашел на сайт), то мы выводим ссылку
    if (isset($internet_link)) {
      echo $internet_link;
    }
    if (isset($download_link)) {
      echo $download_link;
    }
    if ((isset($post['size'])) and ($post['type']) != 3) {echo '<p class="center green1">[Размер: '.$post['size'].']</p><br>';} ?><?php
  // а если нету, то выводим сообщение
  else: ?>
    <div class="spoiler"><br><p>Вы вошли на сайт как <strong>Гость</strong>.</p><br><p class="downloadlink"><a class="downloadlink" href="" onclick="return false" target="_top">Ссылки на закачку</a> доступны только <a href="registration" target="_top">зарегистрированным пользователям</a>.</p><br></div>
  <?php endif;
  if (($post['type'] == 2) or ($post['type'] == 4)): ?>
    <div class="spoilerfold">[Свернуть]</div>
  </div>
  </div>
  <?php endif;
  /* Вывод секретной информации доступной только авторизованым пользователям (конец) */
endif; ?>