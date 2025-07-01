<?php $this->pageTitle='Изменение оператора' ?><?php
$this->breadcrumbs=array(
	'Staffs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список операторов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить оператора', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр оператора', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),							
	array('label'=>'Права доступа', 'url'=>array('staffaccess/index', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_access'),'visible'=> ($model->id!=1) ),    							
);
?>

<div class="wrap">

<h3>Операторы</h3>

<h1>Изменение оператора &quot;<?php echo $model->username; ?>&quot;</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>