<?php $this->pageTitle='Просмотр системного письма' ?><?

$this->menu=array(
	array('label'=>'Список писем', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Изменить письмо', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
);
?>

<div class="wrap">

<h3>Системные письма</h3>

<h1>Просмотр письма #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'description',
		'lon' => array (
			'label' => 'Включено',
			'value' => Lookup::item ('Visible',$model->lon),
		),
		'type',
		
		'space' => array ('label' => '&nbsp;', 'value' => ' '),		
		'subject',
		'message' => array (
			'label' => 'Текст письма',
			'type' => 'raw',
			'value' => nl2br ($model->message),
		),

	),
)); ?>

</div>
