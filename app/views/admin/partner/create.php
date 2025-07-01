<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} ?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<form action="" enctype="multipart/form-data" method="post" name="create_partner">

  <div class="cpinput form-group" id="create_partner_title">
    <label class="form-label" for="create_partner_title_field">Введите имя и фамилию партнёра<span class="red1">*</span>:</label>
    <input class="create_partner form-control" id="create_partner_title_field" maxlength="255" name="title" placeholder="Имя и фамилия партнёра" size="100" title="Введите имя и фамилию партнёра" type="text" value="<?=isset($_SESSION['create']['title']) ? $_SESSION['create']['title'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_partner_alias">
    <label class="form-label" for="create_partner_alias_field">Введите алиас партнёра<span class="red1">*</span>:</label>
    <input class="create_partner form-control" id="create_partner_alias_field" maxlength="255" name="alias" placeholder="Алиас партнёра" size="100" title="Введите алиас партнёра" type="text" value="<?=isset($_SESSION['create']['alias']) ? $_SESSION['create']['alias'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_partner_published">
    <div class="create_partner">Опубликовать партнёра?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" id="create_partner_published_yes" name="published" title="Опубликовать партнёра?" type="radio" value="1"><label class="form-check-label" for="create_partner_published_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" id="create_partner_published_no" name="published" title="Опубликовать партнёра?" type="radio" value="0"><label class="form-check-label" for="create_partner_published_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="create_partner_description">
    <label class="form-label" for="create_partner_description_field">Введите краткое описание партнёра (для SEO, если есть):</label>
    <input class="create_partner form-control" id="create_partner_description_field" maxlength="255" name="description" placeholder="Краткое описание" size="100" title="Введите краткое описание" type="text" value="<?=isset($_SESSION['create']['description']) ? $_SESSION['create']['description'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_partner_keywords">
    <label class="form-label" for="create_partner_keywords_field">Введите ключевые слова (для SEO, если есть):</label>
    <input class="create_partner form-control" id="create_partner_keywords_field" maxlength="255" name="keywords" placeholder="Ключевые слова" size="100" title="Введите ключевые слова" type="text" value="<?=isset($_SESSION['create']['keywords']) ? $_SESSION['create']['keywords'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_partner_image">
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

  <div class="cpinput form-group" id="create_partner_file_upload_name">
    <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>)<span class="red1">*</span>:</label>
    <input class="create_partner form-control" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?=isset($_SESSION['create']['image']) ? $_SESSION['create']['image'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_partner_image_path">
    <label class="form-label" for="create_partner_image_path_field">Путь к картинке (например, <span class="monospace_url">images/partners/</span>)<span class="red1">*</span>:</label>
    <input class="create_partner form-control" id="create_partner_image_path_field" maxlength="255" name="image_path" placeholder="Путь к картинке" readonly="readonly" size="100" title="Путь к картинке" type="text" value="<?php echo 'images/partners/'; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_partner_text">
    <label class="form-label" for="create_partner_text_field">Введите текст страницы партнёра с html-тэгами<span class="red1">*</span>:</label>
    <textarea class="create_partner form-control" cols="102" id="text_field" name="text" placeholder="Текст страницы партнёра" rows="10" title="Текст страницы партнёра"><?php if (isset($_SESSION['create']['text'])) {echo $_SESSION['create']['text'];}?></textarea>
    <div class="form-text"></div>
  </div>

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_partner" name="submit_partner" type="submit" value="Добавить партнера"></div>
</form><br>
<?php
unset($_SESSION['create']);
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>