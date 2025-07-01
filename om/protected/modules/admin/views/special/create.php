<?php $this->pageTitle='Добавление скидки' ?><?

$this->menu=array(
	array('label'=>'Список скидок', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Специальные скидки</h3>

<h1>Добавление скидки</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>