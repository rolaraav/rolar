<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\support\tickets.php */ ?>
<?php $this->pageTitle='Список тикетов' ?><?

$this->menu=array(
	array('label'=>'Список отделов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('ticket-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Поддержка</h3>

<h1>Список тикетов для раздела &quot;<?=$model->section->title ?>&quot;</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<p><br />

<form method="get" action="<?=Y::bua()?>support/tickets/id/<?=$model->section_id?>">
    
    <input type="submit" value="Отменить фильтры и сортировку" />
    &nbsp; &nbsp; &nbsp;
    </form> 


</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ticket-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,        
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(
    
			 array(
				'name'=>'email',
				'value'=>'$data->email',
				'headerHtmlOptions'=>array('width'=>'40'),
			),    			
			
			 array(
				'name'=>'subject',
				'value'=>'$data->subject',
				'headerHtmlOptions'=>array('width'=>'180'),
			),
                        
			 array(		
                                'header' => 'Ответов',
				'value'=>'$data->answersCount',
				'filter'=>FALSE,
				'headerHtmlOptions'=>array('width'=>'30'),
			),                        
	
			 array(
				'name'=>'priority_id',
				'value'=>'"<span style=\'color:" . CHtml::encode (Lookup::item(\'TicketPColor\',$data->priority_id)) . "\'>" . Lookup::item("TicketPriority",$data->priority_id). "</span>"',
                                'type' => 'raw',
				'filter'=>Lookup::items('TicketPriority'),
				'headerHtmlOptions'=>array('width'=>'30'),
			),
			
			 array(
				'name'=>'status_id',
				'value'=>'Lookup::item("TicketStatus",$data->status_id)',
				'filter'=>Lookup::items('TicketStatus'),
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'updateTime',
				'value'=>'date (\'j.m.Y H:i\',$data->updateTime)',
                'filter' => FALSE,
				'headerHtmlOptions'=>array('width'=>'100'),
                'htmlOptions' => array ('class' => 'thedate'),
			),			
			
		array(
			'class'=>'CButtonColumn',
                        'htmlOptions' => array('width' => '40'),
                        'updateButtonOptions' => array ('style' => 'display:none'),
		),
	),
)); ?>

</div>