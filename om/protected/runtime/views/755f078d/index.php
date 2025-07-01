<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\waylist\index.php */ ?>
<?php $this->pageTitle='Список вариантов оплаты' ?><?

$this->menu=array(
	array('label'=>'Добавить вариант', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('way-list-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Варианты оплаты</h3>

<h1>Список вариантов оплаты</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'way-list-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(

			 array(
				'name'=>'plist_id',
				'value'=>'$data->plist_id',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'title',
				'value'=>'$data->title',
				'headerHtmlOptions'=>array('width'=>'240'),
			),			
                        
			 array(
				'name'=>'category',
				'value'=>'$data->category',
				'headerHtmlOptions'=>array('width'=>'140'),
			),                        
			
			 array(
				'name'=>'ways',
				'value'=>'$data->ways',
				'headerHtmlOptions'=>array('width'=>'140'),
			),

			 array(
				'name'=>'position',
				'value'=>'$data->position',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
		array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '82'),
		),
	),
)); ?>

</div>