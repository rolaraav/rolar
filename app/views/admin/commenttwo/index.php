<?php defined('A') or die('Access denied'); ?>
<h1><?php echo $title;?></h1>
<br>
<?php
if (isset($pagination)) {
  echo $pagination;
}

if (isset($_SESSION['result'])){
  echo $_SESSION['result'].'<br>';
  unset($_SESSION['result']);
}

if (!empty($commentstwo)):
  // debug($commentstwo); ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Создать комментарий 2</a></div>
  <table class="admin_panel">
    <tr>
      <th>№</th>
      <th>Текст комментария</th>
      <th>Автор</th>
      <th class="cpth" id="edit" title="Редактировать"></th>
      <th class="cpth" id="delete" title="Удалить"></th>
    </tr>
    <?php foreach($commentstwo as $item): ?>
      <tr<?php $item['published'] == 0 ? $published = ' class="cpnopublished"' : $published = ''; echo $published;?>>
        <td><?=$item['id'];?></td>
        <td class="text"><?=$item['text'];?></td>
        <td class="text"><?=$item['author'];?></td>
        <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S.'edit/id'.$item['id'];?>" target="_self" title="Редактировать"></a></td>
        <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S.'delete/id'.$item['id'];?>" target="_self" title="Удалить"></a></td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else: ?>
  <p>Комментариев 2 пока нет.</p><br>
<?php endif; ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Создать комментарий 2</a></div>
<?php
if (isset($pagination)) {
  echo $pagination;
}
?>
