<?php $this->pageTitle='Изменение автоустановки комиссии' ?><?php

$this->menu=array(
	array('label'=>'Список записей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить запись', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр записи', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Автоустановки комиссий</h3>

<h1>Изменение автоустановки №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>