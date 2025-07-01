<?php $this->pageTitle='Добавление новости для партнёра' ?><?php
$this->menu=array(
	array('label'=>'Список новостей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Новости для партнёров</h3>

<h1>Добавление новости для партнёров</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>