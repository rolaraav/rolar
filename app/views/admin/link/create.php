<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} ?>
<form action="" method="post" name="create_link">

  <div class="cpinput form-group" id="create_link_secret">
    <div class="create_link">Сделать ссылку секретной?</div>
      <div class="row">
      <div class="form-check col-sm-1">
      <input <?php echo $secret1; ?>class="form-check-input" id="create_link_secret_yes" name="secret" title="Сделать ссылку секретной?" type="radio" value="1"><label class="form-check-label" for="create_link_secret_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
      <input <?php echo $secret0; ?>class="form-check-input" id="create_link_secret_no" name="secret" title="Сделать ссылку секретной?" type="radio" value="0"><label class="form-check-label" for="create_link_secret_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="create_link_ref">
    <div class="create_link">Сделать ссылку реферальной (партнёрской)?</div>
      <div class="row">
      <div class="form-check col-sm-1">
      <input <?php echo $ref1; ?>class="form-check-input" id="create_link_ref_yes" name="ref" title="Сделать ссылку реферальной (партнёрской)?" type="radio" value="1"><label class="form-check-label" for="create_link_ref_yes"> Да</label>
    </div>
      <div class="form-check col-sm-1">
      <input <?php echo $ref0; ?>class="form-check-input" id="create_link_ref_no" name="ref" title="Сделать ссылку реферальной (партнёрской)?" type="radio" value="0"><label class="form-check-label" for="create_link_ref_no"> Нет</label>
      </div>
    </div>
  </div>

    <div class="cpinput form-group" id="create_link_published">
      <div class="create_link">Опубликовать ссылку?</div>
      <div class="row">
        <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" id="create_link_published_yes" name="published" title="Опубликовать ссылку?" type="radio" value="1"><label class="form-check-label" for="create_link_published_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" id="create_link_published_no" name="published" title="Опубликовать ссылку?" type="radio" value="0"><label class="form-check-label" for="create_link_published_no"> Нет</label>
        </div>
      </div>
    </div>

  <div class="cpinput form-group" id="create_link_title">
    <label class="form-label" for="create_link_title_field">Введите название ссылки<span class="red1">*</span>:</label>
    <input class="create_link form-control" id="create_link_title_field" maxlength="255" name="title" placeholder="Название ссылки" size="100" title="Введите название ссылки" type="text" value="<?=isset($_SESSION['create']['title']) ? $_SESSION['create']['title'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_link_link">
    <label class="form-label" for="create_link_link_field">Введите адрес ссылки<span class="red1">*</span>:</label>
    <input class="create_link form-control" id="create_link_link_field" maxlength="255" name="link" placeholder="Адрес ссылки" size="100" title="Введите адрес ссылки" type="text" value="<?php if (empty($_SESSION['create']['link'])) {echo 'http://';} else {echo $_SESSION['create']['link'];}?>">
    <div class="form-text"></div>
  </div>

  <!--
  <div class="cpinput form-group" id="create_link_short_link">
    <label class="form-label" for="create_link_short_link_field">Введите короткий адрес ссылки (если есть)<span class="red1">*</span>:</label>
    <input class="create_link form-control" id="create_link_short_link_field" maxlength="255" name="short_link" placeholder="Короткий адрес ссылки" size="100" title="Введите короткий адрес ссылки" type="text" value="<?php if (isset($_SESSION['create']['short_link'])) {echo $_SESSION['create']['short_link'];}?>">
    <div class="form-text"></div>
  </div> -->

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_link" name="submit_link" type="submit" value="Создать ссылку"></div>
</form><br>
<?php
unset($_SESSION['create']);
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>