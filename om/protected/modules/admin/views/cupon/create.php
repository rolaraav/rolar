<?php $this->pageTitle='Добавление купона скидки' ?><?

$this->menu=array(
	array('label'=>'Список купонов', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Купоны скидки</h3>

<h1>Добавление купона скидки</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>