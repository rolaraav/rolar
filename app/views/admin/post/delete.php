<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($post);
if (empty($post)): ?>
  <div>Такого(ой) <?=$name['r'];?> не существует.</div>
<?php else: ?>
<div class="center red"><strong>Внимание! Восстановить <?=$name['v'];?> будет невозможно!</strong></div><br><br>
  <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
    <form action="" enctype="multipart/form-data" method="post" name="delete_post">

    <div class="cpinput form-group" id="delete_post_type">
      <?php if (isset($post_types)) {echo $post_types;} ?>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_category">
      <?php if (isset($post_categories)) {echo $post_categories;} ?>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_partner">
      <?php if (isset($partners)) {echo $partners;} ?>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_secret">
      <div class="delete_post">Поместить <?=$name['v'];?> в секретный раздел?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $secret1; ?>class="form-check-input" disabled="disabled" id="delete_post_secret_yes" name="secret" title="Поместить <?=$name['v'];?> в секретный раздел?" type="radio" value="1"><label class="form-check-label" for="delete_post_secret_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $secret0; ?>class="form-check-input" disabled="disabled" id="delete_post_secret_no" name="secret" title="Поместить <?=$name['v'];?> в секретный раздел?" type="radio" value="0"><label class="form-check-label" for="delete_post_secret_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_post_hidden">
      <div class="delete_post">Скрыть <?=$name['v'];?>?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $hidden1; ?>class="form-check-input" disabled="disabled" id="delete_post_hidden_yes" name="hidden" title="Скрыть <?=$name['v'];?>?" type="radio" value="1"><label class="form-check-label" for="delete_post_hidden_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $hidden0; ?>class="form-check-input" disabled="disabled" id="delete_post_hidden_no" name="hidden" title="Скрыть <?=$name['v'];?>?" type="radio" value="0"><label class="form-check-label" for="delete_post_hidden_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_post_hide_link">
      <div class="delete_post">Скрыть ссылки на скачивание?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $hide_link1; ?>class="form-check-input" disabled="disabled" id="delete_post_hide_link_yes" name="hide_link" title="Скрыть ссылки на скачивание?" type="radio" value="1"><label class="form-check-label" for="delete_post_hide_link_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $hide_link0; ?>class="form-check-input" disabled="disabled" id="delete_post_hide_link_no" name="hide_link" title="Скрыть ссылки на скачивание?" type="radio" value="0"><label class="form-check-label" for="delete_post_hide_link_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_post_comments">
      <div class="delete_post">Разрешить комментарии к <?=$name['d'];?>?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $comments1; ?>class="form-check-input" disabled="disabled" id="delete_post_comments_yes" name="comments" title="Разрешить комментарии к <?=$name['d'];?>?" type="radio" value="1"><label class="form-check-label" for="delete_post_comments_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $comments0; ?>class="form-check-input" disabled="disabled" id="delete_post_comments_no" name="comments" title="Разрешить комментарии к <?=$name['d'];?>?" type="radio" value="0"><label class="form-check-label" for="delete_post_comments_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_post_published">
      <div class="delete_post">Опубликовать <?=$name['v'];?>?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $published1; ?>class="form-check-input" disabled="disabled" id="delete_post_published_yes" name="published" title="Опубликовать <?=$name['v'];?>?" type="radio" value="1"><label class="form-check-label" for="delete_post_published_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $published0; ?>class="form-check-input" disabled="disabled" id="delete_post_published_no" name="published" title="Опубликовать <?=$name['v'];?>?" type="radio" value="0"><label class="form-check-label" for="delete_post_published_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_post_del">
      <div class="delete_post">Удалить <?=$name['v'];?>?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $del1; ?>class="form-check-input" disabled="disabled" id="delete_post_del_yes" name="del" title="Удалить <?=$name['v'];?>?" type="radio" value="1"><label class="form-check-label" for="delete_post_del_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $del0; ?>class="form-check-input" disabled="disabled" id="delete_post_del_no" name="del" title="Удалить <?=$name['v'];?>?" type="radio" value="0"><label class="form-check-label" for="delete_post_del_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_post_title">
      <label class="form-label" for="delete_post_title_field">Название <?=$name['r'];?><span class="red1">*</span>:</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_title_field" maxlength="255" name="title" placeholder="Название <?=$name['r'];?>" size="100" title="Название <?=$name['r'];?>" type="text" value="<?=$post['title'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_alias">
      <label class="form-label" for="delete_post_alias_field">Алиас <?=$name['r'];?><span class="red1">*</span>:</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_alias_field" maxlength="255" name="alias" placeholder="Алиас <?=$name['r'];?>" size="100" title="Алиас <?=$name['r'];?>" type="text" value="<?=$post['alias'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_description">
      <label class="form-label" for="delete_post_description_field">Краткое описание <?=$name['r'];?> (для SEO, если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_description_field" maxlength="255" name="description" placeholder="Краткое описание" size="100" title="Краткое описание" type="text" value="<?=$post['description'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_keywords">
      <label class="form-label" for="delete_post_keywords_field">Ключевые слова (для SEO, если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_keywords_field" maxlength="255" name="keywords" placeholder="Ключевые слова" size="100" title="Ключевые слова" type="text" value="<?=$post['keywords'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_author">
      <label class="form-label" for="delete_post_author_field">Имя автора <?=$name['r'];?><span class="red1">*</span>:</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_author_field" maxlength="255" name="author" placeholder="Имя автора <?=$name['r'];?>" size="100" title="Имя автора <?=$name['r'];?>" type="text" value="<?php if (empty($post['author'])) {echo $this->user['login'];} else {echo $post['author'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_date">
      <label class="form-label" for="delete_post_date_field">Дата и время создания <?=$name['r'];?> (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_date_field" maxlength="19" name="date" placeholder="Дата и время создания <?=$name['r'];?>" size="15" title="Дата и время создания <?=$name['r'];?>" type="text" value="<?php if (empty($post['date'])) {$date = date("Y-m-d H:i:s"); echo $date;} else {echo $post['date'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_view">
      <label class="form-label" for="delete_post_view_field">Количество просмотров:</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_view_field" maxlength="7" name="view" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($post['view'])) {echo '0';} else {echo $post['view'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_rating">
      <label class="form-label" for="delete_post_rating_field">Рейтинг (оценка):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_rating_field" maxlength="7" name="rating" placeholder="Рейтинг (оценка)" size="7" title="Рейтинг (оценка)" type="number" value="<?php if (empty($post['rating'])) {echo '5';} else {echo $post['rating'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_quantity_vote">
      <label class="form-label" for="delete_post_quantity_vote_field">Количество голосов:</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_quantity_vote_field" maxlength="7" name="quantity_vote" placeholder="Количество голосов" size="7" title="Количество голосов" type="number" value="<?php if (empty($post['quantity_vote'])) {echo '1';} else {echo $post['quantity_vote'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="uploaded_image">
      <label class="form-label">Ранее загруженная картинка:</label><br>
    <?php if ((!empty($post['image'])) and (is_file($post['image']))): ?>
      <a class="uploadimage" href="<?=D.S.$post['image'];?>" rel="image" target="_blank" title="<?=basename($post['image']);?>"><img alt="<?=basename($post['image']);?>" class="oneimage" src="<?=D.S.$post['image'];?>" title="<?=basename($post['image']);?>"></a>
    <?php endif; ?>
    </div>

    <div class="cpinput form-group" id="delete_post_file_upload_name">
      <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>):</label>
      <input class="delete_post form-control" disabled="disabled" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?php if (is_file($post['image'])) {echo basename($post['image']);}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_image_path">
      <label class="form-label" for="delete_post_image_path_field">Путь к картинке (например, <span class="monospace_url"><?=$default_image_path;?></span>):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_image_path_field" maxlength="255" name="image_path" placeholder="Путь к картинке" size="100" title="Путь к картинке" type="text" value="<?php $image_path=$default_image_path; if (is_file($post['image'])) {$image_path = dirname($post['image']);} elseif (is_dir($post['image'])) {$image_path = $post['image'];} elseif (empty($post['image'])) {$image_path = $default_image_path;} echo $image_path; ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput" id="screenshots"><label>Ранее загруженные скриншоты:</label><br>
    <?php if (!empty($post['screenshots'])): ?>
      <?php $screenshots_array = explode(',',$post['screenshots']);
      foreach($screenshots_array as $key => $item): ?>
        <a class="uploadimage" data-index="<?=$key;?>" href="<?=dirname($post['image']).S.$item;?>" rel="gallery" target="_blank" title="<?=$item;?>"><img alt="<?=$item;?>" class="images" src="<?=dirname($post['image']).S.$item;?>" title="<?=$item;?>"></a>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>

    <div class="cpinput form-group" id="delete_post_screenshots">
      <label class="form-label" for="delete_post_screenshots_field">Названия скриншотов <?=$name['r'];?> через запятую (если есть):</label>
      <textarea class="delete_post form-control" cols="102" disabled="disabled" id="delete_post_screenshots_field" name="screenshots" placeholder="Названия скриншотов" rows="6" title="Названия скриншотов"><?=isset($post['screenshots']) ? $post['screenshots'] : ''; ?></textarea>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_size">
      <label class="form-label" for="delete_post_size_field">Размер прикреплённых файлов (в байтах, если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_size_field" maxlength="15" name="size" placeholder="Размер файла" size="15" title="Размер файла" type="number" value="<?php if (empty($post['size'])) {echo '0';} else {echo $post['size'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_gallery_id">
      <label class="form-label" for="delete_post_gallery_id_field">ID галереи (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_gallery_id_field" maxlength="7" name="gallery_id" placeholder="ID галереи" size="15" title="ID галереи" type="number" value="<?php if (empty($post['gallery_id'])) {echo '0';} else {echo $post['gallery_id'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_album_id">
      <label class="form-label" for="delete_post_album_id_field">ID альбома (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_album_id_field" maxlength="7" name="album_id" placeholder="ID альбома" size="15" title="ID альбома" type="number" value="<?php if (empty($post['album_id'])) {echo '0';} else {echo $post['album_id'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_partner_link">
      <label class="form-label" for="delete_post_partner_link_field">Адрес реферальной (партнёрской) ссылки (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_partner_link_field" maxlength="255" name="partner_link" placeholder="Адрес реферальной (партнёрской) ссылки" size="100" title="Адрес реферальной (партнёрской) ссылки" type="text" value="<?php if (isset($post['partner_link'])) {echo $post['partner_link'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_transitions">
      <label class="form-label" for="delete_post_transitions_field">Количество переходов по реферальной (партнёрской) ссылке (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_transitions_field" maxlength="7" name="transitions" placeholder="Количество переходов по реферальной (партнёрской) ссылке" size="7" title="Количество переходов по реферальной (партнёрской) ссылке" type="number" value="<?php if (empty($post['transitions'])) {echo '0';} else {echo $post['transitions'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_download_link">
      <label class="form-label" for="delete_post_download_link_field">Адрес ссылки для скачивания с ftp-сервера (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_download_link_field" maxlength="255" name="download_link" placeholder="Адрес ссылки для скачивания с ftp-сервера" size="100" title="Адрес ссылки для скачивания с ftp-сервера" type="text" value="<?php if (isset($post['download_link'])) {echo $post['download_link'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_downloaded">
      <label class="form-label" for="delete_post_downloaded_field">Количество переходов по ссылке для скачивания с ftp-сервера (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_downloaded_field" maxlength="7" name="downloaded" placeholder="Количество переходов по ссылке для скачивания с ftp-сервера" size="7" title="Количество переходов по ссылке для скачивания с ftp-сервера" type="number" value="<?php if (empty($post['downloaded'])) {echo '0';} else {echo $post['downloaded'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_internet_link">
      <label class="form-label" for="delete_post_internet_link_field">Адрес ссылки для скачивания с интернета (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_internet_link_field" maxlength="255" name="internet_link" placeholder="Адрес ссылки для скачивания с интернета" size="100" title="Адрес ссылки для скачивания с интернета" type="text" value="<?php if (isset($post['internet_link'])) {echo $post['internet_link'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_internet_downloaded">
      <label class="form-label" for="delete_post_internet_downloaded_field">Количество переходов по ссылке для скачивания с интернета (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_internet_downloaded_field" maxlength="7" name="internet_downloaded" placeholder="Количество переходов по ссылке для скачивания с интернета" size="7" title="Количество переходов по ссылке для скачивания с интернета" type="number" value="<?php if (empty($post['internet_downloaded'])) {echo '0';} else {echo $post['internet_downloaded'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_buy_link">
      <label class="form-label" for="delete_post_buy_link_field">Адрес ссылки для оформления заказа (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_buy_link_field" maxlength="255" name="buy_link" placeholder="Адрес ссылки для оформления заказа" size="100" title="Адрес ссылки для оформления заказа" type="text" value="<?php if (isset($post['buy_link'])) {echo $post['buy_link'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_orders">
      <label class="form-label" for="delete_post_orders_field">Количество переходов для оформления заказа (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_orders_field" maxlength="7" name="orders" placeholder="Количество переходов для оформления заказа" size="7" title="Количество переходов для оформления заказа" type="number" value="<?php if (empty($post['orders'])) {echo '0';} else {echo $post['orders'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_price">
      <label class="form-label" for="delete_post_price_field">Цена (если есть):</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_price_field" maxlength="7" name="price" placeholder="Цена" size="15" title="Цена" type="number" value="<?php if (empty($post['price'])) {echo '0';} else {echo $post['price'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_hash">
      <label class="form-label" for="delete_post_hash_field">Хеш для ссылок для скачивания:</label>
      <input class="delete_post form-control" disabled="disabled" id="delete_post_hash_field" maxlength="255" name="hash" placeholder="Хеш для ссылок для скачивания" size="100" title="Хеш для ссылок для скачивания" type="text" value="<?php echo $post['hash']; ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_introduction">
      <label class="form-label" for="introduction_field">Краткое описание <?=$name['r'];?> с html-тэгами<span class="red1">*</span>:</label>
      <textarea class="delete_post form-control" cols="102" disabled="disabled" id="introduction_field" name="introduction" placeholder="Краткое описание <?=$name['r'];?>" rows="10" title="Краткое описание <?=$name['r'];?>"><?php if (isset($post['introduction'])) {echo $post['introduction'];}?></textarea>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_post_text">
      <label class="form-label" for="delete_post_text_field">Полный текст <?=$name['r'];?> с html-тэгами<span class="red1">*</span>:</label>
      <textarea class="delete_post form-control" cols="102" disabled="disabled" id="text_field" name="text" placeholder="Полный текст <?=$name['r'];?>" rows="15" title="Полный текст <?=$name['r'];?>"><?php if (isset($post['text'])) {echo $post['text'];}?></textarea>
      <div class="form-text"></div>
    </div>

    <div class="center red"><strong>Внимание! Восстановить <?=$name['v'];?> будет невозможно!</strong></div><br><br>
    <div class="cpinput_button"><input class="button delete" id="submit_post" name="submit_post" type="submit" value="Удалить <?=$name['v'];?>"></div>
  </form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div><br>