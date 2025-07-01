<?php $this->pageTitle='Список Закрытых Зон' ?><?

$this->menu=array(
	array('label'=>'Добавить зону', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('area-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Закрытые Зоны</h3>

<h1>Список Закрытых Зон</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-grid',
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
				'headerHtmlOptions'=>array('width'=>'350'),
			),
			
			 array(
				'name'=>'active',
				'value'=>'Lookup::item(\'Visible\',$data->active)',
                                'filter' => Lookup::items ('Visible'),
				'headerHtmlOptions'=>array('width'=>'40'),
			),
					array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

<br>

<p>Ссылка для входа в закрытую зону: <a href="<?=Y::bu(true)?>area/" target="_blank"><?=Y::bu()?>area/</a></p>

</div>