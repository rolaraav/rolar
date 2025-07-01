<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} ?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<form action="" enctype="multipart/form-data" method="post" name="create_post">

    <div class="cpinput form-group" id="create_post_type">
      <?php if (isset($post_types)) {echo $post_types;} ?>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_category">
      <?php if (isset($post_categories)) {echo $post_categories;} ?>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_partner">
      <?php if (isset($partners)) {echo $partners;} ?>
        <div class="form-text"></div>
    </div>

  <?php // echo '<br>secret='.$_SESSION['create']['secret'].'<br>published='.$_SESSION['create']['published'].'<br>comments='.$_SESSION['create']['comments'].'<br>';
?>

    <div class="cpinput form-group" id="create_post_secret">
        <div class="create_post">Поместить <?=$name['v'];?> в секретный раздел?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $secret1; ?>class="form-check-input" id="create_post_secret_yes" name="secret" title="Поместить <?=$name['v'];?> в секретный раздел?" type="radio" value="1"><label class="form-check-label" for="create_post_secret_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $secret0; ?>class="form-check-input" id="create_post_secret_no" name="secret" title="Поместить <?=$name['v'];?> в секретный раздел?" type="radio" value="0"><label class="form-check-label" for="create_post_secret_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="create_post_hidden">
        <div class="create_post">Скрыть <?=$name['v'];?>?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $hidden1; ?>class="form-check-input" id="create_post_hidden_yes" name="hidden" title="Скрыть <?=$name['v'];?>?" type="radio" value="1"><label class="form-check-label" for="create_post_hidden_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $hidden0; ?>class="form-check-input" id="create_post_hidden_no" name="hidden" title="Скрыть <?=$name['v'];?>?" type="radio" value="0"><label class="form-check-label" for="create_post_hidden_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="create_post_hide_link">
        <div class="create_post">Скрыть ссылки на скачивание?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $hide_link1; ?>class="form-check-input" id="create_post_hide_link_yes" name="hide_link" title="Скрыть ссылки на скачивание?" type="radio" value="1"><label class="form-check-label" for="create_post_hide_link_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $hide_link0; ?>class="form-check-input" id="create_post_hide_link_no" name="hide_link" title="Скрыть ссылки на скачивание?" type="radio" value="0"><label class="form-check-label" for="create_post_hide_link_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="create_post_comments">
        <div class="create_post">Разрешить комментарии к <?=$name['d'];?>?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $comments1; ?>class="form-check-input" id="create_post_comments_yes" name="comments" title="Разрешить комментарии к <?=$name['d'];?>?" type="radio" value="1"><label class="form-check-label" for="create_post_comments_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $comments0; ?>class="form-check-input" id="create_post_comments_no" name="comments" title="Разрешить комментарии к <?=$name['d'];?>?" type="radio" value="0"><label class="form-check-label" for="create_post_comments_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="create_post_published">
        <div class="create_post">Опубликовать <?=$name['v'];?>?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $published1; ?>class="form-check-input" id="create_post_published_yes" name="published" title="Опубликовать <?=$name['v'];?>?" type="radio" value="1"><label class="form-check-label" for="create_post_published_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $published0; ?>class="form-check-input" id="create_post_published_no" name="published" title="Опубликовать <?=$name['v'];?>?" type="radio" value="0"><label class="form-check-label" for="create_post_published_no"> Нет</label>
            </div>
        </div>
    </div>

    <div class="cpinput form-group" id="create_post_title">
        <label class="form-label" for="create_post_title_field">Введите название <?=$name['r'];?><span class="red1">*</span>:</label>
        <input class="create_post form-control" id="create_post_title_field" maxlength="255" name="title" placeholder="Название <?=$name['r'];?>" size="100" title="Введите название <?=$name['r'];?>" type="text" value="<?=isset($_SESSION['create']['title']) ? $_SESSION['create']['title'] : '';?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_alias">
        <label class="form-label" for="create_post_alias_field">Введите алиас <?=$name['r'];?><span class="red1">*</span>:</label>
        <input class="create_post form-control" id="create_post_alias_field" maxlength="255" name="alias" placeholder="Алиас <?=$name['r'];?>" size="100" title="Введите алиас <?=$name['r'];?>" type="text" value="<?=isset($_SESSION['create']['alias']) ? $_SESSION['create']['alias'] : '';?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_description">
        <label class="form-label" for="create_post_description_field">Введите краткое описание <?=$name['r'];?> (для SEO, если есть):</label>
        <input class="create_post form-control" id="create_post_description_field" maxlength="255" name="description" placeholder="Краткое описание" size="100" title="Введите краткое описание" type="text" value="<?=isset($_SESSION['create']['description']) ? $_SESSION['create']['description'] : '';?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_keywords">
        <label class="form-label" for="create_post_keywords_field">Введите ключевые слова (для SEO, если есть):</label>
        <input class="create_post form-control" id="create_post_keywords_field" maxlength="255" name="keywords" placeholder="Ключевые слова" size="100" title="Введите ключевые слова" type="text" value="<?=isset($_SESSION['create']['keywords']) ? $_SESSION['create']['keywords'] : '';?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_author">
        <label class="form-label" for="create_post_author_field">Введите имя автора <?=$name['r'];?><span class="red1">*</span>:</label>
        <input class="create_post form-control" id="create_post_author_field" maxlength="255" name="author" placeholder="Имя автора <?=$name['r'];?>" size="100" title="Введите имя автора <?=$name['r'];?>" type="text" value="<?php if (empty($_SESSION['create']['author'])) {echo $this->user['login'];} else {echo $_SESSION['create']['author'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_date">
        <label class="form-label" for="create_post_date_field">Введите дату и время создания <?=$name['r'];?> (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
        <input class="create_post form-control" id="create_post_date_field" maxlength="19" name="date" placeholder="Дата и время создания <?=$name['r'];?>" size="15" title="Введите дату и время создания <?=$name['r'];?>" type="text" value="<?php if (empty($_SESSION['create']['date'])) {$date = date("Y-m-d H:i:s"); echo $date;} else {echo $_SESSION['create']['date'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_image">
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

    <div class="cpinput form-group" id="create_post_file_upload_name">
        <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>)<span class="red1">*</span>:</label>
        <input class="create_post form-control" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?=isset($_SESSION['create']['image']) ? $_SESSION['create']['image'] : '';?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_image_path">
        <label class="form-label" for="create_post_image_path_field">Путь к картинке (например, <span class="monospace_url"><?=$default_image_path;?></span>)<span class="red1">*</span>:</label>
        <input class="create_post form-control" id="create_post_image_path_field" maxlength="255" name="image_path" placeholder="Путь к картинке" size="100" title="Путь к картинке" type="text" value="<?php if (empty($_SESSION['create']['image_path'])) {echo $default_image_path;} else {echo $_SESSION['create']['image_path'];}?>">
        <div class="form-text"></div>
    </div>

  <div class="cpinput"><div class="upload"></div>
    <div id="upload_result"></div>
    <div id="upload_image"></div></div>

    <div class="cpinput form-group" id="create_post_screenshots">
        <label class="form-label" for="screenshots_field">Введите названия скриншотов новости через запятую (если есть):</label>
        <textarea class="create_post form-control" cols="102" id="screenshots_field" name="screenshots" placeholder="Названия скриншотов" rows="6" title="Введите названия скриншотов"><?=isset($_SESSION['create']['screenshots']) ? $_SESSION['create']['screenshots'] : ''; ?></textarea>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_size">
        <label class="form-label" for="create_post_size_field">Введите размер прикреплённых файлов (в байтах, если есть):</label>
        <input class="create_post form-control" id="create_post_size_field" maxlength="15" name="size" placeholder="Размер файла" size="15" title="Введите размер файла" type="number" value="<?php if (empty($_SESSION['create']['size'])) {echo '0';} else {echo $_SESSION['create']['size'];}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_gallery_id">
        <label class="form-label" for="create_post_gallery_id_field">Введите ID галереи (если есть):</label>
        <input class="create_post form-control" id="create_post_gallery_id_field" maxlength="7" name="gallery_id" placeholder="ID галереи" size="15" title="Введите ID галереи" type="number" value="<?php if (empty($_SESSION['create']['gallery_id'])) {echo '0';} else {echo $_SESSION['create']['gallery_id'];}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_album_id">
        <label class="form-label" for="create_post_album_id_field">Введите ID альбома (если есть):</label>
        <input class="create_post form-control" id="create_post_album_id_field" maxlength="7" name="album_id" placeholder="ID альбома" size="15" title="Введите ID альбома" type="number" value="<?php if (empty($_SESSION['create']['album_id'])) {echo '0';} else {echo $_SESSION['create']['album_id'];}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_partner_link">
        <label class="form-label" for="create_post_partner_link_field">Введите адрес реферальной (партнёрской) ссылки (если есть):</label>
        <input class="create_post form-control" id="create_post_partner_link_field" maxlength="255" name="partner_link" placeholder="Адрес реферальной (партнёрской) ссылки" size="100" title="Введите адрес реферальной (партнёрской) ссылки" type="text" value="<?php if (isset($_SESSION['create']['partner_link'])) {echo $_SESSION['create']['partner_link'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_download_link">
        <label class="form-label" for="create_post_download_link_field">Введите адрес ссылки для скачивания с ftp-сервера (если есть):</label>
        <input class="create_post form-control" id="create_post_download_link_field" maxlength="255" name="download_link" placeholder="Адрес ссылки для скачивания с ftp-сервера" size="100" title="Введите адрес ссылки для скачивания с ftp-сервера" type="text" value="<?php if (isset($_SESSION['create']['download_link'])) {echo $_SESSION['create']['download_link'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_internet_link">
        <label class="form-label" for="create_post_internet_link_field">Введите адрес ссылки для скачивания с интернета (если есть):</label>
        <input class="create_post form-control" id="create_post_internet_link_field" maxlength="255" name="internet_link" placeholder="Адрес ссылки для скачивания с интернета" size="100" title="Введите адрес ссылки для скачивания с интернета" type="text" value="<?php if (isset($_SESSION['create']['internet_link'])) {echo $_SESSION['create']['internet_link'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_buy_link">
        <label class="form-label" for="create_post_buy_link_field">Введите адрес ссылки для оформления заказа (если есть):</label>
        <input class="create_post form-control" id="create_post_buy_link_field" maxlength="255" name="buy_link" placeholder="Адрес ссылки для оформления заказа" size="100" title="Введите адрес ссылки для оформления заказа" type="text" value="<?php if (isset($_SESSION['create']['buy_link'])) {echo $_SESSION['create']['buy_link'];} ?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_price">
        <label class="form-label" for="create_post_price_field">Введите цену (если есть):</label>
        <input class="create_post form-control" id="create_post_price_field" maxlength="7" name="price" placeholder="Цена" size="15" title="Введите цену" type="number" value="<?php if (empty($_SESSION['create']['price'])) {echo '0';} else {echo $_SESSION['create']['price'];}?>">
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_introduction">
        <label class="form-label" for="create_post_introduction_field">Введите краткое описание <?=$name['r'];?> с html-тэгами<span class="red1">*</span>:</label>
        <textarea class="create_post form-control" cols="102" id="introduction_field" name="introduction" placeholder="Краткое описание <?=$name['r'];?>" rows="10" title="Введите краткое описание <?=$name['r'];?>"><?php if (isset($_SESSION['create']['introduction'])) {echo $_SESSION['create']['introduction'];}?></textarea>
        <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="create_post_text">
        <label class="form-label" for="create_post_text_field">Введите полный текст <?=$name['r'];?> с html-тэгами<span class="red1">*</span>:</label>
        <textarea class="create_post form-control" cols="102" id="text_field" name="text" placeholder="Полный текст <?=$name['r'];?>" rows="15" title="Введите полный текст <?=$name['r'];?>"><?php if (isset($_SESSION['create']['text'])) {echo $_SESSION['create']['text'];}?></textarea>
        <div class="form-text"></div>
    </div>

    <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
    <div class="cpinput_button"><input class="button" id="submit_post" name="submit_post" type="submit" value="Создать <?=$name['v'];?>"></div>
</form><br>
<?php
unset($_SESSION['create']);
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div><br>