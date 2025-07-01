<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($current_user);
if (empty($current_user)): ?>
    <div>Такого пользователя не существует.</div>
    <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<?php else: ?>
<form action="" enctype="multipart/form-data" method="post" name="edit_user">

  <input id="old_login" name="old_login" type="hidden" value="<?php echo $current_user['login'];?>">

  <div class="cpinput form-group" id="edit_user_first_name">
    <label class="form-label" for="edit_user_first_name_field">Введите имя пользователя<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_first_name_field" maxlength="100" name="first_name" placeholder="Имя пользователя" size="100" title="Введите имя пользователя" type="text" value="<?=$current_user['first_name'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_last_name">
    <label class="form-label" for="edit_user_last_name_field">Введите фамилию пользователя<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_last_name_field" maxlength="100" name="last_name" placeholder="Фамилия пользователя" size="100" title="Введите фамилию пользователя" type="text" value="<?=$current_user['last_name'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_login">
    <label class="form-label" for="edit_user_login_field">Введите логин пользователя (3-15 символов)<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_login_field" maxlength="15" name="login" placeholder="Логин пользователя" size="15" title="Введите логин пользователя" type="text" value="<?=$current_user['login'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_password">
    <div class="form-label red"><strong>Пароль пользователя зашифрован, изменить его невозможно!</strong></div><br>
    <span class="yellowfon">Хеш пароля: <?=$current_user['password'];?></span><br><br>
    <input class="button input-group-text" id="edit_user_password_reset" name="password_reset" type="submit" value="Сбросить пароль">
    <span class="gray"><em>Пароль по умолчанию: 111</em></span>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_phone">
    <label class="form-label" for="edit_user_phone_field">Введите номер телефона пользователя<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_phone_field" maxlength="11" name="phone" placeholder="Номер телефона пользователя" size="100" title="Введите номер телефона пользователя" type="tel" value="<?=$current_user['phone'];?>"><div class="phone_plus">+</div>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_email">
    <label class="form-label" for="edit_user_email_field">Введите e-mail пользователя<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_email_field" maxlength="100" name="email" placeholder="E-mail пользователя" size="100" title="Введите e-mail пользователя" type="email" value="<?=$current_user['email'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_site">
    <label class="form-label" for="edit_user_site_field">Введите сайт пользователя (если есть):</label>
    <input class="edit_user form-control" id="edit_user_site_field" maxlength="255" name="site" placeholder="Сайт пользователя" size="100" title="Введите сайт пользователя" type="text" value="<?=$current_user['site'];?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_image">
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

  <div class="cpinput form-group" id="edit_user_avatar">
    <label class="form-label" for="edit_user_avatar_field">Путь к картинке-аватару (например, <span class="monospace_url">images/users/avatars/rolar.jpg</span>)<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_avatar_field" maxlength="255" name="avatar" placeholder="Путь к картинке-аватару" size="100" title="Путь к картинке-аватару" type="text" value="<?php if (empty($current_user['avatar'])) {echo DAVATAR;} else {echo $current_user['avatar'];}?>">
    <div class="form-text"></div>

    <label class="form-label" for="edit_user_avatar_link">Фотография пользователя (если есть):</label><br>
    <?php if (!empty($current_user['avatar'])) {
      echo '<a class="uploadimage" href="'.D.S.$current_user['avatar'].'" id="edit_user_avatar_link" rel="image" target="_blank" title="'.basename($current_user['avatar']).'"><img alt="'.basename($current_user['avatar']).'" class="oneimage" src="'.D.S.$current_user['avatar'].'" title="'.basename($current_user['avatar']).'"><div class="delimg" title="Удалить фотографию '.basename($current_user['avatar']).'"></div></a>';
    } ?>
  </div>

  <div class="cpinput form-group" id="edit_user_photo">
    <label class="form-label" for="edit_user_photo_field">Ссылка на форографию в социальных сетях (если есть):</label><br>
    <input class="edit_user form-control" disabled="disabled" id="edit_user_photo_field" maxlength="255" name="photo" placeholder="Путь к фотографии в соц.сетях" size="100" title="Путь к фотографии в соц. сетях" type="text" value="<?php if (empty($current_user['photo'])) {echo 'фотографии нет';} else {echo $current_user['photo'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_reg_date">
    <label class="form-label" for="edit_user_reg_date_field">Введите дату и время регистрации (добавления) пользователя (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_reg_date_field" maxlength="19" name="reg_date" placeholder="Дата и время регистрации пользователя" size="15" title="Введите дату и время регистрации пользователя" type="text" value="<?php if (empty($current_user['reg_date'])) {$reg_date = date("Y-m-d H:i:s"); echo $reg_date;} else {echo $current_user['reg_date'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_login_date">
    <label class="form-label" for="edit_user_login_date_field">Введите дату и время авторизации пользователя (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_login_date_field" maxlength="19" name="login_date" placeholder="Дата и время авторизации пользователя" size="15" title="Введите дату и время авторизации пользователя" type="text" value="<?php if (empty($current_user['login_date'])) {$login_date = date("Y-m-d H:i:s"); echo $login_date;} else {echo $current_user['login_date'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_birthday">
    <label class="form-label" for="edit_user_birthday_field">Введите дату рождения пользователя (ГГГГ-ММ-ДД)<span class="red1">*</span>:</label>
    <input class="edit_user form-control" id="edit_user_birthday_field" maxlength="10" name="birthday" placeholder="Дата рождения пользователя" size="15" title="Введите дату рождения пользователя" type="text" value="<?php if (empty($current_user['birthday'])) {$birthday = '1970-01-01'; echo $birthday;} else {echo $current_user['birthday'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_status">
    <?php if (isset($user_status)) {echo $user_status;} // выберите статус пользователя ?>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_method">
    <?php if (isset($user_method)) {echo $user_method;} // выберите метод регистрации/авторизации пользователя ?>
    <input class="button btn btn-outline-secondary" id="edit_user_method_reset" name="method_reset" type="submit" value="Авторизовать через Rolar.ru">&nbsp;<span class="red"><strong>Вернуть назад будет невозможно!</strong></span>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_social_id">
    <label class="form-label" for="edit_user_social_id_field">Введите ID в социальной сети (если есть):</label>
    <input class="edit_user form-control" id="edit_user_social_id_field" maxlength="255" name="social_id" placeholder="ID в социальной сети" size="100" title="Введите ID в социальной сети" type="text" value="<?=isset($current_user['social_id']) ? $current_user['social_id'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_gender">
    <div class="edit_user">Укажите пол пользователя:</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $gender2; ?>class="form-check-input" id="edit_user_gender_male" name="gender" title="Укажите пол пользователя" type="radio" value="2"><label class="form-check-label" for="edit_user_gender_male"> мужской</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $gender1; ?>class="form-check-input" id="edit_user_gender_female" name="gender" title="Укажите пол пользователя" type="radio" value="1"><label class="form-check-label" for="edit_user_gender_female"> женский</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $gender0; ?>class="form-check-input" id="edit_user_gender_no" name="gender" title="Укажите пол пользователя" type="radio" value="0"><label class="form-check-label" for="edit_user_gender_no"> не указан</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="edit_user_activation">
    <div class="edit_user">Активировать пользователя?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $activation1; ?>class="form-check-input" id="edit_user_activation_yes" name="activation" title="Активировать пользователя?" type="radio" value="1"><label class="form-check-label" for="edit_user_activation_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $activation0; ?>class="form-check-input" id="edit_user_activation_no" name="activation" title="Активировать пользователя?" type="radio" value="0"><label class="form-check-label" for="edit_user_activation_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="edit_user_letter_type">
    <div class="edit_user">Укажите тип получаемых писем:</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $letter_type1; ?>class="form-check-input" id="edit_user_letter_type_html" name="letter_type" title="Укажите тип получаемых писем" type="radio" value="1"><label class="form-check-label" for="edit_user_letter_type_html"> HTML</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $letter_type0; ?>class="form-check-input" id="edit_user_letter_type_text" name="letter_type" title="Укажите тип получаемых писем" type="radio" value="0"><label class="form-check-label" for="edit_user_letter_type_text"> текст</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="edit_user_ip">
    <label class="form-label" for="edit_user_ip_field">Введите IP-адрес (если есть):</label>
    <input class="edit_user form-control" id="edit_user_ip_field" maxlength="15" name="ip" placeholder="IP-адрес пользователя" size="100" title="Введите IP-адрес пользователя" type="text" value="<?=isset($current_user['ip']) ? $current_user['ip'] : '';?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="edit_user_view">
    <label class="form-label" for="edit_user_view_field">Количество просмотров:</label>
    <div class="edit_user input-group">
      <input class="edit_user form-control" id="edit_user_view_field" maxlength="7" name="view" readonly="readonly" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($current_user['view'])) {echo '0';} else {echo $current_user['view'];} ?>">
      <div class="input-group-append">
        <input class="button btn btn-outline-secondary" id="edit_user_view_reset" name="view_reset" type="button" value="Обнулить">
      </div>
    </div>
    <div class="form-text"></div>
  </div>

  <div class="cphelp-block form-text"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div><br>
  <div class="cpinput_button"><input class="button" id="submit_user" name="submit_user" type="submit" value="Сохранить пользователя"></div>
</form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>