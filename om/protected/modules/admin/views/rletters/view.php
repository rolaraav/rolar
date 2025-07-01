<?php $this->pageTitle='Просмотр письма' ?><?

$this->menu=array(
	array('label'=>'Список писем', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),	
	array('label'=>'Изменить письмо', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить письмо', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Письма рассылки</h3>

<h1>Просмотр письма #<?php echo $model->id; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'rass_id' => array (
                    'name' => 'rass_id',
                    'value' => Rass::item ($model->rass_id),
                ),
		'title',		
		'hours',
		'comment',
                'content' => array (
                    'name' => 'contents',
                    'type' => 'raw',
                    'value' => nl2br ($model->content),
                ),
            
	),
)); ?>
