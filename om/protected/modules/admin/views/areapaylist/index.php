<?php $this->pageTitle='Список сроков оплаты Закрытой Зоны' ?><?

$this->menu=array(
	array('label'=>'Добавить срок', 'url'=>array('create','a' => $model->area_id), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('area-paylist-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Сроки оплаты Закрытой Зоны</h3>

<h1>Список сроков оплаты Закрытой Зоны №<?=$model->area_id?></h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-paylist-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(

			 array(
				'name'=>'id',
				'value'=>'$data->id',
				'headerHtmlOptions'=>array('width'=>'40'),
			),			
			
			 array(
				'name'=>'title',
				'value'=>'$data->title',
				'headerHtmlOptions'=>array('width'=>'340'),
			),
			
			 array(
				'name'=>'srok',
				'value'=>'$data->srok',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			 array(
				'name'=>'price',
				'value'=>'$data->price.\' р.\'',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
					array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>