<?php $this->pageTitle='Выплаты' ?>

<div class="wrap">

<h3>Выплаты</h3>

<h1>Выплаты партнёрам и авторам</h1>

<?=CHtml::link ('История выплат',array ('payhistory/index')); ?>

<?php $minsum = Settings::item ('affMin'); define ('A_MIN_SUM',$minsum); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'partner-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>NULL,
        'htmlOptions' => array('style' => 'width:680px'),
        'rowCssClassExpression' => '(($data->total-$data->paid) >= A_MIN_SUM)?(($row%2)?"even":"odd"):"hidden"',
	'columns'=>array(

			 array(
				'name'=>'id',
                                'type'=>'raw',
				'value'=>'CHtml::link ($data->id,array("partner/view","id" => $data->id),array ("target" => "_blank"))',
                                'header' => 'RefID',
				'headerHtmlOptions'=>array('width'=>'100'),                                
			),

			 array(
				'name'=>'ways',
				'value'=>'Payouta::ways ($data->wmz,$data->wmr,$data->rbkmoney,$data->yandex,$data->zpayment)',
                                'header' => 'Способы выплаты',
				'headerHtmlOptions'=>array('width'=>'340'),
			),

			 array(
				'name'=>'total',
				'value'=>'H::mysum($data->total-$data->paid).\' р.\'',
                            'header' => 'Сумма',
				'headerHtmlOptions'=>array('width'=>'40'),
			),

		array(
			'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'42'),
                        'updateButtonOptions' => array ('style' => 'display:none'),
                        'deleteButtonOptions' => array ('style' => 'display:none'),
                        
		),
	),
)); ?>

<br>
<?=H::moredivAll ('выплаты авторам'); ?>
<br>

<h1>Выплаты авторам</h1>


<br><br>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'author-grid',
	'dataProvider'=>$amodel->search(),
   	'selectableRows' => false,
	'filter'=>NULL,
    'htmlOptions' => array('style' => 'width:680px'),    
	'columns'=>array(

			 array(
				'name'=>'id',
                                'type'=>'raw',
				'value'=>'CHtml::link ($data->id,array("author/view","id" => $data->id),array ("target" => "_blank"))',
                                'header' => 'ID автора',
				'headerHtmlOptions'=>array('width'=>'100'),
			),

			 array(
				'name'=>'ways',
				'value'=>'Lookup::item("Purse",$data->kind)',
                                'header' => 'Способы выплаты',
				'headerHtmlOptions'=>array('width'=>'340'),
			),

			 array(
				'name'=>'total',
				'value'=>'H::mysum($data->total-$data->paid).\' р.\'',
                            'header' => 'Сумма',
				'headerHtmlOptions'=>array('width'=>'40'),
			),

		array(
			'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'42'),
                        'updateButtonOptions' => array ('style' => 'display:none'),
                        'deleteButtonOptions' => array ('style' => 'display:none'),
                        'viewButtonUrl' => 'Y::bu()."admin/payouts/aview/id/".$data->id',
                        
		),
	),
)); ?>

</div>

</div>