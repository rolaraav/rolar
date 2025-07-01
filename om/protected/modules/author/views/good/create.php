<?php $this->pageTitle='Добавление товара' ?><?

$this->menu=array(
	array('label'=>'Список товаров', 'url'=>array('index'), 'itemOptions' => array ('class' => 'rmenu_list')),
);
?>

<div class="wrap">

<h3>Панель автора</h3>

<h1>Добавление товара</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>