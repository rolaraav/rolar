<?php defined('A') or die('Access denied'); ?>
<div class="block">
<div class="blockhead"></div>
<div class="blockbody">
<?php if(isset($breadcrumbs)){
  echo $breadcrumbs;
}
?>
<h1><?php if(isset($title)){echo $title;} ?></h1>
<?php
  if(is_array($users)):
    echo '<table class="userlist" cellpadding="5px" cellspacing="0px">
      <tr>
        <th>№</th>
        <th>Аватар</th>
        <th>Логин</th>
        <th>Имя/фамилия</th>
      </tr>
    ';
    foreach($users as $item): ?>
        <tr>
            <td><?=$item['id'];?></td>
            <td><a href="user<?=$item['id'];?>" target="_top" title="<?=$item['first_name'];?>"><img alt="<?=$item['first_name'];?>" class="avatarimage" src="<?=$item['avatar'];?>" title="<?=$item["first_name"];?>"></a></td>
            <td><a href="user<?=$item['id'];?>" target="_top" title="<?=$item['first_name'];?>"><?=$item['login'];?></a></td>
            <td><?=$item['first_name'];?></td>
        </tr>
    <?php endforeach;
    echo '</table>';
  else: echo '<div>Информация по запросу не найдена, т.к. в таблице нет записей.</div>';
  endif; ?>
    <div class="help-block"><span class="red1">*</span> Пользователи сортируются по их ID.</div>
    <br><div class="userlinks"><a href="<?=D.S;?>user<?=$user['id'];?>">Моя страница</a> |
        <a href="<?=D.S;?>users">Список пользователей</a> |
        <a href="<?=D.S;?>exit">Выход</a></div>

<div class="clear"></div>
</div>
</div>