<?php defined('A') or die('Access denied'); ?>
<h1><?php if (isset($title)) {echo $title;}?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($category);
if (empty($category)): ?>
  <div>Такой категории не существует.</div>
<?php else: ?>
  <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
  <form action="" enctype="multipart/form-data" method="post" name="edit_category">

    <div class="cpinput form-group" id="edit_category_type">
      <?php if (isset($category_types)) {echo $category_types;} ?>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_title">
      <label class="form-label" for="edit_category_title_field">Введите название категории<span class="red1">*</span>:</label>
      <input class="edit_category form-control" id="edit_category_title_field" maxlength="255" name="title" placeholder="Название категории" size="100" title="Введите название категории" type="text" value="<?=$category['title'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_alias">
      <label class="form-label" for="edit_category_alias_field">Введите алиас категории<span class="red1">*</span>:</label>
      <input class="edit_category form-control" id="edit_category_alias_field" maxlength="255" name="alias" placeholder="Алиас категории" size="100" title="Введите алиас категории" type="text" value="<?=$category['alias'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_parent">
      <?php if (isset($parent_categories)) {echo $parent_categories;} ?>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_position">
      <label class="form-label" for="edit_category_position_field">Введите позицию категории<span class="red1">*</span>:</label>
      <input class="edit_category form-control" id="edit_category_position_field" maxlength="15" name="position" placeholder="Позиция категории" size="15" title="Введите позицию категории" type="number" value="<?php if (empty($category['position'])) {echo '0';} else {echo $category['position'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_menu">
      <div class="edit_category">Отображать в меню?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $menu1; ?>class="form-check-input" id="edit_category_menu_yes" name="menu" title="Отображать в меню?" type="radio" value="1"><label class="form-check-label" for="edit_category_menu_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $menu0; ?>class="form-check-input" id="edit_category_menu_no" name="menu" title="Отображать в меню?" type="radio" value="0"><label class="form-check-label" for="edit_category_menu_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="edit_category_published">
      <div class="edit_category">Опубликовать категорию?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $published1; ?>class="form-check-input" id="edit_category_published_yes" name="published" title="Опубликовать категорию?" type="radio" value="1"><label class="form-check-label" for="edit_category_published_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $published0; ?>class="form-check-input" id="edit_category_published_no" name="published" title="Опубликовать категорию?" type="radio" value="0"><label class="form-check-label" for="edit_category_published_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="edit_category_del">
      <div class="edit_category">Удалить категорию?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $del1; ?>class="form-check-input" id="edit_category_del_yes" name="del" title="Удалить категорию?" type="radio" value="1"><label class="form-check-label" for="edit_category_del_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $del0; ?>class="form-check-input" id="edit_category_del_no" name="del" title="Удалить категорию?" type="radio" value="0"><label class="form-check-label" for="edit_category_del_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="edit_category_description">
      <label class="form-label" for="edit_category_description_field">Введите краткое описание категории (для SEO, если есть):</label>
      <input class="edit_category form-control" id="edit_category_description_field" maxlength="255" name="description" placeholder="Краткое описание" size="100" title="Введите краткое описание" type="text" value="<?=$category['description'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_keywords">
      <label class="form-label" for="edit_category_keywords_field">Введите ключевые слова (для SEO, если есть):</label>
      <input class="edit_category form-control" id="edit_category_keywords_field" maxlength="255" name="keywords" placeholder="Ключевые слова" size="100" title="Введите ключевые слова" type="text" value="<?=$category['keywords'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_image">
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
    <?php if ((!empty($category['image'])) and (is_file($category['image']))): ?>
      <a class="uploadimage" href="<?=D.S.$category['image'];?>" rel="image" target="_blank" title="<?=basename($category['image']);?>"><img alt="<?=basename($category['image']);?>" class="oneimage" src="<?=D.S.$category['image'];?>" title="<?=basename($category['image']);?>"><div class="delimg" title="Удалить картинку <?=basename($category['image']);?>"></div></a>
    <?php endif; ?>
    </div>

    <div class="cpinput form-group" id="edit_category_file_upload_name">
      <label class="form-label" for="file_upload_name_field">Название загруженной картинки (например, <span class="monospace_url">rolar.jpg</span>)<span class="red1">*</span>:</label>
      <input class="edit_category form-control" id="file_upload_name_field" maxlength="255" name="image" placeholder="Название загруженной картинки" size="100" title="Название загруженной картинки" type="text" value="<?php if (is_file($category['image'])) {echo basename($category['image']);} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_image_path">
      <label class="form-label" for="edit_category_image_path_field">Путь к картинке (например, <span class="monospace_url">images/categories/</span>)<span class="red1">*</span>:</label>
      <input class="edit_category form-control" id="edit_category_image_path_field" maxlength="255" name="image_path" placeholder="Путь к картинке" readonly="readonly" size="100" title="Путь к картинке" type="text" value="<?php echo 'images/categories/'; ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_text">
      <label class="form-label" for="edit_category_text_field">Введите текст категории с html-тэгами<span class="red1">*</span>:</label>
      <textarea class="edit_category form-control" cols="102" id="text_field" name="text" placeholder="Текст категории" rows="10" title="Текст категории"><?php echo $category['text']; ?></textarea>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="edit_category_view">
      <label class="form-label" for="edit_category_view_field">Количество просмотров:</label>
      <div class="edit_category input-group">
        <input class="edit_category form-control" id="edit_category_view_field" maxlength="7" name="view" readonly="readonly" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($category['view'])) {echo '0';} else {echo $category['view'];} ?>">
        <div class="input-group-append">
          <input class="button btn btn-outline-secondary" id="edit_category_view_reset" name="view_reset" type="button" value="Обнулить">
        </div>
      </div>
      <div class="form-text"></div>
    </div>

    <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
    <div class="cpinput_button"><input class="button" id="submit_category" name="submit_category" type="submit" value="Сохранить категорию"></div>
  </form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>