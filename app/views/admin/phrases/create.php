<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} ?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<form action="" enctype="multipart/form-data" method="post" name="create_phrase">

  <div class="cpinput form-group" id="create_phrase_text">
    <label class="form-label" for="create_phrase_text_field">Введите текст фразы с html-тэгами<span class="red1">*</span>:</label>
    <textarea class="create_phrase form-control" cols="102" id="text_field" name="text" placeholder="Текст фразы" rows="10" title="Введите текст фразы"><?php if (isset($_SESSION['create']['text'])) {echo $_SESSION['create']['text'];}?></textarea>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_phrase_author">
    <label class="form-label" for="create_phrase_author_field">Введите имя автора фразы или источник<span class="red1">*</span>:</label>
    <input class="create_phrase form-control" id="create_phrase_author_field" maxlength="255" name="author" placeholder="Имя автора фразы или источник" size="100" title="Введите имя автора фразы или источник" type="text" value="<?=isset($_SESSION['create']['author']) ? $_SESSION['create']['author'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_phrase_image">
    <label class="form-label" for="file_upload_input">Загрузка фоновой картинки:</label><br>
    <div class="file_upload">
      <div class="file_upload_label">Файл не выбран</div>
      <button class="file_upload_button" type="button">Загрузить файл</button>
      <input id="file_upload_input" name="file" type="file">
    </div>
    <div class="file_upload_result"></div>
    <div class="file_upload_image"></div>
    <input type="hidden" name="MAX_FILE_SIZE" value="<?=MAX_FILE_SIZE;?>">
  </div>

  <div class="cpinput form-group" id="create_phrase_file_upload_name">
    <label class="form-label" for="file_upload_name_field">Название загруженной фоновой картинки (например, <span class="monospace_url">fon.jpg</span>)<span class="red1">*</span>:</label>
    <input class="create_phrase form-control" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной фоновой картинки" size="100" title="Название загруженной фоновой картинки" type="text" value="<?=empty($_SESSION['create']['image']) ? 'fon.jpg' : $_SESSION['create']['image'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_phrase_text_color">
    <label class="form-label" for="create_phrase_text_color_field">Введите цвет текста (в формате <span class="monospace_url">#000000</span>)<span class="red1">*</span>:</label>
    <input class="create_phrase form-control" id="create_phrase_text_color_field" maxlength="7" name="color" placeholder="Цвет текста" size="100" title="Введите цвет текста" type="color" value="<?=empty($_SESSION['create']['color']) ? '#ffffff' : $_SESSION['create']['color'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_phrase_published">
    <div class="create_phrase">Опубликовать фразу?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" id="create_phrase_published_yes" name="published" title="Опубликовать фразу?" type="radio" value="1"><label class="form-check-label" for="create_phrase_published_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" id="create_phrase_published_no" name="published" title="Опубликовать фразу?" type="radio" value="0"><label class="form-check-label" for="create_phrase_published_no"> Нет</label>
      </div>
    </div>
  </div>

  <!--
  <div class="cpinput form-group" id="create_phrase_del">
    <div class="create_phrase">Удалить фразу?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $del1; ?>class="form-check-input" id="create_phrase_del_yes" name="del" title="Удалить фразу?" type="radio" value="1"><label class="form-check-label" for="create_phrase_del_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $del0; ?>class="form-check-input" id="create_phrase_del_no" name="del" title="Удалить фразу?" type="radio" value="0"><label class="form-check-label" for="create_phrase_del_no"> Нет</label>
      </div>
    </div>
  </div> -->

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_phrase" name="submit_phrase" type="submit" value="Добавить фразу"></div>
</form><br>
<?php
unset($_SESSION['create']);
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>