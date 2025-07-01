<?php $this->pageTitle='Добавление категории файлов закрытой зоны' ?><?

$this->menu=array(
	array('label'=>'Список категорий', 'url'=>array('index',array('a' => $area_id)), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Категории файлов Закрытой Зоны</h3>

<h1>Добавление новой категории для файлов Закрытой Зоны №<?=$area_id?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>