<?php $this->pageTitle='Чёрный список' ?><?

$this->menu=array(
	array('label'=>'Добавить запись', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('black-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Чёрный список</h3>

<h1>Чёрный список</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'black-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(

			 array(
				'name'=>'id',
				'value'=>'$data->id',
				'headerHtmlOptions'=>array('width'=>'15'),
			),
			
			 array(
				'name'=>'createDate',
				'value'=>'H::date($data->createDate)',
                                'filter' => '',
                                'htmlOptions' => array ('class' => 'thedate'),
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'ip',
				'value'=>'$data->ip',
				'headerHtmlOptions'=>array('width'=>'50'),
			),
			
			 array(
				'name'=>'email',
				'value'=>'$data->email',
				'headerHtmlOptions'=>array('width'=>'140'),
			),
			
			 array(
				'name'=>'phone',
				'value'=>'$data->phone',
				'headerHtmlOptions'=>array('width'=>'140'),
			),
			
			 array(
				'name'=>'address',
				'value'=>'$data->address',
				'headerHtmlOptions'=>array('width'=>'240'),
			),
					/*

			 array(
				'name'=>'comment',
				'value'=>'$data->comment',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
					*/
		array(
			'class'=>'CButtonColumn',
                        'updateButtonOptions' => array ('style' => 'display:none'),
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>