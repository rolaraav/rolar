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
  <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
    <form action="" enctype="multipart/form-data" method="post" name="edit_post">

    <div class="cpinput form-group" id="edit_post_type">
      <?php if (isset($post_types)) {echo $post_types;} ?>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_category">
      <?php if (isset($post_categories)) {echo $post_categories;} ?>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_partner">
      <?php if (isset($partners)) {echo $partners;} ?>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_secret">
        <div class="edit_post">Поместить <?=$name['v'];?> в секретный раздел?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $secret1; ?>class="form-check-input" id="edit_post_secret_yes" name="secret" title="Поместить <?=$name['v'];?> в секретный раздел?" type="radio" value="1"><label class="form-check-label" for="edit_post_secret_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $secret0; ?>class="form-check-input" id="edit_post_secret_no" name="secret" title="Поместить <?=$name['v'];?> в секретный раздел?" type="radio" value="0"><label class="form-check-label" for="edit_post_secret_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_post_hidden">
        <div class="edit_post">Скрыть <?=$name['v'];?>?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $hidden1; ?>class="form-check-input" id="edit_post_hidden_yes" name="hidden" title="Скрыть <?=$name['v'];?>?" type="radio" value="1"><label class="form-check-label" for="edit_post_hidden_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $hidden0; ?>class="form-check-input" id="edit_post_hidden_no" name="hidden" title="Скрыть <?=$name['v'];?>?" type="radio" value="0"><label class="form-check-label" for="edit_post_hidden_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_post_hide_link">
        <div class="edit_post">Скрыть ссылки на скачивание?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $hide_link1; ?>class="form-check-input" id="edit_post_hide_link_yes" name="hide_link" title="Скрыть ссылки на скачивание?" type="radio" value="1"><label class="form-check-label" for="edit_post_hide_link_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $hide_link0; ?>class="form-check-input" id="edit_post_hide_link_no" name="hide_link" title="Скрыть ссылки на скачивание?" type="radio" value="0"><label class="form-check-label" for="edit_post_hide_link_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_post_comments">
        <div class="edit_post">Разрешить комментарии к <?=$name['d'];?>?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $comments1; ?>class="form-check-input" id="edit_post_comments_yes" name="comments" title="Разрешить комментарии к <?=$name['d'];?>?" type="radio" value="1"><label class="form-check-label" for="edit_post_comments_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $comments0; ?>class="form-check-input" id="edit_post_comments_no" name="comments" title="Разрешить комментарии к <?=$name['d'];?>?" type="radio" value="0"><label class="form-check-label" for="edit_post_comments_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_post_published">
        <div class="edit_post">Опубликовать <?=$name['v'];?>?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $published1; ?>class="form-check-input" id="edit_post_published_yes" name="published" title="Опубликовать <?=$name['v'];?>?" type="radio" value="1"><label class="form-check-label" for="edit_post_published_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $published0; ?>class="form-check-input" id="edit_post_published_no" name="published" title="Опубликовать <?=$name['v'];?>?" type="radio" value="0"><label class="form-check-label" for="edit_post_published_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_post_del">
        <div class="edit_post">Удалить <?=$name['v'];?>?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $del1; ?>class="form-check-input" id="edit_post_del_yes" name="del" title="Удалить <?=$name['v'];?>?" type="radio" value="1"><label class="form-check-label" for="edit_post_del_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $del0; ?>class="form-check-input" id="edit_post_del_no" name="del" title="Удалить <?=$name['v'];?>?" type="radio" value="0"><label class="form-check-label" for="edit_post_del_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="edit_post_title">
        <label class="form-label" for="edit_post_title_field">Введите название <?=$name['r'];?><span class="red1">*</span>:</label>
        <input class="edit_post form-control" id="edit_post_title_field" maxlength="255" name="title" placeholder="Название <?=$name['r'];?>" size="100" title="Введите название <?=$name['r'];?>" type="text" value="<?=$post['title'];?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_alias">
        <label class="form-label" for="edit_post_alias_field">Введите алиас <?=$name['r'];?><span class="red1">*</span>:</label>
        <input class="edit_post form-control" id="edit_post_alias_field" maxlength="255" name="alias" placeholder="Алиас <?=$name['r'];?>" size="100" title="Введите алиас <?=$name['r'];?>" type="text" value="<?=$post['alias'];?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_description">
        <label class="form-label" for="edit_post_description_field">Введите краткое описание <?=$name['r'];?> (для SEO, если есть):</label>
        <input class="edit_post form-control" id="edit_post_description_field" maxlength="255" name="description" placeholder="Краткое описание" size="100" title="Введите краткое описание" type="text" value="<?=$post['description'];?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_keywords">
        <label class="form-label" for="edit_post_keywords_field">Введите ключевые слова (для SEO, если есть):</label>
        <input class="edit_post form-control" id="edit_post_keywords_field" maxlength="255" name="keywords" placeholder="Ключевые слова" size="100" title="Введите ключевые слова" type="text" value="<?=$post['keywords'];?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_author">
        <label class="form-label" for="edit_post_author_field">Введите имя автора <?=$name['r'];?><span class="red1">*</span>:</label>
        <input class="edit_post form-control" id="edit_post_author_field" maxlength="255" name="author" placeholder="Имя автора <?=$name['r'];?>" size="100" title="Введите имя автора <?=$name['r'];?>" type="text" value="<?php if (empty($post['author'])) {echo $this->user['login'];} else {echo $post['author'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_date">
        <label class="form-label" for="edit_post_date_field">Введите дату и время создания <?=$name['r'];?> (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
        <input class="edit_post form-control" id="edit_post_date_field" maxlength="19" name="date" placeholder="Дата и время создания <?=$name['r'];?>" size="15" title="Введите дату и время создания <?=$name['r'];?>" type="text" value="<?php if (empty($post['date'])) {$date = date("Y-m-d H:i:s"); echo $date;} else {echo $post['date'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_view">
        <label class="form-label" for="edit_post_view_field">Количество просмотров:</label>
        <div class="edit_post input-group">
        <input class="edit_post form-control" id="edit_post_view_field" maxlength="7" name="view" readonly="readonly" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($post['view'])) {echo '0';} else {echo $post['view'];}?>">
            <div class="input-group-append">
                <input class="button btn btn-outline-secondary" id="edit_post_view_reset" name="view_reset" type="button" value="Обнулить">
            </div>
        </div>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_rating">
        <label class="form-label" for="edit_post_rating_field">Рейтинг (оценка):</label>
        <div class="edit_post input-group">
        <input class="edit_post form-control" id="edit_post_rating_field" maxlength="7" name="rating" readonly="readonly" placeholder="Рейтинг (оценка)" size="7" title="Рейтинг (оценка)" type="number" value="<?php if (empty($post['rating'])) {echo '5';} else {echo $post['rating'];}?>">
            <div class="input-group-append">
                <input class="button btn btn-outline-secondary" id="edit_post_rating_reset" name="rating_reset" type="button" value="Сбросить">
            </div>
        </div>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_quantity_vote">
        <label class="form-label" for="edit_post_quantity_vote_field">Количество голосов:</label>
        <div class="edit_post input-group">
        <input class="edit_post form-control" id="edit_post_quantity_vote_field" maxlength="7" name="quantity_vote" readonly="readonly" placeholder="Количество голосов" size="7" title="Количество голосов" type="number" value="<?php if (empty($post['quantity_vote'])) {echo '1';} else {echo $post['quantity_vote'];}?>">
            <div class="input-group-append">
                <input class="button btn btn-outline-secondary" id="edit_post_quantity_vote_reset" name="quantity_vote_reset" type="button" value="Сбросить">
            </div>
        </div>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_image">
        <label class="form-label" for="file_upload_input">Загрузка картинки:</label><br>
        <div class="file_upload">
            <div class="file_upload_label">Файл не выбран</div>
            <button class="file_upload_button" type="button">Загрузить файл</button>
            <input id="file_upload_input" name="file" type="file">
        </div>
        <div class="file_upload_result"></div>
        <div class="file_upload_image"></div>
        <input type="hidden" name="MAX_FILE_SIZE" value="<?=MAX_FILE_SIZE;?>">
    </div>

    <div class="cpinput form-group" id="uploaded_image">
      <label class="form-label">Ранее загруженная картинка (после сохранения она будет заменена на новую):</label><br>
    <?php if ((!empty($post['image'])) and (is_file($post['image']))): ?>
      <a class="uploadimage" href="<?=D.S.$post['image'];?>" rel="image" target="_blank" title="<?=basename($post['image']);?>"><img alt="<?=basename($post['image']);?>" class="oneimage" src="<?=D.S.$post['image'];?>" title="<?=basename($post['image']);?>"><div class="delimg" title="Удалить картинку <?=basename($post['image']);?>"></div></a>
    <?php endif; ?>
    </div>

    <div class="cpinput form-group" id="edit_post_file_upload_name">
        <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>)<span class="red1">*</span>:</label>
        <input class="edit_post form-control" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?php if (is_file($post['image'])) {echo basename($post['image']);}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_image_path">
        <label class="form-label" for="edit_post_image_path_field">Путь к картинке (например, <span class="monospace_url"><?=$default_image_path;?></span>)<span class="red1">*</span>:</label>
        <input class="edit_post form-control" id="edit_post_image_path_field" maxlength="255" name="image_path" placeholder="Путь к картинке" size="100" title="Путь к картинке" type="text" value="<?php $image_path=$default_image_path; if (is_file($post['image'])) {$image_path = dirname($post['image']);} elseif (is_dir($post['image'])) {$image_path = $post['image'];} elseif (empty($post['image'])) {$image_path = $default_image_path;} echo $image_path; ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput"><div class="upload"></div>
        <div id="upload_result"></div>
        <div id="upload_image"></div></div>

    <div class="cpinput" id="screenshots"><label>Ранее загруженные скриншоты (после сохранения они будут заменены на новые):</label><br>
    <?php if (!empty($post['screenshots'])): ?>
    <?php $screenshots_array = explode(',',$post['screenshots']);
      foreach($screenshots_array as $key => $item): ?>
        <a class="uploadimage" data-index="<?=$key;?>" href="<?=dirname($post['image']).S.$item;?>" rel="gallery" target="_blank" title="<?=$item;?>"><img alt="<?=$item;?>" class="images" src="<?=dirname($post['image']).S.$item;?>" title="<?=$item;?>"><div class="delimg" title="Удалить картинку <?=$item;?>"></div></a>
      <?php endforeach; ?>
    <?php endif; ?>
    </div>

    <div class="cpinput form-group" id="edit_post_screenshots">
        <label class="form-label" for="screenshots_field">Введите названия скриншотов <?=$name['r'];?> через запятую (если есть):</label>
        <textarea class="edit_post form-control" cols="102" id="screenshots_field" name="screenshots" placeholder="Названия скриншотов" rows="6" title="Введите названия скриншотов"><?=isset($post['screenshots']) ? $post['screenshots'] : ''; ?></textarea>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_size">
        <label class="form-label" for="edit_post_size_field">Введите размер прикреплённых файлов (в байтах, если есть):</label>
        <input class="edit_post form-control" id="edit_post_size_field" maxlength="15" name="size" placeholder="Размер файла" size="15" title="Введите размер файла" type="number" value="<?php if (empty($post['size'])) {echo '0';} else {echo $post['size'];}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_gallery_id">
        <label class="form-label" for="edit_post_gallery_id_field">Введите ID галереи (если есть):</label>
        <input class="edit_post form-control" id="edit_post_gallery_id_field" maxlength="7" name="gallery_id" placeholder="ID галереи" size="15" title="Введите ID галереи" type="number" value="<?php if (empty($post['gallery_id'])) {echo '0';} else {echo $post['gallery_id'];}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_album_id">
        <label class="form-label" for="edit_post_album_id_field">Введите ID альбома (если есть):</label>
        <input class="edit_post form-control" id="edit_post_album_id_field" maxlength="7" name="album_id" placeholder="ID альбома" size="15" title="Введите ID альбома" type="number" value="<?php if (empty($post['album_id'])) {echo '0';} else {echo $post['album_id'];}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_partner_link">
        <label class="form-label" for="edit_post_partner_link_field">Введите адрес реферальной (партнёрской) ссылки (если есть):</label>
        <input class="edit_post form-control" id="edit_post_partner_link_field" maxlength="255" name="partner_link" placeholder="Адрес реферальной (партнёрской) ссылки" size="100" title="Введите адрес реферальной (партнёрской) ссылки" type="text" value="<?php if (isset($post['partner_link'])) {echo $post['partner_link'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_transitions">
        <label class="form-label" for="edit_post_transitions_field">Количество переходов по реферальной (партнёрской) ссылке (если есть):</label>
        <div class="edit_post input-group">
            <input class="edit_post form-control" id="edit_post_transitions_field" maxlength="7" name="transitions" readonly="readonly" placeholder="Количество переходов по реферальной (партнёрской) ссылке" size="7" title="Количество переходов по реферальной (партнёрской) ссылке" type="number" value="<?php if (empty($post['transitions'])) {echo '0';} else {echo $post['transitions'];} ?>">
            <div class="input-group-append">
                <input class="button btn btn-outline-secondary" id="edit_post_transitions_reset" name="transitions_reset" type="button" value="Обнулить">
            </div>
        </div>
        <div class="form-text"></div>
    </div>
    
    <div class="cpinput form-group" id="edit_post_download_link">
        <label class="form-label" for="edit_post_download_link_field">Введите адрес ссылки для скачивания с ftp-сервера (если есть):</label>
        <input class="edit_post form-control" id="edit_post_download_link_field" maxlength="255" name="download_link" placeholder="Адрес ссылки для скачивания с ftp-сервера" size="100" title="Введите адрес ссылки для скачивания с ftp-сервера" type="text" value="<?php if (isset($post['download_link'])) {echo $post['download_link'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_downloaded">
        <label class="form-label" for="edit_post_downloaded_field">Количество переходов по ссылке для скачивания с ftp-сервера (если есть):</label>
        <div class="edit_post input-group">
            <input class="edit_post form-control" id="edit_post_downloaded_field" maxlength="7" name="downloaded" readonly="readonly" placeholder="Количество переходов по ссылке для скачивания с ftp-сервера" size="7" title="Количество переходов по ссылке для скачивания с ftp-сервера" type="number" value="<?php if (empty($post['downloaded'])) {echo '0';} else {echo $post['downloaded'];} ?>">
            <div class="input-group-append">
                <input class="button btn btn-outline-secondary" id="edit_post_downloaded_reset" name="downloaded_reset" type="button" value="Обнулить">
            </div>
        </div>
        <div class="form-text"></div>
    </div>
    
    <div class="cpinput form-group" id="edit_post_internet_link">
        <label class="form-label" for="edit_post_internet_link_field">Введите адрес ссылки для скачивания с интернета (если есть):</label>
        <input class="edit_post form-control" id="edit_post_internet_link_field" maxlength="255" name="internet_link" placeholder="Адрес ссылки для скачивания с интернета" size="100" title="Введите адрес ссылки для скачивания с интернета" type="text" value="<?php if (isset($post['internet_link'])) {echo $post['internet_link'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_internet_downloaded">
        <label class="form-label" for="edit_post_internet_downloaded_field">Количество переходов по ссылке для скачивания с интернета (если есть):</label>
        <div class="edit_post input-group">
            <input class="edit_post form-control" id="edit_post_internet_downloaded_field" maxlength="7" name="internet_downloaded" readonly="readonly" placeholder="Количество переходов по ссылке для скачивания с интернета" size="7" title="Количество переходов по ссылке для скачивания с интернета" type="number" value="<?php if (empty($post['internet_downloaded'])) {echo '0';} else {echo $post['internet_downloaded'];} ?>">
            <div class="input-group-append">
                <input class="button btn btn-outline-secondary" id="edit_post_internet_downloaded_reset" name="internet_downloaded_reset" type="button" value="Обнулить">
            </div>
        </div>
        <div class="form-text"></div>
    </div>
    
    <div class="cpinput form-group" id="edit_post_buy_link">
        <label class="form-label" for="edit_post_buy_link_field">Введите адрес ссылки для оформления заказа (если есть):</label>
        <input class="edit_post form-control" id="edit_post_buy_link_field" maxlength="255" name="buy_link" placeholder="Адрес ссылки для оформления заказа" size="100" title="Введите адрес ссылки для оформления заказа" type="text" value="<?php if (isset($post['buy_link'])) {echo $post['buy_link'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_orders">
        <label class="form-label" for="edit_post_orders_field">Количество переходов для оформления заказа (если есть):</label>
        <div class="edit_post input-group">
            <input class="edit_post form-control" id="edit_post_orders_field" maxlength="7" name="orders" readonly="readonly" placeholder="Количество переходов для оформления заказа" size="7" title="Количество переходов для оформления заказа" type="number" value="<?php if (empty($post['orders'])) {echo '0';} else {echo $post['orders'];} ?>">
            <div class="input-group-append">
                <input class="button btn btn-outline-secondary" id="edit_post_orders_reset" name="orders_reset" type="button" value="Обнулить">
            </div>
        </div>
        <div class="form-text"></div>
    </div>
    
    <div class="cpinput form-group" id="edit_post_price">
        <label class="form-label" for="edit_post_price_field">Введите цену (если есть):</label>
        <input class="edit_post form-control" id="edit_post_price_field" maxlength="7" name="price" placeholder="Цена" size="15" title="Введите цену" type="number" value="<?php if (empty($post['price'])) {echo '0';} else {echo $post['price'];}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_hash">
        <label class="form-label" for="edit_post_hash_field">Хеш для ссылок для скачивания:</label>
        <div class="edit_post input-group">
            <input class="edit_post form-control" id="edit_post_hash_field" maxlength="255" name="hash" readonly="readonly" placeholder="Хеш для ссылок для скачивания" size="100" title="Хеш для ссылок для скачивания" type="text" value="<?php echo $post['hash']; ?>">
            <div class="input-group-append">
                <input class="button btn btn-outline-secondary" id="edit_post_hash_generate" name="hash_generate" type="button" value="Обновить">
            </div>
        </div>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_introduction">
        <label class="form-label" for="edit_post_introduction_field">Введите краткое описание <?=$name['r'];?> с html-тэгами<span class="red1">*</span>:</label>
        <textarea class="edit_post form-control" cols="102" id="introduction_field" name="introduction" placeholder="Краткое описание <?=$name['r'];?>" rows="10" title="Введите краткое описание <?=$name['r'];?>"><?php if (isset($post['introduction'])) {echo $post['introduction'];}?></textarea>
         <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_post_text">
        <label class="form-label" for="edit_post_text_field">Введите полный текст <?=$name['r'];?> с html-тэгами<span class="red1">*</span>:</label>
        <textarea class="edit_post form-control" cols="102" id="text_field" name="text" placeholder="Полный текст <?=$name['r'];?>" rows="15" title="Введите полный текст <?=$name['r'];?>"><?php if (isset($post['text'])) {echo $post['text'];}?></textarea>
        <div class="form-text"></div>
    </div>

    <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
    <div class="cpinput_button"><input class="button" id="submit_post" name="submit_post" type="submit" value="Сохранить <?=$name['v'];?>"></div>
    </form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div><br>