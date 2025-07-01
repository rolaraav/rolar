<?php $this->pageTitle='Список системных писем' ?><?

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('letter-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Системные письма</h3>

<h1>Список системных писем</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'letter-grid',
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
				'name'=>'description',
				'value'=>'$data->description',
				'headerHtmlOptions'=>array('width'=>'380'),
			),			
			
			 array(
				'name'=>'lon',
				'value'=>'Lookup::item("Visible",$data->lon)',
				'filter'=>Lookup::items('Visible'),
				'headerHtmlOptions'=>array('width'=>'50'),
			),
					array(
			'class'=>'CButtonColumn',
            'deleteButtonOptions' => array ('style' => 'display:none'),
            
            'htmlOptions' => array('width' => '44'),
		),
	),
)); ?>

</div>