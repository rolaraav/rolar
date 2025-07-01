<?php $this->pageTitle='Изменение автора' ?><?php

$this->menu=array(
	array('label'=>'Список авторов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить автора', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр автора', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Авторы</h3>

<h1>Изменение автора <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>