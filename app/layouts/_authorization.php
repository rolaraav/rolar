<?php defined('A') or die('Access denied'); ?>
<!-- ФОРМА ВХОДА (АВТОРИЗАЦИИ) ПОЛЬЗОВАТЕЛЯ (НАЧАЛО) -->
<?php
// проверяем, не извлечены ли данные пользователя из базы. Если нет, то он не вошел, либо пароль в сессии неверный. Выводим окно для входа. Но мы не будем его выводить для вошедших, им оно уже не нужно.
if(!isset($user['login'])): ?>
  <div id="authorization_info">Вы вошли на сайт, как <strong>Гость</strong></div>
  <!-- Форма входа (авторизации) пользователя, когда пользователь не вошел на сайт (начало) -->
  <form action="<?=D.S;?>user/login" id="authorization_form" method="post">
  <fieldset class="authorization" id="authorization_fieldset">

  <!-- Токен для защиты от XSS -->
  <input class="authorization" id="authorization_token" name="authorization_token" type="hidden" value="<?php if (isset($authorization_token)) {echo $authorization_token;}?>">

  <div class="form-group" id="authorization_login">
  <label class="form-label" for="authorization_login_field">Ваш логин:</label><br>
  <!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
  <input class="authorization form-control" id="authorization_login_field" maxlength="15" name="login" placeholder="Логин" size="20" title="Введите Ваш логин" type="text" value="<?php if (isset($_SESSION['authorization_data']['login'])) {
    echo $_SESSION['authorization_data']['login']; // если есть логин в сессиях, то выводим логин из сессии
  }
  else { // иначе проверяем есть ли логин в куках (пользователь нажал на чекбокс "Запомнить меня" при прошлом входе на сайт)
    if (isset($_COOKIE['login'])) {echo $_COOKIE['login'];} // если есть логин в куках, то выводим логин из куков
  } ?>">
  <?php if (!empty($_SESSION['authorization_errors']['login'])): ?>
  <div class="error">* <?php echo $_SESSION['authorization_errors']['login']; ?></div>
  <?php endif; ?>
  </div>

  <div class="form-group input-group" id="authorization_password">
  <label class="form-label" for="authorization_password_field">Ваш пароль:</label><br>
  <div class="input-group">
  <!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** -->
  <input class="authorization form-control" id="authorization_password_field" maxlength="15" name="password" placeholder="Пароль" size="15" title="Введите Ваш пароль" type="password" value="<?php if (isset($_SESSION['authorization_data']['password'])) {
    echo $_SESSION['authorization_data']['password']; // если есть пароль в сессиях, то выводим пароль из сессии
  }
  else { // иначе проверяем есть ли пароль в куках (пользователь нажал на чекбокс "Запомнить меня" при прошлом входе на сайт)
    if (isset($_COOKIE['password'])) {echo $_COOKIE['password'];} // если есть пароль в куках, то выводим пароль из куков
  } ?>">
  <div class="input-group-append">
  <span class="input-group-text" id="authorization_show_password" title="Показать пароль"><i aria-hidden="true" class="fa fa-eye"></i></span><!-- fa-eye-slash -->
  </div>
  </div>
  <?php if (!empty($_SESSION['authorization_errors']['password'])): ?>
  <div class="error">* <?php echo $_SESSION['authorization_errors']['password']; ?></div>
  <?php endif; ?>
  </div>

  <div class="form-group" id="authorization_remember">
  <label class="form-label" for="authorization_remember_checkbox">Запомнить меня</label>
  <input <?php if (isset($_SESSION['authorization_data']['remember'])) {
    echo CHECK; // если есть метка "Запомнить меня" в сессиях, то выводим CHECK
  }
  else { // иначе проверяем есть ли метка "Запомнить меня" в куках (пользователь нажал на чекбокс "Запомнить меня" при прошлом входе на сайт)
    if (isset($_COOKIE['remember'])) {echo CHECK;} // если есть метка "Запомнить меня" в куках, то выводим CHECK
  } ?>class="authorization" id="authorization_remember_checkbox" name="remember" type="checkbox" value="remember">
  </div>

  <div class="form-group" id="authorization_submit">
    <input class="button btn btn-default" id="authorization_submit_button" name="authorization_submit" type="submit" value="Войти">
  </div>

  </fieldset>
  <?php
    //debug($_SESSION['authorization_data']);
    //debug($_SESSION['authorization_result']);
    //echo $_COOKIE['remember'];
    //debug($user);
  if(isset($_SESSION['authorization_result'])){
    echo '<div class="error">'.$_SESSION['authorization_result'].'</div>';
    unset($_SESSION['authorization_result']);
  }
  //unset($_SESSION['authorization_data']);
  unset($_SESSION['authorization_errors']); ?>
  <!-- <div id="social_authorization"><a href="<?=D.S;?>vkauth" target="_self" title="Авторизация через Вконтакте"><img src="<?=I.S;?>templates/all/vk.png" width="24px" height="24px" border="0px" alt="Авторизация через Вконтакте" title="Авторизация через Вконтакте"></a><a href="<?=D.S;?>fbauth" target="_self" title="Авторизация через Facebook"><img src="<?=I.S;?>templates/all/fb.png" width="24px" height="24px" border="0px" alt="Авторизация через Facebook" title="Авторизация через Facebook"></a><a href="<?=D.S;?>twauth" target="_self" title="Авторизация через Twitter"><img src="<?=I.S;?>templates/all/tw.png" width="24px" height="24px" border="0px" alt="Авторизация через Twitter" title="Авторизация через Twitter"></a><a href="<?=D.S;?>okauth" target="_self" title="Авторизация через Одноклассники"><img src="<?=I.S;?>templates/all/ok.png" width="24px" height="24px" border="0px" alt="Авторизация через Одноклассники" title="Авторизация через Одноклассники"></a><a href="<?=D.S;?>mrauth" target="_self" title="Авторизация через Mail.Ru"><img src="<?=I.S;?>templates/all/mr.png" width="24px" height="24px" border="0px" alt="Авторизация через Mail.Ru" title="Авторизация через Mail.Ru"></a><a href="<?=D.S;?>goauth" target="_self" title="Авторизация через Google"><img src="<?=I.S;?>templates/all/go.png" width="24px" height="24px" border="0px" alt="Авторизация через Google" title="Авторизация через Google"></a><a href="<?=D.S;?>yaauth" target="_self" title="Авторизация через Яндекс"><img src="<?=I.S;?>templates/all/ya.png" width="24px" height="24px" border="0px" alt="Авторизация через Яндекс" title="Авторизация через Яндекс"></a></div> -->

  <ul>
  <!-- ссылка на восстановление пароля -->
  <li><a href="<?=D.S;?>send_password" target="_self">Забыли пароль?</a></li>
  <li><a href="<?=D.S;?>send_login" target="_self">Забыли логин?</a></li>
  <li><a href="<?=D.S;?>registration" target="_self">Регистрация</a></li>
  <!-- <li><a href="<?=D.S;?>authorization" target="_self">Авторизация</a></li> -->
  <li><a href="<?=D.S;?>user/subscribe" target="_self">Подписка</a></li>
  </ul>
  </form>
  <!-- Форма входа (авторизации) пользователя, когда пользователь не вошел на сайт (конец) -->
