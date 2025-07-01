<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\author\views\bills\index.php */ ?>
<?php $this->pageTitle='Заказы' ?>

<div class="wrap">
    
    <h3>Панель автора</h3>
    
    <h1>Заказы Ваших товаров</h1>

<?php
    
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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
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
				'name'=>'bill_id',
				'value'=>'$data->bill_id',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'htmlOptions' => array ('style' => 'color:#003366; font-weight:bold'),
			),
			
			 array(
				'name'=>'good_id',
				'value'=>'$data->good_id',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
                        
			 array(				
                                'name' => 'email',
				'value'=>'$data->bill->email',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'filter' => '',
                                'header' => 'E-mail',
			),                        
			
			 array(
				'name'=>'createDate',
				'value'=>'H::date($data->createDate)',
                                'filter' => '',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'htmlOptions' => array ('class' => 'thedate'),
			),
			
			array(
				'name'=>'cena',
				'value'=>'$data->cena.H::valuta($data->valuta)',
				'headerHtmlOptions'=>array('width'=>'70'),
                                'htmlOptions' => array ('style' => 'color:#006600;'),
                                'filter' => '',
			),			

			 array(
				'name'=>'partner_id',
				'value'=>'$data->partner_id',
				'headerHtmlOptions'=>array('width'=>'80'),
                                'filter' => '',
			),
                        
			 array(
				'name'=>'status_id',
                                'header' => '**',
                                'type' => 'raw',
				'value'=>'CHtml::image (Y::bu()."images/status/".$data->bill->status_id.".gif")',
				'headerHtmlOptions'=>array('width'=>'36'),
                                'filter' => '',
			),			                                                					
	),
)); ?>    
    
    
</div>

<?= $this->renderPartial('//main/_statuses'); ?>