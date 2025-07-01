<?php $this->pageTitle='Просмотр специальной комиссии партнёра' ?><?

$this->menu=array(
	array('label'=>'Список записей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить запись', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить запись', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить запись', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Особые комиссии партнёра</h3>

<h1>Просмотр персональной комисии #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'partner_id',
		'good_id',
		'komis',
		'komis_type_id' => array (
                    'label' => 'Тип комиссии',
                    'value' => Lookup::item('KomisType',$model->komis_type_id),
                ),
		'auto' => array (
                    'label' => 'Добавлено автоматом?',
                    'value' => Lookup::item('Visible',$model->auto),
                ),
	),
)); ?>

</div>
