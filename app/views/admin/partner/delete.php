<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($partner);
if (empty($partner)): ?>
  <div>Такого партнёра не существует.</div>
<?php else: ?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<div class="center red"><strong>Внимание! Восстановить партнёра будет невозможно!</strong></div><br><br>
  <form action="" enctype="multipart/form-data" method="post" name="delete_partner">

    <div class="cpinput form-group" id="delete_partner_title">
      <label class="form-label" for="delete_partner_title_field">Имя и фамилия партнёра<span class="red1">*</span>:</label>
      <input class="delete_partner form-control" disabled="disabled" id="delete_partner_title_field" maxlength="255" name="title" placeholder="Имя и фамилия партнёра" size="100" title="Имя и фамилия партнёра" type="text" value="<?=isset($partner['title']) ? $partner['title'] : '';?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_partner_alias">
      <label class="form-label" for="delete_partner_alias_field">Алиас партнёра<span class="red1">*</span>:</label>
      <input class="delete_partner form-control" disabled="disabled" id="delete_partner_alias_field" maxlength="255" name="alias" placeholder="Алиас партнёра" size="100" title="Алиас партнёра" type="text" value="<?=isset($partner['alias']) ? $partner['alias'] : '';?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_partner_published">
      <div class="delete_partner">Опубликовать партнёра?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $published1; ?>class="form-check-input" disabled="disabled" id="delete_partner_published_yes" name="published" title="Опубликовать партнёра?" type="radio" value="1"><label class="form-check-label" for="delete_partner_published_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $published0; ?>class="form-check-input" disabled="disabled" id="delete_partner_published_no" name="published" title="Опубликовать партнёра?" type="radio" value="0"><label class="form-check-label" for="delete_partner_published_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_partner_del">
      <div class="delete_partner">Удалить партнёра?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $del1; ?>class="form-check-input" disabled="disabled" id="delete_partner_del_yes" name="del" title="Удалить партнёра?" type="radio" value="1"><label class="form-check-label" for="delete_partner_del_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $del0; ?>class="form-check-input" disabled="disabled" id="delete_partner_del_no" name="del" title="Удалить партнёра?" type="radio" value="0"><label class="form-check-label" for="delete_partner_del_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_partner_description">
      <label class="form-label" for="delete_partner_description_field">Краткое описание партнёра (для SEO, если есть):</label>
      <input class="delete_partner form-control" disabled="disabled" id="delete_partner_description_field" maxlength="255" name="description" placeholder="Краткое описание" size="100" title="Краткое описание" type="text" value="<?=isset($partner['description']) ? $partner['description'] : '';?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_partner_keywords">
      <label class="form-label" for="delete_partner_keywords_field">Ключевые слова (для SEO, если есть):</label>
      <input class="delete_partner form-control" disabled="disabled" id="delete_partner_keywords_field" maxlength="255" name="keywords" placeholder="Ключевые слова" size="100" title="Ключевые слова" type="text" value="<?=isset($partner['keywords']) ? $partner['keywords'] : '';?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="uploaded_image">
      <label class="form-label">Ранее загруженная картинка:</label><br>
    <?php if ((!empty($partner['image'])) and (is_file($partner['image']))): ?>
      <a class="uploadimage" href="<?=D.S.$partner['image'];?>" rel="image" target="_blank" title="<?=basename($partner['image']);?>"><img alt="<?=basename($partner['image']);?>" class="oneimage" src="<?=D.S.$partner['image'];?>" title="<?=basename($partner['image']);?>"></a>
    <?php endif; ?>
    </div>

    <div class="cpinput form-group" id="delete_partner_file_upload_name">
      <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>)<span class="red1">*</span>:</label>
      <input class="delete_partner form-control" disabled="disabled" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?php if (is_file($partner['image'])) {echo basename($partner['image']);} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_partner_image_path">
      <label class="form-label" for="delete_partner_image_path_field">Путь к картинке (например, <span class="monospace_url">images/partners/</span>)<span class="red1">*</span>:</label>
      <input class="delete_partner form-control" disabled="disabled" id="delete_partner_image_path_field" maxlength="255" name="image_path" readonly="readonly" placeholder="Путь к картинке" size="100" title="Путь к картинке" type="text" value="<?php echo 'images/partners/'; ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_partner_text">
      <label class="form-label" for="delete_partner_text_field">Текст страницы партнёра с html-тэгами<span class="red1">*</span>:</label>
      <textarea class="delete_partner form-control" cols="102" disabled="disabled" id="text_field" name="text" placeholder="Текст страницы партнёра" rows="10" title="Текст страницы партнёра"><?php if (isset($partner['text'])) {echo $partner['text'];}?></textarea>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_partner_view">
      <label class="form-label" for="delete_partner_view_field">Количество просмотров:</label>
      <input class="delete_partner form-control" disabled="disabled" id="delete_partner_view_field" maxlength="7" name="view" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($partner['view'])) {echo '0';} else {echo $partner['view'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="center red"><strong>Внимание! Восстановить партнёра будет невозможно!</strong></div><br><br>
    <div class="cpinput_button"><input class="button delete" id="submit_partner" name="submit_partner" type="submit" value="Удалить партнёра"></div>
  </form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>