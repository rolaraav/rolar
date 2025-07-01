<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php
if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
}

if (!empty($users)):
  // print_array($users); ?>
<?php
if (isset($pagination)) {
  echo $pagination;
}
?>
    <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Добавить пользователя</a></div>
  <table class="admin_panel">
    <tr>
      <th>№</th>
      <th>Имя пользователя</th>
      <th>Логин</th>
      <th>Email</th>
      <th>Статус</th>
      <th class="cpth" id="view" title="Просмотреть на сайте"></th>
      <th class="cpth" id="view" title="Просмотреть в админке"></th>
      <th class="cpth" id="edit" title="Редактировать"></th>
      <th class="cpth" id="delete" title="Удалить"></th>
    </tr>
    <?php foreach($users as $item): ?>
      <tr<?php $item['activation'] == 0 ? $activation = ' class="cpnoactivation"' : $activation = ''; echo $activation;?>>
        <td><?=$item['id'];?></td>
        <td class="text"><?=$item['first_name'];?></td>
        <td class="text"><?=$item['login'];?></td>
        <td class="text"><a href="maito:<?=$item['email'];?>" target="_blank"><?=$item['email'];?></a></td>
        <?php
        switch($item['status']){
          case(0):
            $item['view_status'] = 'удалён';
            break;
          case(1):
            $item['view_status'] = 'заблокирован';
            break;
          case(2):
            $item['view_status'] = 'подписчик';
            break;
          case(3):
            $item['view_status'] = 'обычный';
            break;
          case(4):
            $item['view_status'] = 'модератор';
            break;
          case(5):
            $item['view_status'] = 'администратор';
            break;
          default:
            $item['view_status'] = 'обычный';
        }
        ?>
        <td class="text"><?=$item['view_status'];?></td>
        <td class="cpimg"><a class="view" href="<?=D.S.'user'.$item['id'];?>" target="_blank" title="Просмотреть на сайте"></a></td>
        <td class="cpimg"><a class="view" href="<?=ADMIN.S.$this->alias.S.'view'.S.$item['id'];?>" target="_self" title="Просмотреть в админке"></a></td>
        <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S.'edit'.S.$item['id'];?>" target="_self" title="Редактировать"></a></td>
        <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S.'delete'.S.$item['id'];?>" target="_self" title="Удалить"></a></td>
      </tr>
    <?php endforeach;?>
  </table>
    <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Добавить пользователя</a></div>

<?php
  if(isset($pagination)) {
    echo $pagination;
  }
  ?>

    <div class="form-label">
    <h1>Изменить пароли пользователей</h1>
    <form id="users" action="" method="post">
        <div class="cpchange_passwords"><input class="button" id="change_passwords" name="change_passwords" type="submit" value="Изменить пароли пользователей"><span></span></div><br>
        <div class="cphelp-block form-text"><span class="red1">*</span> Изменяет старые хеши паролей пользователей на новые (по новому алгоритму шифрования).</div><br>
    </form>
    </div>

  <div class="probel">&nbsp;</div>

  <div class="form-label">
  <h1>Почистить удалённых пользователей</h1>
  <form id="users" action="" method="post">
    <div class="cpclear_users"><input class="button" id="clear_users" name="clear_users" type="submit" value="Почистить удалённых пользователей"><span></span></div><br>
    <div class="cphelp-block form-text"><span class="red1">*</span> Помещает адреса электронной почты удалённых пользователей в чёрный список и удаляет пользователя (устанавливает статус=0 удалён)</div><br>
  </form>
  <br>
  <div class="logmessage"><?php
    if (isset($_SESSION['logmessage'])){
      echo $_SESSION['logmessage']; unset($_SESSION['logmessage']);
    }?></div>
  </div>

<?php else: ?>
  <div>Пользователей пока нет.</div><br>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Добавить пользователя</a></div>
<?php endif; ?>

