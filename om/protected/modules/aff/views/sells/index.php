<?php $this->pageTitle='Заказы - Панель партнёра' ?>

<div class="wrap">
    
    <h3>Панель партнёра</h3>
    
    <h1>Заказы</h1>
    
    <p><?=CHtml::link('Список привлечённых партнёров 2-го уровня',array ('partners/index')); ?></p>
    <p><br><?=CHtml::link('История выплат',array ('history/index')); ?></p>
    
    <?php define ('TRUSTEDP',$partner->trusted); ?>
    
    <br><?=CHtml::link('Показать только оплаченные заказы',array ('sells/index','paid' => 1)); ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'order-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
        'htmlOptions' => array('style' => 'width:680px'),        
        'rowCssClassExpression' => '((($data->status_id == "approved") OR ($data->status_id == "processing") OR ($data->status_id == "sent") OR ($data->status_id == "nalozh_ok")) AND ($data->affstat->komis==0))?"hidden":$this->rowCssClass[$row%2]',
	'columns'=>array(

			
			 array(
				'name'=>'id',
				'value'=>'$data->id',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'htmlOptions' => array ('style' => 'color:#003366; font-weight:bold'),
                                'filter' => '',
                                
			),
			
			 array(
				'name'=>'good_id',
				'value'=>'$data->good_id',
				'headerHtmlOptions'=>array('width'=>'40'),
			),
                        
			 array(				
                                'name' => 'ip',
                                'type'=>'raw',
                                'value'=>'empty($data->bill->ip)?"":"<a target=\'_blank\' href=\'http://www.geoiptool.com/en/?IP=".$data->bill->ip."\'>".$data->bill->ip."</a>"', 
				'headerHtmlOptions'=>array('width'=>'60'),
                                'filter' => '',
                                'header' => 'IP',
			),                                                
                        
			 array(				
                                'name' => 'email',
				'value'=>'(TRUSTEDP==1)?$data->bill->email:H::codemail ($data->bill->email)',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'filter' => '',
                                'header' => 'E-mail',
			),                        
                        
			 array(				
                                'name' => 'phone',
				'value'=>'(TRUSTEDP==1)?$data->bill->phone:H::codemail ($data->bill->phone)',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'htmlOptions' => array ('style' => 'color: #080'),
                                'filter' => '',
                                'header' => 'Тел.',
			),                        
                        
			
			 array(
				'name'=>'createDate',
				'value'=>'H::date($data->createDate)',
                                'filter' => '',
				'headerHtmlOptions'=>array('width'=>'40'),
                                'htmlOptions' => array ('class' => 'thedate'),
			),
			
			array(
				'name'=>'kanal',
				'value'=>'$data->kanal',
				'headerHtmlOptions'=>array('width'=>'120'),                                
                                'filter' => '',
                                'header' => 'Канал/субакк',
			),			
                        
			array(
				'name'=>'zar',                                
                                'header' => 'Заработано',
				'value'=>'empty($data->affstat->komis)?" ":$data->affstat->komis." р."',
				'headerHtmlOptions'=>array('width'=>'70'),
                                'htmlOptions' => array ('style' => 'color:#006600;'),
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

