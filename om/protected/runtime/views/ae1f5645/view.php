<?php /* source file: D:\YandexDisk\OpenServer\domains\test\om\protected\modules\admin\views\author\view.php */ ?>
<?php $this->pageTitle='Просмотр автора' ?><?

$this->menu=array(
	array('label'=>'Список авторов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить автора', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить автора', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить автора', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Авторы</h3>

<h1>Просмотр автора #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'password',
		'email',
		'uname',
		'total' => array (
                    'label' => 'Начислено',
                    'value' => $model->total.' р.',
                ),
		'paid' => array (
                    'label' => 'Выплачено',
                    'value' => $model->paid.' р.',
                ),
		'purse',
		'kind' => array (
                    'label' => 'Тип кошелька',
                    'value' => Lookup::item ('Purse',$model->kind),
                ),
	),
)); ?>

</div>
