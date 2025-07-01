<?php defined('A') or die('Access denied');?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>
<h1><?php if(isset($title)){echo $title;} ?></h1>
<?php
if (!isset($user['login'])): // если пользователь не авторизован
  // debug($_SESSION['registration_data']);
?>
<div class="blocktext row">
<div class="col-md-12">
<?php // здесь отображаются сообщения о регистрации
  if (isset($_SESSION['registration_result'])){
    echo $_SESSION['registration_result'];
    unset($_SESSION['registration_result']);
    // echo '<script language="javascript" type="text/javascript">setTimeout("document.location.href=\''.D.'\'", 10000);</script>';
    // echo $_SESSION['registration_redirect'];
    //unset($_SESSION['registration_redirect']);
  }
  // при первом входе устанавливаем дефолтные значения для полей формы, иначе выводим то, что было заполнено
  if (!isset($_SESSION['registration_success'])): // если метки об успешной регистрации нет, то выводим форму
?>
<!-- Форма регистрации пользователя (начало) -->
<form action="<?=D.S;?>user/signup" id="registration_form" method="post">
<fieldset class="userdata" id="registration_fieldset">

<!-- Токен для защиты от XSS -->
<input class="registration" id="registration_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">

<div class="form-group" id="registration_first_name">
<label class="form-label" for="registration_first_name_field">Ваше имя<span class="red1">*</span>:</label>
<!--**** В текстовое поле (name="first_name" type="text") пользователь вводит свое имя/фамилию ***** -->
<input class="registration form-control" id="registration_first_name_field" maxlength="30" name="first_name" placeholder="Введите Ваше имя" size="15" title="Введите Ваше имя" type="text" value="<?=isset($_SESSION['registration_data']['first_name']) ? $_SESSION['registration_data']['first_name'] : '';?>">
  <?php if (!empty($_SESSION['registration_errors']['first_name'])): ?>
<div class="error">* <?php echo $_SESSION['registration_errors']['first_name']; ?></div>
  <?php endif; ?>
</div>

<div class="form-group" id="registration_login">
<label class="form-label" for="registration_login_field">Ваш логин<span class="red1">*</span>:</label>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
<input class="registration form-control" id="registration_login_field" maxlength="15" name="login" placeholder="Введите Ваш логин" size="15" title="Введите Ваш логин" type="text" value="<?=isset($_SESSION['registration_data']['login']) ? $_SESSION['registration_data']['login'] : '';?>">
  <?php if (!empty($_SESSION['registration_errors']['login'])): ?>
<div class="error">* <?php echo $_SESSION['registration_errors']['login']; ?></div>
  <?php endif; ?>
</div>

<div class="form-group input-group" id="registration_password">
<label class="form-label" for="registration_password_field">Ваш пароль<span class="red1">*</span>:</label>
<div class="input-group">
<!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** -->
<input class="registration form-control" id="registration_password_field" maxlength="15" name="password" placeholder="Введите Ваш пароль" title="Введите Ваш пароль" size="15" type="password" value="">
<div class="input-group-append">
<span class="input-group-text" id="registration_generate_password" style="display:none;visibility:hidden;" title="Сгенерировать пароль"><i aria-hidden="true" class="fa fa-magic"></i></span>
<span class="input-group-text" id="registration_show_password" title="Показать пароль"><i aria-hidden="true" class="fa fa-eye"></i></span><!-- fa-eye-slash -->
</div>
</div>
  <?php if (!empty($_SESSION['registration_errors']['password'])): ?>
<div class="error">* <?php echo $_SESSION['registration_errors']['password']; ?></div>
  <?php endif; ?>
</div>

<div class="form-group" id="registration_email">
<label class="form-label" for="registration_email_field">Ваш e-mail<span class="red1">*</span>:</label>
<!-- **** В текстовое поле (name="email" type="email") пользователь вводит свой email ***** -->
<input class="registration form-control" id="registration_email_field" maxlength="100" name="email" placeholder="Введите Ваш e-mail" title="Введите Ваш e-mail" size="15" type="email" value="<?=isset($_SESSION['registration_data']['email']) ? $_SESSION['registration_data']['email'] : '';?>">
  <?php if (!empty($_SESSION['registration_errors']['email'])): ?>
<div class="error">* <?php echo $_SESSION['registration_errors']['email']; ?></div>
  <?php endif; ?>
<div class="help-block"><span class="red1">*</span> Адрес электронной почты отображается только на Вашей странице и нужен для подтверждения регистрации на сайте</div>
</div>

<div class="form-group" id="registration_code">
<!-- В 'codegen.php' генерируется код и рисуется изображение -->
<img id="codegen_img" src="<?=D.S.'core'.S.'vendors'.S.'codegen.php';?>" title="Нажмите, чтобы обновить код на картинке"><a href="#" id="codegen_link" title="Нажмите, чтобы обновить код на картинке" onclick="document.getElementById('codegen_img').src='<?=D.S.'core'.S.'vendors'.S.'codegen.php?';?>'+Math.random();document.getElementById('registration_code_field').focus();">Обновить</a><br>
<label class="form-label" for="registration_code_field">Введите код с картинки<span class="red1">*</span>:</label><input class="form-control" id="registration_code_field" maxlength="6" name="code" placeholder="Введите код с картинки" size="6" title="Введите код с картинки" type="text">
<?php if (!empty($_SESSION['registration_errors']['code'])): ?>
  <div class="error">* <?php echo $_SESSION['registration_errors']['code']; ?></div>
  <?php endif; ?>
</div>

<div class="form-group" id="registration_submit">
  <!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** -->
  <input class="button btn btn-default" id="registration_submit_button" name="registration_submit" type="submit" value="Зарегистрировать">
</div>

<div class="help-block"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div>
</fieldset></form>
<!-- Форма регистрации пользователя (конец) -->
<?php endif; // конец условия о наличии метки об успешной регистрации $_SESSION['registration_success']
  unset($_SESSION['registration_data'],$_SESSION['registration_errors'],$_SESSION['registration_success']); // после вывода в любом случае удаляем массив регистрации, массив ошибок регистрации и метку об успешной регистрации
?>
</div>
</div>
<?php
else:
  // при удачном входе пользователю выдается всё, что расположено ниже между звездочками
  //************************************************************************************
  ?>
<div class="blocktext">
  <div class="userlinks"><a href="<?=D.S;?>user<?=$user['id'];?>">Моя страница</a> |
    <a href="<?=D.S;?>users">Список пользователей</a> |
    <a href="<?=D.S;?>exit">Выход</a></div>
  <!-- Здесь выводится данные для авторизованного пользователя, который зашел на сайт -->
  <fieldset class="userdata" id="authorization_fieldset">
    <div class="avatarblockimage"><img alt='<?=$user['login'];?>' src='<?=D.$user['avatar'];?>' class='avatarimage' title='<?=$user['login'];?>'></div>
    <div id="authorization_info"><span class="red1">Вы уже зарегистрированы!!!</span><br>Вы вошли на сайт, как <strong><?=$user['login'];?></strong>.<br><a href="<?=D.S;?>exit" target="_top">Выход</a></div>
  </fieldset>
  <!-- Здесь заканчиваются данные для авторизованного пользователя, который зашел на сайт -->
</div>
<?php
  //************************************************************************************
    // при удачном входе пользователю выдается все, что расположено выше между звездочками
endif; ?>
<div class="clear"></div>
</div>
</div>