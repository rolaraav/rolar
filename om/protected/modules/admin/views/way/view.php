<?php $this->pageTitle='Просмотр способа оплаты' ?><?

$this->menu=array(
	array('label'=>'Список способов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить способ', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить способ', 'url'=>array('update', 'id'=>$model->way_id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить способ', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->way_id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Способы оплаты</h3>

<h1>Просмотр способа оплаты &quot;<?php echo $model->way_id; ?>&quot;</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'way_id',
		'title',
		'code' => array (
                    'label' => 'HTML-код',
                    'type' => 'raw',
                    'value' => nl2br(CHtml::encode($model->code)),
                ),
	),
)); ?>

</div>
