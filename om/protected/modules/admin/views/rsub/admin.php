<?php $this->pageTitle='Список подписчиков' ?><?

$this->menu=array(
	array('label'=>'Список рассылок', 'url'=>array('maillist/index'), 'itemOptions' => array ('class' => 'rmenu_list')),        
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#rass-sub-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Управление подпиской</h3>


<h1>Управление очередью подписки</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rass-sub-grid',
        'selectableRows' => false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'rass_id' => array (
                    'name' => 'rass_id',
                    'value' => 'Rass::item ($data->rass_id)',
                    'filter' => Rass::items (),
                ),
		'user_id',
		'letter_id',
		'date' => array (
                    'name' => 'date',
                    'value' => 'date ("j.m.Y H:i:s",$data->date)',
                    'filter' => false,
                ),		
		array(
			'class'=>'CButtonColumn',
                        'viewButtonOptions' => array ('style' => 'display:none'),
                        'updateButtonOptions' => array ('style' => 'display:none'),                    
		),
	),
)); ?>

</div>