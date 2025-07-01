<?php defined('A') or die('Access denied');?>
<nav class="breadcrumb" aria-label="breadcrumb">
<a class="breadcrumb-item" href="<?=D.S;?>" title="Главная">Главная</a>
<?php if(isset($breadcrumbs_array)): ?>
  <?php $elements = count($breadcrumbs_array); // определяем количество элементов в массиве
  //debug($elements);
  $i = 1;
  foreach($breadcrumbs_array as $alias => $title): ?>
    <a class="breadcrumb-item<?php if ($i == $elements) {echo ' active';} ?>" href="<?=D.S.$alias;?>" title="<?=$title;?>"><?=$title;?></a>
  <?php $i = $i+1;
  endforeach; ?>
<?php endif; ?>
</nav>