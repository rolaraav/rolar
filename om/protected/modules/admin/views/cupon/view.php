<?php $this->pageTitle='Просмотр купона скидки' ?><?

$this->menu=array(
	array('label'=>'Список купонов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить купон', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить купон', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить купон', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Купоны скидки</h3>

<h1>Просмотр купона скидки #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
                'code',
                'category_id',
                'good_id',		
                'title',
		'sum',            
		'kind_id' => array (
                    'label' => 'Тип скидки',
                    'value' => Lookup::item ('CuponKind',$model->kind_id),
                ),
		'startDate' => array (
                    'label' => 'Дата старта',
                    'value' => H::date ($model->startDate),                    
                ),
		'stopDate' => array (
                    'label' => 'Дата окончания',
                    'value' => H::date ($model->stopDate),                    
                ),
		'komis' => array (
                    'label' => 'Комиссионные',
                    'value' => Lookup::item ('CuponKomis',$model->komis),
                    
                ),		
		
		'selfDelete' => array (
                    'label' => 'Удалять после оплаты',
                    'value' => Lookup::item ('Visible',$model->selfDelete),
                ),
                'client_good_id',
	),
)); ?>

</div>
