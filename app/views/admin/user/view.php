<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php // debug($current_user);
if (empty($current_user)): ?>
  <div>Такого пользователя не существует.</div>
  <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<?php else: ?>
  <div class="form-label">

    <div class="cpinput form-group" id="edit_user_first_name">Имя пользователя: <span class="green1 bold"><?=$current_user['first_name'];?></span></div>

    <div class="cpinput form-group" id="edit_user_last_name">Фамилия пользователя: <span class="green1 bold"><?=$current_user['last_name'];?></span></div>

    <div class="cpinput form-group" id="edit_user_login">Логин пользователя (3-15 символов): <span class="green1 bold"><?=$current_user['login'];?></span></div>

    <div class="cpinput form-group" id="edit_user_password">Хеш пароля пользователя: <span class="yellowfon bold"><?=$current_user['password'];?></span></div>

    <div class="cpinput form-group" id="edit_user_phone">Номер телефона пользователя: <span class="green1 bold">+<?=$current_user['phone'];?></span></div>

    <div class="cpinput form-group" id="edit_user_email">E-mail пользователя: <span class="green1 bold"><?=$current_user['email'];?></span></div>

    <div class="cpinput form-group" id="edit_user_site">Сайт пользователя (если есть): <span class="green1 bold"><? if (empty($current_user['site'])) {echo 'нет сайта';} else {echo $current_user['site'];} ?></span></div>

    <div class="cpinput form-group" id="edit_user_avatar">Путь к картинке-аватару: <span class="green1 bold"><?php if (empty($current_user['avatar'])) {echo DAVATAR;} else {echo $current_user['avatar'];}?></span></div>

    <div class="cpinput form-group">Фотография пользователя (если есть):<br>
      <?php if (!empty($current_user['avatar'])): ?>
      <a class="uploadimage" href="<?php echo D.S.$current_user['avatar']; ?>" id="edit_user_avatar_link" rel="image" target="_blank" title="<?php echo basename($current_user['avatar']); ?>"><img alt="<?php echo basename($current_user['avatar']); ?>" class="oneimage" src="<?php echo D.S.$current_user['avatar']; ?>" title="<?php echo basename($current_user['avatar']); ?>"></a>
      <?php endif; ?>
    </div>

    <div class="cpinput form-group" id="edit_user_photo">Ссылка на форографию в социальных сетях (если есть):<br>
      <span class="green1 bold"><?php if (empty($current_user['photo'])) {echo 'фотографии нет';} else {echo $current_user['photo'];}?></span><br>
      <a class="uploadimage" href="<?php echo D.S.$current_user['photo']; ?>" id="edit_user_avatar_link" rel="image" target="_blank" title="<?php echo basename($current_user['photo']); ?>"><img alt="<?php echo basename($current_user['photo']); ?>" class="oneimage" src="<?php echo D.S.$current_user['photo']; ?>" title="<?php echo basename($current_user['photo']); ?>"></a>
    </div>

    <div class="cpinput form-group" id="edit_user_reg_date">Дата и время регистрации (добавления) пользователя (ГГГГ-ММ-ДД чч:мм:сс): <span class="green1 bold"><?php if (empty($current_user['reg_date'])) {$reg_date = date("Y-m-d H:i:s"); echo $reg_date;} else {echo $current_user['reg_date'];} ?></span></div>

    <div class="cpinput form-group" id="edit_user_login_date">Дата и время авторизации пользователя (ГГГГ-ММ-ДД чч:мм:сс): <span class="green1 bold"><?php if (empty($current_user['login_date'])) {$login_date = date("Y-m-d H:i:s"); echo $login_date;} else {echo $current_user['login_date'];} ?></span></div>

    <div class="cpinput form-group" id="edit_user_birthday">Дата рождения пользователя (ГГГГ-ММ-ДД): <span class="green1 bold"><?php if (empty($current_user['birthday'])) {$birthday = '1970-01-01'; echo $birthday;} else {echo $current_user['birthday'];} ?></span></div>

    <div class="cpinput form-group" id="edit_user_status">Статус пользователя: <span class="green1 bold"><?php if (isset($user_status)) {echo $user_status;} ?></span></div>

    <div class="cpinput form-group" id="edit_user_method">Метод регистрации/авторизации пользователя: <span class="green1 bold"><?php if (isset($user_method)) {echo $user_method;} ?></span></div>

    <div class="cpinput form-group" id="edit_user_social_id">ID в социальной сети (если есть): <span class="green1 bold"><?=isset($current_user['social_id']) ? $current_user['social_id'] : '';?></span></div>

    <div class="cpinput form-group" id="edit_user_gender">Пол пользователя: <span class="green1 bold"><?php echo $gender; ?></span></div>

    <div class="cpinput form-group" id="edit_user_activation">Активация пользователя: <span class="green1 bold"><?php echo $activation; ?></span></div>

    <div class="cpinput form-group" id="edit_user_letter_type">Тип получаемых писем: <span class="green1 bold"><?php echo $letter_type; ?></span></div>

    <div class="cpinput form-group" id="edit_user_ip">IP-адрес (если есть): <span class="green1 bold"><?=isset($current_user['ip']) ? $current_user['ip'] : '';?></span></div>

    <div class="cpinput form-group" id="edit_user_view">Количество просмотров: <span class="green1 bold"><?php if (empty($current_user['view'])) {echo '0';} else {echo $current_user['view'];} ?></span></div>

  </div>
<?php endif; ?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>