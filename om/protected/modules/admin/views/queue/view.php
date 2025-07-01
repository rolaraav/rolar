<?php

$this->menu=array(
	array('label'=>'Показать очередь', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Удалить задание', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Удалить?'), 'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">
    
    <h3>Очередь писем</h3>

<h1>Просмотр письма из очереди #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'format',
		'subject',		
		'priority',
	),
)); ?>

<p><br><b>Текст письма:</b></p>

<p><br><?=nl2br (htmlspecialchars($model->body)); ?></p>

</wrap>