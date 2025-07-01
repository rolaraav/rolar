<?php $this->pageTitle='Новая страничка' ?><?

$this->menu=array(
	array('label'=>'Список страничек', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Странички</h3>

<h1>Создание новой странички</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>