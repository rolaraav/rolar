<?php $this->pageTitle='Изменение категории пин-кодов' ?><?php

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая категория', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Категории пин-кодов</h3>

<h1>Изменение категории пин-кодов <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>