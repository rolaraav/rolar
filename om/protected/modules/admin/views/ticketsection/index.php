<?php $this->pageTitle='Список отделов поддержки' ?><?

$this->menu=array(
	array('label'=>'Создать отдел', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
        array('label'=>'Поддержка', 'url'=>array('support/index'), 'itemOptions' => array ('class' => 'rmenu_view')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ticket-section-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Отделы поддержки</h3>

<h1>Список отделов поддержки</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ticket-section-grid',
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
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'default_staff_id',
                                'value'=>'Staff::item($data->default_staff_id)',
				'filter'=>Staff::items(),
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'position',
				'value'=>'$data->position',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
					array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>