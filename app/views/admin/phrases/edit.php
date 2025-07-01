<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($phrase);
if (empty($phrase)): ?>
    <div>Такой фразы не существует.</div>
<?php else: ?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<div class="cpinput"><strong>Исходная фраза:</strong></div>
<div class="phrase"<?php if (isset($phrase['image'])): ?> style="background-image: url(<?='../images/phrases/'.$phrase['image'];?>);"<?php endif; ?>>
    <div class="phraseblock"<?php if (isset($phrase['color'])): ?> style="color: <?=$phrase['color'];?>;"<?php endif; ?>>
        <div class="phrasetext"><?=$phrase['text'];?></div>
        <div class="phraseauthor"><?=$phrase['author'];?></div>
    </div>
</div>
<br>
<form action="" enctype="multipart/form-data" method="post" name="edit_phrase">

  <div class="cpinput form-group" id="edit_phrase_text">
    <label class="form-label" for="edit_phrase_text_field">Введите текст фразы с html-тэгами<span class="red1">*</span>:</label>
    <textarea class="edit_phrase form-control" cols="102" id="text_field" name="text" placeholder="Текст фразы" rows="10" title="Введите текст фразы"><?php if (isset($phrase['text'])) {echo $phrase['text'];}?></textarea>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_phrase_author">
    <label class="form-label" for="edit_phrase_author_field">Введите имя автора фразы или источник<span class="red1">*</span>:</label>
    <input class="edit_phrase form-control" id="edit_phrase_author_field" maxlength="255" name="author" placeholder="Имя автора фразы или источник" size="100" title="Введите имя автора фразы или источник" type="text" value="<?=isset($phrase['author']) ? $phrase['author'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_phrase_image">
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

  <div class="cpinput form-group" id="uploaded_image">
    <label class="form-label">Ранее загруженная фоновая картинка (после сохранения она будет заменена на новую):</label><br>
  <?php if ((!empty($phrase['image'])) and (is_file('images/phrases/'.$phrase['image']))): ?>
  <a class="uploadimage" href="<?=I.S.'phrases'.S.$phrase['image'];?>" rel="image" target="_blank" title="<?=$phrase['image'];?>"><img alt="<?=$phrase['image'];?>" class="oneimage" src="<?=I.S.'phrases'.S.$phrase['image'];?>" title="<?=$phrase['image'];?>"><?php if ($phrase['image'] != 'fon.jpg'): ?><div class="delimg" title="Удалить картинку <?=$phrase['image'];?>"></div><?php endif; ?></a><?php if ($phrase['image'] == 'fon.jpg'): ?> - <span class="blue1">фоновая картинка по умолчанию</span><?php endif; ?>
  <?php endif; ?>
  </div>

  <div class="cpinput form-group" id="edit_phrase_file_upload_name">
    <label class="form-label" for="file_upload_name_field">Название загруженной фоновой картинки (например, <span class="monospace_url">fon.jpg</span>)<span class="red1">*</span>:</label>
    <input class="edit_phrase form-control" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной фоновой картинки" size="100" title="Название загруженной фоновой картинки" type="text" value="<?=empty($phrase['image']) ? 'fon.jpg' : $phrase['image'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_phrase_text_color">
    <label class="form-label" for="edit_phrase_text_color_field">Введите цвет текста (в формате <span class="monospace_url">#000000</span>)<span class="red1">*</span>:</label>
    <input class="edit_phrase form-control" id="edit_phrase_text_color_field" maxlength="7" name="color" placeholder="Цвет текста" size="100" title="Введите цвет текста" type="color" value="<?=empty($phrase['color']) ? '#ffffff' : $phrase['color'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_phrase_view">
    <label class="form-label" for="edit_phrase_view_field">Количество просмотров:</label>
    <div class="edit_banner input-group">
      <input class="edit_phrase form-control" id="edit_phrase_view_field" maxlength="7" name="view" readonly="readonly" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($phrase['view'])) {echo '0';} else {echo $phrase['view'];} ?>">
      <div class="input-group-append">
        <input class="button btn btn-outline-secondary" id="edit_phrase_view_reset" name="view_reset" type="button" value="Обнулить">
      </div>
    </div>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_phrase_published">
    <div class="edit_phrase">Опубликовать фразу?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" id="edit_phrase_published_yes" name="published" title="Опубликовать фразу?" type="radio" value="1"><label class="form-check-label" for="edit_phrase_published_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" id="edit_phrase_published_no" name="published" title="Опубликовать фразу?" type="radio" value="0"><label class="form-check-label" for="edit_phrase_published_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="edit_phrase_del">
    <div class="edit_phrase">Удалить фразу?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $del1; ?>class="form-check-input" id="edit_phrase_del_yes" name="del" title="Удалить фразу?" type="radio" value="1"><label class="form-check-label" for="edit_phrase_del_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $del0; ?>class="form-check-input" id="edit_phrase_del_no" name="del" title="Удалить фразу?" type="radio" value="0"><label class="form-check-label" for="edit_phrase_del_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_phrase" name="submit_phrase" type="submit" value="Сохранить фразу"></div>
</form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>