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

if (!empty($links)):
  // debug($links); ?>
  <div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Создать ссылку</a></div>
  <table class="admin_panel">
    <tr>
      <th>№</th>
      <th>Название ссылки</th>
      <th>Адрес ссылки</th>
      <th>Переходы</th>
      <th class="cpth" id="edit" title="Редактировать"></th>
      <th class="cpth" id="delete" title="Удалить"></th>
    </tr>
    <?php foreach($links as $item): ?>
      <tr<?php $item['published'] == 0 ? $published = " class='cpnopublished'" : $published = ''; echo $published;?>>
        <td><?=$item['id'];?></td>
          <td class="text<?php $item['secret'] == 1 ? $secret = ' cpsecret' : $secret = ''; echo $secret;?>"><a class="links" href="<?=D.S.'l'.$item['id'];?>" target="_blank" title="Перейти через redirect"><?=$item['title'];?></a></td>
          <td class="text<?php $item['ref'] == 1 ? $referal = ' green1' : $referal = ''; echo $referal;?>"><a class="links" href="<?=$item['link'];?>" target="_blank" title="Перейти напрямую"><?=$item['link'];?></a></td>
        <td><?=$item['transitions'];?></td>
        <td class="cpimg"><a class="edit" href="<?=ADMIN.S.$this->alias.S;?>edit/<?=$item['id'];?>" target="_self" title="Редактировать"></a></td>
        <td class="cpimg"><a class="delete" href="<?=ADMIN.S.$this->alias.S;?>delete/<?=$item['id'];?>" target="_self" title="Удалить"></a></td>
      </tr>
    <?php endforeach;?>
  </table>
<?php else: ?>
  <p>Ссылок пока нет.</p><br>
<?php endif; ?>
<div><a class="button" href="<?=ADMIN.S.$this->alias.S.'create';?>" target="_self">Создать ссылку</a></div>
<?php
if(isset($pagination)) {
  echo $pagination;
}
?>