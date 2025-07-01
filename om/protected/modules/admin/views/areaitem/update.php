<?php $this->pageTitle='Изменение файла в Закрытой Зоне' ?><?php

$this->menu=array(
	array('label'=>'Список файлов', 'url'=>array('index',array ('a'=> $area_id)), 'itemOptions' => array ('class' => 'rmenu_list')),
	array('label'=>'Добавить файл', 'url'=>array('create',array ('a'=> $area_id)), 'itemOptions' => array ('class' => 'rmenu_add')),
	array('label'=>'Просмотр файла', 'url'=>array('view', 'id'=>$model->id),
    						'itemOptions' => array ('class' => 'rmenu_view')),
);
?>

<div class="wrap">

<h3>Файлы Закрытой Зоны</h3>

<h1>Изменение файла &quot;<?php echo $model->title; ?>&quot;</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'area_id' => $area_id)); ?>
</div>