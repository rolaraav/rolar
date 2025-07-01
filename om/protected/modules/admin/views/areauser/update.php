<?php $this->pageTitle='Изменение участника закрытой зоны' ?><?php

$this->menu=array(
	array('label'=>'Список участников', 'url'=>array('index','a' => $model->area_id), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Просмотр участника', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Участники Закрытой Зоны</h3>

<h1>Изменение участника закрытой зоны - <?php echo $model->username; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>