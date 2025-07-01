<?php $this->pageTitle='Изменение варианта оплаты' ?><?php

$this->menu=array(
	array('label'=>'Список вариантов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить вариант', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр варианта', 'url'=>array('view', 'id'=>$model->plist_id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Варианты оплаты</h3>

<h1>Изменение варианта оплаты <?php echo $model->plist_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>