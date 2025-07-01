<?php $this->pageTitle='Список категорий купонов скидки' ?><?

$this->menu=array(
	array('label'=>'Новая категория', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
        array('label'=>'Список купонов', 'url'=>array('cupon/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cupon-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Категории купонов скидок</h3>

<h1>Список категорий купонов скидок</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cupon-category-grid',
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
				'headerHtmlOptions'=>array('width'=>'440'),
			),
			
			 array(
				'name'=>'createDate',
				'value'=>'date (\'j.m.Y\',$data->createDate)',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
					array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>