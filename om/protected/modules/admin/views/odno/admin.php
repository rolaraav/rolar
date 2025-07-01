<?php $this->pageTitle='Список одностраничников' ?><?

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

<h3>Одностраничники</h3>


<h1>Управление одностраничниками</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'odno-grid',
        'selectableRows' => false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'good_id',
		'title',				
			 array(
				'name'=>'price',
				'value'=>'$data->price.$data->currency',
                                'filter' =>'',
				'headerHtmlOptions'=>array('width'=>'80'),
			),			
		'visible' => array (
                    'name' => 'visible',
                    'value'=>'Lookup::item("Visible",$data->visible)',
                    'filter'=>Lookup::items('Visible'),                    
                ),
                array (
                    'header' => 'Ссылка',
                    'value' => 'Y::bu()."i/".$data->good_id',
                    'headerHtmlOptions'=>array('width'=>'250'),
                ),
		array(
			'class'=>'CButtonColumn',
                        'viewButtonUrl' => 'Y::bu()."i/".$data->good_id',
                        'viewButtonOptions' => array ('target' => '_blank'),
		),
	),
)); ?>
