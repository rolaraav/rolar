<?php $this->pageTitle='Список клиентов' ?><?

$this->menu=array(
	array('label'=>'Экспорт клиентов', 'url'=>array('export'), 'itemOptions' => array ('class' => 'rmenu_list')),
        array('label'=>'Импорт клиентов', 'url'=>array('import'), 'itemOptions' => array ('class' => 'rmenu_add')),        

);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('client-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Клиенты</h3>

<h1>Список клиентов</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'client-grid',
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
				'name'=>'good_id',
				'value'=>'$data->good_id',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'uname',
				'value'=>'$data->uname',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'email',
				'value'=>'$data->email',
				'headerHtmlOptions'=>array('width'=>'40'),
			),			
			
			array(
				'name'=>'date',
				'value'=>'H::date($data->date)',
                                'filter' => '',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'htmlOptions' => array ('class' => 'thedate'),
			),
		

			 array(
				'name'=>'subscribe',
                                'filter' => '',
				'value'=>'$data->subscribe==1?"Да":"Нет"',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'bill_id',
				'value'=>'$data->bill_id>0?CHtml::link($data->bill_id,array("bill/view","id" => $data->bill_id)):" "',
                                'type'=> 'raw',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
		
		array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
            'updateButtonOptions' => array ('style' => 'display:none'),
		),
	),
)); ?>

</div>