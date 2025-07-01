<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} ?>
<form action="" enctype="multipart/form-data" method="post" name="create_user">

  <div class="cpinput form-group" id="create_user_first_name">
    <label class="form-label" for="create_user_first_name_field">Введите имя пользователя<span class="red1">*</span>:</label>
    <input class="create_user form-control" id="create_user_first_name_field" maxlength="100" name="first_name" placeholder="Имя пользователя" size="100" title="Введите имя пользователя" type="text" value="<?=isset($_SESSION['create']['first_name']) ? $_SESSION['create']['first_name'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_last_name">
    <label class="form-label" for="create_user_last_name_field">Введите фамилию пользователя<span class="red1">*</span>:</label>
    <input class="create_user form-control" id="create_user_last_name_field" maxlength="100" name="last_name" placeholder="Фамилия пользователя" size="100" title="Введите фамилию пользователя" type="text" value="<?=isset($_SESSION['create']['last_name']) ? $_SESSION['create']['last_name'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_login">
    <label class="form-label" for="create_user_login_field">Введите логин пользователя (3-15 символов)<span class="red1">*</span>:</label>
    <input class="create_user form-control" id="create_user_login_field" maxlength="15" name="login" placeholder="Логин пользователя" size="15" title="Введите логин пользователя" type="text" value="<?=isset($_SESSION['create']['login']) ? $_SESSION['create']['login'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_password">
    <label class="form-label" for="create_user_password_field">Введите пароль пользователя (3-15 символов)<span class="red1">*</span>:</label>
    <div class="input-group">
    <input class="create_user form-control" id="create_user_password_field" maxlength="15" name="password" placeholder="Пароль пользователя" size="15" title="Введите пароль пользователя" type="password" value="<?=isset($_SESSION['create']['password']) ? $_SESSION['create']['password'] : '';?>">
    <div class="input-group-append">
    <span class="input-group-text" id="create_user_generate_password" style="display:none;visibility:hidden;" title="Сгенерировать пароль"><i aria-hidden="true" class="fa fa-magic"></i></span>
    <span class="input-group-text" id="create_user_show_password" title="Показать пароль"><i aria-hidden="true" class="fa fa-eye"></i></span><!-- fa-eye-slash -->
    </div>
    </div>
    <div class="form-text"></div>
    <span class="red">(В дальнейшем изменить пароль может только пользователь на своей персональной странице.)</span>
  </div>


  <div class="cpinput form-group" id="create_user_phone">
    <label class="form-label" for="create_user_phone_field">Введите номер телефона пользователя<span class="red1">*</span>:</label>
    <input class="create_user form-control" id="create_user_phone_field" maxlength="11" name="phone" placeholder="Номер телефона пользователя" size="100" title="Введите номер телефона пользователя" type="tel" value="<?=isset($_SESSION['create']['phone']) ? $_SESSION['create']['phone'] : '';?>"><div class="phone_plus">+</div>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_email">
    <label class="form-label" for="create_user_email_field">Введите e-mail пользователя<span class="red1">*</span>:</label>
    <input class="create_user form-control" id="create_user_email_field" maxlength="100" name="email" placeholder="E-mail пользователя" size="100" title="Введите e-mail пользователя" type="email" value="<?=isset($_SESSION['create']['email']) ? $_SESSION['create']['email'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_site">
    <label class="form-label" for="create_user_site_field">Введите сайт пользователя (если есть):</label>
    <input class="create_user form-control" id="create_user_site_field" maxlength="255" name="site" placeholder="Сайт пользователя" size="100" title="Введите сайт пользователя" type="text" value="<?=isset($_SESSION['create']['site']) ? $_SESSION['create']['site'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_image">
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

  <div class="cpinput form-group" id="create_user_avatar">
    <label class="form-label" for="create_user_avatar_field">Путь к картинке-аватару (например, <span class="monospace_url">images/users/avatars/rolar.jpg</span>)<span class="red1">*</span>:</label>
    <input class="create_user form-control" id="create_user_avatar_field" maxlength="255" name="avatar" placeholder="Путь к картинке-аватару" size="100" title="Путь к картинке-аватару" type="text" value="<?php if (empty($_SESSION['create']['avatar'])) {echo DAVATAR;} else {echo $_SESSION['create']['avatar'];}?>">
    <div class="form-text"></div>

    <label class="form-label" for="create_user_photo_link">Фотография пользователя (если есть):</label><br>
