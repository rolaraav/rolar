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
<div class="center red"><strong>Внимание! Восстановить фразу будет невозможно!</strong><br><br></div>
<form action="" enctype="multipart/form-data" method="post" name="delete_phrase">

  <div class="cpinput form-group" id="delete_phrase_text">
    <label class="form-label" for="delete_phrase_text_field">Текст фразы с html-тэгами<span class="red1">*</span>:</label>
    <textarea class="delete_phrase form-control" cols="102" disabled="disabled" id="text_field" name="text" placeholder="Текст фразы" rows="10" title="Текст фразы"><?php if (isset($phrase['text'])) {echo $phrase['text'];}?></textarea>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="delete_phrase_author">
    <label class="form-label" for="delete_phrase_author_field">Имя автора фразы или источник<span class="red1">*</span>:</label>
    <input class="delete_phrase form-control" disabled="disabled" id="delete_phrase_author_field" maxlength="255" name="author" placeholder="Имя автора фразы или источник" size="100" title="Имя автора фразы или источник" type="text" value="<?=isset($phrase['author']) ? $phrase['author'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="uploaded_image">
    <label class="form-label">Ранее загруженная фоновая картинка:</label><br>
  <?php if ((!empty($phrase['image'])) and (is_file('images/phrases/'.$phrase['image']))): ?>
    <a class="uploadimage" href="<?=I.S.'phrases'.S.$phrase['image'];?>" rel="image" target="_blank" title="<?=$phrase['image'];?>"><img alt="<?=$phrase['image'];?>" class="oneimage" src="<?=I.S.'phrases'.S.$phrase['image'];?>" title="<?=$phrase['image'];?>"></a><?php if ($phrase['image'] == 'fon.jpg'): ?> - <span class="blue1">фоновая картинка по умолчанию</span><?php endif; ?>
  <?php endif; ?>
  </div>

  <div class="cpinput form-group" id="delete_phrase_file_upload_name">
    <label class="form-label" for="delete_phrase_file_upload_name_field">Название загруженной фоновой картинки (например, <span class="monospace_url">fon.jpg</span>)<span class="red1">*</span>:</label>
    <input class="delete_phrase form-control" disabled="disabled" id="delete_phrase_file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной фоновой картинки" size="100" title="Название загруженной фоновой картинки" type="text" value="<?=empty($phrase['image']) ? 'fon.jpg' : $phrase['image'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="delete_phrase_text_color">
    <label class="form-label" for="delete_phrase_text_color_field">Цвет текста (в формате <span class="monospace_url">#000000</span>)<span class="red1">*</span>:</label>
    <input class="delete_phrase form-control" disabled="disabled" id="delete_phrase_text_color_field" maxlength="7" name="color" placeholder="Цвет текста" size="100" title="Цвет текста" type="color" value="<?=empty($phrase['color']) ? '#ffffff' : $phrase['color'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="delete_phrase_view">
    <label class="form-label" for="delete_phrase_view_field">Количество просмотров:</label>
    <input class="delete_phrase form-control" disabled="disabled" id="delete_phrase_view_field" maxlength="7" name="view" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($phrase['view'])) {echo '0';} else {echo $phrase['view'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="delete_phrase_published">
    <div class="delete_phrase">Опубликовать фразу?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" disabled="disabled" id="delete_phrase_published_yes" name="published" title="Опубликовать фразу?" type="radio" value="1"><label class="form-check-label" for="delete_phrase_published_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" disabled="disabled" id="delete_phrase_published_no" name="published" title="Опубликовать фразу?" type="radio" value="0"><label class="form-check-label" for="delete_phrase_published_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="delete_phrase_del">
    <div class="delete_phrase">Удалить фразу?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $del1; ?>class="form-check-input" disabled="disabled" id="delete_phrase_del_yes" name="del" title="Удалить фразу?" type="radio" value="1"><label class="form-check-label" for="delete_phrase_del_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $del0; ?>class="form-check-input" disabled="disabled" id="delete_phrase_del_no" name="del" title="Удалить фразу?" type="radio" value="0"><label class="form-check-label" for="delete_phrase_del_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="center red"><strong>Внимание! Восстановить фразу будет невозможно!</strong><br><br></div>
  <div class="cpinput_button"><input class="button delete" id="submit_phrase" name="submit_phrase" type="submit" value="Удалить фразу"></div>
</form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>