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

if (!empty($categories)):
  // debug($categories); ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create'.$type_string_for_url;?>" target="_self"><?=$button_name;?></a></div>
  <table class="admin_panel">
    <tr>
      <th>№</th>
      <th><?=$column_title;?></th>
      <th class="cpth" id="view" title="Просмотреть"></th>
      <th class="cpth" id="edit" title="Редактировать"></th>
      <th class="cpth" id="delete" title="Удалить"></th>
    </tr>
    <?php foreach($categories as $item): ?>
      <tr>
        <td><?=$item['id'];?></td>
        <td class="text"><?=$item['title'];?></td>
        <td class="cpimg"><a class="view" href="<?=D.S.'cat'.$item['id'];?>" target="_blank" title="Просмотреть на сайте"></a></td>
        <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S.'edit/id'.$item['id'].$type_string_for_url;?>" target="_self" title="Редактировать"></a></td>
        <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S.'delete/id'.$item['id'].$type_string_for_url;?>" target="_self" title="Удалить"></a></td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else: ?>
  <p><?=$ifempty;?></p><br>
<?php endif; ?>
<div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create'.$type_string_for_url;?>" target="_self"><?=$button_name;?></a></div>
<?php
if(isset($pagination)) {
  echo $pagination;
}
?>