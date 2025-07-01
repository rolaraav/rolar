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
<div class="center red"><strong>Внимание! Восстановить курс будет невозможно!</strong></div><br><br>
  <form action="" enctype="multipart/form-data" method="post" name="delete_course">

      <div class="cpinput form-group" id="delete_course_category">
        <?php if (isset($course_categories)) {echo $course_categories;} ?>
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_hide_plink">
          <div class="delete_course">Скрыть партнёрскую ссылку?</div>
          <div class="row">
              <div class="form-check col-sm-1">
                  <input <?php echo $hide_plink1; ?>class="form-check-input" disabled="disabled" id="delete_course_hide_plink_yes" name="hide_plink" title="Скрыть партнёрскую ссылку?" type="radio" value="1"><label class="form-check-label" for="delete_course_hide_plink_yes"> Да</label>
              </div>
              <div class="form-check col-sm-1">
                  <input <?php echo $hide_plink0; ?>class="form-check-input" disabled="disabled" id="delete_course_hide_plink_no" name="hide_plink" title="Скрыть партнёрскую ссылку?" type="radio" value="0"><label class="form-check-label" for="delete_course_hide_plink_no"> Нет</label>
              </div>
          </div>
      </div>

      <div class="cpinput form-group" id="delete_course_published">
          <div class="delete_course">Опубликовать курс?</div>
          <div class="row">
              <div class="form-check col-sm-1">
                  <input <?php echo $published1; ?>class="form-check-input" disabled="disabled" id="delete_course_published_yes" name="published" title="Опубликовать курс?" type="radio" value="1"><label class="form-check-label" for="delete_course_published_yes"> Да</label>
              </div>
              <div class="form-check col-sm-1">
                  <input <?php echo $published0; ?>class="form-check-input" disabled="disabled" id="delete_course_published_no" name="published" title="Опубликовать курс?" type="radio" value="0"><label class="form-check-label" for="delete_course_published_no"> Нет</label>
              </div>
          </div>
      </div>

      <div class="cpinput form-group" id="delete_course_del">
          <div class="delete_course">Удалить курс?</div>
          <div class="row">
              <div class="form-check col-sm-1">
                  <input <?php echo $del1; ?>class="form-check-input" disabled="disabled" id="delete_course_del_yes" name="del" title="Удалить курс?" type="radio" value="1"><label class="form-check-label" for="delete_course_del_yes"> Да</label>
              </div>
              <div class="form-check col-sm-1">
                  <input <?php echo $del0; ?>class="form-check-input" disabled="disabled" id="delete_course_del_no" name="del" title="Удалить курс?" type="radio" value="0"><label class="form-check-label" for="delete_course_del_no"> Нет</label>
              </div>
          </div>
      </div>

      <div class="cpinput form-group" id="delete_course_title">
          <label class="form-label" for="delete_course_title_field">Название курса<span class="red1">*</span>:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_title_field" maxlength="255" name="title" placeholder="Название курса" size="100" title="Название курса" type="text" value="<?=$course['title'];?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_alias">
          <label class="form-label" for="delete_course_alias_field">Алиас курса (нужен при заказе и для скачивания)<span class="red1">*</span>:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_alias_field" maxlength="255" name="alias" placeholder="Алиас курса" size="100" title="Алиас курса" type="text" value="<?=$course['alias'];?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_author">
          <label class="form-label" for="delete_course_author_field">Автор(ы) курса<span class="red1">*</span>:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_author_field" maxlength="255" name="author" placeholder="Автор(ы) курса" size="100" title="Автор(ы) курса" type="text" value="<?=$course['author'];?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="uploaded_image">
          <label class="form-label">Ранее загруженная картинка:</label><br>
      <?php if ((!empty($course['image'])) and (is_file($course['image']))): ?>
          <a class="uploadimage" href="<?=D.S.$course['image'];?>" rel="image" target="_blank" title="<?=basename($course['image']);?>"><img alt="<?=basename($course['image']);?>" class="oneimage" src="<?=D.S.$course['image'];?>" title="<?=basename($course['image']);?>"></a>
      <?php endif; ?>
      </div>

      <div class="cpinput form-group" id="delete_course_file_upload_name">
          <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>)<span class="red1">*</span>:</label>
          <input class="delete_course form-control" disabled="disabled" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?php if (is_file($course['image'])) {echo basename($course['image']);} ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_image_path">
          <label class="form-label" for="delete_course_image_path_field">Путь к картинке (например, <span class="monospace_url">images/courses/</span>)<span class="red1">*</span>:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_image_path_field" maxlength="255" name="image_path" placeholder="Путь к картинке" size="100" title="Путь к картинке" type="text" value="<?php $image_path='images/courses/'; if (is_file($course['image'])) {$image_path = dirname($course['image']).S;} elseif (is_dir($course['image'])) {$image_path = $course['image'];} elseif (empty($course['image'])) {$image_path = 'images/courses/';} echo $image_path; ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_text">
          <label class="form-label" for="delete_course_text_field">Текст курса с html-тэгами<span class="red1">*</span>:</label>
          <textarea class="delete_course form-control" cols="102" disabled="disabled" id="text_field" name="text" placeholder="Текст курса" rows="10" title="Текст курса"><?php echo $course['text']; ?></textarea>
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_view">
          <label class="form-label" for="delete_course_view_field">Количество просмотров:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_view_field" maxlength="7" name="view" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($course['view'])) {echo '0';} else {echo $course['view'];} ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_size">
          <label class="form-label" for="delete_course_size_field">Размер прикреплённых файлов (в байтах, если есть):</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_size_field" maxlength="15" name="size" placeholder="Размер файла" size="15" title="Размер файла" type="number" value="<?php echo $course['size']; ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_year">
          <label class="form-label" for="delete_course_year_field">Год выпуска курса (ГГГГ, если есть):</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_year_field" maxlength="4" name="year" placeholder="Год выпуска" size="4" title="Год выпуска" type="number" value="<?php echo $course['year']; ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_price">
          <label class="form-label" for="delete_course_price_field">Цена курса<span class="red1">*</span>:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_price_field" maxlength="7" name="price" placeholder="Цена курса" size="15" title="Цена курса" type="number" value="<?php echo $course['price']; ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_author_price">
          <label class="form-label" for="delete_course_author_price_field">Цена курса на сайте автора (если есть):</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_author_price_field" maxlength="7" name="author_price" placeholder="Цена курса на сайте автора" size="15" title="Цена курса на сайте автора" type="number" value="<?php echo $course['author_price']; ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_buy_link">
          <label class="form-label" for="delete_course_buy_link_field">Адрес ссылки для оформления заказа<span class="red1">*</span>:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_buy_link_field" maxlength="255" name="buy_link" placeholder="Адрес ссылки для оформления заказа" size="100" title="Адрес ссылки для оформления заказа" type="text" value="<?php echo $course['buy_link']; ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_orders">
          <label class="form-label" for="delete_course_orders_field">Количество переходов для оформления заказа:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_orders_field" maxlength="7" name="orders" placeholder="Количество переходов для оформления заказа" size="7" title="Количество переходов для оформления заказа" type="number" value="<?php if (empty($course['orders'])) {echo '0';} else {echo $course['orders'];} ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_download_link">
          <label class="form-label" for="delete_course_download_link_field">Адрес ссылки для скачивания с ftp-сервера<span class="red1">*</span>:</label>
          <input class="create_course form-control" disabled="disabled" id="delete_course_download_link_field" maxlength="255" name="download_link" placeholder="Адрес ссылки для скачивания" size="100" title="Адрес ссылки для скачивания" type="text" value="<?php echo $course['download_link']; ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_downloaded">
          <label class="form-label" for="delete_course_downloaded_field">Количество переходов по ссылке для скачивания с ftp-сервера:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_downloaded_field" maxlength="7" name="downloaded" placeholder="Количество переходов по ссылке для скачивания" size="7" title="Количество переходов по ссылке для скачивания" type="number" value="<?php if (empty($course['downloaded'])) {echo '0';} else {echo $course['downloaded'];} ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_partner_link">
          <label class="form-label" for="delete_course_partner_link_field">Адрес реферальной (партнёрской) ссылки (если есть):</label>
          <input class="create_course form-control" disabled="disabled" id="delete_course_partner_link_field" maxlength="255" name="partner_link" placeholder="Адрес реферальной (партнёрской) ссылки" size="100" title="Адрес реферальной (партнёрской) ссылки" type="text" value="<?php echo $course['partner_link']; ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_transitions">
          <label class="form-label" for="delete_course_transitions_field">Количество переходов по реферальной (партнёрской) ссылке:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_transitions_field" maxlength="7" name="transitions" placeholder="Количество переходов по реферальной (партнёрской) ссылке" size="7" title="Количество переходов по реферальной (партнёрской) ссылке" type="number" value="<?php if (empty($course['transitions'])) {echo '0';} else {echo $course['transitions'];} ?>">
          <div class="form-text"></div>
      </div>

      <div class="cpinput form-group" id="delete_course_hash">
          <label class="form-label" for="delete_course_hash_field">Хеш для ссылок для скачивания:</label>
          <input class="delete_course form-control" disabled="disabled" id="delete_course_hash_field" maxlength="255" name="hash" placeholder="Хеш для ссылок для скачивания" size="100" title="Хеш для ссылок для скачивания" type="text" value="<?php echo $course['hash']; ?>">
          <div class="form-text"></div>
      </div>

      <div class="center red"><strong>Внимание! Восстановить курс будет невозможно!</strong></div><br><br>
      <div class="cpinput_button"><input class="button delete" id="submit_course" name="submit_course" type="submit" value="Удалить курс"></div>
  </form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div><br>