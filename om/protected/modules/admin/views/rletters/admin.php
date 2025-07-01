<?php $this->pageTitle='Список писем рассылки' ?><?

$this->menu=array(
	array('label'=>'Список рассылок', 'url'=>array('maillist/index'), 'itemOptions' => array ('class' => 'rmenu_list')),        
        array('label'=>'Добавить письмо', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rass-letter-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Письма из серии</h3>


<h1>Управление письмами</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rass-letter-grid',
	'dataProvider'=>$model->search(),
        'selectableRows' => false,
	'filter'=>$model,
	'columns'=>array(
		'id',
		'rass_id' => array (
                    'name' => 'rass_id',
                    'value' => 'Rass::item ($data->rass_id)',
                    'filter' => Rass::items (),
                ),
		'comment',
		'hours',		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
