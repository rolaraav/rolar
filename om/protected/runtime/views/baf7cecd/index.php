<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\bill\index.php */ ?>
<?php $this->pageTitle='Список счетов';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('bill-grid', {
		data: $(this).serialize()
	});
	return false;
});
");


?>

<div class="wrap">

<h3>Счета</h3>

<h1>Счета</h1>

<br><p><img src="<?=Y::bu()?>images/status/approved.gif" style="vertical-align: middle"> <?=CHtml::link ('Показать только оплаченные счета',array ('bill/index/paid/1'))?> <br><br>    
    <img src="<?=Y::bu()?>images/status/nalozh.gif" style="vertical-align: middle"> <?=CHtml::link ('Показать только ожидающие подтверждения наложенного платежа',array ('bill/index/wait/1'))?> <br><br>
<img src="<?=Y::bu()?>images/status/processing.gif" style="vertical-align: middle"> <?=CHtml::link ('Показать только счета за товары, ожидающие отправки по почте',array ('bill/index/send/1'))?></p>


<br>
<?= CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<form method="post">
    
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'bill-grid',
	'dataProvider'=>$model->search(),
   	'selectableRows' => false,
	'filter'=>$model,
        'htmlOptions' => array('style' => 'width:890px'),        
	'columns'=>array(
            
                        array (
                            'class' => 'CCheckBoxColumn',
                            'checkBoxHtmlOptions' => array ('class' => 'checkbox'),
                            'selectableRows' => 2,
                            'id' => 'bills',
                        ),

			 array(
				'name'=>'id',
                                'type'=>'raw',
				'value'=>'CHtml::link($data->id,array("bill/view/id/".$data->id),array("style"=>"color:#003366; font-weight:bold"))',
				'headerHtmlOptions'=>array('width'=>'25'),
                                'htmlOptions' => array ('style' => 'color:#003366; font-weight:bold'),
			),
                        
			 array(
				'name'=>'uname',
				'value'=>'trim ($data->surname . " " .$data->uname . " " . $data->otchestvo)',
				'headerHtmlOptions'=>array('width' => '15%'),
			),                        			
                        
                        
                        
                        
			 array(
                                'header' => 'E-mail/телефон',
				'name'=>'email',                            
                                'type' => 'raw',
				'value'=>'nl2br(CHtml::encode(str_replace ("noemail@example.com\r\n","",$data->email."\r\n")))."<span style=\'color:#036\'>".trim (CHtml::encode(str_replace ("нет","",$data->phone)))."</span>"',
				'headerHtmlOptions'=>array('width' => '150'),
			),                        			
                        
			array(
                                'header' => 'Товары',
				'value'=>'H::compOrders ($data->orders)',
                                'type' => 'raw',
				'headerHtmlOptions'=>array('width' => '50'),
                                'htmlOptions' => array ('style' => 'color:#660066; font-size: 10px;'),
			),                        
                        
			 array(
				'name'=>'gorod',
				'value'=>'trim ($data->gorod).(($data->curier==1)?" [курьер]":"")',
				'headerHtmlOptions'=>array('width' => '15%'),
			),                        			
                        
 			
			 array(
				'name'=>'sum',
				'value'=>'$data->sum.H::valuta($data->valuta)',				
				'headerHtmlOptions'=>array('width'=>'60'),
                                'htmlOptions' => array ('style' => 'color:#006600; font-weight:700'),
			),
                        
			 array(
				'name'=>'orderCount',
                                'type' => 'raw',
				'value'=>'CHtml::link("<b>".$data->orderCount."</b>",array (\'order/index?Order[bill_id]=\'.$data->id),array(\'target\' => \'_blank\',"style" => "padding:10px;"))',
				'headerHtmlOptions'=>array('width'=>'40'),
			),                        
                        
			 array(
				'name'=>'createDate',
				'value'=>'date("j.m.Y H:i",$data->createDate)',
				'headerHtmlOptions'=>array('width'=>'100'),
                                'filter' => FALSE,
                                'htmlOptions' => array ('class' => 'thedate'),
			),                        			

			 array(
				'name'=>'way',
				'value'=>'$data->way',
				'htmlOptions'=>array('width'=>'50','style' => 'font-size: 10px'),
                                'filter' => FALSE,
			),                        			
			
			 array(
				'name'=>'status_id',
                                'header' => '**',
                                'type' => 'raw',
				'value'=>'CHtml::image (Y::bu()."images/status/".$data->status_id.".gif",Lookup::item("Status",$data->status_id),array("title" => Lookup::item("Status",$data->status_id)))',
				'headerHtmlOptions'=>array('width'=>'16'),
			),			
			
			
		array(
			'class'=>'CButtonColumn',
                        'htmlOptions' => array('width' => '40'),
                        'updateButtonOptions' => array ('style' => 'display:none; width:1px;'),
                        'viewButtonOptions' => array ('style' => 'margin-right:0px; padding:3px;'),
		),
	),
)); ?>

<br>
<div class="dolist">
<select name="operation">
<option value="excel">Экспортировать выбранные в Excel-файл</option>
<option value="excelall">Экспортировать <?=$napis?> в Excel-файл</option>
<option value="mail">Разослать сообщение</option>
<option value="sent">Заказы отправлены (по предоплате или наложенным)</option>
<option value="pay">Поступила оплата (оплата вручную или за наложенный платёж)</option>
<option value="cancel">Отменить выбранные счета</option>
<option value="delete">Удалить выбранные счета</option>
</select>
<input type="submit" class="submit" value="Выполнить действие">
<br>&nbsp;
</form>
</div>


</div>

<?= $this->renderPartial('//main/_statuses'); ?>