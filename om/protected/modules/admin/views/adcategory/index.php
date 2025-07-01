<?php $this->pageTitle='Список категорий рекламных материалов' ?><?php
$this->menu=array(
        array('label'=>'Материалы', 'url'=>array('ad/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Новая категория', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ad-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Категории рекламных материалов</h3>

<h1>Список категорий рекламных материалов</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ad-category-grid',
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
				'headerHtmlOptions'=>array('width'=>'540'),
			),			
					array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>