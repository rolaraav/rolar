<?

$this->pageTitle='Журнал операций (лог)';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('letter-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>



<div class="wrap">

<h3>Журнал операций</h3>

<h1>Журнал операций (лог)</h1>

<p><a href="<?=Y::bua()?>settings/partner/log">Настройки журнала операций</a>
    <br><br><?= CHtml::link ('Очистить журнал операций',array ('log/clear'),array ('confirm'=>'Вы действительно хотите очистить журнал?')); ?></a></p>

<p>&nbsp;<br>&nbsp;</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'log-grid',
	'dataProvider'=>$model->search(),
        'selectableRows' => false,
	'filter'=>$model,
	'columns'=>array(
		'id',
		 array(
                        'name'=>'date',
			'value'=>'date("j.m.Y H:i",$data->date)',
			'headerHtmlOptions'=>array('width'=>'120'),
                        'filter' => FALSE,
                        'htmlOptions' => array ('class' => 'thedate'),
		),     
		'action' => array (
                    'name' => 'action',
                    'value' => 'Lookup::item ("log", $data->action)',
                    'filter' => Lookup::items ("log"),
                ),
		'user' => array (
                    'name' => 'user',
                    'value' => 'Staff::item ($data->user)',
                    'filter' => Staff::items (),
                    
                ),
		'comment' => array (
                    'name' => 'comment',
                    'type' => 'raw',
                    'value' => 'nl2br ($data->comment)',
                    'htmlOptions' => array ('style' => 'line-height: 170%; width: 470px;'),
                ),
		array(
			'class'=>'CButtonColumn',
                        'viewButtonOptions' => array ('style' => 'display:none'),
                        'updateButtonOptions' => array ('style' => 'display:none'),
		),
	),
)); ?>

</div>