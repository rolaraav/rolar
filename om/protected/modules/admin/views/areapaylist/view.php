<?php $this->pageTitle='Просмотр срока оплаты' ?><?

$this->menu=array(
	array('label'=>'Список сроков', 'url'=>array('index','a' => $model->area_id), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Удалить срок', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Сроки оплаты закрытой зоны</h3>

<h1>Просмотр срока #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',		
		'title',
		'srok',
                'price',
	),
)); ?>

</div>
