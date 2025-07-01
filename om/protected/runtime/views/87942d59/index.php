<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\pincat\index.php */ ?>
<?php $this->pageTitle='Список категорий пин-кодов' ?><?

$this->menu=array(
	array('label'=>'Новая категория', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('plink-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Категории пин-кодов</h3>

<h1>Управление категориями пин-кодов</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pincat-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'selectableRows' => FALSE,
	'columns'=>array(
		'id',
		'title',
                array (
                    'header' => 'Просмотреть пин-коды',
                    'type' => 'raw',
                    'value' => 'CHtml::link ("просмотреть",array ("pin/index/cat/".$data->id))',
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

<p style="font-size:10px; color: #555;">Подсказка. Чтобы использовать PIN-коды - вставьте в текст письма товара макрос вида <b>{PIN_ЧИСЛО}</b> - где вместо ЧИСЛО - ID категории. Например <b>{PIN_7}</b> - будет браться один неиспользованный ближайший код из категории 7.</p>

</div>