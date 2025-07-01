<?php $this->pageTitle = 'История выплат'; ?><?

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('partner-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>История выплат</h3>

<h1>История выплат партнёрам и авторам</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payout-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'selectableRows' => false,
	'columns'=>array(
		'id' => array (
                    'name' => 'id',
                    'value' => '$data->id',
                    'headerHtmlOptions' => array ('style' => 'width:20px'),
                ),
		'kind' => array (
                   'name' => 'kind',
                   'value' => '($data->kind=="partner")?"партнёр":"автор"',
                   'filter' => array ('partner' => 'Партнёр','author' => 'Автор'),                   
                   'headerHtmlOptions' => array ('style' => 'width:70px'),
                ),
		'date' => array (
                    'name' => 'date',
                    'filter' => FALSE,
                    'value' => 'date ("j.m.Y H:i", $data->date)',
                    'htmlOptions' => array ('style' => 'color:#036'),
                    'headerHtmlOptions' => array ('style' => 'width:100px'),
                ),
		'theid' => array (
                    'name' => 'theid',
                    'value' => '$data->theid',
                    'headerHtmlOptions' => array ('style' => 'width:130px'),                    
                ),
		'way',
                'rekv',
		'sum' => array (
                    'name' => 'sum',
                    'value' => '$data->sum . H::valuta($data->valuta)',                    
                ),
		array(
			'class'=>'CButtonColumn',
                        'viewButtonOptions' => array ('style' => 'display:none'),
                        'updateButtonOptions' => array ('style' => 'display:none'),
		),
	),
)); ?>

</div>