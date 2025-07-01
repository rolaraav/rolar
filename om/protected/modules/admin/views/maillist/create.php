<?php $this->pageTitle='Новая серия писем' ?><?

$this->menu=array(
	array('label'=>'Список рассылок', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Серии рассылок</h3>

<h1>Создание новой рассылки (серии писем) для товара</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>