<?php defined('A') or die('Access denied');?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>
<div class="blocktext">
<h1><?php if(isset($title)){echo $title;} ?></h1>
<?php if(!isset($user['login'])): ?>
<div>Пожалуйста, введите Ваш логин и адрес электронной почты, указанный в параметрах Вашей учётной записи.
После этого проверте Вашу электронную почту - на неё будет отправлен Ваш новый пароль.</div>

<!-- Форма восстановления пароля (начало) -->
<form action="<?=D.S;?>user/send_password" id="send_password_form" method="post">
<fieldset class="userdata" id="send_password_fieldset">

<!-- Токен для защиты от XSS -->
<input class="send_password" id="send_password_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">

<div class="form-group" id="send_password_login">
<label for="send_password_login_field">Введите Ваш логин<span class="red1">*</span>:</label><br>
<!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
<input class="send_password form-control" id="send_password_login_field" maxlength="15" name="login" placeholder="Логин" size="20" title="Введите Ваш логин" type="text" value="<?=isset($_SESSION['send_password_data']['login']) ? $_SESSION['send_password_data']['login'] : '';?>">
<?php if (!empty($_SESSION['send_password_errors']['login'])): ?>
<div class="error">* <?php echo $_SESSION['send_password_errors']['login']; ?></div>
<?php endif; ?>
</div>

<div class="form-group" id="send_password_email">
<label for="send_password_email_field">Введите Ваш e-mail<span class="red1">*</span>:</label><br>
<!-- **** В текстовое поле (name="email" type="email") пользователь вводит свой email ***** -->
<input class="send_password form-control" id="send_password_email_field" maxlength="100" name="email" placeholder="E-mail" title="Введите Ваш e-mail" size="20" type="email" value="<?=isset($_SESSION['send_password_data']['email']) ? $_SESSION['send_password_data']['email'] : '';?>">
<?php if (!empty($_SESSION['send_password_errors']['email'])): ?>
  <div class="error">* <?php echo $_SESSION['send_password_errors']['email']; ?></div>
<?php endif; ?>
</div>

<div class="form-group" id="send_password_submit">
<input class="button btn btn-default" id="send_password_submit_button" name="send_password_submit" type="submit" value="Отправить">
</div>

<div class="help-block"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div>
</fieldset></form>
<!-- Форма восстановления пароля (конец) -->

<div>Если пользователя с таким логином или адресом электронной почты не существует, то письмо отправлено не будет.</div>
<?php
if(isset($_SESSION['send_password_result'])){
    echo $_SESSION['send_password_result'];
    unset($_SESSION['send_password_result']);
}
unset($_SESSION['send_password_data'],$_SESSION['send_password_errors']);
else: ?>
<div class="userlinks"><a href="<?=D.S;?>user<?=$user['id'];?>">Моя страница</a> |
<a href="<?=D.S;?>users">Список пользователей</a> |
<a href="<?=D.S;?>exit">Выход</a></div>
<!-- Здесь выводится данные для авторизованного пользователя, который зашел на сайт -->
<div id="authorization_info"><span class="red1">Вы уже авторизованы!</span><br>Вы вошли на сайт, как <strong><?=$user['login'];?></strong>.<br><a href="<?=D.S;?>exit" target="_top">Выход</a></div>
<!-- Здесь заканчиваются данные для авторизованного пользователя, который зашел на сайт -->
<?php endif; ?>
</div>

<div class="clear"></div>
</div>
</div>