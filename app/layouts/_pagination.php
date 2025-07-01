<?php defined('A') or die('Access denied');?>
<!-- Постраничная навигация (начало) -->
<?php $sel = ' selected="selected"';
/* Блок для выбора количества заметок на странице onchange='window.location.reload(false);'  onchange='num_change.call(this)*/
?>
<div class="paginal_navigation">
<div class="center">
<form action="" id="num_change" method="post" target="_top">
  <div class="num_select" id="num_change">Отображать
  <select id="changeShow" name="num" target="_self" title="Выберите количество записей на странице">
    <option disabled="disabled" value="7">Выберите количество записей</option>
    <option value="7" <?php if ($quantity_posts == 7) {echo $sel;} ?>>7 записей на странице</option>
    <option value="15" <?php if ($quantity_posts == 15) {echo $sel;} ?>>15 записей на странице</option>
    <option value="30" <?php if ($quantity_posts == 30) {echo $sel;} ?>>30 записей на странице</option>
    <option value="50" <?php if ($quantity_posts == 50) {echo $sel;} ?>>50 записей на странице</option>
    <option value="100" <?php if ($quantity_posts == 100) {echo $sel;} ?>>100 записей на странице</option>
    <option value="999" <?php if ($quantity_posts > 100) {echo $sel;} ?>>все записи на странице</option>
  </select>
  <input class="button" id="num_change_submit_button" name="num_change" type="submit" value="Выбрать">
  </div>
</form>
</div>
<div class="clearfix"></div>
<?php if(isset($pagination)): ?>
<ul class="pstrnav pagination justify-content-center">

<?php if(!empty($pagination['first_page'])):?>
  <li class="first_page page-item"><a class="page-link" href="<?=D.$uri;?>page=<?=$pagination['first_page'];?>" title="Первая страница">&laquo;</a></li>
<?php endif;?>

<?php if(!empty($pagination['previous_page'])):?>
  <li class="previous_page page-item"><a class="page-link" href="<?=D.$uri;?>page=<?=$pagination['previous_page'];?>" title="Предыдущая страница">&lt;</a></li>
<?php endif;?>

<?php if(!empty($pagination['previous_pages'])):?>
<? foreach($pagination['previous_pages'] as $i):?>
  <li class="previous_pages page-item"><a class="page-link" href="<?=D.$uri;?>page=<?=$i;?>" title="Страница <?=$i;?>"><?=$i;?></a></li>
<? endforeach;?>
<?php endif;?>

<?php if(!empty($pagination['current_page'])):?>
  <li class="current_page page-item active"><a class="page-link" href="<?=D.$uri;?>page=<?=$pagination['current_page'];?>" title="Текущая страница <?=$pagination['current_page'];?>"><?=$pagination['current_page'];?><span class="sr-only">(Текущая страница <?=$pagination['current_page'];?>)</span></a></li>
<?php endif;?>

<?php if(!empty($pagination['next_pages'])):?>
<? foreach($pagination['next_pages'] as $i):?>
  <li class="next_pages page-item"><a class="page-link" href="<?=D.$uri;?>page=<?=$i;?>" title="Страница <?=$i;?>"><?=$i;?></a></li>
<? endforeach;?>
<?php endif;?>

<?php if(!empty($pagination['next_page'])):?>
  <li class="nest_page page-item"><a class="page-link" href="<?=D.$uri;?>page=<?=$pagination['next_page'];?>" title="Следующая страница">&gt;</a></li>
<?php endif;?>

<?php if(!empty($pagination['last_page'])):?>
  <li class="last_page page-item"><a class="page-link" href="<?=D.$uri;?>page=<?=$pagination['last_page'];?>" title="Последняя страница">&raquo;</a></li>
<?php endif;?>

</ul>
<?php endif;?>
</div>
<!-- Постраничная навигация (конец) -->