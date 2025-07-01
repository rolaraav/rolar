<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php
if(isset($pagination)) {
  echo $pagination;
}

if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
}

if (!empty($posts)):
// debug($posts); ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create'.$type_string_for_url;?>" target="_self"><?=$button_name;?></a></div>
  <table class="admin_panel">
      <tr>
          <th>№</th>
          <th><?=$column_title;?></th>
          <th class="cpth" id="view" title="Просмотреть"></th>
          <th class="cpth" id="edit" title="Редактировать"></th>
          <th class="cpth" id="delete" title="Удалить"></th>
      </tr>
    <?php foreach($posts as $item): ?>
        <tr<?php $item['published'] == 0 ? $published = ' class="cpnopublished"' : $published = ''; echo $published;?>>
            <td><?=$item['id'];?></td>
            <td class="text<?php if (isset($item['secret'])) {$item['secret'] == 1 ? $secret = ' cpsecret' : $secret = '';} else {$secret = '';} echo $secret;?><?php $item['hidden'] == 1 ? $hidden = ' cphidden' : $hidden = ''; echo $hidden;?>"><?=$item['title'];?></td>
            <td class="cpimg"><a class="view" href="<?=D.S.$this->alias.$item['id'];?>" target="_blank" title="Просмотреть на сайте"></a></td>
            <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S.'edit'.S.$item['id'].$type_string_for_url;?>" target="_self" title="Редактировать"></a></td>
            <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S.'delete'.S.$item['id'].$type_string_for_url;?>" target="_self" title="Удалить"></a></td>
        </tr>
    <?php endforeach;?>
  </table>
<?php else: ?>
  <p><?php if(isset($ifempty)) {echo $ifempty;} ?></p><br>
<?php endif; ?>
  <?php if (isset($type_string_for_url)): ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create'.$type_string_for_url;?>" target="_self"><?=$button_name;?></a></div>
  <!-- <div class='cplinks'><a href='index.php?p=news&a=create'>Создать</a> | <a href='index.php?p=news&a=edit'>Редактировать</a> | <a href='index.php?p=news&a=delete'>Удалить</a></div> -->
  <?php endif; ?>
<?php
if(isset($pagination)) {
  echo $pagination;
}
?>