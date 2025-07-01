<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} ?>
<form action="" method="post" name="create_banner">

  <div class="cpinput form-group" id="create_banner_published">
    <div class="create_banner">Опубликовать баннер?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" id="create_banner_published_yes" name="published" title="Опубликовать баннер?" type="radio" value="1"><label class="form-check-label" for="create_banner_published_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" id="create_banner_published_no" name="published" title="Опубликовать баннер?" type="radio" value="0"><label class="form-check-label" for="create_banner_published_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="create_banner_secret">
    <div class="create_banner">Выберите тип баннера:</div>
    <div class="row">
      <div class="form-check col-sm-2">
        <input <?php echo $type1; ?>class="form-check-input" id="create_banner_type_horizontal" name="type" title="Тип баннера" type="radio" value="1"><label class="form-check-label" for="create_banner_type_horizontal"> Горизонтальный (468x60)</label>
      </div>
      <div class="form-check col-sm-2">
        <input <?php echo $type2; ?>class="form-check-input" id="create_banner_type_vertical" name="type" title="Тип баннера" type="radio" value="2"><label class="form-check-label" for="create_banner_type_vertical"> Вертикальный (180x300)</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="create_banner_title">
    <label class="form-label" for="create_banner_title_field">Введите название баннера<span class="red1">*</span>:</label>
    <input class="create_banner form-control" id="create_banner_title_field" maxlength="255" name="title" placeholder="Название баннера" size="100" title="Введите название баннера" type="text" value="<?=isset($_SESSION['create']['title']) ? $_SESSION['create']['title'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_banner_link">
    <label class="form-label" for="create_banner_link_field">Введите адрес баннера<span class="red1">*</span>:</label>
    <input class="create_banner form-control" id="create_banner_link_field" maxlength="255" name="link" placeholder="Адрес баннера" size="100" title="Введите адрес баннера" type="text" value="<?php if (empty($_SESSION['create']['link'])) {echo 'http://';} else {echo $_SESSION['create']['link'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_banner_image">
    <label class="form-label" for="create_banner_image_field">Введите полный путь к изображению или flash-ролику (например, <span class="monospace_url">images/about/rolar.swf</span>)<span class="red1">*</span>:</label>
    <input class="create_banner form-control" id="create_banner_image_field" maxlength="255" name="image" placeholder="Полный путь к изображению или flash-ролику" size="100" title="Введите полный путь к изображению или flash-ролику" type="text" value="<?php if (empty($_SESSION['create']['image'])) {echo 'images/banners/';} else {echo $_SESSION['create']['image'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_banner" name="submit_banner" type="submit" value="Создать баннер"></div>
</form><br>
<?php
unset($_SESSION['create']);
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
