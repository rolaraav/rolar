<?php defined('A') or die('Access denied'); ?>
  <h1><?php echo $title;?></h1>
  <br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($banner);
if (empty($banner)): ?>
  <div>Такого баннера не существует.</div>
  <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<?php else: ?>
  <div class="cpinput"><strong>Исходный баннер:</strong></div>
  <?php
// получаем расширение файла (отрезаем все символы, кроме 3-х последних символов в названии файла)
  $file_extension = substr($banner['image'],-3);
// echo '3 последних символа в пути к файлу $banner['image']: '.$file_extension.'<br>';
  if ($banner['type'] == 1) {
    /* Вывод горизонтального баннера (468x60) (начало) */
    if ($file_extension == 'swf' or $file_extension == 'SWF') {
      printf ("
        <div style='border: 1px solid #000000; height: 60px; width: 468px; text-align: center; margin: 0px auto;'>
        <div class='banner468x60'>
        <object id='banner468x60swf' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='468px' height='60px'>
        <param name='allowScriptAccess' value='sameDomain'>
        <param name='movie' value='../%s'>
        <param name='quality' value='high'>
        <param name='bgcolor' value='#ffffff'>
        <embed src='../%s' name='%s' title='%s' id='banner468x60swf' flashvars='Referal=597960&' wmode='transparent' quality='high' width='468px' height='60px' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer'>
        </object>
        </div>
        </div>",$banner['image'],$banner['image'],$banner['title'],$banner['title']);
    }
    else {
      printf ("
        <div style='border: 1px solid #000000; height: 60px; width: 468px; text-align: center; margin: 0px auto;'>
        <div class='banner468x60'><img alt='%s' height='60px' src='../%s' title='%s' width='468px'></div>
        </div>",$banner['title'],$banner['image'],$banner['title']);
    }
    /* Вывод горизонтального баннера (468x60) (конец) */
  }
  else {
    /* Вывод вертикального баннера (180x300) (начало) */
    if ($file_extension == 'swf' or $file_extension == 'SWF') {
      printf ("
        <div style='border: 1px solid #000000; height: 300px; width: 180px; text-align: center; margin: 0px auto;'>
        <div id='banner_left'><div class='banner_left'>
        <object id='banner_leftswf' classid='clsid:d27cdb6e-ae6d-11cf-96b8-444553540000' codebase='http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0' width='468px' height='60px'>
        <param name='allowScriptAccess' value='sameDomain'>
        <param name='movie' value='../%s'>
        <param name='quality' value='high'>
        <param name='bgcolor' value='#ffffff'>
        <embed src='../%s' name='%s' title='%s' id='banner_leftswf' flashvars='Referal=597960&' wmode='transparent' quality='high' allowScriptAccess='sameDomain' type='application/x-shockwave-flash' pluginspage='http://www.macromedia.com/go/getflashplayer'>
        </object>
        </div></div>
        </div>",$banner['image'],$banner['image'],$banner['title'],$banner['title']);
    }
    else {
      printf ("
        <div style='border: 1px solid #000000; height: 300px; width: 180px; text-align: center; margin: 0px auto;'>
        <div id='banner_left'><div class='banner_left'><img alt='%s' src='../%s' title='%s'></div></div>
        </div>",$banner['title'],$banner['image'],$banner['title']);
    }
    /* Вывод вертикального баннера (180x300) (конец) */
  }
  ?>
  <br>
  <div class="center red"><strong>Внимание! Восстановить баннер будет невозможно!</strong><br><br></div>
  <form action="" method="post" name="edit_banner">

    <div class="cpinput form-group" id="edit_banner_published">
      <div class="edit_banner">Опубликовать баннер?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $published1; ?>class="form-check-input" disabled="disabled" id="edit_banner_published_yes" name="published" title="Опубликовать баннер?" type="radio" value="1"><label class="form-check-label" for="edit_banner_published_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $published0; ?>class="form-check-input" disabled="disabled" id="edit_banner_published_no" name="published" title="Опубликовать баннер?" type="radio" value="0"><label class="form-check-label" for="edit_banner_published_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="edit_banner_secret">
      <div class="edit_banner">Тип баннера:</div>
      <div class="row">
        <div class="form-check col-sm-2">
          <input <?php echo $type1; ?>class="form-check-input" disabled="disabled" id="edit_banner_type_horizontal" name="type" title="Тип баннера" type="radio" value="1"><label class="form-check-label" for="edit_banner_type_horizontal"> Горизонтальный (468x60)</label>
        </div>
        <div class="form-check col-sm-2">
          <input <?php echo $type2; ?>class="form-check-input" disabled="disabled" id="edit_banner_type_vertical" name="type" title="Тип баннера" type="radio" value="2"><label class="form-check-label" for="edit_banner_type_vertical"> Вертикальный (180x300)</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="edit_banner_title">
      <label class="form-label" for="edit_banner_title_field">Название баннера<span class="red1">*</span>:</label>
      <input class="edit_banner form-control" disabled="disabled" id="edit_banner_title_field" maxlength="255" name="title" placeholder="Название баннера" size="100" title="Название баннера" type="text" value="<?=$banner['title'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_banner_link">
      <label class="form-label" for="edit_banner_link_field">Адрес баннера<span class="red1">*</span>:</label>
      <input class="edit_banner form-control" disabled="disabled" id="edit_banner_link_field" maxlength="255" name="link" placeholder="Адрес баннера" size="100" title="Адрес баннера" type="text" value="<?=$banner['link'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_banner_image">
      <label class="form-label" for="edit_banner_image_field">Полный путь к изображению или flash-ролику (например, <span class="monospace_url">images/about/rolar.swf</span>)<span class="red1">*</span>:</label>
      <input class="edit_banner form-control" disabled="disabled" id="edit_banner_image_field" maxlength="255" name="image" placeholder="Полный путь к изображению или flash-ролику" size="100" title="Полный путь к изображению или flash-ролику" type="text" value="<?php if (empty($banner['image'])) {echo 'images/banners/';} else {echo $banner['image'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_banner_view">
      <label class="form-label" for="edit_banner_view_field">Количество просмотров:</label>
      <input class="edit_banner form-control" disabled="disabled" id="edit_banner_view_field" maxlength="7" name="view" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($banner['view'])) {echo '0';} else {echo $banner['view'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_banner_click">
      <label class="form-label" for="edit_banner_click_field">Количество нажатий (переходов по ссылке):</label>
      <input class="edit_banner form-control" disabled="disabled" id="edit_banner_click_field" maxlength="7" name="click" placeholder="Количество нажатий (переходов по ссылке)" size="7" title="Количество нажатий (переходов по ссылке)" type="text" value="<?php if (empty($banner['click'])) {echo '0';} else {echo $banner['click'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="center red"><strong>Внимание! Восстановить баннер будет невозможно!</strong><br><br></div>
    <div class="cpinput_button"><input class="button delete" id="submit_banner" name="submit_banner" type="submit" value="Удалить баннер"></div>
  </form><br>
<?php endif;
?>
  <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>