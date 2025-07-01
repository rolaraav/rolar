<?php $this->pageTitle='Список участников' ?><?


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('area-user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Участники Закрытой Зоны</h3>

<h1>Список участников Закрытой Зоны №<?=$model->area_id?></h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'area-user-grid',
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
				'name'=>'username',
				'value'=>'$data->username',
				'headerHtmlOptions'=>array('width'=>'40'),
			),

			 array(
				'name'=>'email',
				'value'=>'$data->email',
				'headerHtmlOptions'=>array('width'=>'240'),
			),

						
			 array(
				'name'=>'createDate',
				'value'=>'date(\'j.m.Y\',$data->createDate)',
				'headerHtmlOptions'=>array('width'=>'40'),
			),					
			
			 array(
				'name'=>'payTill',
				'value'=>'date(\'j.m.Y\',$data->payTill)',
				'headerHtmlOptions'=>array('width'=>'40'),
			),			
			
		array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>