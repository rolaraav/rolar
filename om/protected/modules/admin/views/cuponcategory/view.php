<?php $this->pageTitle='Просмотр категории купонов скидок' ?><?

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая категория', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить категорию', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить категорию', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить категорию и все купоны этой категории?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Категории купонов скидки</h3>

<h1>Просмотр категории купонов &quot;<?php echo CHtml::encode ($model->title); ?>&quot;</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'createDate' => array (
                    'label' => 'Дата создания',
                    'value' => date ('j.m.Y',$model->createDate),
                ),
	),
)); ?>

<br>
<p align="center"><?= CHtml::link ('Просмотреть купоны этой категории',array ('cupon/index','Cupon[category_id]'=>$model->id)); ?>

</div>
