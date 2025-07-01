<?php $this->pageTitle='Список операторов' ?><?

$this->menu=array(
	array('label'=>'Новый оператор', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
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

<h3>Операторы</h3>

<h1>Список операторов</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'staff-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(

			 array(
				'name'=>'username',
				'value'=>'$data->username',
				'headerHtmlOptions'=>array('width'=>'120'),
			),            
			
			array(
				'name'=>'firstName',
				'value'=>'$data->firstName',
				'headerHtmlOptions'=>array('width'=>'120'),
			),
			
			 array(
				'name'=>'email',
				'value'=>'$data->email',
				'headerHtmlOptions'=>array('width'=>'120'),
			),
            			
					array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>