<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
} // debug($message);
if (empty($message)): ?>
    <div>Такого сообщения не существует.</div>
    <div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>
<?php else: ?>
<div class="center red"><strong>Внимание! Восстановить сообщение будет невозможно!</strong><br><br></div>
<form action="" method="post" name="delete_message">

  <div class="cpinput form-group" id="delete_message_published">
    <div class="delete_message">Опубликовать сообщение?</div>
    <div class="row">
      <div class="form-check col-sm-1">
        <input <?php echo $published1; ?>class="form-check-input" disabled="disabled" id="delete_message_published_yes" name="published" title="Опубликовать сообщение?" type="radio" value="1"><label class="form-check-label" for="delete_message_published_yes"> Да</label>
      </div>
      <div class="form-check col-sm-1">
        <input <?php echo $published0; ?>class="form-check-input" disabled="disabled" id="delete_message_published_no" name="published" title="Опубликовать сообщение?" type="radio" value="0"><label class="form-check-label" for="delete_message_published_no"> Нет</label>
      </div>
    </div>
  </div>

  <div class="cpinput form-group" id="delete_message_author">
    <label class="form-label" for="delete_message_author_field">Имя автора сообщения<span class="red1">*</span>:</label>
    <input class="delete_message form-control" disabled="disabled" id="delete_message_author_field" maxlength="100" name="author" placeholder="Имя автора сообщения" size="100" title="Имя автора сообщения" type="text" value="<?php if (empty($message['author'])) {echo $this->user['login'];} else {echo $message['author'];}?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="delete_message_addressee">
    <?php if (isset($addressees)) {echo $addressees;} // выберите имя получателя сообщения ?>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="delete_message_all_users">
    <input <?php if (empty($message['all_users'])) {echo '';} else {echo CHECK;}; ?>class="delete_message" disabled="disabled" id="delete_message_all_users_field" name="all_users" title="Групповое сообщение" type="checkbox">
    <label class="form-label" for="delete_message_all_users_field">&nbsp;Групповое сообщение всем пользователям</label>
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="delete_message_date">
    <label class="form-label" for="delete_message_date_field">Дата и время создания сообщения (ГГГГ-ММ-ДД чч:мм:сс)<span class="red1">*</span>:</label>
    <input class="delete_message form-control" disabled="disabled" id="delete_message_date_field" maxlength="19" name="date" placeholder="Дата и время создания сообщения" size="15" title="Дата и время создания сообщения" type="text" value="<?php if (empty($message['date'])) {$date = date("Y-m-d H:i:s"); echo $date;} else {echo $message['date'];} ?>">
    <div class="form-text"></div>
  </div>

  <div class="cpinput form-group" id="delete_message_text">
    <label class="form-label" for="delete_message_text_field">Текст сообщения<span class="red1">*</span>:</label>
    <textarea class="delete_message form-control" cols="102" disabled="disabled" id="text_field" name="text" placeholder="Текст сообщения" rows="10" title="Текст сообщения"><?php if (isset($message['text'])) {echo $message['text'];}?></textarea>
    <div class="form-text"></div>
  </div>

  <div class="center red"><strong>Внимание! Восстановить сообщение будет невозможно!</strong><br><br></div>
  <div class="cpinput_button"><input class="button delete" id="submit_message" name="submit_message" type="submit" value="Удалить сообщение"></div>
</form><br>
<?php endif;
?>
<div class="center"><a class="button" href="<?=ADMIN.S.$this->alias;?>" target="_self" title="Вернуться назад">Вернуться назад</a></div>