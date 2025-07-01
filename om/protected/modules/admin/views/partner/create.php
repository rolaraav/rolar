<?php $this->pageTitle='Добавление партнёра' ?><?

$this->menu=array(
	array('label'=>'Список партнёров', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Партнёры</h3>

<h1>Добавление партнёра</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>