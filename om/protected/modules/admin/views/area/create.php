<?php $this->pageTitle='Добавление Закрытой зоны' ?><?

$this->menu=array(
	array('label'=>'Список зон', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Закрытые зоны</h3>

<h1>Добавление Закрытой зоны</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,)); ?>
</div>