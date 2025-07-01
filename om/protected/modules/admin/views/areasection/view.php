<?php $this->pageTitle='Просмотр категории файлов Закрытой Зоны' ?><?

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index','a' => $model->area_id), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая категория', 'url'=>array('create','a' => $model->area_id), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить категорию', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить категорию', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Категории файлов Закрытой Зоны</h3>

<h1>Просмотр категории №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'area_id',
		'title',
		'description',
		'position',
	),
)); ?>

</div>
