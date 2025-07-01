<?php $this->pageTitle='Просмотр файла Закрытой Зоны' ?><?

$this->menu=array(
	array('label'=>'Список файлов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить файл', 'url'=>array('create'), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Изменить файл', 'url'=>array('update', 'id'=>$model->id), 'itemOptions' => array ('class' => 'rmenu_edit')),
	array('label'=>'Удалить файл', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),
    			'confirm'=>'Вы действительно хотите удалить эту запись?'),'itemOptions' => array ('class' => 'rmenu_del')),
);
?>

<div class="wrap">

<h3>Файлы закрытой зоны</h3>

<h1>Просмотр файла #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',		
		'area_section_id' => array (
                    'label' => 'Категория',
                    'value' => AreaSection::item ($model->area_section_id,$model->section->area_id)
                ),
		'title',
		'description',
		'icon',
		'uploadDate' => array (
                    'label' => 'Дата загрузки',
                    'value' => date ('j.m.Y H:i',$data->uploadDate),
                ),
		'filename',
		'position',
		'size',
	),
)); ?>

</div>