<?php else:
  // при удачном входе пользователю выдается всё, что расположено ниже между звездочками
  //************************************************************************************
  ?>
  <!-- Здесь выводится данные для авторизованного пользователя, который зашел на сайт -->
  <fieldset class="userdata" id="authorization_fieldset">
  <div class="avatarblockimage"><img alt="<?=$user['login'];?>" src="<?=D.S.$user['avatar'];?>" class="avatarimage" title="<?=$user['login'];?>"></div>
  <div id="authorization_info">Вы вошли на сайт, как <strong><?=$user['login'];?></strong><div class="clear"></div>
  <a href="<?=D.S;?>user<?=$user['id'];?>" target="_top">Моя страница</a><br>
  <a href="<?=D.S;?>users" target="_top">Пользователи</a><br>
  <a href="<?=D.S;?>exit" target="_top">Выход</a>
  <?php if ($user['login'] == 'rolar') {
    echo '<br><a href="'.ADMIN.'" target="_blank">Админка</a><br>
       <a href="'.D.S.'om/admin" target="_blank">OrderMaster</a>';
  } ?></div>
  </fieldset>
  <!-- Здесь заканчиваются данные для авторизованного пользователя, который зашел на сайт -->
  <?php
  if(isset($_SESSION['authorization_success'])){
    echo '<div class="success">'.$_SESSION['authorization_success'].'</div>';
    unset($_SESSION['authorization_success']);
  }
  //************************************************************************************
  // при удачном входе пользователю выдается все, что расположено выше между звездочками
endif; ?>
<!-- ФОРМА ВХОДА (АВТОРИЗАЦИИ) ПОЛЬЗОВАТЕЛЯ (КОНЕЦ) -->