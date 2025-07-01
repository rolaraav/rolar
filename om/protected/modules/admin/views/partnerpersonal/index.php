<?php $this->pageTitle='Список особых комиссий' ?><?

$this->menu=array(
	array('label'=>'Добавить запись', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('partner-personal-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Особые комиссии партнёра</h3>

<h1>Список особых комиссий партнёра</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'partner-personal-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(

			 array(
				'name'=>'id',
				'value'=>'$data->id',
				'headerHtmlOptions'=>array('width'=>'20'),
			),
			
			 array(
				'name'=>'partner_id',
				'value'=>'$data->partner_id',
				'headerHtmlOptions'=>array('width'=>'70'),
			),
			
			 array(
				'name'=>'good_id',
				'value'=>'$data->good_id',
				'headerHtmlOptions'=>array('width'=>'120'),
			),
			
			 array(
				'name'=>'komis',
				'value'=>'$data->komis.(($data->komis_type_id=="fixed")?" (в валюте)":"%")',
				'headerHtmlOptions'=>array('width'=>'60'),
			),			
			
			 array(
				'name'=>'auto',
				'value'=>'Lookup::item("Visible",$data->auto)',
                                'filter' => Lookup::items ('Visible'),
				'headerHtmlOptions'=>array('width'=>'70'),
			),
					array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>