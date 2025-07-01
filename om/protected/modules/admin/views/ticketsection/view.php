<?php $this->pageTitle='Просмотр отдела поддержки' ?><?

$this->menu=array(
	array('label'=>'Список отделов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Создать отдел', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить отдел', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить отдел', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Отделы поддержки</h3>

<h1>Просмотр отдела поддержки &quot;<?php echo CHtml::encode($model->title); ?>&quot;</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'default_staff_id' => array (
                    'label' => 'Оператор поддержки',
                    'value' => Staff::item ($model->default_staff_id),
                ),
		'position',
	),
)); ?>

</div>
