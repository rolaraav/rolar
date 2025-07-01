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
	$('#rass-user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Подписчики серий писем</h3>


<h1>Управление подписчиками</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'rass-user-grid',
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
		'uname',
		'email',
		'sub' => array (
                    'name' => 'sub',
                    'value' => 'Lookup::item ("Visible",$data->sub)',
                    'filter' => Lookup::items ("Visible"),
                ),
		'date' => array (
                    'name' => 'date',
                    'value' => 'date ("j.m.Y H:i:s",$data->date)',
                    'filter' => false,
                ),		
		'unsubdate' => array (
                    'name' => 'unsubdate',
                    'value' => '$data->unsubdate>0?date ("j.m.Y H:i:s",$data->unsubdate):""',
                    'filter' => false,
                ),
		array(
			'class'=>'CButtonColumn',
                        'viewButtonUrl' => 'array ("rsub/index?RassSub[user_id]=".$data->id)',
                        'updateButtonOptions' => false,
		),
	),
)); ?>

</div>