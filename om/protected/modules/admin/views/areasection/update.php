<?php $this->pageTitle='Изменение категории файлов Закрытой Зоны' ?><?php

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index','a' => $model->area_id), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая категория', 'url'=>array('create','a' => $model->area_id), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр категории', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Категории файлов Закрытой Зоны</h3>

<h1>Изменение категории №<?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>