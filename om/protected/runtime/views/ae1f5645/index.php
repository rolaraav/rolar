<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\author\index.php */ ?>
<?php $this->pageTitle='Список авторов' ?><?

$this->menu=array(
	array('label'=>'Добавить автора', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('author-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Авторы</h3>

<h1>Список авторов</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'author-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(

			 array(
				'name'=>'id',
				'value'=>'$data->id',
				'headerHtmlOptions'=>array('width'=>'60'),
			),			
			
			 array(
				'name'=>'email',
				'value'=>'$data->email',
				'headerHtmlOptions'=>array('width'=>'340'),
			),			
			
			 array(
				'name'=>'total',
				'value'=>'H::mysum($data->total).\' р.\'',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'paid',
				'value'=>'H::mysum($data->paid).\' р.\'',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
                        
		array(
			'class'=>'CButtonColumn',
            'htmlOptions' => array('width' => '62'),
		),
	),
)); ?>

<p><b>Ссылка на авторскую панель:</b> <a href="<?=Yii::app()->getBaseUrl (TRUE)?>/author/" target="_blank"><?=Yii::app()->getBaseUrl (TRUE)?>/author/</a></p>

</div>