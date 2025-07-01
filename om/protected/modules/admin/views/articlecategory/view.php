<?php $this->pageTitle='Просмотр категорий статей' ?><?

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая категория', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить категорию', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить категорию', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Категории статей Базы Знаний</h3>

<h1>Просмотр категории №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'description',
		'position',
                array (
                    'label' => 'Ссылка на категорию',
                    'type' => 'raw',
                    'value' => CHtml::link (Yii::app()->getBaseUrl(TRUE).'/support/base/category/'.$model->id,array ('/support/base/category/'.$model->id), array ('target' => '_blank')),
                )
            
	),
)); ?>

</div>
