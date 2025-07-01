<?php $this->pageTitle='Просмотр варианта оплаты' ?><?

$this->menu=array(
	array('label'=>'Список вариантов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить вариант', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить вариант', 'url'=>array('update', 'id'=>$model->plist_id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить вариант', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->plist_id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Варианты оплаты</h3>

<h1>Просмотр варианта #<?php echo $model->plist_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'plist_id',
		'title',
                'category',
		'url',
		'ways',		
		'position',
		'pic' => array (
                    'label' => 'Картинка',
                    'type' => 'raw',
                    'value' => 'images/ways/'.$model->pic.'.gif',
                ),            
	),
)); ?>

<p align="center"><br> <?=CHtml::image (Y::bu().'images/ways/'.$model->pic.'.gif','',array('style' => 'vertical-align:top')); ?></p>

</div>
