<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} ?>
<form action="" method="post" name="create_comment">

  <div class="cpinput form-group" id="create_comment_published">
        <div class="create_comment">Опубликовать комментарий?</div>
        <div class="row">
            <div class="form-check col-sm-1">
                <input <?php echo $published1; ?>class="form-check-input" id="create_comment_published_yes" name="published" title="Опубликовать комментарий?" type="radio" value="1"><label class="form-check-label" for="create_comment_published_yes"> Да</label>
            </div>
            <div class="form-check col-sm-1">
                <input <?php echo $published0; ?>class="form-check-input" id="create_comment_published_no" name="published" title="Опубликовать комментарий?" type="radio" value="0"><label class="form-check-label" for="create_comment_published_no"> Нет</label>
            </div>
        </div>
    </div>

  <div class="cpinput form-group" id="create_comment_type">
    <?php if (isset($comment_types)) {echo $comment_types;} ?>
      <div class="form-text"></div>
  </div>

  <fieldset class="identificators"><span class="red1">*</span>
  <div class="cpinput form-group" id="create_comment_post_id">
    <label class="form-label" for="create_comment_post_id_field">Введите ID материала (заметки, новости, партнёрского продукта, закачки, товара к которому относится комментарий, если есть):</label>
    <input class="create_comment form-control" id="create_comment_post_id_field" maxlength="5" name="post" placeholder="ID материала" size="100" title="Введите ID материала" type="text" value="<?=isset($_SESSION['create']['post']) ? $_SESSION['create']['post'] : 1;?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_gallery_id">
    <label class="form-label" for="create_comment_gallery_id_field">Введите ID галереи (если есть):</label>
    <input class="create_comment form-control" id="create_comment_gallery_id_field" maxlength="5" name="gallery" placeholder="ID галереи" size="100" title="Введите ID галереи" type="text" value="<?=isset($_SESSION['create']['gallery']) ? $_SESSION['create']['gallery'] : 0;?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_image_id">
    <label class="form-label" for="create_comment_image_id_field">Введите ID изображения (если есть):</label>
    <input class="create_comment form-control" id="create_comment_image_id_field" maxlength="7" name="image" placeholder="ID изображения" size="100" title="Введите ID изображения" type="text" value="<?=isset($_SESSION['create']['image']) ? $_SESSION['create']['image'] : 0;?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_album_id">
    <label class="form-label" for="create_comment_album_id_field">Введите ID альбома (если есть):</label>
    <input class="create_comment form-control" id="create_comment_album_id_field" maxlength="5" name="album" placeholder="ID альбома" size="100" title="Введите ID альбома" type="text" value="<?=isset($_SESSION['create']['album']) ? $_SESSION['create']['album'] : 0;?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_parent_id">
    <label class="form-label" for="create_comment_parent_id_field">Введите ID родительского комментария (если есть):</label>
    <input class="create_comment form-control" id="create_comment_parent_id_field" maxlength="5" name="parent" placeholder="ID родительского комментария" size="100" title="Введите ID родительского комментария" type="text" value="<?=isset($_SESSION['create']['parent']) ? $_SESSION['create']['parent'] : 0;?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_user_id">
    <label class="form-label" for="create_comment_user_id_field">Введите ID пользователя (если есть):</label>
    <input class="create_comment form-control" id="create_comment_user_id_field" maxlength="5" name="user" placeholder="ID пользователя" size="100" title="Введите ID пользователя" type="text" value="<?=isset($_SESSION['create']['user']) ? $_SESSION['create']['user'] : 0;?>">
    <div class="form-text"></div>
  </div>
  </fieldset>

  <div class="cpinput form-group" id="create_comment_author">
    <label class="form-label" for="create_comment_author_field">Введите имя автора комментария<span class="red1">*</span>:</label>
    <input class="create_comment form-control" id="create_comment_author_field" maxlength="100" name="author" placeholder="Имя автора комментария" size="100" title="Введите имя автора комментария" type="text" value="<?php if (empty($_SESSION['create']['author'])) {echo $this->user['login'];} else {echo $_SESSION['create']['author'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_author_email">
    <label class="form-label" for="create_comment_author_email_field">Введите e-mail автора комментария<span class="red1">*</span>:</label>
    <input class="create_comment form-control" id="create_comment_author_email_field" maxlength="100" name="email" placeholder="E-mail автора комментария" size="100" title="Введите e-mail автора комментария" type="email" value="<?=isset($_SESSION['create']['email']) ? $_SESSION['create']['email'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_author_site">
    <label class="form-label" for="create_comment_author_site_field">Введите сайт автора комментария (если есть):</label>
    <input class="create_comment form-control" id="create_comment_author_site_field" maxlength="255" name="site" placeholder="Сайт автора комментария" size="100" title="Введите сайт автора комментария" type="text" value="<?=isset($_SESSION['create']['site']) ? $_SESSION['create']['site'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_date">
    <label class="form-label" for="create_comment_date_field">Введите дату и время создания комментария (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
    <input class="create_comment form-control" id="create_comment_date_field" maxlength="19" name="date" placeholder="Дата и время создания комментария" size="15" title="Введите дату и время создания комментария" type="text" value="<?php if (empty($_SESSION['create']['date'])) {$date = date("Y-m-d H:i:s"); echo $date;} else {echo $_SESSION['create']['date'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_comment_text">
    <label class="form-label" for="create_comment_text_field">Введите текст комментария<span class="red1">*</span>:</label>
    <textarea class="create_comment form-control" cols="102" id="text_field" name="text" placeholder="Текст комментария" rows="10" title="Введите текст комментария"><?php if (isset($_SESSION['create']['text'])) {echo $_SESSION['create']['text'];}?></textarea>
    <div class="form-text"></div>
  </div>

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_comment" name="submit_comment" type="submit" value="Создать комментарий"></div>
</form><br>
<?php
unset($_SESSION['create']);
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>