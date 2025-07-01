<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
    // если такого пользователя не существует, то выводим сообщение
    if (empty($current_user['login'])): ?>
    <div class="alert alert-danger">Такого пользователя не существует! Возможно он был удалён</div>
    <div class="message_button btn"><input class="button" name="back" type="button" value="Вернуться назад" onclick="history.back();"></div>
    <?php else: ?>
    <h1>Страница пользователя <?=$current_user['login']?></h1>
    <div class="userlinks"><a href="<?=D.S;?>user<?=$user['id']?>">Моя страница</a> |
        <a href="<?=D.S;?>users">Список пользователей</a> | <a href="<?=D.S;?>exit">Выход</a></div>
  <?php
  // Если страничка принадлежит вошедшему, то предлагаем изменить данные и выводим личные сообщения
  if ($current_user['login'] == $user['login']): ?>
    <p>Ниже Вы можете просмотреть и изменить Ваши персональные данные.</p>

    <form action="<?=D.S;?>user" id="update_first_name_form" method="post">
      <fieldset class="user_data" id="update_first_name_fieldset">
        <input class="update_first_name" id="update_first_name_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
        <div class="form-group" id="update_first_name">
          <div class="update_header left">Ваше имя: <strong><?=$current_user['first_name'];?></strong>.</div>
          <div class="update_user input-group">
          <input class="update_first_name form-control" id="update_first_name_field" maxlength="30" name="first_name" placeholder="Имя" title="Введите Ваше новое имя" type="text" value="">
          <div class="input-group-append">
            <input class="button btn btn-outline-secondary" id="update_first_name_button" name="update_submit" type="submit" value="Изменить имя">
          </div>
          </div>
          <?php if (!empty($_SESSION['update_first_name']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_first_name']['result'].'</div>';}
          if (!empty($_SESSION['update_first_name']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_first_name']['error'].'</div>'; }
          unset($_SESSION['update_first_name']);?>
        </div>
      </fieldset>
    </form>

      <form action="<?=D.S;?>user" id="update_last_name_form" method="post">
          <fieldset class="user_data" id="update_last_name_fieldset">
              <input class="update_last_name" id="update_last_name_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_last_name">
                  <div class="update_header left">Ваша фамилия: <strong><?=$current_user['last_name'];?></strong>.</div>
                  <div class="update_user input-group">
                      <input class="update_last_name form-control" id="update_last_name_field" maxlength="30" name="last_name" placeholder="Фамилия" title="Введите Вашу новую фамилию" type="text" value="">
                      <div class="input-group-append">
                          <input class="button btn btn-outline-secondary" id="update_last_name_button" name="update_submit" type="submit" value="Изменить фамилию">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_last_name']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_last_name']['result'].'</div>';}
                if (!empty($_SESSION['update_last_name']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_last_name']['error'].'</div>'; }
                unset($_SESSION['update_last_name']);?>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_login_form" method="post">
          <fieldset class="user_data" id="update_login_fieldset">
              <input class="update_login" id="update_login_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_login">
                  <div class="update_header left">Ваш логин: <strong><?=$current_user['login'];?></strong>.</div>
                  <div class="update_user input-group">
                      <input class="update_login form-control" id="update_login_field" maxlength="15" name="login" placeholder="Логин" title="Введите Ваш новый логин" type="text" value="">
                      <div class="input-group-append">
                          <input class="button btn btn-outline-secondary" id="update_login_button" name="update_submit" type="submit" value="Изменить логин">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_login']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_login']['result'].'</div>';}
                if (!empty($_SESSION['update_login']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_login']['error'].'</div>'; }
                unset($_SESSION['update_login']);?>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_password_form" method="post">
          <fieldset class="user_data" id="update_password_fieldset">
              <input class="update_password" id="update_password_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
            <?php if ($_SESSION['user']['password'] == "ca89b6b21f977a18455187a4e229f1fa") {
              echo '<span class="red"><strong>У Вас установлен пароль по умолчанию - 111.<br>Для избежания взлома Вашего аккаунта измените Ваш пароль прямо сейчас!!!</strong></span><br>';
            } ?>
              <div class="form-group" id="update_password">
                  <!-- <div class="update_header left">Ваш пароль: <strong><?=$current_user['password'];?></strong>.</div> -->
                  <div class="update_user input-group">
                      <input class="update_password form-control" id="update_password_field" maxlength="15" name="password" placeholder="Пароль" title="Введите Ваш новый пароль" type="password" value="">
                      <div class="input-group-append">
                          <span class="input-group-text" id="update_generate_password" style="display:none;visibility:hidden;" title="Сгенерировать пароль"><i aria-hidden="true" class="fa fa-magic"></i></span>
                          <span class="input-group-text" id="update_show_password" title="Показать пароль"><i aria-hidden="true" class="fa fa-eye"></i></span><!-- fa-eye-slash -->
                          <input class="button btn btn-outline-secondary" id="update_password_button" name="update_submit" type="submit" value="Изменить пароль">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_password']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_password']['result'].'</div>';}
                if (!empty($_SESSION['update_password']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_password']['error'].'</div>'; }
                unset($_SESSION['update_password']);?>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_email_form" method="post">
          <fieldset class="user_data" id="update_email_fieldset">
              <input class="update_email" id="update_email_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_email">
                  <div class="update_header left">Ваш e-mail<span class="red">*</span>: <strong><?=$current_user['email'];?></strong>.</div>
                  <div class="update_user input-group">
                      <input class="update_email form-control" id="update_email_field" maxlength="100" name="email" placeholder="E-mail" title="Введите Ваш новый e-mail" type="email" value="">
                      <div class="input-group-append">
                          <input class="button btn btn-outline-secondary" id="update_email_button" name="update_submit" type="submit" value="Изменить e-mail">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_email']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_email']['result'].'</div>';}
                if (!empty($_SESSION['update_email']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_email']['error'].'</div>'; }
                unset($_SESSION['update_email']);?>
                <div class="help-block"><span class="red">*</span> Адрес электронной почты отображается только на Вашей странице</div>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_phone_form" method="post">
          <fieldset class="user_data" id="update_phone_fieldset">
              <input class="update_phone" id="update_phone_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_phone">
                  <div class="update_header left">Ваш номер телефона<span class="red">*</span>: <strong>+<?=(string)$current_user['phone'];?></strong>.</div>
                  <div class="update_user input-group">
                      <input class="update_phone form-control" id="update_phone_field" maxlength="11" name="phone" placeholder="Номер телефона, например +7987654321" title="Введите Ваш новый номер телефона" type="tel" value=""><div class="update_phone_plus">+</div>
                      <div class="input-group-append">
                          <input class="button btn btn-outline-secondary" id="update_phone_button" name="update_submit" type="submit" value="Изменить номер телефона">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_phone']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_phone']['result'].'</div>';}
                if (!empty($_SESSION['update_phone']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_phone']['error'].'</div>'; }
                unset($_SESSION['update_phone']);?>
                  <div class="help-block"><span class="red">*</span> Номер телефона отображается только на Вашей странице</div>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_site_form" method="post">
          <fieldset class="user_data" id="update_site_fieldset">
              <input class="update_site" id="update_site_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_site">
                  <div class="update_header left">Ваш сайт (страница в соц.сетях): <strong><a href="<?=$current_user['site'];?>" target="_blank"><?=$current_user['site'];?></a></strong>.</div>
                  <div class="update_user input-group">
                      <input class="update_site form-control" id="update_site_field" maxlength="100" name="site" placeholder="Сайт" title="Введите новый адрес Вашего сайта (если есть)" type="url" value="">
                      <div class="input-group-append">
                          <input class="button btn btn-outline-secondary" id="update_site_button" name="update_submit" type="submit" value="Изменить сайт">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_site']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_site']['result'].'</div>';}
                if (!empty($_SESSION['update_site']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_site']['error'].'</div>'; }
                unset($_SESSION['update_site']);?>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" enctype="multipart/form-data" id="update_avatar_form" method="post">
          <fieldset class="user_data" id="update_avatar_fieldset">
              <input class="update_avatar" id="update_avatar_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_avatar">
                  <div class="update_header left">Ваш аватар<span class="red">*</span>: <strong><?=$current_user['avatar'];?></strong><br>
                  <div class="avatarblockimageuserpage"><img alt="<?=$current_user['login'];?>" class="avatarimage" src="<?=$current_user['avatar'];?>" title="<?=$current_user['login'];?>"></div>
                  </div>
                  <div class="update_user input-group">
                      <input accept="image/jpeg,image/png,image/gif" class="update_avatar form-control" id="update_avatar_file" name="fupload" placeholder="Аватар" title="Выберите файл изображения для Вашего нового аватара" type="file">
                      <div class="input-group-append">
                          <input class="button btn btn-outline-secondary" id="update_avatar_button" name="update_submit" type="submit" value="Изменить аватар">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_avatar']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_avatar']['result'].'</div>';}
                if (!empty($_SESSION['update_avatar']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_avatar']['error'].'</div>'; }
                unset($_SESSION['update_avatar']);?>
                <div class="help-block"><span class="red">*</span> Изображение для аватара должно быть в формате <strong>JPG</strong>, <strong>GIF</strong> или <strong>PNG</strong> и размером не более 2 Мб</div>
                <div class="help-block"><span class="red">*</span> Если файл изображения не выбран, то будет установлен аватар по-умолчанию</div>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_birthday_form" method="post">
          <fieldset class="user_data" id="update_birthday_fieldset">
              <input class="update_birthday" id="update_birthday_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_birthday">
                  <div class="update_header left">Ваша дата Рождения: <strong><?=$current_user['birthday_for_view'];?></strong>.</div>
                  <div class="update_user input-group">
                      <input class="update_birthday form-control" id="update_birthday_field" maxlength="10" name="birthday" placeholder="Дата Рождения (ГГГГ-ММ-ДД)" title="Укажите Вашу новую дату Рождения" type="date" value="<?=$current_user['birthday'];?>">
                      <div class="input-group-append">
                          <input class="button btn btn-outline-secondary" id="update_birthday_button" name="update_submit" type="submit" value="Изменить дату Рождения">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_birthday']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_birthday']['result'].'</div>';}
                if (!empty($_SESSION['update_birthday']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_birthday']['error'].'</div>'; }
                unset($_SESSION['update_birthday']);?>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_gender_form" method="post">
          <fieldset class="user_data" id="update_gender_fieldset">
              <input class="update_gender" id="update_gender_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_gender">
                  <div class="update_header left">Ваш пол: <strong><?=$current_user['gender_for_view'];?></strong>.</div>
                  <div class="update_user row">
                      <div class="col-md-3"></div>
                      <div class="form-check col-md-2">
                  <input <?php echo $current_user['gender2']; ?>class="form-check-input" id="update_gender_male" name="gender" title="Укажите Ваш пол (если нужно)" type="radio" value="2"><label class="form-check-label" for="update_gender_male"> мужской</label>
                      </div>
                      <div class="form-check col-md-2">
                  <input <?php echo $current_user['gender1']; ?>class="form-check-input" id="update_gender_female" name="gender" title="Укажите Ваш пол (если нужно)" type="radio" value="1"><label class="form-check-label" for="update_gender_female"> женский</label>
                      </div>
                      <div class="form-check col-md-2">
                  <input <?php echo $current_user['gender0']; ?>class="form-check-input" id="update_gender_not_specified" name="gender" title="Укажите Ваш пол (если нужно)" type="radio" value="0"><label class="form-check-label" for="update_gender_not_specified"> не указан</label>
                      </div>
                      <div class="col-md-3">
                  <input class="button btn btn-outline-secondary" id="update_gender_button" name="update_submit" type="submit" value="Изменить пол">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_gender']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_gender']['result'].'</div>';}
                if (!empty($_SESSION['update_gender']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_gender']['error'].'</div>'; }
                unset($_SESSION['update_gender']);?>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_letter_type_form" method="post">
          <fieldset class="user_data" id="update_letter_type_fieldset">
              <input class="update_letter_type" id="update_letter_type_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_letter_type">
                  <div class="update_header left">Тип письма: <strong><?=$current_user['letter_type_for_view'];?></strong>.</div>
                  <div class="update_user row">
                      <div class="col-md-4"></div>
                      <div class="form-check col-md-2">
                          <input <?php echo $current_user['letter_type0']; ?>class="form-check-input" id="update_letter_type_text" name="letter_type" title="Укажите тип письма" type="radio" value="0"><label class="form-check-label" for="update_letter_type_text"> текст</label>
                      </div>
                      <div class="form-check col-md-2">
                          <input <?php echo $current_user['letter_type1']; ?>class="form-check-input" id="update_letter_type_html" name="letter_type" title="Укажите тип письма" type="radio" value="1"><label class="form-check-label" for="update_letter_type_html"> HTML</label>
                      </div>
                      <div class="col-md-4">
                          <input class="button btn btn-outline-secondary" id="update_letter_type_button" name="update_submit" type="submit" value="Изменить тип письма">
                      </div>
                  </div>
                <?php if (!empty($_SESSION['update_letter_type']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_letter_type']['result'].'</div>';}
                if (!empty($_SESSION['update_letter_type']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_letter_type']['error'].'</div>'; }
                unset($_SESSION['update_letter_type']);?>
              </div>
          </fieldset>
      </form>

      <form action="<?=D.S;?>user" id="update_subscribe_form" method="post">
          <fieldset class="user_data" id="update_subscribe_fieldset">
              <input class="update_subscribe" id="update_subscribe_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
              <div class="form-group" id="update_subscribe">
                  <div class="update_header left">Статус пользователя: <strong><?=$current_user['status_for_view'];?></strong>.</div>
                  <div class="update_user row">
                      <div class="form-check col-md-2"></div>
                      <div class="form-check col-md-4">
                          <input <?php if ($current_user['status'] > 1) {echo CHECK;} ?>class="form-check-input" id="update_subscribe" name="subscribe" title="Подписаться на новости сайта?" type="checkbox" value="subscribe"><label class="form-check-label" for="update_subscribe"> подписаться на новости</label>
                      </div>
                      <div class="col-md-4">
                          <input class="button btn btn-outline-secondary" id="update_subscribe_button" name="update_submit" type="submit" value="Отменить подписку">
                      </div>
                      <div class="form-check col-md-2"></div>
                  </div>
                <?php if (!empty($_SESSION['update_subscribe']['result'])) {echo '<div class="alert alert-success">'.$_SESSION['update_subscribe']['result'].'</div>';}
                if (!empty($_SESSION['update_subscribe']['error'])) {echo '<div class="alert alert-danger">'.$_SESSION['update_subscribe']['error'].'</div>'; }
                unset($_SESSION['update_subscribe']);?>
              </div>
          </fieldset>
      </form>

    <fieldset class="user_data" id="auth_info_fieldset">
        <div id="auth_method">Вы авторизованы через: <strong><?=$current_user['auth_method'];?></strong>.</div>
        <div id="reg_date">Дата и время регистрации: <strong><?=$current_user['reg_date'];?></strong>.</div>
        <div id="login_date">Дата и время последней авторизации: <strong><?=$current_user['login_date'];?></strong>.</div>
        <div id="views">Количество просмотров: <strong><?=$current_user['view'];?></strong>.</div>
        <div id="user_agent">Ваш браузер: <strong><?php echo mb_substr($_SERVER['HTTP_USER_AGENT'],0,stripos($_SERVER['HTTP_USER_AGENT'],' '),"UTF-8");?></strong>.</div>
        <div id="ip_address">Ваш IP-адрес: <strong><?=$current_user['ip'];?></strong>.</div>
        <div id="request_tume">Вы зашли на страницу: <strong><?php echo rusdate('j %MONTH% Y, G:i:s', $_SERVER['REQUEST_TIME'],1,0); //get_datetime($_SERVER['REQUEST_TIME']) ?></strong>.</div>
        <div id="ets_info">Ваши действия: <strong>сидите на стуле, ковыряетесь в носу, смотрите в монитор и улыбаетесь</strong> <em>(шутка)</em>.</div>
      <?php //print_array($_SERVER); print_array($current_user);?>
    </fieldset>

    <form action="<?=D.S;?>user" id="delete_form" method="post">
        <fieldset class="user_data" id="delete_user_fieldset">
            <div class="probel">&nbsp;</div>
            <div id="delete_user" class="center">
                <input class="delete_user" id="delete_user_token" name="token" type="hidden" value="<?php if (isset($token)) {echo $token;}?>">
                <input id="delete_user" name="delete_user" type="hidden" value="1">
                <input class="button btn btn-outline-secondary" id="delete_user_button" name="update_submit" type="submit" value="Удалить аккаунт пользователя <?=$current_user['login'];?>"></div>
            <div class="red1 bold">После нажатия на кнопку восстановить аккаунт пользователя будет невозможно!</div>
            <div class="probel">&nbsp;</div>
        </fieldset>
    </form>

    <div class="messages">Личные сообщения:</div>
  <?php
  /* Вывод личных сообщений (начало) */
  if(!empty($current_user['messages'])):
  foreach($current_user['messages'] as $item): ?>
    <div class="message">
        <div class="messageauthoravatar"><a href="<?=D.S;?>user<?=$item['author_id'];?>" target="_self"><img alt="<?=$item['author'];?>" class="avatarimage" src="<?=$item['author_avatar'];?>" title="<?=$item['author'];?>"></a></div>
        <div class="messageinfo">
            <span class="messageauthor">Отправитель: <strong><a href="<?=D.S;?>user<?=$item['author_id'];?>" target="_self"><?=$item['author'];?></a></strong></span><br>
            <span class="messageauthor">Получатель: <strong><?=$item['addressee'];?></strong></span>
            <span class="messagedate">Отправлено: <strong><?=$item['date'];?></strong></span>
        </div>
        <div class="messagetext"><?=$item['text'];?></div>
        <div class="clear"></div>
        <div class="messagedelete"><a class="messagedelete" href="<?=D.S;?>delete_message<?=$item['id'];?>" target="_self">Удалить [X]</a></div>
    </div>
  <?php endforeach;
  //если сообщений не найдено
  else: echo '<div class="">Сообщений пока нет.</div>';
  endif;
  if (isset($_SESSION['delete_message_result'])):
    echo $_SESSION['delete_message_result'];
  endif;
  unset($_SESSION['delete_message_result']);
  /* Вывод личных сообщений (конец) */
  // если страничка чужая, то выводим только некторые данные и форму для отправки личных сообщений
  else: ?>
    <p>Ниже приведена информация о данном пользователе.</p>
    <div id="first_name">Имя: <strong><?=$current_user['first_name'];?></strong>.</div>
    <div id="last_name">Фамилия: <strong><?=$current_user['last_name'];?></strong>.</div>
    <div id="login">Логин: <strong><?=$current_user['login'];?></strong>.</div>
    <div id="site">Сайт: <strong><?=$current_user['site_for_view'];?></strong>.</div>
    <div id="birthday">Дата Рождения: <strong><?=$current_user['birthday_for_view'];?></strong>.</div>
    <div id="gender">Пол: <strong><?=$current_user['gender_for_view'];?></strong>.</div>
    <div id="avatar">Аватар:<br>
        <div class="avatarblockimageuserpage"><img alt="<?=$current_user['login'];?>" class="avatarimage" src="<?=$current_user['avatar'];?>" title="<?=$current_user['login'];?>"></div></div>
    <div id="method">Авторизован через: <strong><?=$current_user['auth_method'];?></strong>.</div>
    <div id="reg_date">Дата и время регистрации: <strong><?=$current_user['reg_date'];?></strong>.</div>
    <div id="login_date">Дата и время авторизации: <strong><?=$current_user['login_date'];?></strong>.</div>
    <div id="views">Количество просмотров: <strong><?=$current_user['view'];?></strong>.</div>
    <br>
    <h3>Отправить сообщение <?=$current_user['login'];?>:</h3>
    <form action="<?=D.S.'user'.$current_user['id'];?>" id="send_message_form" method="post">
      <fieldset class="userdata" id="send_message_fieldset">
        <input class="send_message" id="send_message_token" name="message_token" type="hidden" value="<?php if (isset($message_token)) {echo $message_token;}?>">
        <textarea id="message_text_field" maxlength="2000" name="message_text" placeholder="Введите Ваше сообщение" cols="75" rows="10" title="Введите Ваше сообщение"></textarea><br>
        <input name="message_addressee" type="hidden" value="<?=$current_user['login'];?>">
        <input class="button" id="send_message_button" name="submit_message" type="submit" value="Отправить">
      </fieldset>
    </form>
  <?php
    if (isset($_SESSION['send_message_result'])) {
      echo $_SESSION['send_message_result'];
    }
    unset($_SESSION['send_message_result'],$_SESSION['send_message_errors']);
  endif;
  endif; ?>


<div class="clear"></div>
</div>
</div>