<?php $this->pageTitle='Список купонов скидок' ?><?

$this->menu=array(
	array('label'=>'Добавить купон', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
        array('label'=>'Категории купонов', 'url'=>array('cuponcategory/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cupon-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Купоны скидок</h3>

<h1>Список купонов скидок</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cupon-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(

			
			 array(
				'name'=>'code',
				'value'=>'$data->code',
				'headerHtmlOptions'=>array('width'=>'60'),
			),
                        
			 array(
				'name'=>'category_id',
				'value'=>'CuponCategory::item($data->category_id)',
                                'filter'=>CuponCategory::items (),
				'headerHtmlOptions'=>array('width'=>'70'),
			),                        
                        
			 array(
				'name'=>'title',
				'value'=>'$data->title',
				'headerHtmlOptions'=>array('width'=>'150'),
			),
			
			 array(
				'name'=>'good_id',
				'value'=>'$data->good_id',
				'headerHtmlOptions'=>array('width'=>'140'),
			),                        
			
			 array(
				'name'=>'sum',
				'value'=>'$data->sum',
				'headerHtmlOptions'=>array('width'=>'70'),
			),			
			
			 array(
				'name'=>'startDate',
				'value'=>'H::date($data->startDate)',
				'headerHtmlOptions'=>array('width'=>'70'),
                                'cssClassExpression' => '$data->startDate < time()?"gooddate":"baddate"',
			),
			
			 array(
				'name'=>'stopDate',
				'value'=>'H::date($data->stopDate)',
				'headerHtmlOptions'=>array('width'=>'70'),
                                'cssClassExpression' => '$data->stopDate > time()?"gooddate":"baddate"',
			),					
			
		array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '150'),
		),
	),
)); ?>

</div>