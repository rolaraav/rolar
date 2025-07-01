<?php $this->pageTitle='Список специальных скидок' ?><?

$this->menu=array(
	array('label'=>'Добавить скидку', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('staff-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Специальные скидки</h3>

<h1>Список специальных скидок</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'special-grid',
        'selectableRows' => false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'good_id',
		'newgood_id',
		'sum' => array (
                    'name' => 'sum',
                    'value' => '$data->sum.H::valuta($data->valuta)',
                ),		
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
