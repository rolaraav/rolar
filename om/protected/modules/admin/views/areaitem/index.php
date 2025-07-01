<?php $this->pageTitle='Список файлов Закрытой зоны' ?><?

$this->menu=array(
	array('label'=>'Добавить файл', 'url'=>array('create','a'=>$area_id), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('area-item-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Файлы Закрытой Зоны</h3>

<h1>Список файлов закрытой зоны №<?=$area_id?></h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-item-grid',
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
				'name'=>'area_section_id',
				'value'=>'AreaSection::item($data->area_section_id,$data->area_id)',
                                'filter' => AreaSection::items ($data->area_id),
				'headerHtmlOptions'=>array('width'=>'140'),
			),

			 array(
				'name'=>'filename',
				'value'=>'$data->filename',
				'headerHtmlOptions'=>array('width'=>'70'),
			),			
			
			 array(
				'name'=>'title',
				'value'=>'$data->title',
				'headerHtmlOptions'=>array('width'=>'140'),
			),			

			array(
				'name'=>'uploadDate',
				'value'=>'date(\'j.m.Y\',$data->uploadDate)',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			

		array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>