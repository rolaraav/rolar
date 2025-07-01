<?php $this->pageTitle='Просмотр Закрытой Зоны' ?><?

$this->menu=array(
	array('label'=>'Список зон', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить зону', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить зону', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить зону', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Закрытые Зоны</h3>

<h1>Просмотр Закрытой Зоны №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'active' => array (
                    'label' => 'Активна',
                    'value' => Lookup::item ('Visible',$model->active),
                ),
                array (
                    'label' => '&nbsp;',
                    'value' => '&nbsp;',
                    'type' => 'raw',
                ),
                array (
                    'label' => '&nbsp;',
                    'type'  => 'raw',
                    'value' => CHtml::link ('Управлять пользователями Закрытой Зоны',array('areauser/index?a='.$model->id),array ('target' => '_blank')),
                ),

                array (
                    'label' => '&nbsp;',
                    'value' => '&nbsp;',
                    'type' => 'raw',
                ),
            
                array (
                    'label' => '&nbsp;',
                    'type'  => 'raw',
                    'value' => CHtml::link ('Категории файлов Закрытой Зоны',array('areasection/index?a='.$model->id),array ('target' => '_blank')),
                ),

                array (
                    'label' => '&nbsp;',
                    'type'  => 'raw',
                    'value' => CHtml::link ('Файлы Закрытой Зоны',array('areaitem/index?a='.$model->id),array ('target' => '_blank')),
                ),

                array (
                    'label' => '&nbsp;',
                    'type'  => 'raw',
                    'value' => CHtml::link ('Сроки и цены для Закрытой Зоны',array('areapaylist/index?a='.$model->id),array ('target' => '_blank')),
                ),


	),
)); ?>

</div>
