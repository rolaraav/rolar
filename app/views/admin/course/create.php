<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} ?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<form action="" enctype="multipart/form-data" method="post" name="create_course">

  <!--
  <div class="cpinput form-group" id="create_post_type">
  <?php if (isset($post_types)) {echo $post_types;} ?>
    <div class="form-text"></div>
  </div> -->

  <div class="cpinput form-group" id="create_course_category">
  <?php if (isset($course_categories)) {echo $course_categories;} ?>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_hide_plink">
    <div class="create_course">Скрыть партнёрскую ссылку?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $hide_plink1; ?>class="form-check-input" id="create_course_hide_plink_yes" name="hide_plink" title="Скрыть партнёрскую ссылку?" type="radio" value="1"><label class="form-check-label" for="create_course_hide_plink_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $hide_plink0; ?>class="form-check-input" id="create_course_hide_plink_no" name="hide_plink" title="Скрыть партнёрскую ссылку?" type="radio" value="0"><label class="form-check-label" for="create_course_hide_plink_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="create_course_published">
    <div class="create_course">Опубликовать курс?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" id="create_course_published_yes" name="published" title="Опубликовать курс?" type="radio" value="1"><label class="form-check-label" for="create_course_published_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" id="create_course_published_no" name="published" title="Опубликовать курс?" type="radio" value="0"><label class="form-check-label" for="create_course_published_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="create_course_title">
    <label class="form-label" for="create_course_title_field">Введите название курса<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="create_course_title_field" maxlength="255" name="title" placeholder="Название курса" size="100" title="Введите название курса" type="text" value="<?=isset($_SESSION['create']['title']) ? $_SESSION['create']['title'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_alias">
    <label class="form-label" for="create_course_alias_field">Введите алиас курса (нужен при заказе и для скачивания)<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="create_course_alias_field" maxlength="255" name="alias" placeholder="Алиас курса" size="100" title="Введите алиас курса" type="text" value="<?=isset($_SESSION['create']['alias']) ? $_SESSION['create']['alias'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_author">
    <label class="form-label" for="create_course_author_field">Введите автора(ов) курса<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="create_course_author_field" maxlength="255" name="author" placeholder="Автор(ы) курса" size="100" title="Введите автора(ов) курса" type="text" value="<?=isset($_SESSION['create']['author']) ? $_SESSION['create']['author'] : '';?>">
    <div class="form-text"></div>
  </div>


  <div class="cpinput form-group" id="create_course_image">
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

  <div class="cpinput form-group" id="create_course_file_upload_name">
    <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>)<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?=isset($_SESSION['create']['image']) ? $_SESSION['create']['image'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_image_path">
    <label class="form-label" for="create_course_image_path_field">Путь к картинке (например, <span class="monospace_url">images/courses/</span>)<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="create_course_image_path_field" maxlength="255" name="image_path" placeholder="Путь к картинке" readonly="readonly" size="100" title="Путь к картинке" type="text" value="<?php if (empty($_SESSION['create']['image_path'])) {echo 'images/courses/';} else {echo $_SESSION['create']['image_path'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_text">
    <label class="form-label" for="create_course_text_field">Введите текст курса с html-тэгами<span class="red1">*</span>:</label>
    <textarea class="create_course form-control" cols="102" id="text_field" name="text" placeholder="Текст курса" rows="10" title="Введите текст курса"><?php if (isset($_SESSION['create']['text'])) {echo $_SESSION['create']['text'];}?></textarea>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_size">
    <label class="form-label" for="create_course_size_field">Введите размер прикреплённых файлов (в байтах, если есть):</label>
    <input class="create_course form-control" id="create_course_size_field" maxlength="15" name="size" placeholder="Размер файла" size="15" title="Введите размер файла" type="number" value="<?php if (empty($_SESSION['create']['size'])) {echo '0';} else {echo $_SESSION['create']['size'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_year">
    <label class="form-label" for="create_course_year_field">Введите год выпуска курса (ГГГГ, если есть):</label>
    <input class="create_course form-control" id="create_course_year_field" maxlength="4" name="year" placeholder="Год выпуска" size="4" title="Введите год выпуска" type="number" value="<?php if (empty($_SESSION['create']['year'])) {echo '2000';} else {echo $_SESSION['create']['year'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_price">
    <label class="form-label" for="create_course_price_field">Введите цену курса<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="create_course_price_field" maxlength="7" name="price" placeholder="Цена курса" size="15" title="Введите цену курса" type="number" value="<?php if (empty($_SESSION['create']['price'])) {echo '0';} else {echo $_SESSION['create']['price'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_author_price">
    <label class="form-label" for="create_course_author_price_field">Введите цену курса на сайте автора (если есть):</label>
    <input class="create_course form-control" id="create_course_author_price_field" maxlength="7" name="author_price" placeholder="Цена курса на сайте автора" size="15" title="Введите цену курса на сайте автора" type="number" value="<?php if (empty($_SESSION['create']['author_price'])) {echo '0';} else {echo $_SESSION['create']['author_price'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_buy_link">
    <label class="form-label" for="create_course_buy_link_field">Введите адрес ссылки для оформления заказа<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="create_course_buy_link_field" maxlength="255" name="buy_link" placeholder="Адрес ссылки для оформления заказа" size="100" title="Введите адрес ссылки для оформления заказа" type="text" value="<?php if (isset($_SESSION['create']['buy_link'])) {echo $_SESSION['create']['buy_link'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_download_link">
    <label class="form-label" for="create_course_download_link_field">Введите адрес ссылки для скачивания с ftp-сервера<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="create_course_download_link_field" maxlength="255" name="download_link" placeholder="Адрес ссылки для скачивания" size="100" title="Введите адрес ссылки для скачивания" type="text" value="<?php if (isset($_SESSION['create']['download_link'])) {echo $_SESSION['create']['download_link'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_course_partner_link">
    <label class="form-label" for="create_course_partner_link_field">Введите адрес реферальной (партнёрской) ссылки (если есть):</label>
    <input class="create_course form-control" id="create_course_partner_link_field" maxlength="255" name="partner_link" placeholder="Адрес реферальной (партнёрской) ссылки" size="100" title="Введите адрес реферальной (партнёрской) ссылки" type="text" value="<?php if (isset($_SESSION['create']['partner_link'])) {echo $_SESSION['create']['partner_link'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_course" name="submit_course" type="submit" value="Создать курс"></div>
</form><br>
<?php
unset($_SESSION['create']);
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div><br>