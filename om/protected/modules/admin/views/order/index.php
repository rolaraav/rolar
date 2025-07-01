<?php $this->pageTitle='Список заказов' ?><?

$this->menu=array(
	array('label'=>'Счета', 'url'=>array('bill/index'), 'itemOptions' => array ('class' => 'rmenu_list')),	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('order-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="wrap">

<h3>Заказы</h3>

<h1>Список заказов</h1>

<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<form method="post">

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
    'htmlOptions' => array('style' => 'width:680px'),
	'columns'=>array(
        
                        array (
                            'class' => 'CCheckBoxColumn',
                            'checkBoxHtmlOptions' => array ('class' => 'checkbox'),
                            'selectableRows' => 2,
                            'id' => 'orders',
                        ),        

			 array(
				'name'=>'id',
				'value'=>'$data->id',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
			
			 array(
				'name'=>'bill_id',
                                'type' => 'raw',
				'value'=>'CHtml::link($data->bill_id,array("bill/view/id/".$data->bill_id))',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'htmlOptions' => array ('style' => 'color:#CC0000; font-weight:bold'),
			),
			
			 array(
				'name'=>'good_id',
				'value'=>'$data->good_id',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
                        
			 array(
                                'header' => 'E-mail',
				'value'=>'$data->bill->email',
				'headerHtmlOptions'=>array('width'=>'240'),
			),                        
			
			 array(
				'name'=>'createDate',
				'value'=>'H::date($data->createDate)',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'htmlOptions' => array ('class' => 'thedate'),
			),
			
			 array(
				'name'=>'cena',
				'value'=>'$data->cena.H::valuta($data->valuta)',				
                                'htmlOptions' => array ('style' => 'color:#006600; font-weight:700'),
				'headerHtmlOptions'=>array('width'=>'50'),
			),
                        
			 array(
				'name'=>'kanal',
				'value'=>'$data->kanal',
				'headerHtmlOptions'=>array('width'=>'40'),
			),                        

			 array(
				'name'=>'partner_id',				
                                'type' => 'raw',
				'value'=>'CHtml::link($data->partner_id,array (\'partner/view/id/\'.$data->partner_id),array(\'target\' => \'_blank\'))',
				'headerHtmlOptions'=>array('width'=>'40'),
			),					
                        
			 array(
				'name'=>'status_id',
                                'header' => '**',
                                'type' => 'raw',
				'value'=>'CHtml::image (Y::bu()."images/status/".$data->status_id.".gif")',
				'headerHtmlOptions'=>array('width'=>'16'),
			),			                        
	),
)); ?>

<br>
<div class="dolist">
<select name="operation">
<option value="excel">Экспортировать выбранные заказы в Excel-файл</option>
</select>
<input type="submit" class="submit" value="Выполнить действие">
<br>&nbsp;
</form>

</div>

<?= $this->renderPartial('//main/_statuses'); ?>