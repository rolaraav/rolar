<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\author\views\good\index.php */ ?>
<?

$this->pageTitle='Список товаров';

/*
$this->menu=array(
	array('label'=>'Добавить товар', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),        
        array('label'=>'PIN-коды', 'url'=>array('pincat/index'), 'itemOptions' => array ('class' => 'rmenu_list')),        
        array('label'=>'Скидки апселл', 'url'=>array('special/index'), 'itemOptions' => array ('class' => 'rmenu_access')),                
); */

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('good-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Панель автора</h3>

<h1>Список товаров</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<p><br><?= CHtml::link ('Показать отключённые товары',array('good/index/used/0')); ?></p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'good-grid',
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
				'name'=>'category_id',
				'value'=>'Category::item($data->category_id)',
                                'filter'=> Category::items (),
				'headerHtmlOptions'=>array('width'=>'60'),
			),
			
			 array(
				'name'=>'title',
				'value'=>'$data->title',
				'headerHtmlOptions'=>array('width'=>'140'),
			),			
			
			 array(
				'name'=>'price',
				'value'=>'$data->price.H::valuta($data->currency)',
                                'filter' =>'',
				'headerHtmlOptions'=>array('width'=>'40'),
			),			
			
			 array(
				'name'=>'kind',
				'value'=>'Lookup::item(\'GoodKind\',$data->kind)',
                                'filter' => Lookup::items ('GoodKind'),
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
		/*			
		array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		), */
	),
)); ?>

</div>