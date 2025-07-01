<?php $this->pageTitle='Просмотр рекламного материала' ?><?php
$this->menu=array(
	array('label'=>'Список баннеров', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить баннер', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить баннер', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить баннер', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Рекламные материалы</h3>

<h1>Просмотр баннера #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'good_id',
		'title',
		'code',
		'adcategory_id' => array (
                    'label' => 'Категория',
                    'value' => AdCategory::item ($model->adcategory_id),
                ),
                'position',
                'showcode' => array (
                    'label' => 'Поле с кодом',
                    'value' => Lookup::item ('Visible',$model->showcode),
                ),

	),
)); ?>

</div>
