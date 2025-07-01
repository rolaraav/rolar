<?php defined('A') or die('Access denied'); ?>
  <h1><?=$post['title'];?><?=$post['secret2'];?></h1>
  <table class="downloads" cellpadding="5px" cellspacing="0px">
  <tr class="odd">
    <td class="tabletitle" colspan="2"><?=$post['title'];?></td>
  </tr>
  <tr class="even">
    <td class="lefttd">Категория:</td>
    <td class="righttd"><a href="<?=D.S.$post['alias_category'];?>" target="_self" title="<?=$post['title_category'];?>"><?=$post['title_category'];?></a></td>
  </tr>
  <tr class="odd">
  <td class="downloaddescription" colspan="2"><strong>Описание:</strong><br>
  <?php if (isset($image)) {
    echo $image;
  }
  echo $post['text'];?></td>
  </tr>
  <tr class="even">
    <td class="lefttd">Размер:</td>
    <td class="righttd"><?php if (isset($post['size'])) {echo $post['size'];} else {echo "не указан";}?></td>
  </tr>
  <tr class="odd">
    <td class="lefttd">Дата:</td>
    <td class="righttd"><?=$post['date'];?></td>
  </tr>
  <tr class="even">
    <td class="lefttd">Выложил:</td>
    <td class="righttd"><?=$post['author'];?></td>
  </tr>
  <tr class="odd">
    <td class="lefttd">Скриншот(ы):</td>
    <td class="righttd"><?php if (isset($post['screenshots'])) {echo $post['screenshots'];} else {echo 'Скриншотов нет';}?></td>
  </tr>
  <tr class="even">
    <td class="lefttd">Просмотрели:</td>
    <td class="righttd"><?=$post['view'];?></td>
  </tr>
  <tr class="odd">
    <td class="lefttd">Скачали:</td>
    <td class="righttd"><?php if ((!empty($post['internet_downloaded'])) and (!empty($post['downloaded']))) {echo (int)$post['internet_downloaded']+(int)$post['downloaded'];} else {echo 0;}?></td>
  </tr>
  <tr class="even">
    <td class="lefttd">Рейтинг:</td>
    <td class="righttd">
        <a class="like_btn like" onclick="Like.toggle(this, event);" data-count="0" href="#" title="Нравится"><i class="fa fa-thumbs-o-up green1" aria-hidden="true" title="Нравится"></i> <?=$post['rating'];?></a>
        <a class="dislike_btn dislike" onclick="Dislike.toggle(this, event);" data-count="0" href="#" title="Не нравится"><i class="fa fa-thumbs-o-down red1" aria-hidden="true" title="Не нравится"></i> <?=$post['rating'];?></a>
        <img src="<?=I.S;?>rating/blue_stars<?=$post['rating'];?>.png" width="65px" height="13px"> - <?=$post['rating'];?>/5</td>
  </tr>
  <tr class="odd">
    <td class="lefttd">Комментарии:</td>
    <td class="righttd"><?=$post['count_comments'];?></td>
  </tr>
  <?php if ((isset($post['internet_link'])) or (isset($post['download_link']))):?>
    <tr class="even">
    <td class="lefttd">Ссылки на скачивание:</td>
    <td class="righttd"><?php
    /* Вывод секретной информации доступной только авторизованым пользователям (начало) */
    //if (isset($user['login'])): // Проверяем наличие логина пользователя, если есть (пользователь зашел на сайт), то мы выводим ссылку
    if (isset($post['internet_link'])) {echo '<p class="downloadlink"><br><!--noindex--><a class="downloadlink" href="'.D.S.'il'.$post['id'].'" rel="nofollow" target="_blank">Скачать с сервиса Облако Mail.Ru</a><!--/noindex-->&nbsp;<span class="remark">(Закачек: '.$post['internet_downloaded'].')</span><p>';}
    if (isset($post['download_link'])) {echo '<p class="downloadlink"><br><!--noindex--><a class="downloadlink" href="'.D.S.'dl'.$post['id'].'" rel="nofollow" target="_blank">Скачать с FTP-сервера</a><!--/noindex-->&nbsp;<span class="remark">(Закачек: '.$post['downloaded'].')</span><p><br><p class="help-block center">Для скачивания с FTP-сервера используйте браузер <a href="'.D.S.'l614" target="_blank">Mozilla Firefox</a>.</p>';}?><?php

        // если нужно проверить хеш, то нужно добавить в ссылку '?hash='.$post['hash'].

      // а если нету, то выводим сообщение
    //else: ?>
    <!-- Вы вошли на сайт как <strong>Гость</strong>.<p class='downloadlink'><br><a class='downloadlink' href='' onclick='return false' target='_top'>Ссылки на закачку</a> доступны только <a href='registration.php' target='_top'>зарегистрированным пользователям</a>.</p> -->
    <?php //endif;
    /* Вывод секретной информации доступной только авторизованым пользователям (конец) */
    ?></td>
    </tr>
  <?php endif;?>
  </table>
<?php
if (isset($price)) {
  echo $price;
}

if (isset($partner_link)) {
  echo $partner_link;
}
?>