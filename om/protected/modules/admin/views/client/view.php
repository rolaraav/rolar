<?php $this->pageTitle='Просмотр клиента' ?><?

$this->menu=array(
	array('label'=>'Список клиентов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Удалить клиента', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Клиенты</h3>

<h1>Просмотр клиента №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'good_id',
		'uname',
		'email',
		'amail',
		'date' => array (
                    'label' => 'Дата',
                    'value' => H::date ($model->date),
                 ),
		'subscribe' => array (
                    'label' => 'Получать рассылку?',
                    'value' => ($model->subscribe==1)?"Да":"Нет",
                ),            
		'bill_id' => array(
                    'label' => 'Номер счёта',
                    'value' => $model->bill_id>0?CHtml::link($model->bill_id,array("bill/view","id" => $model->bill_id)):" ",
                ),
	),
)); ?>

</div>
