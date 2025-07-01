<?php $this->pageTitle='Изменение срока оплаты Закрытой Зоны' ?><?php

$this->menu=array(
	array('label'=>'Список сроков', 'url'=>array('index',array ('a' => $model->area_id)), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить срок', 'url'=>array('create',array ('a' => $model->area_id)), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр срока', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Сроки оплаты Закрытой Зоны</h3>

<h1>Изменение срока оплаты Закрытой Зоны <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>