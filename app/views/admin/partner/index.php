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

  if (!empty($partners)):
  // debug($partners); ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Добавить партнёра</a></div>
  <table class="admin_panel">
    <tr>
      <th>№</th>
      <th>Имя партнёра</th>
      <th class="cpth" id="view" title="Просмотреть"></th>
      <th class="cpth" id="edit" title="Редактировать"></th>
      <th class="cpth" id="delete" title="Удалить"></th>
    </tr>
    <?php foreach($partners as $item): ?>
      <tr<?php $item['published'] == 0 ? $published = ' class="cpnopublished"' : $published = ''; echo $published;?>>
        <td><?=$item['id'];?></td>
        <td class="text"><?=$item['title'];?></td>
        <td class="cpimg"><a class="view" href="<?=D.S;?>partner_products?partner=<?=$item['id'];?>" target="_blank" title="Просмотреть на сайте"></a></td>
        <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S.'edit'.S.$item['id'];?>" target="_self" title="Редактировать"></a></td>
        <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S.'delete'.S.$item['id'];?>" target="_self" title="Удалить"></a></td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else: ?>
  <p>Партнёров пока нет.</p><br>
<?php endif; ?>
<div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Добавить партнёра</a></div>
<?php
if(isset($pagination)) {
  echo $pagination;
}
?>