<?php $this->pageTitle='Просмотр новости для партнёра' ?><?

$this->menu=array(
	array('label'=>'Список новостей', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить новость', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить новость', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить новость', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Новости для партнёров</h3>

<h1>Просмотр новости #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',		
		'createTime' => array (
                    'label' => 'Время создания',
                    'value' => date ('j.m.Y H:i',$model->createTime),
                ),
	),
)); ?>

<br>
<p><?= nl2br (CHtml::encode ($model->content)); ?></p>

</div>
