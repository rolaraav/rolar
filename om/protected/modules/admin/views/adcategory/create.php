<?php $this->pageTitle='Добавление категории рекламных материалов' ?><?php
$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Категории рекламных материалов</h3>

<h1>Добавление категории рекламных материалов</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>