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

if (!empty($banners)):
  // debug($banners); ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Создать баннер</a></div>
  <table class="admin_panel">
    <tr>
      <th>№</th>
      <th>Название баннера</th>
      <th>Адрес ссылки</th>
      <th>Просмотры</th>
      <th>Переходы</th>
      <th class="cpth" id="edit" title="Редактировать"></th>
      <th class="cpth" id="delete" title="Удалить"></th>
    </tr>
    <?php foreach($banners as $item): ?>
      <tr<?php $item['published'] == 0 ? $published = " class='cpnopublished'" : $published = ''; echo $published;?>>
        <td><?=$item['id'];?></td>
        <td class="text"><a class="links" href="<?=D.S.'ba'.$item['id'];?>" target="_blank" title="Перейти через redirect"><?=$item['title'];?></a>
        <?=$item['code'];?>
        </td>
        <td class="text"><a class="links" href="<?=$item['link'];?>" target="_blank" title="Перейти напрямую"><?=$item['link'];?></a></td>
        <td><?=$item['view'];?></td>
        <td><?=$item['click'];?></td>
        <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S;?>edit/<?=$item['id'];?>" target="_self" title="Редактировать"></a></td>
        <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S;?>delete/<?=$item['id'];?>" target="_self" title="Удалить"></a></td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else: ?>
  <p>Баннеров пока нет.</p><br>
<?php endif; ?>
<div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Создать баннер</a></div>
<?php
if (isset($pagination)) {
  echo $pagination;
}
?>