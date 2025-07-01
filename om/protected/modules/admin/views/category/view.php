<?php $this->pageTitle='Просмотр категории товаров' ?><?php

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Создать категорию', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить категорию', 'url'=>array('update', 'id'=>$model->id),'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить категорию', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить эту категорию?'),
	 'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Категории</h3>

<h1>Просмотр категории &quot;<?php echo $model->title; ?>&quot;</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'visible' => array (
                    'label' => 'Отображать?',
                    'value' => Lookup::item ('Visible',$model->visible),
                ),
		'position',
	),
)); ?>

</div>