<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php
if(isset($pagination)) {
  echo $pagination;
}

if (isset($_SESSION['result'])){
  echo $_SESSION['result']."<br>";
  unset($_SESSION['result']);
}


if (!empty($users)):
  // print_array($users); ?>
    <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Добавить подписчика</a></div>
  <table class="admin_panel">
    <tr>
      <th>№</th>
      <th>Имя подписчика</th>
      <th>Email</th>
      <th class="cpth" id="view" title="Просмотреть"></th>
      <th class="cpth" id="edit" title="Редактировать"></th>
      <th class="cpth" id="delete" title="Удалить"></th>
    </tr>
    <?php foreach($users as $item): ?>
      <tr<?php $item['activation'] == 0 ? $activation = ' class="cpnoactivation"' : $activation = ''; echo $activation;?>>
        <td><?=$item['id'];?></td>
        <td class="text"><?=$item['first_name'];?></td>
        <td class="text"><a href="maito:<?=$item['email'];?>" target="_blank"><?=$item['email'];?></a></td>
        <td class="cpimg"><a class="view" href="<?=D.S.'user'.$item['id'];?>" target="_blank" title="Просмотреть на сайте"></a></td>
        <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S.'edit'.S.'id'.$item['id'];?>" target="_self" title="Редактировать"></a></td>
        <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S.'delete'.S.'id'.$item['id'];?>" target="_self" title="Удалить"></a></td>
      </tr>
    <?php endforeach;?>
  </table>
    <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Добавить подписчика</a></div>

<?php
  if(isset($pagination)) {
    echo $pagination;
  }
?>

  <div class="probel">&nbsp;</div>
  <div><a class="button" href="index.php" target="_self">Экспортировать подписчиков</a></div>

  <div class="probel">&nbsp;</div>
  <h1>Почистить удалённых пользователей</h1>
  <form id="users" action="" method="post">
    <div class="cpclearusers"><input class="button" id="clearusers" name="clearusers" type="submit" value="Почистить удалённых пользователей"><span></span></div><br>
    <div class="cphelp-block form-text"><span class="red1">*</span> Помещает адреса электронной почты удалённых пользователей в чёрный список и удаляет пользователя (устанавливает статус=0 удалён)</div>
  </form>

<?php else: ?>
  <p>Подписчиков пока нет.</p><br>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Добавить подписчика</a></div>
<?php endif; ?>

<div class="probel">&nbsp;</div>
<h1>Импортировать подписчиков</h1>
<form id="subscribers" enctype="multipart/form-data" action="" method="post">
    <div class="cpsubscribers"><label for="email">Список email подписчиков (данные каждого подписчика в одной строке):<br>
    Порядок параметров (разделённых запятыми):<br><strong>email,first_name,last_name,letter_type,login,site,reg_date,login_date,birthday,gender</strong><br>
    <textarea id="emaillist" name="emaillist" cols="100" rows="10">rolar@list.ru,Артур,Абзалов,1</textarea><span></span></label></div>
    <div class="cpsubscribers"><label for="emailfile">Выбрать текстовый файл:<br><input accept="text/plain" id="emailfile" name="emailfile" title="Выберите текстовый файл на вашем компьютере" type="file"><span></span></label></div>
        <div class="probel">&nbsp;</div>
        <div class="cpsendmail"><input class="button" id="importsubscribers" name="importsubscribers" type="submit" value="Импортировать"><span></span></div>
</form>

<br>
<div class="logmessage"><?php
  if (isset($_SESSION['logmessage'])){
    echo $_SESSION['logmessage']; unset($_SESSION['logmessage']);
  }?></div>

<div class="center"><a class="button" href="<?=ADMIN;?>" target="_self" title="Вернуться на главную страницу">Вернуться на главную страницу</a></div>
