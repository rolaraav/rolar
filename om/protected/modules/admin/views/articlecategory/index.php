<?php $this->pageTitle='Список категорий статей Базы Знаний' ?><?

$this->menu=array(
	array('label'=>'Новая категория', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
        array('label'=>'База Знаний', 'url'=>array('article/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('article-category-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Категории статей Базы Знаний</h3>

<h1>Список категорий статей Базы Знаний</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'article-category-grid',
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
				'headerHtmlOptions'=>array('width'=>'180'),
			),
			
			 array(
				'name'=>'description',
				'value'=>'$data->description',
				'headerHtmlOptions'=>array('width'=>'240'),
			),
			
			 array(
				'name'=>'position',
				'value'=>'$data->position',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
					array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>