<?php $this->pageTitle='Добавление файла в Закрытую зону' ?><?

$this->menu=array(
	array('label'=>'Список файлов', 'url'=>array('index',array('a'=>$area_id)), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Файлы Закрытой Зоны</h3>

<h1>Добавление файла в Закрытую Зону</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'area_id' => $area_id)); ?>

<br><p>Примечание: файл должен быть уже загружен в папку <b>files/area/</b> - на сервере.

</div>

