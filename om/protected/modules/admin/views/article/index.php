<?php $this->pageTitle='Список статей базы знаний' ?><?

$this->menu=array(
	array('label'=>'Добавить статью', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
        array('label'=>'Категории статей', 'url'=>array('articlecategory/index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('article-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>База знаний</h3>

<h1>Список статей базы знаний</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'article-grid',
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
				'name'=>'category_id',
				'value'=>'ArticleCategory::item($data->category_id)',
				'filter'=>ArticleCategory::items(),

				'headerHtmlOptions'=>array('width'=>'120'),
			),
			
			 array(
				'name'=>'title',
				'value'=>'$data->title',
				'headerHtmlOptions'=>array('width'=>'210'),
			),			
			
			 array(
				'name'=>'position',
				'value'=>'$data->position',
				'headerHtmlOptions'=>array('width'=>'30'),
			),
			
			 array(
				'name'=>'createTime',
				'value'=>'date (\'j.m.Y\',$data->createTime)',
				'headerHtmlOptions'=>array('width'=>'30'),
                                'htmlOptions' => array  ('class' => 'date'),
			),
			

			 array(
				'name'=>'updateTime',
				'value'=>'date (\'j.m.Y\',$data->updateTime)',
				'headerHtmlOptions'=>array('width'=>'30'),
                                'htmlOptions' => array  ('class' => 'date2'),
			),
			 array(
				'name'=>'visible',
				'value'=>'($data->visible)?"да":"нет"',
				'headerHtmlOptions'=>array('width'=>'30'),
			),
                        
			
		array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

</div>