<?php $this->pageTitle='Просмотр страницы' ?><?

$this->menu=array(
	array('label'=>'Список страниц', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),	
	array('label'=>'Изменить страницу', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить страницу', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Странички</h3>

<h1>Просмотр странички <?php echo $model->psevdo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'psevdo' => array (
                    'name' => 'psevdo',
                    'type' => 'raw',
                    'value' => CHtml::link ($model->psevdo,array ('/page/'.$model->psevdo), array ('target' => '_blank')),
                ),
                'visible' => array ('label' => 'Отображать?', 'value' => Lookup::item ('Visible',$model->visible)),
		'title',		
            	'content',
	),
)); ?>

</div>