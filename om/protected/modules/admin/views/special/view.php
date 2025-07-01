<?php $this->pageTitle='Просмотр скидки' ?><?

$this->menu=array(
	array('label'=>'Список скидок', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить скидку', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить скидку', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить скидку', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить эту запись?'),
	    'itemOptions' => array ('class' => 'rmenu_del')
    ),
    		
);
?>

<div class="wrap">

<h3>Специальные скидки</h3>

<h1>Просмотр скидки №<?=$model->id?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'good_id',
		'newgood_id',
		'sum' => array (
                    'name' => 'sum',
                    'value' => $model->sum.H::valuta ($model->valuta),
                )
	),
)); ?>

</div>