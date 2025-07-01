<?php $this->pageTitle='Просмотр записи из чёрного списка' ?><?

$this->menu=array(
	array('label'=>'Список записей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить запись', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	
	array('label'=>'Удалить запись', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Чёрный список</h3>

<h1>Просмотр записи #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'createDate' => array (
                    'label' => 'Дата записи',
                    'value' => H::date ($model->createDate),
                ),
		'ip',
		'email',
		'phone',
		'address',
		'comment',
	),
)); ?>

</div>
