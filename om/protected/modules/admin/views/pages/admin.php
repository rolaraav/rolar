<?php $this->pageTitle='Список страничек' ?><?

$this->menu=array(
	array('label'=>'Новая страница', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),        
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#page-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Странички</h3>


<h1>Управление страничками</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'page-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'psevdo',
		'title',		
			 array(
				'name'=>'visible',
				'value'=>'($data->visible)?"да":"нет"',
				'headerHtmlOptions'=>array('width'=>'30'),
			),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

</div>