<?php if (!empty($_SESSION['create']['avatar'])) {
      echo '<a class="uploadimage" href="'.D.S.$_SESSION['create']['avatar'].'" id="create_user_photo_link" rel="image" target="_blank" title="'.basename($_SESSION['create']['avatar']).'"><img alt="'.basename($_SESSION['create']['avatar']).'" class="oneimage" src="'.D.S.$_SESSION['create']['avatar'].'" title="'.basename($_SESSION['create']['avatar']).'"><div class="delimg" title="Удалить фотографию '.basename($_SESSION['create']['avatar']).'"></div></a>';
} ?>
  </div>

  <div class="cpinput form-group" id="create_user_reg_date">
    <label class="form-label" for="create_user_reg_date_field">Введите дату и время регистрации (добавления) пользователя (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
    <input class="create_user form-control" id="create_user_reg_date_field" maxlength="19" name="reg_date" placeholder="Дата и время регистрации пользователя" size="15" title="Введите дату и время регистрации пользователя" type="text" value="<?php if (empty($_SESSION['create']['reg_date'])) {$reg_date = date("Y-m-d H:i:s"); echo $reg_date;} else {echo $_SESSION['create']['reg_date'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_login_date">
    <label class="form-label" for="create_user_login_date_field">Введите дату и время авторизации пользователя (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
    <input class="create_user form-control" id="create_user_login_date_field" maxlength="19" name="login_date" placeholder="Дата и время авторизации пользователя" size="15" title="Введите дату и время авторизации пользователя" type="text" value="<?php if (empty($_SESSION['create']['login_date'])) {$login_date = date("Y-m-d H:i:s"); echo $login_date;} else {echo $_SESSION['create']['login_date'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_birthday">
    <label class="form-label" for="create_user_birthday_field">Введите дату рождения пользователя (ГГГГ-ММ-ДД):</label>
    <input class="create_user form-control" id="create_user_birthday_field" maxlength="10" name="birthday" placeholder="Дата рождения пользователя" size="15" title="Введите дату рождения пользователя" type="text" value="<?php if (empty($_SESSION['create']['birthday'])) {$birthday = '1970-01-01'; echo $birthday;} else {echo $_SESSION['create']['birthday'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_status">
    <?php if (isset($user_status)) {echo $user_status;} // выберите статус пользователя ?>
      <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="create_user_gender">
    <div class="create_user">Укажите пол пользователя:</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $gender2; ?>class="form-check-input" id="create_user_gender_male" name="gender" title="Укажите пол пользователя" type="radio" value="2"><label class="form-check-label" for="create_user_gender_male"> мужской</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $gender1; ?>class="form-check-input" id="create_user_gender_female" name="gender" title="Укажите пол пользователя" type="radio" value="1"><label class="form-check-label" for="create_user_gender_female"> женский</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $gender0; ?>class="form-check-input" id="create_user_gender_no" name="gender" title="Укажите пол пользователя" type="radio" value="0"><label class="form-check-label" for="create_user_gender_no"> не указан</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="create_user_activation">
    <div class="create_user">Активировать пользователя?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $activation1; ?>class="form-check-input" id="create_user_activation_yes" name="activation" title="Активировать пользователя?" type="radio" value="1"><label class="form-check-label" for="create_user_activation_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $activation0; ?>class="form-check-input" id="create_user_activation_no" name="activation" title="Активировать пользователя?" type="radio" value="0"><label class="form-check-label" for="create_user_activation_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="create_user_letter_type">
    <div class="create_user">Укажите тип получаемых писем:</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $letter_type1; ?>class="form-check-input" id="create_user_letter_type_html" name="letter_type" title="Укажите тип получаемых писем" type="radio" value="1"><label class="form-check-label" for="create_user_letter_type_html"> HTML</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $letter_type0; ?>class="form-check-input" id="create_user_letter_type_text" name="letter_type" title="Укажите тип получаемых писем" type="radio" value="0"><label class="form-check-label" for="create_user_letter_type_text"> текст</label>
      </div>
    </div>
  </div>

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_user" name="submit_user" type="submit" value="Добавить пользователя"></div>
</form><br>
<?php
unset($_SESSION['create']);
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>