<?php $this->pageTitle='Добавление категории' ?><?php

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Категории товаров</h3>

<h1>Добавить категорию</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>