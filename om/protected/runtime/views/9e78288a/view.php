<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\staff\view.php */ ?>
<?php $this->pageTitle='Просмотр оператора' ?><?

$this->menu=array(
	array('label'=>'Список операторов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить оператора', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить оператора', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Права доступа', 'url'=>array('staffaccess/index', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_access'),'visible'=> ($model->id!=1) ),    
	array('label'=>'Удалить оператора', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы действительно хотите удалить эту запись?'),
	    'itemOptions' => array ('class' => 'rmenu_del')
    ),
    		
);
?>

<div class="wrap">

<h3>Операторы</h3>

<h1>Просмотр оператора &quot;<?php echo $model->username; ?>&quot;</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
		'firstName',
		'email',
		array ('label' => 'Роль','value' => ($model->id==1)?'Администратор':'Оператор'),
		'space3' => array ('label' => '&nbsp;', 'value' => ' '),
         array(
            'label'=>'Последний вход',
            'value'=>date ('j.m.Y H:i',$model->lastLogin),
        ),		
		'lastLoginIp',
	),
)); ?>

</div>
