<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\views\status\index.php */ ?>
<?php $this->pageTitle='Состояние Вашего заказа #'.$model->id ?>

<div class="wrap">
    
    <h3>Информация о счёте</h3>
    
    <h1>Состояние Вашего заказа №<?=$model->id?></h1>
    
    <p align="center" style="font-size:16px">Текущий статус счёта:<br><br>
        
        <img src="<?=Y::bu()?>images/status/<?=$model->status_id?>.gif"><br><br><b>&quot;<?=Lookup::item('Status',$model->status_id) ?>&quot;</b> </p>
        
        <br><br>    
    <p>Дата последнего изменения заказа: <span class="date"><?=($model->lastDate>0)?H::date($model->createDate):H::date($model->lastDate)?></span></p>
    
    <br><br>
    
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(		
		'createDate' => array (
                    'label' => 'Дата создания',
                    'value' => H::date ($model->createDate),
                ),
		'sum' => array (
                    'label' => 'На сумму',
                    'value' => H::mysum ($model->sum).H::valuta ($model->valuta),
                ),            
            
                array (
                    'label' => 'Ссылка на оплату:',
                    'type'  => 'raw',
                    'value' => CHtml::link ('перейти',Y::bu().'bill/index?bill_id='.$model->id.'&hash='.Bill::hashBill($model->id),array ('target' => '_blank')),
                    'visible' => ($model->status_id == 'waiting')?TRUE:FALSE,
                ),
                'sp0'=> array ('label' => '','type'=>'raw','value' => '&nbsp;'),
		array (
                    'label' => 'Оплата вручную',
                    'type' =>'raw',
                    'value' => '<a target="_blank" href="'.$notify.'">сообщить о совершении оплаты вручную прямым переводом</a>',
                    'visible' => ($model->status_id == 'waiting')?TRUE:FALSE,
                ),                        
                'sp1'=> array ('label' => '','type'=>'raw','value' => '&nbsp;','visible' => ($model->status_id == 'waiting')?TRUE:FALSE),
		'email',
		'amail',            
		
                'sp'=> array ('label' => '','type'=>'raw','value' => '&nbsp;'),			

		'surname',
		'uname',            
		'otchestvo',
            
		'strana',
		'region',
		'gorod',
            
		'postindex',
            
		'address',
            
		'phone',
            
                'sp3'=> array ('label' => '','type'=>'raw','value' => '&nbsp;'),			
		'curier' => array (
                    'label' => 'Доставка курьером',
                    'value' => Lookup::item('Visible',$model->curier+0),
                ),      
                'comment' => array (
                    'label' => 'Комментарий',
                    'value' => $model->comment,
                ),
            
		'ip',            

                'sp2'=> array ('label' => '','type'=>'raw','value' => '&nbsp;'),			            
            
		'postNumber',            

		'orderCount',		
	),
)); ?>    
        
    
    <br><br>
    
    <p><b>Заказанные товары:</b></p>
    
    <?php $orders = $model->orders; ?>
    <ul>
    <?php foreach ($orders as $order): ?>
    
    <li><?=$order->good->title?></li>
    
    <?php endforeach; ?>
    </ul>
    
    
    
</div>