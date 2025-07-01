<?php defined('A') or die('Access denied');?>
<!-- Шапка (начало) -->
<header class="header">
  <div class="logotip"><a href="<?=D;?>" target="_self"></a></div>
  <div class="slogan">Может ли одна идея изменить мир?</div>
<?php if ($this->alias != 'search'): ?>
  <div class="search_form_head">
<?php if(isset($search_form)) {
  echo $search_form; // поисковая форма
}?>
  </div>
<?php endif;?>
<div class="clear"></div>
</header><!-- Шапка (конец) -->