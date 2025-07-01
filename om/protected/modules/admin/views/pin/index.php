<?php

$this->pageTitle = 'PIN-коды';

$this->menu=array(	
	array('label'=>'Список категорий', 'url'=>array('pincat/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('pin-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h1>Управление PIN-кодами</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pin-grid',
        'selectableRows' => false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'pincat_id' => 			 array(
				'name'=>'pincat_id',
				'value'=>'Pincat::item($data->pincat_id)',
                                'filter'=>false,
				'headerHtmlOptions'=>array('width'=>'70'),
                ),                        
                        
		'added' =>  array(
				'name'=>'added',
				'value'=>'date("j.m.Y H:i",$data->added)',
				'headerHtmlOptions'=>array('width'=>'100'),
                                'filter' => FALSE,
                                'htmlOptions' => array ('class' => 'thedate'),
			),                        			

                'code',
                array(
				'name'=>'used',
				'value'=>'Lookup::item("Visible",$data->used)',
				'filter'=>Lookup::items('Visible'),
				'headerHtmlOptions'=>array('width'=>'80'),
			),
		'client_id',				
		array(
			'class'=>'CButtonColumn',
                        'viewButtonOptions' => array ('style' => 'display:none'),
                        'updateButtonOptions' => array ('style' => 'display:none'),
		),
	),
)); ?>

</div>