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
  <div class="center red"><strong>Внимание! Восстановить пользователя будет невозможно!</strong></div><br><br>
  <form action="" enctype="multipart/form-data" method="post" name="delete_user">

    <input id="old_login" name="old_login" type="hidden" value="<?php echo $current_user['login'];?>">

    <div class="cpinput form-group" id="delete_user_first_name">
      <label class="form-label" for="delete_user_first_name_field">Имя пользователя<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_first_name_field" maxlength="100" name="first_name" placeholder="Имя пользователя" size="100" title="Имя пользователя" type="text" value="<?=$current_user['first_name'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_last_name">
      <label class="form-label" for="delete_user_last_name_field">Фамилия пользователя<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_last_name_field" maxlength="100" name="last_name" placeholder="Фамилия пользователя" size="100" title="Фамилия пользователя" type="text" value="<?=$current_user['last_name'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_login">
      <label class="form-label" for="delete_user_login_field">Логин пользователя (3-15 символов)<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_login_field" maxlength="15" name="login" placeholder="Логин пользователя" size="15" title="Логин пользователя" type="text" value="<?=$current_user['login'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_password">
      <div class="form-label red"><strong>Пароль пользователя зашифрован, изменить его невозможно!</strong></div><br>
      <span class="yellowfon">Хеш пароля: <?=$current_user['password'];?></span><br><br>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_phone">
      <label class="form-label" for="delete_user_phone_field">Номер телефона пользователя<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_phone_field" maxlength="11" name="phone" placeholder="Номер телефона пользователя" size="100" title="Номер телефона пользователя" type="tel" value="<?=$current_user['phone'];?>"><div class="phone_plus">+</div>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_email">
      <label class="form-label" for="delete_user_email_field">E-mail пользователя<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_email_field" maxlength="100" name="email" placeholder="E-mail пользователя" size="100" title="E-mail пользователя" type="email" value="<?=$current_user['email'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_site">
      <label class="form-label" for="delete_user_site_field">Сайт пользователя (если есть):</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_site_field" maxlength="255" name="site" placeholder="Сайт пользователя" size="100" title="Сайт пользователя" type="text" value="<?=$current_user['site'];?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_avatar">
      <label class="form-label" for="delete_user_avatar_field">Путь к картинке-аватару (например, <span class="monospace_url">images/users/avatars/rolar.jpg</span>)<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_avatar_field" maxlength="255" name="avatar" placeholder="Путь к картинке-аватару" size="100" title="Путь к картинке-аватару" type="text" value="<?php if (empty($current_user['avatar'])) {echo DAVATAR;} else {echo $current_user['avatar'];}?>">
      <div class="form-text"></div>

      <label class="form-label" for="delete_user_avatar_link">Фотография пользователя (если есть):</label><br>
      <?php if (!empty($current_user['avatar'])) {
        echo '<a class="uploadimage" href="'.D.S.$current_user['avatar'].'" id="delete_user_avatar_link" rel="image" target="_blank" title="'.basename($current_user['avatar']).'"><img alt="'.basename($current_user['avatar']).'" class="oneimage" src="'.D.S.$current_user['avatar'].'" title="'.basename($current_user['avatar']).'"></a>';
      } ?>
    </div>

    <div class="cpinput form-group" id="delete_user_photo">
      <label class="form-label" for="delete_user_photo_field">Ссылка на форографию в социальных сетях (если есть):</label><br>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_photo_field" maxlength="255" name="photo" placeholder="Путь к фотографии в соц.сетях" size="100" title="Путь к фотографии в соц. сетях" type="text" value="<?php if (empty($current_user['photo'])) {echo 'фотографии нет';} else {echo $current_user['photo'];}?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_reg_date">
      <label class="form-label" for="delete_user_reg_date_field">Дата и время регистрации (добавления) пользователя (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_reg_date_field" maxlength="19" name="reg_date" placeholder="Дата и время регистрации пользователя" size="15" title="Дата и время регистрации пользователя" type="text" value="<?php if (empty($current_user['reg_date'])) {$reg_date = date("Y-m-d H:i:s"); echo $reg_date;} else {echo $current_user['reg_date'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_login_date">
      <label class="form-label" for="delete_user_login_date_field">Дата и время авторизации пользователя (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_login_date_field" maxlength="19" name="login_date" placeholder="Дата и время авторизации пользователя" size="15" title="Дата и время авторизации пользователя" type="text" value="<?php if (empty($current_user['login_date'])) {$login_date = date("Y-m-d H:i:s"); echo $login_date;} else {echo $current_user['login_date'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_birthday">
      <label class="form-label" for="delete_user_birthday_field">Дата рождения пользователя (ГГГГ-ММ-ДД)<span class="red1">*</span>:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_birthday_field" maxlength="10" name="birthday" placeholder="Дата рождения пользователя" size="15" title="Дата рождения пользователя" type="text" value="<?php if (empty($current_user['birthday'])) {$birthday = '1970-01-01'; echo $birthday;} else {echo $current_user['birthday'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_status">
      <?php if (isset($user_status)) {echo $user_status;} // выберите статус пользователя ?>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_method">
      <?php if (isset($user_method)) {echo $user_method;} // выберите метод регистрации/авторизации пользователя ?>
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_social_id">
      <label class="form-label" for="delete_user_social_id_field">ID в социальной сети (если есть):</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_social_id_field" maxlength="255" name="social_id" placeholder="ID в социальной сети" size="100" title="ID в социальной сети" type="text" value="<?=isset($current_user['social_id']) ? $current_user['social_id'] : '';?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_gender">
      <div class="delete_user">Пол пользователя:</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $gender2; ?>class="form-check-input" disabled="disabled" id="delete_user_gender_male" name="gender" title="Пол пользователя" type="radio" value="2"><label class="form-check-label" for="delete_user_gender_male"> мужской</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $gender1; ?>class="form-check-input" disabled="disabled" id="delete_user_gender_female" name="gender" title="Пол пользователя" type="radio" value="1"><label class="form-check-label" for="delete_user_gender_female"> женский</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $gender0; ?>class="form-check-input" disabled="disabled" id="delete_user_gender_no" name="gender" title="Пол пользователя" type="radio" value="0"><label class="form-check-label" for="delete_user_gender_no"> не указан</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_user_activation">
      <div class="delete_user">Активировать пользователя?</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $activation1; ?>class="form-check-input" disabled="disabled" id="delete_user_activation_yes" name="activation" title="Активировать пользователя?" type="radio" value="1"><label class="form-check-label" for="delete_user_activation_yes"> Да</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $activation0; ?>class="form-check-input" disabled="disabled" id="delete_user_activation_no" name="activation" title="Активировать пользователя?" type="radio" value="0"><label class="form-check-label" for="delete_user_activation_no"> Нет</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_user_letter_type">
      <div class="delete_user">Тип получаемых писем:</div>
      <div class="row">
        <div class="form-check col-sm-1">
          <input <?php echo $letter_type1; ?>class="form-check-input" disabled="disabled" id="delete_user_letter_type_html" name="letter_type" title="Тип получаемых писем" type="radio" value="1"><label class="form-check-label" for="delete_user_letter_type_html"> HTML</label>
        </div>
        <div class="form-check col-sm-1">
          <input <?php echo $letter_type0; ?>class="form-check-input" disabled="disabled" id="delete_user_letter_type_text" name="letter_type" title="Тип получаемых писем" type="radio" value="0"><label class="form-check-label" for="delete_user_letter_type_text"> текст</label>
        </div>
      </div>
    </div>

    <div class="cpinput form-group" id="delete_user_ip">
      <label class="form-label" for="delete_user_ip_field">IP-адрес (если есть):</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_ip_field" maxlength="15" name="ip" placeholder="IP-адрес пользователя" size="100" title="IP-адрес пользователя" type="text" value="<?=isset($current_user['ip']) ? $current_user['ip'] : '';?>">
      <div class="form-text"></div>
    </div>

    <div class="cpinput form-group" id="delete_user_view">
      <label class="form-label" for="delete_user_view_field">Количество просмотров:</label>
      <input class="delete_user form-control" disabled="disabled" id="delete_user_view_field" maxlength="7" name="view" placeholder="Количество просмотров" size="7" title="Количество просмотров" type="number" value="<?php if (empty($current_user['view'])) {echo '0';} else {echo $current_user['view'];} ?>">
      <div class="form-text"></div>
    </div>

    <div class="center red"><strong>Внимание! Восстановить пользователя будет невозможно!</strong></div><br><br>
    <div class="cpinput_button"><input class="button delete" id="submit_user" name="submit_user" type="submit" value="Удалить пользователя"></div>
  </form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
