<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($course);
if (empty($course)): ?>
  <div>Такого курса не существует.</div>
<?php else: ?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<form action="" enctype="multipart/form-data" method="post" name="edit_course">

  <div class="cpinput form-group" id="edit_course_category">
    <?php if (isset($course_categories)) {echo $course_categories;} ?>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_hide_plink">
    <div class="edit_course">Скрыть партнёрскую ссылку?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $hide_plink1; ?>class="form-check-input" id="edit_course_hide_plink_yes" name="hide_plink" title="Скрыть партнёрскую ссылку?" type="radio" value="1"><label class="form-check-label" for="edit_course_hide_plink_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $hide_plink0; ?>class="form-check-input" id="edit_course_hide_plink_no" name="hide_plink" title="Скрыть партнёрскую ссылку?" type="radio" value="0"><label class="form-check-label" for="edit_course_hide_plink_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="edit_course_published">
    <div class="edit_course">Опубликовать курс?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" id="edit_course_published_yes" name="published" title="Опубликовать курс?" type="radio" value="1"><label class="form-check-label" for="edit_course_published_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" id="edit_course_published_no" name="published" title="Опубликовать курс?" type="radio" value="0"><label class="form-check-label" for="edit_course_published_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="edit_course_del">
    <div class="edit_course">Удалить курс?</div>
    <div class="row">
        <div class="form-check col-sm-1">
            <input <?php echo $del1; ?>class="form-check-input" id="edit_course_del_yes" name="del" title="Удалить курс?" type="radio" value="1"><label class="form-check-label" for="edit_course_del_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
            <input <?php echo $del0; ?>class="form-check-input" id="edit_course_del_no" name="del" title="Удалить курс?" type="radio" value="0"><label class="form-check-label" for="edit_course_del_no"> Нет</label>
        </div>
    </div>
  </div>

  <div class="cpinput form-group" id="edit_course_title">
    <label class="form-label" for="edit_course_title_field">Введите название курса<span class="red1">*</span>:</label>
    <input class="edit_course form-control" id="edit_course_title_field" maxlength="255" name="title" placeholder="Название курса" size="100" title="Введите название курса" type="text" value="<?=$course['title'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_alias">
    <label class="form-label" for="edit_course_alias_field">Введите алиас курса (нужен при заказе и для скачивания)<span class="red1">*</span>:</label>
    <input class="edit_course form-control" id="edit_course_alias_field" maxlength="255" name="alias" placeholder="Алиас курса" size="100" title="Введите алиас курса" type="text" value="<?=$course['alias'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_author">
    <label class="form-label" for="edit_course_author_field">Введите автора(ов) курса<span class="red1">*</span>:</label>
    <input class="edit_course form-control" id="edit_course_author_field" maxlength="255" name="author" placeholder="Автор(ы) курса" size="100" title="Введите автора(ов) курса" type="text" value="<?=$course['author'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_image">
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

  <div class="cpinput form-group" id="uploaded_image">
    <label class="form-label">Ранее загруженная картинка (после сохранения она будет заменена на новую):</label><br>
  <?php if ((!empty($course['image'])) and (is_file($course['image']))): ?>
    <a class="uploadimage" href="<?=D.S.$course['image'];?>" rel="image" target="_blank" title="<?=basename($course['image']);?>"><img alt="<?=basename($course['image']);?>" class="oneimage" src="<?=D.S.$course['image'];?>" title="<?=basename($course['image']);?>"><div class="delimg" title="Удалить картинку <?=basename($course['image']);?>"></div></a>
  <?php endif; ?>
  </div>

  <div class="cpinput form-group" id="edit_course_file_upload_name">
    <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>)<span class="red1">*</span>:</label>
    <input class="edit_course form-control" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?php if (is_file($course['image'])) {echo basename($course['image']);} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_image_path">
    <label class="form-label" for="edit_course_image_path_field">Путь к картинке (например, <span class="monospace_url">images/courses/</span>)<span class="red1">*</span>:</label>
    <input class="edit_course form-control" id="edit_course_image_path_field" maxlength="255" name="image_path" placeholder="Путь к картинке" readonly="readonly" size="100" title="Путь к картинке" type="text" value="<?php $image_path='images/courses/'; if (is_file($course['image'])) {$image_path = dirname($course['image']).S;} elseif (is_dir($course['image'])) {$image_path = $course['image'];} elseif (empty($course['image'])) {$image_path = 'images/courses/';} echo $image_path; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_text">
    <label class="form-label" for="edit_course_text_field">Введите текст курса с html-тэгами<span class="red1">*</span>:</label>
    <textarea class="edit_course form-control" cols="102" id="text_field" name="text" placeholder="Текст курса" rows="10" title="Текст курса"><?php echo $course['text']; ?></textarea>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_view">
    <label class="form-label" for="edit_course_view_field">Количество просмотров:</label>
    <div class="edit_course input-group">
      <input class="edit_course form-control" id="edit_course_view_field" maxlength="7" name="view" readonly="readonly" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($course['view'])) {echo '0';} else {echo $course['view'];} ?>">
      <div class="input-group-append">
        <input class="button btn btn-outline-secondary" id="edit_course_view_reset" name="view_reset" type="button" value="Обнулить">
      </div>
    </div>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_size">
    <label class="form-label" for="edit_course_size_field">Введите размер прикреплённых файлов (в байтах, если есть):</label>
    <input class="edit_course form-control" id="edit_course_size_field" maxlength="15" name="size" placeholder="Размер файла" size="15" title="Введите размер файла" type="number" value="<?php echo $course['size']; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_year">
    <label class="form-label" for="edit_course_year_field">Введите год выпуска курса (ГГГГ, если есть):</label>
    <input class="edit_course form-control" id="edit_course_year_field" maxlength="4" name="year" placeholder="Год выпуска" size="4" title="Введите год выпуска" type="number" value="<?php echo $course['year']; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_price">
    <label class="form-label" for="edit_course_price_field">Введите цену курса<span class="red1">*</span>:</label>
    <input class="edit_course form-control" id="edit_course_price_field" maxlength="7" name="price" placeholder="Цена курса" size="15" title="Введите цену курса" type="number" value="<?php echo $course['price']; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_author_price">
    <label class="form-label" for="edit_course_author_price_field">Введите цену курса на сайте автора (если есть):</label>
    <input class="edit_course form-control" id="edit_course_author_price_field" maxlength="7" name="author_price" placeholder="Цена курса на сайте автора" size="15" title="Введите цену курса на сайте автора" type="number" value="<?php echo $course['author_price']; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_buy_link">
    <label class="form-label" for="edit_course_buy_link_field">Введите адрес ссылки для оформления заказа<span class="red1">*</span>:</label>
    <input class="edit_course form-control" id="edit_course_buy_link_field" maxlength="255" name="buy_link" placeholder="Адрес ссылки для оформления заказа" size="100" title="Введите адрес ссылки для оформления заказа" type="text" value="<?php echo $course['buy_link']; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_orders">
    <label class="form-label" for="edit_course_orders_field">Количество переходов для оформления заказа:</label>
    <div class="edit_course input-group">
      <input class="edit_course form-control" id="edit_course_orders_field" maxlength="7" name="orders" readonly="readonly" placeholder="Количество переходов для оформления заказа" size="7" title="Количество переходов для оформления заказа" type="number" value="<?php if (empty($course['orders'])) {echo '0';} else {echo $course['orders'];} ?>">
      <div class="input-group-append">
        <input class="button btn btn-outline-secondary" id="edit_course_orders_reset" name="orders_reset" type="button" value="Обнулить">
      </div>
    </div>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_download_link">
    <label class="form-label" for="edit_course_download_link_field">Введите адрес ссылки для скачивания с ftp-сервера<span class="red1">*</span>:</label>
    <input class="create_course form-control" id="edit_course_download_link_field" maxlength="255" name="download_link" placeholder="Адрес ссылки для скачивания" size="100" title="Введите адрес ссылки для скачивания" type="text" value="<?php echo $course['download_link']; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_downloaded">
    <label class="form-label" for="edit_course_downloaded_field">Количество переходов по ссылке для скачивания с ftp-сервера:</label>
    <div class="edit_course input-group">
      <input class="edit_course form-control" id="edit_course_downloaded_field" maxlength="7" name="downloaded" readonly="readonly" placeholder="Количество переходов по ссылке для скачивания" size="7" title="Количество переходов по ссылке для скачивания" type="number" value="<?php if (empty($course['downloaded'])) {echo '0';} else {echo $course['downloaded'];} ?>">
      <div class="input-group-append">
        <input class="button btn btn-outline-secondary" id="edit_course_downloaded_reset" name="downloaded_reset" type="button" value="Обнулить">
      </div>
    </div>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_partner_link">
    <label class="form-label" for="edit_course_partner_link_field">Введите адрес реферальной (партнёрской) ссылки (если есть):</label>
    <input class="create_course form-control" id="edit_course_partner_link_field" maxlength="255" name="partner_link" placeholder="Адрес реферальной (партнёрской) ссылки" size="100" title="Введите адрес реферальной (партнёрской) ссылки" type="text" value="<?php echo $course['partner_link']; ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_transitions">
    <label class="form-label" for="edit_course_transitions_field">Количество переходов по реферальной (партнёрской) ссылке:</label>
    <div class="edit_course input-group">
      <input class="edit_course form-control" id="edit_course_transitions_field" maxlength="7" name="transitions" readonly="readonly" placeholder="Количество переходов по реферальной (партнёрской) ссылке" size="7" title="Количество переходов по реферальной (партнёрской) ссылке" type="number" value="<?php if (empty($course['transitions'])) {echo '0';} else {echo $course['transitions'];} ?>">
      <div class="input-group-append">
        <input class="button btn btn-outline-secondary" id="edit_course_transitions_reset" name="transitions_reset" type="button" value="Обнулить">
      </div>
    </div>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_course_hash">
    <label class="form-label" for="edit_course_hash_field">Хеш для ссылок для скачивания:</label>
    <div class="edit_course input-group">
      <input class="edit_course form-control" id="edit_course_hash_field" maxlength="255" name="hash" readonly="readonly" placeholder="Хеш для ссылок для скачивания" size="100" title="Хеш для ссылок для скачивания" type="text" value="<?php echo $course['hash']; ?>">
      <div class="input-group-append">
        <input class="button btn btn-outline-secondary" id="edit_course_hash_generate" name="hash_generate" type="button" value="Обновить">
      </div>
    </div>
    <div class="form-text"></div>
  </div>

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_course" name="submit_course" type="submit" value="Сохранить курс"></div>
</form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div><br>