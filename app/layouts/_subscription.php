<?php defined('A') or die('Access denied');
if ((!isset($_SESSION['subscription_success'])) and (!isset($_COOKIE['subscription']))): // если метки и кукии об успешной подписке нет, то выводим форму
?>
<div class="smartresponder">Подпишитесь на рассылку наших новостей, чтобы всегда быть в курсе последних обновлений!</div>

<form action="<?=D.S;?>user/subscribe" id="subscription_form" method="post" name="subscription_form" onsubmit="return SR_submit(this)">
<fieldset id="subscription_fieldset">

<!-- Токен для защиты от XSS -->
<input class="subscription" id="subscription_token" name="subscription_token" type="hidden" value="<?php if (isset($subscription_token)) {echo $subscription_token;}?>">

<div class="form-group" id="subscription_first_name">
<label for="field_name_first">Ваше имя<span class="red1">*</span>:</label><br>
<!--**** В текстовое поле (name="first_name" type="text") пользователь вводит своё имя ***** -->
<input class="subscription form-control" id="field_name_first" maxlength="30" name="first_name" placeholder="Введите Ваше имя" size="20" title="Например: Александр" type="text" value="<?=isset($_SESSION['subscription_data']['first_name']) ? $_SESSION['subscription_data']['first_name'] : '';?>">
<?php if (!empty($_SESSION['subscription_errors']['first_name'])): ?>
  <div class="error">* <?php echo $_SESSION['subscription_errors']['first_name']; ?></div>
<?php endif; ?>
</div>


<div class="form-group" id="subscription_email">
<label for="field_email">Ваш e-mail<span class="red1">*</span>:</label><br>
<!-- **** В текстовое поле (name="email" type="email") пользователь вводит свой email ***** -->
<input class="subscription form-control" id="field_email" maxlength="100" name="email" placeholder="Введите Ваш e-mail" title="Например: aleks@mail.ru" size="20" type="email" value="<?=isset($_SESSION['subscription_data']['email']) ? $_SESSION['subscription_data']['email'] : '';?>">
<?php if (!empty($_SESSION['subscription_errors']['email'])): ?>
  <div class="error">* <?php echo $_SESSION['subscription_errors']['email']; ?></div>
<?php endif; ?>
</div>

<div class="form-group" id="subscription_submit">
<input class="button btn btn-default" id="subscription_submit_button" name="subscription_submit" type="submit" value="Подписаться">
</div>

<div class="help-block"><span class="red1">*</span> Звёздочкой помечены обязательные поля для заполнения</div>
</fieldset>
</form>
<div class="smartresponder">Ваши данные никому не передаются. Вы можете отписаться от рассылки новостей в любой момент.</div>
<?php else:
// если метки об успешной подписке нет, то выводим сообщение
  if (!isset($_SESSION['subscription_success'])) {
    echo '<div class="alert alert-warning">Вы уже подписаны на рассылку новостей сайта '.DOMEN.'!</div>';
  }
endif;
if (isset($_SESSION['subscription_result'])){
  echo $_SESSION['subscription_result'];
  unset($_SESSION['subscription_result']);
}
unset($_SESSION['subscription_data'],$_SESSION['subscription_errors'],$_SESSION['subscription_success']); // после вывода в любом случае удаляем массив подписки и метку об успешной подписке
?>