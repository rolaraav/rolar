<?php

$this->pageTitle = 'Просмотр очереди писем';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('queue-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

$this->menu=array(
        array('label'=>'Разослать сейчас', 'url'=>array('send'), 'itemOptions' => array ('class' => 'rmenu_base')),
	array('label'=>'Очистить очередь', 'url'=>'#', 'linkOptions'=>array('submit'=>array('clean'),'confirm'=>'Очистить всю очередь? Эту процедуру отменить невозможно!'), 'itemOptions' => array ('class' => 'rmenu_del')),
);

?>

<div class="wrap">

<h1>Очередь писем</h1>

<?php echo CHtml::link('Поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'queue-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'selectableRows' => FALSE,
	'columns'=>array(
		'id',
		'email',
		'format' => array (
			'name' => 'format',
			'value' => '($data->format=="html")?"HTML":"Обычный"',
			'headerHtmlOptions' => array ('style' => 'width:40px'),
		),
		'subject' => array (
			'name' => 'subject',
			'value' => '$data->subject',
			'headerHtmlOptions' => array ('style' => 'width:300px'),
		),
		'priority',
		array(
			'class'=>'CButtonColumn',
			'updateButtonOptions' => array ('style' => 'display:none'),
		),
	),
)); ?>

</div>