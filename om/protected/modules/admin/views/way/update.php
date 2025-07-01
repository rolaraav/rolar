<?php $this->pageTitle='Изменение способа оплаты' ?><?php

$this->menu=array(
	array('label'=>'Список способов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить способ', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр способа', 'url'=>array('view', 'id'=>$model->way_id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Способы оплаты</h3>

<h1>Изменение способа оплаты <?php echo $model->way_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>