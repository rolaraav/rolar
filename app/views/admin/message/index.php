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

if (!empty($messages)):
  // debug($messages); ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Создать сообщение</a></div>
  <table class="admin_panel">
    <tr>
      <th>№</th>
      <th>Текст сообщения</th>
      <th>Автор</th>
      <th>Получатель</th>
      <th class="cpth" id="edit" title="Редактировать"></th>
      <th class="cpth" id="delete" title="Удалить"></th>
    </tr>
    <?php foreach($messages as $item): ?>
      <tr<?php $item['published'] == 0 ? $published = ' class="cpnopublished"' : $published = ''; echo $published;?>>
        <td><?=$item['id'];?></td>
        <td class="text"><?=$item['text'];?></td>
        <td class="text"><?=$item['author'];?></td>
        <td class="text"><?=$item['addressee'];?></td>
        <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S.'edit'.S.$item['id'];?>" target="_self" title="Редактировать"></a></td>
        <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S.'delete'.S.$item['id'];?>" target="_self" title="Удалить"></a></td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else: ?>
  <p>Сообщений пока нет.</p><br>
<?php endif; ?>
<div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Создать сообщение</a></div>
<?php
if(isset($pagination)) {
  echo $pagination;
}
?>