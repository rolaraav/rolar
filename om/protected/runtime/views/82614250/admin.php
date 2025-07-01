<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\category\admin.php */ ?>
<?php $this->pageTitle='Список категорий' ?><?php

$this->menu=array(
	array('label'=>'Создать категорию', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h1>Категории товаров</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'category-grid',
	'dataProvider'=>$model->search(),
	'selectableRows' => false,
	'htmlOptions' => array('style' => 'width:680px'),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'id',
			'value'=>'$data->id',
			'headerHtmlOptions'=>array('width'=>'40'),
		),
		array(
			'name'=>'title',
			'value'=>'$data->title',			
		),
		array(
			'name'=>'visible',
			'value'=>'Lookup::item("Visible",$data->visible)',
			'filter'=>Lookup::items('Visible'),
			'headerHtmlOptions' => array ('width' => '80'),
		),
		array(
			'name'=>'position',
			'value'=>'$data->position',
			'headerHtmlOptions' => array ('width' => '30'),
		),
		array(
			'class'=>'CButtonColumn',			
			'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>